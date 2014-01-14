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


class Moderation_SiteController extends AppController
{
    function init()
    {
        $this->acl->allow('moderator', $this->name, "*");
        $this->acl->allow('administrator', $this->name, "*");

        if (!$this->acl->isAllowed($this->session->get("role"), $this->name, $this->action)) {
            $this->redirect(AppRouter::getRewrittedUrl("/moderation/main/logIn"));
        }
    }

    function indexAction()
    {
        $this->redirect($this->moduleLink("waiting"));
    }

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
        $this->set("pageNavigation", array("baseLink" => "/moderation/site/waiting/",
                                           "totalPages" => $totalPages,
                                           "currentPage" => $page));

        if ($totalCount >= $perPage) {
            $this->set("skipAutoRefresh", true);
        }
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

        if ($site->status == "waiting") {
            $site->keywordIds = $site->getKeywordIds();
            $this->set($site->toArray());
        }

        $this->viewClass = "JsonView";
    }

    function getWebmasterDataAction()
    {
        $c = new Criteria();
        $c->add("userId", $this->request->webmasterId);
        $c->add("role", "webmaster");
        $site = $this->user->find($c, "login, email");
        $this->set($site->toArray());
        $this->viewClass = "JsonView";
    }

    function editAction($siteId)
    {
        $this->set("siteId", $siteId);
        $c = new Criteria();
        $c->add("siteId", $siteId);
        $c->add("status", "waiting");

        $site = $this->site->find($c);

        if (empty($site)) {
            return $this->return404();
        }

        $package = $site->packageId ? $this->package->findByPk($site->packageId) : null;
        $this->set("package", $package);

        // Decide to display link to remove image or not
        $this->set("displayRemoveImage", ($site->imageSrc && !$site->ascreen ? true : false));

        $site->updateImageSrc();
        $site->categoryParentsData = $this->category->getParents($site->categoryId);

        $this->site->attachPhotos($site);
        $this->site->fillExtraFields($site);
        $this->site->attachKeywordIds($site);

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

    function updateSiteStateAction()
    {
        if (!empty($this->request->siteIds)
            && in_array($this->request->status, array("validated", "banned", "refused"))
        ) {
            $siteIds = $this->request->siteIds;
            $status = $this->request->status;

            $mailer = Mailer::getInstance();

            $c = new Criteria();
            $c->add("status", "waiting");
            $c->add("siteId", $siteIds, "IN");
            $sites = $this->site->findAll($c, "*", true);

            foreach ($sites as $site) {
                $site['status'] = $status;
                $customSubject = false;
                $customDescription = false;
                $siteId = $site['siteId'];

                if ($this->request->emailType[$siteId] == "custom") {
                    $customSubject = $this->request->subject[$siteId];
                    $customDescription = $this->request->description[$siteId];
                }

                $mailer->sendSiteStateUpdate($site['webmasterEmail'], $site, $customSubject, $customDescription);
            }

            if ($status == "refused") {
                $this->site->del($c);
                $this->refusal->updateRefusedSitesCount($this->userId, count($sites));
            } else {
                $this->site->update(array("status" => $status,
                                          "proposalForKeywords" => "",
                                          "proposalForCategory" => "",
                                          "moderatorId" => $this->userId,
                                          "_creationDate" => "NOW()"),
                                    $c);
            }
        }

        $this->redirect($this->moduleLink("waiting"));
    }

    function saveSiteAction()
    {
        $this->viewClass = "JsonView";
        $edit = !empty($this->request->siteId);
        $validationOptions = array("admin" => true,
                                   "forceCategoryDuplicate" => true,
                                   "forcePossibleTender" => true);

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

        $fields = array("categoryId", "webmasterName", "webmasterEmail", "webmasterId", "siteTitle",
                        "url", "rssTitle", "rssFeedOfSite", "description", "returnBond",
                        "status", "problemExists", "priority", "visitsCount", "referrerTimes");

        if (Config::get("countryFlagsEnabled")) {
            array_push($fields, "countryCode");
        }

        if (Config::get("companyInfoEnabled")) {
            array_push($fields, "address", "zipCode", "city", "country", "phoneNumber", "faxNumber");
        }

        $site->fromArray($this->request->getArray($fields));
        $site->save();

        // store keywords
        if (!empty($this->request->keywords)) {
            $maxKeywordsCountPerSite = $package ? $package->maxKeywordsCountPerSite : Config::get("maxKeywordsCountPerSite");
            $this->keywordsOfSite->storeKeywords($site->siteId, $this->request->keywords, $maxKeywordsCountPerSite);
        }

        if (!empty($this->request->tempId)) {
            $c = new Criteria();
            $c->add("tempId", $this->request->siteId);

            $this->photo->update(array("siteId" => $site->siteId, "_tempId" => "NULL"), $c);
            $site->updatePhotos();
        }

        $this->extraField->saveExtraFieldsValues($site, $this->request);
        $site->updateSuffix();

        $this->set("status", "ok");
        $this->set("message", _t("The site was successfully submitted."));
        $this->set("redirectUrl", AppRouter::getRewrittedUrl("/moderation/site/waiting"));
    }

    function uploadSiteImageAction($siteId)
    {
        $siteId = intval($siteId);
        $site = $this->site->findByPk($siteId);

        $siteImage = new UploadedFile("siteImage");
        $siteImage->addFilter("extension", array("jpg", "png", "gif"));
        $thumbsPath = Config::get("SITES_THUMBS_PATH");
        $newImageSrc = $siteImage->save($thumbsPath);

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

        echo "<html><body>" . $site->imageSrc . "</body></html>";
        $this->autoRender = false;
    }

    function getWaitingSitesHtmlAction()
    {
        $siteIds = explode(",", $this->request->siteIds);
        $c = new Criteria();
        $c->add("status", "waiting");
        $this->set("sites", $this->siteList->getWaitingSites($siteIds));
        $this->viewFile = "item";
    }

    function compareWaitingSitesAction()
    {
        $waitingSitesOnHtml = $this->request->waitingSitesIds ? explode(",", $this->request->waitingSitesIds) : array();

        $c = new Criteria();
        $c->add("status", "waiting");
        $sites = $this->site->getArray($c, "siteId");

        $actualWaitingSitesInDb = array_values($sites);

        $sitesToRemove = array_diff($waitingSitesOnHtml, $actualWaitingSitesInDb);
        $sitesToAdd = array_diff($actualWaitingSitesInDb, $waitingSitesOnHtml);

        $this->set("toRemove", array_values($sitesToRemove));
        $this->set("toAdd", array_values($sitesToAdd));
        $this->set("waiting", array_values($actualWaitingSitesInDb));

        $this->viewClass = "JsonView";

    }
}
