<?php
/**
 * Arfooo
 * 
 * @package    Arfooo
 * @copyright  Copyright (c) Arfooo Annuaire (fr) and Arfooo Directory (en)
 *             by Guillaume Hocine (c) 2007 - 2010
 *             http://www.arfooo.com/ (fr) and http://www.arfooo.net/ (en)
 * @author     Guillaume Hocine & Adrian Galewski
 * @license    http://creativecommons.org/licenses/by/2.0/fr/ Creative Commons
 */


class Admin_SiteController extends AppController
{
    /**
     * set access privileges
     */
    function init()
    {
        $this->acl->allow("administrator", $this->name, "*");

        if (!$this->acl->isAllowed($this->session->get("role"), $this->name, $this->action)) {
            $this->redirect(AppRouter::getRewrittedUrl("/admin/main/logIn"));
        }
    }

    /**
     * Delete site
     */
    function deleteAction($siteId, $categoryRedirect = false)
    {
        $referer = $this->request->getRefererUrl();

        if ($categoryRedirect) {
            $site = $this->site->findByPk($siteId);

            if (!empty($site)) {
                $referer = AppRouter::getRewrittedUrl("/admin/category/index/" . $site->categoryId);
            }
        }

        $this->site->delByPk($siteId);

        $this->redirect($referer);
    }

    /**
     * Update site state from waiting sites
     */
    function updateSiteStateAction()
    {
        //check that siteid is set and status is valid
        if (!empty($this->request->siteIds)
            && in_array($this->request->status, array("validated",
                                                      "banned",
                                                      "refused"))
        ) {
            $siteIds = $this->request->siteIds;
            $status = $this->request->status;

            $mailer = Mailer::getInstance();

            //get sites which status code should be changed
            $c = new Criteria();
            $c->add("siteId", $siteIds, "IN");
            $sites = $this->site->findAll($c, "*", true);

            foreach ($sites as $site) {
                $site['status'] = $status;
                $customSubject = false;
                $customDescription = false;
                $siteId = $site['siteId'];

                //if admin select custom message copy it to mail message
                if ($this->request->emailType[$siteId] == "custom") {
                    $customSubject = $this->request->subject[$siteId];
                    $customDescription = $this->request->description[$siteId];
                }

                //send mail with state update
                if (Config::get("informWebmastersForAdminValidateDecision") && $status == "validated"
                    || Config::get("informWebmastersForAdminBanDecision") && $status == "banned"
                    || Config::get("informWebmastersForAdminRefuseDecision") && $status == "refused"
                ) {
                    $mailer->sendSiteStateUpdate($site['webmasterEmail'], $site, $customSubject, $customDescription);
                }
            }

            if ($status == "refused") {
                //delete site
                $this->site->del($c);

                //update refusing stats
                $this->refusal->updateRefusedSitesCount(0, count($sites));
            } else {
                //set page moderator id 0 = admin
                $this->site->update(array("status" => $status,
                                           "moderatorId" => 0,
                                           "_creationDate" => "NOW()"),
                                    $c);
            }
        }

        $this->redirect($this->moduleLink("waiting"));
    }

    /**
     * Display waiting pages
     */
    function waitingAction($page = 1)
    {
        $emailMessages = $this->customMessage->getUserDefinedMessages();
        $this->set("emailMessages", $emailMessages);
        $this->set("emailMessagesJSON", JsonView::php2js($emailMessages));

        $page = intval($page);
        $perPage = 5;

        $this->set("sites", $this->siteList->getWaitingSites(false, $page, $perPage));
        $totalCount = $this->siteList->getFoundRowsCount();

        $this->set("totalCount", $totalCount);
        $totalPages = ceil($totalCount / $perPage);
        $this->set("pageNavigation", array("baseLink" => "/admin/site/waiting/",
                                           "totalPages" => $totalPages,
                                           "currentPage" => $page));

        if ($totalCount >= $perPage) {
            $this->set("skipAutoRefresh", true);
        }
    }

    /**
     * Get webmaster data when site is editing and we change webmaster
     */
    function getWebmasterDataAction()
    {
        $c = new Criteria();
        $c->add("userId", $this->request->webmasterId);
        $c->add("role", "webmaster");
        $site = $this->user->find($c, "login, email");
        $this->set($site->toArray());
        $this->viewClass = "JsonView";
    }

    /**
     * Display site edit form
     */
    function editAction($siteId)
    {
        $this->set("siteId", $siteId);
        $c = new Criteria();
        $c->add("siteId", $siteId);

        $site = $this->site->find($c);

        if (empty($site)) {
            return $this->return404();
        }

        $package = $site->packageId ? $this->package->findByPk($site->packageId) : null;
        $this->set("package", $package);

        // Decide to display link to remove image or not
        $this->set("displayRemoveImage", ($site->imageSrc && !$site->ascreen ? true : false));

        $site->updateImageSrc(false);
        $site->categoryParentsData = $this->category->getParents($site->categoryId);

        $this->site->attachPhotos($site);
        $this->site->fillExtraFields($site);
        $this->site->attachKeywordIds($site);
        $site['additionalCategoryIds[]'] = $this->siteAdditionalCategory->getCategoryIdsBySiteId($site->siteId);

        $this->set("site", $site);
        $this->set("siteJson", JsonView::php2js($site));

        $c = new Criteria();
        $c->add("siteId", $siteId);
        $this->set("comments", $this->comment->findAll($c));

        $this->set("selectCategories", $this->category->createOptionsList());
        $c = new Criteria();
        $c->add("role", "webmaster");
        $this->set("webmasters", $this->user->getArray($c, "email"));

        $this->set("allKeywordsList", $this->keyword->generateSortedList());
        $this->set("yesNoOptions", array("0" => _t("No"), "1" => _t("Yes")));
        $this->set("priorites", range(0, 10));

        $this->set("adCriterias", $this->adCriteria->getSelectList());

        require (CODE_ROOT_DIR . "config/flags.php");
        $this->set("countryFlags", $countryFlags);

    }

    function deleteSiteImageAction($siteId)
    {
        // Typecast site's id as integer
        $siteId = (int) $siteId;

        // Get site's details
        $site = $this->site->findByPk($siteId, 'imageSrc, siteId');

        // If site's details not found then display 404 page
        if (false === $site) {
            $this->return404();
        }

        // Build site's image's full path
        $siteImage = Config::get('SITES_THUMBS_PATH') . basename($site->imageSrc);

        // If site's image exists then delete it
        if (file_exists($siteImage)) {
            unlink($siteImage);
        }

        // Set site's image's SRC as blank
        $site->imageSrc = '';

        // Update site details
        $site->save();

        // Redirect to 'edit site' page
        $this->redirect(AppRouter::getResourceUrl('/admin/site/edit/' . $siteId));
    }

    function getMetaDataAction()
    {
        $httpClient = new HttpClient();
        $metaData = $httpClient->getMetaValues($this->request->url);
        $this->set($metaData);
        $this->viewClass = "JsonView";
    }

    function getWebsiteDataAction()
    {
        $siteId = $this->request->siteId;
        $site = $this->site->findByPk($siteId);

        $site->keywordIds = $site->getKeywordIds();
        $this->set($site->toArray());
        $this->viewClass = "JsonView";
    }

    function problemAction()
    {
        $c = new Criteria();
        $c->add("problemExists", 1);
        $this->set("sites", $this->site->findAll($c));
    }

    function bannedAction($page = 1)
    {
        $itemsPerPage = 20;

        $c = new Criteria();
        $c->add('status', 'banned');
        $c->setPagination($page, $itemsPerPage);
        $c->setCalcFoundRows(true);
        $this->set('sites', $this->site->findAll($c));

        $totalPages = ceil($this->site->getFoundRowsCount() / $itemsPerPage);
        $this->set(
            'pageNavigation',
            array(
                'baseLink'    => '/admin/site/banned/',
                'totalPages'  => $totalPages,
                'currentPage' => $page
            )
        );
    }

    function searchAction()
    {
        $sites = array();

        if (!empty($this->request->searchedUrl)) {
            $sites = $this->siteSearcher->search($this->request->searchedUrl);
        }

        $this->set("sites", $sites);
    }

    function errorCodeAction()
    {
        $c = new Criteria();
        $c->add("httpCode IS NOT NULL");
        $c->add("httpCode", 200, "!=");
        $this->set("sites", $this->site->findAll($c, "siteId, siteTitle, httpCode"));
    }

    function saveSiteAction()
    {
        $this->viewClass = "JsonView";
        $edit = !empty($this->request->siteId);
        $validationOptions = array("admin" => true,
                                   "forceCategoryDuplicate" => true,
                                   "forcePossibleTender" => true);
                                   
        if ($this->request->url == "http://") {
            $this->request->url = "";
        }

        if ($edit) {
            $site = $this->site->findByPk($this->request->siteId);

            if ($site->status != "validated" && $this->request->status == "validated") {
                $site->_creationDate = "NOW()";
            }

            $package = $site->packageId ? $this->package->findByPk($site->packageId) : null;
            $errorMessage = $this->siteValidator->validate($this->request,
                                                           $site,
                                                           $validationOptions + array("package" => $package));
        } else {
            $site = new SiteRecord();
            $this->request->webmasterEmail = $this->session->get("email");
            $errorMessage = $this->siteValidator->validate($this->request, null, $validationOptions);
        }

        if ($errorMessage) {
            $status = "error";
            $this->set("status", $status);
            $this->set("message", _t($errorMessage));
            return;
        }

        $fields = array("categoryId", "webmasterName", "webmasterEmail", "webmasterId",
                        "siteTitle", "url", "rssTitle", "rssFeedOfSite", "description",
                        "returnBond", "status", "problemExists", "priority",
                        "visitsCount", "referrerTimes");

        if (Config::get("countryFlagsEnabled")) {
            array_push($fields, "countryCode");
        }

        if (Config::get("companyInfoEnabled")) {
            array_push($fields, "address", "zipCode", "city", "country", "phoneNumber", "faxNumber");
        }

        if (isset($this->request->proposalForCategory)) {
            array_push($fields, 'proposalForCategory');
        }

        if (isset($this->request->proposalForKeywords)) {
            array_push($fields, 'proposalForKeywords');
        }

        if (isset($this->request->descriptionDisplayMethod)) {
           array_push($fields, 'descriptionDisplayMethod');
        }

        $site->fromArray($this->request->getArray($fields));
        $site->searchPartnership = empty($this->request->searchPartnership) ? 0 : 1;
        $site->save();

        // store keywords, admin has no limit here
        if (!empty($this->request->keywords)) {
            $this->keywordsOfSite->storeKeywords($site->siteId, $this->request->keywords, 1000);
        }

        // save additional categories
        if (!empty($this->request->additionalCategoryIds)) {
            $c = new Criteria();
            $c->add('siteId', $site->siteId);
            $this->siteAdditionalCategory->del($c);
            foreach ($this->request->additionalCategoryIds as $categoryId) {
                $additionalCategory = new SiteAdditionalCategoryRecord(
                    array (
                        'siteId'     => $site->siteId,
                        'categoryId' => $categoryId
                    )
                );
                $additionalCategory->save();
            }
            $this->site->updateStats();
        }

        if (!empty($this->request->tempId)) {
            $c = new Criteria();
            $c->add("tempId", $this->request->tempId);

            $this->photo->update(array("itemId" => $site->siteId, "_tempId" => "NULL"), $c);
            $site->updatePhotos();
        }

        $this->extraField->saveExtraFieldsValues($site, $this->request);
        $site->updateSuffix();

        $this->set("status", "ok");
        $this->set("message", _t("The site was successfully submitted."));
        $this->set("redirectUrl", AppRouter::getRewrittedUrl("/admin/category/index/" . $site->categoryId));
    }

    function uploadSiteImageAction($siteId)
    {
        $this->viewClass = 'JsonView';
        $siteId = intval($siteId);
        $site = $this->site->findByPk($siteId);

        $siteImage = new UploadedFile("siteImage");
        $siteImage->addFilter("extension", array("jpg", "png", "gif"));
        $thumbsPath = Config::get("SITES_THUMBS_PATH");
        $siteImage->setSavePath($thumbsPath);
        $siteImage->save();
        $newImageSrc = $siteImage->getSavedFileName();

        if ($newImageSrc) {
            if ($site->imageSrc) {
                $oldFilePath = $thumbsPath . basename($site->imageSrc);

                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            $site->imageSrc = $newImageSrc;
            $site->save();
        }

        $site->updateImageSrc(false);

        $this->set('status', 'ok');
        $this->set('imageSrc', $site->imageSrc);
    }

    function banSiteAction()
    {
        $this->set("bannedSites", $this->bannedSite->getArray(null, "site"));
    }

    function saveNewSiteBanAction()
    {
        $bannedSites = preg_split("#\r?\n#", $this->request->bannedSites);
        foreach ($bannedSites as $site) {
            $site = trim($site);
            if (empty($site)) {
                continue;
            }
            $bannedSite = new BannedSiteRecord();
            $bannedSite->site = $site;
            $bannedSite->save();
        }

        $this->redirect($this->moduleLink("banSite"));
    }

    function deleteSiteBanAction()
    {
        if (!empty($this->request->unbanSites)) {
            $c = new Criteria();
            $c->add("banId", $this->request->unbanSites, "IN");
            $this->bannedSite->del($c);
        }

        $this->redirect($this->moduleLink("banSite"));
    }

    function showGoogleMapAction($siteId)
    {
        $site = $this->site->findByPk($siteId);
        $this->set('googleMap', $site->getGoogleMap());
    }

    function setThumbAction($siteId, $type)
    {
        $site = $this->site->findByPk($siteId);
        if (empty($site)) {
            $this->return404();
        }
        try {
            switch ($type) {
                case "refresh":
                    if ($site->ascreen) {
                        $site->updateAscreen();
                    } else {
                        $site->downloadAndCacheThumb(true);
                    }
                    break;

                case "delnormal":
                    $site->deleteImage();
                    $site->updateAscreen();
                    break;

                case "delascreen":
                    $site->deleteImage();
                    $site->ascreen = 0;
                    $site->downloadAndCacheThumb(true);
                    break;
            }
        } catch (Exception $e) {

        }

        $site->save();

        $this->redirect($this->moduleLink("edit/$siteId"));
    }
}
