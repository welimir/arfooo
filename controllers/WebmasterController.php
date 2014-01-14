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


class WebmasterController extends AppController
{
    private $editMode = false;

    /**
     * Initailize controller set access privileges
     */
    function init()
    {
        $this->acl->allow('webmaster', $this->name, "*");

        $this->acl->allow('guest', $this->name, "logIn");
        $this->acl->allow('guest', $this->name, "lostPassword");
        $this->acl->allow('guest', $this->name, "sendLostPassword");
        $this->acl->allow('guest', $this->name, "isEmailAcceptable");
        $this->acl->allow('guest', $this->name, "register");
        $this->acl->allow('guest', $this->name, "submitDisabled");
        $this->acl->allow('guest', $this->name, "getBackLinkData");
        $this->acl->allow('guest', $this->name, "getMetaData");
        $this->acl->allow('guest', $this->name, "chooseSiteType");
        $this->acl->allow('guest', $this->name, "loading");
        $this->acl->allow('guest', $this->name, "confirmUserEmail");
        $this->acl->allow('guest', $this->name, "confirmSiteEmail");

        if (!Config::get("registrationOfWebmastersEnabled")) {
            $this->acl->allow('guest', $this->name, "submitWebsite");
            $this->acl->allow('guest', $this->name, "saveNewWebsite");
        }

        if (!$this->acl->isAllowed($this->session->get("role"), $this->name, $this->action)) {
            $this->redirect($this->moduleLink("logIn"));
        }
    }

    /**
     * Check that during webmaster inscription email can be acceptabe (not banned and busy)
     * @return mixed AjaxJson
     */
    function isEmailAcceptableAction()
    {
        $status = "ok";
        $email = $this->request->email;

        $c = new Criteria();
        $c->add("email", $email);

        //check is email busy
        if ($this->user->getCount($c)) {
            $status = "busy";
        } else {
            //check is email banned
            if ($this->bannedEmail->isBanned($email)) {
                $status = "banned";
            }
        }

        echo ($status == "ok") ? "true" : "false";
        $this->autoRender = false;
    }

    /**
     * Validate webmaster data
     * @return string message or false
     */
    function validateRegistration()
    {
        if (Config::get("captchaEnabledOnWebmasterRegistration") && !$this->captchaCode->validatePublicAndPrivateCodes($this->request)) {
            return "You did not guess the security code. Try again with a new one.";
        }
        if (empty($this->request->email) || !preg_match("#^(([A-Za-z0-9_])|([\-\.]))+\@(([A-Za-z0-9_])|([\-\.]))+\.([A-Za-z]{2,4})$#", $this->request->email)) {
            return "Missed email";
        }

        $c = new Criteria();
        $c->add("email", $this->request->email);

        if ($this->user->getCount($c) > 0) {
            return "Busy email";
        }
        if ($this->bannedEmail->isBanned($this->request->email)) {
            return "This email is banned.";
        }
        if ($this->bannedIp->isBanned($this->request->getIp())) {
            return "Your IP is banned.";
        }
        if (empty($this->request->password)) {
            return "Empty password";
        }

        return false;
    }

    function saveNewPasswordAction()
    {
        if (!empty($this->request->newPassword)
            && $this->request->newPassword == $this->request->repeatedNewPassword
        ) {
            $this->user->updateByPk(array(
            "password" => md5($this->request->newPassword)), $this->userId);
        }

        $this->redirect($this->moduleLink());
    }

    function changePasswordAction()
    {

    }

    /**
     * Register webmaster from ajax query
     */
    function registerAction()
    {
        $this->viewClass = "JsonView";

        $errorMessage = $this->validateRegistration();

        if (!$errorMessage) {
            $user = new UserRecord();
            $user->email = $this->request->email;
            $user->password = md5($this->request->password);
            $user->role = 'webmaster';

            if (Config::get("emailConfirmationEnabled")) {
                $user->active = 0;
            }

            $user->save();

            if (Config::get("emailConfirmationEnabled")) {
                $this->set("message", _t("The registration was successful! You must confirm your email. Check your inbox."));
                $verification = $this->verification->addVerification($user->userId, "userEmail");
                $confirmLink = Config::get("siteRootUrl") . $this->moduleLink("confirmUserEmail/" . $verification->code, false);
                Mailer::getInstance()->sendEmailConfirmation("userEmail", $user->email, $confirmLink);
            } else {
                $this->set("message", _t("The registration was successful! You can login now."));
            }

            $this->set("status", "ok");

        } else {
            //something is wrong with webmasterData
            $this->set("status", "error");
            $this->set("message", _t($errorMessage));
        }
    }

    /**
     * Redirect to managment panel
     */
    function indexAction()
    {
        $this->redirect($this->moduleLink("manage"));
    }

    function saveSite($mode)
    {
        //copy currect webmaster email to be in site row
        if ($mode == "on") {
            $this->request->webmasterEmail = $this->session->get("email");
        }

        if ($this->request->url == "http://") {
            $this->request->url = "";
        }

        $siteType = $this->request->siteType;
        if (!$this->validSiteType($siteType)) {
            $this->return404();
        }
        $package = null;

        // if we edit site
        if (!empty($this->request->siteId) && $mode == "on") {
            $c = new Criteria();
            $c->add("siteId", $this->request->siteId);
            $c->add("webmasterId", $this->userId);
            $site = $this->site->find($c);

            //this site doesn't exists
            if (empty($site)) {
                $this->set("status", "error");
                $this->set("message", _t("This site doesn't exists"));
                return false;
            }

            $package = $site->packageId ? $this->package->findByPk($site->packageId) : null;

            //validate edited site and for some things compare with old state
            $errorMessage = $this->siteValidator->validate($this->request, $site, array(
            "package" => $package));
        } else {
            if ($siteType == "premium") {
                if ($mode == "on")
                    $payment = $this->payment->getUnusedPaidOneByUserId($this->userId);
                else
                    $payment = $this->payment->getUnusedPaidOneByIp($this->request->getIp());

                if (empty($payment)) {
                    $errorMessage = "You haven't credit for this action";
                } else {
                    $package = $this->package->findByPk($payment->packageId);
                    $paymentProcessor = $this->paymentProcessor->findByPk($payment->processorId);
                }
            }

            if (empty($errorMessage)) {
                //validate new site
                $errorMessage = $this->siteValidator->validate($this->request, null, array(
                "package" => $package));

                if ($mode == "off") {
                    //checking captcha
                    if (Config::get('captchaEnabledOnSiteInscription') && !$errorMessage && !$this->captchaCode->validatePublicAndPrivateCodes($this->request))
                        $errorMessage = 'You did not guess the security code.';
                }
            }

            //if everything okey create new SiteRecord
            if (!$errorMessage) {
                $site = new SiteRecord();
                $site->siteType = $siteType;
                if (Config::get('siteDescriptionHtmlEnabled')) {
                    $site->descriptionDisplayMethod = 'html';
                } else {
                    $site->descriptionDisplayMethod = 'text';
                }

                if ($mode == "on") {
                    $site->webmasterId = $this->userId;
                }
            }
        }

        if ($errorMessage) {
            //set status to js part about that something is wrong with site data
            $this->set("status", "error");

            //set error message what is wrong
            $this->set("message", _t($errorMessage));
            return false;
        }

        //values which will be retrieved from post data
        $fields = array("categoryId", "siteTitle", "url", "rssTitle", "rssFeedOfSite",
                        "returnBond", "description", "proposalForCategory",
                        "proposalForKeywords", "webmasterEmail");

        if (Config::get("countryFlagsEnabled")) {
            array_push($fields, "countryCode");
        }

        if (Config::get("companyInfoEnabled") || Config::get("googleMapEnabled")) {
            array_push($fields, "address", "zipCode", "city", "country", "phoneNumber", "faxNumber");
        }

        //fillling siteRecord with post data
        $site->fromArray($this->request->getArray($fields));
        $site->status = (Config::get('automaticSiteValidation') == 1) ? 'validated' : 'waiting';
        $site->searchPartnership = empty($this->request->searchPartnership) ? 0 : 1;
        $site->newsletterActive = empty($this->request->newsletterActive) ? 0 : 1;
        $site->ip = $this->request->getIp();

        //if premium option mark payment as used to submit site and copy package details to site
        if (!empty($payment)) {
            $site->siteType = "premium";
            $site->priority = $package->priority;
            $site->packageId = $package->packageId;
            if ($package->siteDescriptionHtmlEnabled) {
                $site->descriptionDisplayMethod = 'html';
            } else {
                $site->descriptionDisplayMethod = 'text';
            }

            if ($payment->status == "pending") {
                $site->status = "waiting";
                $site->paymentStatus = $payment->status;
            }

            $site->paymentProcessorName = $paymentProcessor->displayName;
        }

        $site->ascreen = 0;

        if (Config::get("ascreenEnabled")) {
            $site->updateAscreen();
        }

        $site->save();

        if (!empty($payment)) {
            $payment->siteId = $site->siteId;
            $payment->used = 1;
            $payment->save();
        }

        //store keywords
        if (!empty($this->request->keywords)) {
            $maxKeywordsCountPerSite = $package ? $package->maxKeywordsCountPerSite : Config::get("maxKeywordsCountPerSite");
            $this->keywordsOfSite->storeKeywords($site->siteId, $this->request->keywords, $maxKeywordsCountPerSite);
        }

        if (!empty($this->request->tempId)) {
            $c = new Criteria();
            $c->add("tempId", $this->request->tempId);

            $this->photo->update(array(
            "itemId" => $site->siteId,
            "_tempId" => "NULL"), $c);
            $site->updatePhotos();
        }

        $this->extraField->saveExtraFieldsValues($site, $this->request);
        $this->site->attachParents($site);

        //send email to admin that site was submitted/edited
        if (Config::get('sendEmailsOnInscriptionAndApproval')) {
            Mailer::getInstance()->sendAdminNotification($site);
        }

        //send notifications to webmaster that his site was saved to database
        if (Config::get('informWebmastersForAdminDecisions')) {
            Mailer::getInstance()->sendWebmasterNotification($site, $site->webmasterEmail);
        }

        if ($mode == "off" && Config::get("emailConfirmationEnabled")) {
            $verification = $this->verification->addVerification($site->siteId, "siteEmail");
            $confirmLink = Config::get("siteRootUrl") . $this->moduleLink("confirmSiteEmail/" . $verification->code, false);
            Mailer::getInstance()->sendEmailConfirmation("siteEmail", $site->webmasterEmail, $confirmLink);
        }

        return true;
    }

    /**
     * Method to saving new/edited sites
     */
    function saveNewWebsiteAction()
    {
        $this->viewClass = "JsonView";

        if ($this->saveSite(Config::get("registrationOfWebmastersEnabled") ? "on" : "off")) {
            //set status to js part about site proccessing
            $this->set("status", "ok");

            if (!empty($this->request->siteId)) {
                $this->set("message", _t("Your site was submitted again."));
                $this->set("redirectUrl", $this->moduleLink("manage"));
            } else {
                //inform js to redirect
                $this->set("redirectUrl", $this->moduleLink("submitWebsite"));
                
                if (Config::get("emailConfirmationEnabled")
                    && !Config::get("registrationOfWebmastersEnabled")
                ) {
                    $this->set("message", _t("The site was successfully submitted. You must confirm your email. Check your inbox."));
                } else {
                    $this->set("message", _t("The site was successfully submitted."));
                }
            }
        }
    }

    function getBackLinkDataAction()
    {
        $this->viewClass = "JsonView";

        $categoryId = $this->request->categoryId;
        $category = $this->category->findByPk($categoryId);
        $categoryBackLinkCode = '';

        if (!empty($category)) {
            $backLinkUrl = AppRouter::getObjectUrl($category, "category", true);
            $backLinkText = Config::get("backLinkHtmlCode2Text");
            if (empty($backLinkText)) {
                $backLinkText = Config::get("siteTitle");
            }
            $backLinkText .= ' - ' . $category->name;
            $categoryBackLinkCode = '<a href="' . $backLinkUrl . '">' . $backLinkText . '</a>';
        }

        $this->set("categoryBackLinkCode", $categoryBackLinkCode);
    }

    /**
     * Get edited site data
     */
    function getWebsiteDataAction()
    {
        $this->viewClass = "JsonView";

        $siteId = $this->request->siteId;
        $c = new Criteria();
        $c->add("siteId", $siteId);
        $c->add("webmasterId", $this->userId);

        $site = $this->site->findByPk($siteId);

        //if site don't exists
        if (empty($site)) {
            return;
        }

        //find keywords selected for this site
        $c = new Criteria();
        $c->add("siteId", $siteId);
        $keywordIds = array();

        foreach ($this->keywordsOfSite->findAll($c) as $keyword) {
            $keywordIds[] = $keyword['keywordId'];
        }

        //set keywords Ids for this site
        $site->keywordIds = $keywordIds;
        $this->set($site->toArray());
    }

    /**
     * Get meta data for specified url
     */
    function getMetaDataAction()
    {
        $httpClient = new HttpClient();
        $metaData = $httpClient->getMetaValues($this->request->url);
        $this->set($metaData);
        $this->viewClass = "JsonView";
    }

    /**
     * Display edit form
     */
    function editSiteAction($siteId)
    {
        $site = $this->site->findByPk($siteId);

        if (empty($site) || $site->webmasterId != $this->userId) {
            $this->return404();
        }

        $this->site->attachPhotos($site);
        $this->site->fillExtraFields($site);
        $this->site->attachKeywordIds($site);

        $this->set("edit", true);
        $this->set("item", $site);
        $this->set("itemJson", JsonView::php2js($site));
        $this->set("siteType", $site->siteType);

        $package = $site->packageId ? $this->package->findByPk($site->packageId) : null;
        $this->set("package", $package);

        require (CODE_ROOT_DIR . "config/flags.php");
        $this->set("countryFlags", $countryFlags);
        $this->set("allKeywordsList", $this->keyword->generateSortedList());
        $this->viewFile = "submitWebsite";
    }

    /**
     * Form to submit/edit sites
     */
    function submitWebsiteAction($siteType = false)
    {
        if (!$this->editMode) {
            $package = $this->checkSiteTypeAccess($siteType, "submitWebsite");
            $this->set("package", $package);
        }

        //set selected category from cookie
        $this->set("selectedCategoryId", isset($_COOKIE['lastVisitedCategoryId']) ? intval($_COOKIE['lastVisitedCategoryId']) : "");
        $this->set("allKeywordsList", $this->keyword->generateSortedList());
        $this->set("selectCategories", $this->category->createOptionsList(true));
        $this->set("metaDataUrl", $this->moduleLink("getMetaData"));
        $this->set("siteType", $siteType);
        $this->set("tempId", md5(rand()));

        require (CODE_ROOT_DIR . "config/flags.php");
        $this->set("countryFlags", $countryFlags);
    }

    /**
     * Managment panel list of all sites which can be managed
     */
    function manageAction()
    {
        $c = new Criteria();
        $c->add("webmasterId", $this->userId);
        $c->add("sites.status", "banned", "<>");
        $c->addOrder("sites.status");
        $c->addOrder("siteTitle");
        $c->addLeftJoin("packages", "packages.packageId", "sites.packageId");

        $sites = $this->site->findAll($c, "sites.*, packages.name as packageName");
        $this->site->attachParents($sites);
        $this->set("sites", $sites);
    }

    /**
     * Delete site
     */
    function deleteSiteAction($siteId)
    {
        $c = new Criteria();
        $c->add("siteId", $siteId);
        $c->add("webmasterId", $this->userId);
        $c->add("status", "banned", "!=");
        $site = $this->site->find($c);

        if ($site) {
            $site->del();
        }

        $this->redirect($this->moduleLink("manage"));
    }

    /**
     * Login and inscription form
     */
    function logInAction()
    {
        if (!Config::get("registrationOfWebmastersEnabled")) {
            $this->return404();
        }

        //if form was posted
        if (isset($this->request->email) && isset($this->request->password)) {
            $email = $this->request->email;

            //check that user haven't got banned ip/email and password is correct
            if (!$this->bannedEmail->isBanned($email) && !$this->bannedIp->isBanned($this->request->getIp()) && $this->session->loginUser($email, md5($this->request->password), "email", "webmaster")) {
                if (!empty($this->request->rememberMe)) {
                    $expire = time() + 60 * 60 * 24 * 30;

                    $this->response->setCookie("rememberMe", true, $expire);
                    $this->response->setCookie("email", $this->request->email, $expire);
                    $this->response->setCookie("password", md5($this->request->password), $expire);
                }
                //if yes redirect to managment panel
                $this->redirect($this->moduleLink("manage"));
            } else {
                //if no set error message
                $this->set("loginError", 1);
            }
        }

        $this->set("directoryCondition", $this->getDirectoryCondition());
    }

    /**
     * Retrieve html content from db which describe directory condition usage
     */
    private function getDirectoryCondition()
    {
        $cache = Cacher::getInstance();

        if (($message = $cache->load("directoryCondition")) === null) {
            $message = $this->customMessage->findByPk("directoryCondition")->toArray();
            $cache->save($message, null, null, array(
            "custommessage"));
        }

        return $message;
    }

    /**
     * Logoff webmaster
     */
    function logOffAction()
    {
        $this->session->destroy();
        $this->response->setCookie("rememberMe", "");
        $this->response->setCookie("email", "");
        $this->response->setCookie("password", "");
        $this->redirect($this->moduleLink());
    }

    /**
     * Lost password form, generation and sending
     */
    /**
     * Lost password form
     */
    function lostPasswordAction()
    {

    }

    function sendLostPasswordAction()
    {
        $this->viewClass = "JsonView";

        //get user which have this email and role webmaster
        $c = new Criteria();
        $c->add("email", $this->request->email);
        $c->add("role", "webmaster");
        $user = $this->user->find($c);

        if (empty($user)) {
            $errorMessage = "We haven't this email in database";
        }

        if (Config::get('captchaEnabledOnContactForm') && empty($errorMessage) && !$this->captchaCode->validatePublicAndPrivateCodes($this->request))
            $errorMessage = 'You did not guess the security code.';

        if (empty($errorMessage)) {
            $newPassword = $user->generateNewPassword();
            Mailer::getInstance()->sendLostPassword($user->email, $newPassword);
            $this->set("status", "ok");
        } else {
            $this->set("status", "error");
            $this->set("message", _t($errorMessage));
        }
    }

    function checkSiteTypeAccess($siteType, $action)
    {
        if (!Config::get("inscriptionsOfSitesEnabled")) {
            $this->redirect($this->moduleLink("submitDisabled"));
        }

        if (empty($siteType)) {
            if (Config::get("availableSiteTypes") == "basic") {
                $this->redirect($this->moduleLink("$action/basic"));
            } else {
                $this->redirect($this->moduleLink("chooseSiteType"));
            }
        }

        if (!$this->validSiteType($siteType)) {
            $this->return404();
        }

        if ($siteType == "premium") {
            if (Config::get("registrationOfWebmastersEnabled")) {
                $payment = $this->payment->getUnusedPaidOneByUserId($this->userId);
            } else {
                $payment = $this->payment->getUnusedPaidOneByIp($this->request->getIp());
            }

            if (empty($payment)) {
                $this->redirect(AppRouter::getRewrittedUrl("/payment/selectPaymentOptions"));
            } else {
                $package = $this->package->findByPk($payment->packageId);
                return $package;
            }
        }

        return null;
    }

    function validSiteType($siteType)
    {
        if (!in_array($siteType, array("basic", "premium"))) {
            return false;
        }

        $availableSiteTypes = Config::get("availableSiteTypes");

        if ($availableSiteTypes == "both") {
            return true;
        }
        if ($availableSiteTypes == $siteType) {
            return true;
        }

        return false;
    }

    function chooseSiteTypeAction()
    {
        $availableSiteTypes = Config::get("availableSiteTypes");

        if ($availableSiteTypes == "basic") {
            $this->redirect($this->moduleLink("submitWebsite/basic"));
        }
    }

    function submitDisabledAction()
    {

    }

    function loadingAction()
    {
        if (Config::get("registrationOfWebmastersEnabled")) {
            $payment = $this->payment->getUnusedPaidOneByUserId($this->userId);
        } else {
            $payment = $this->payment->getUnusedPaidOneByIp($this->request->getIp());
        }

        $redirectUrl = $this->moduleLink("submitWebsite/premium");

        if (!empty($payment)) {
            $this->redirect($redirectUrl);
        }
    }

    function confirmSiteEmailAction($confirmCode)
    {
        $verification = $this->verification->findByCodeType($confirmCode, "siteEmail");

        if (!empty($verification)) {
            $site = $this->site->findByPk($verification->itemId);

            if (!empty($site)) {
                $site->emailConfirmed = 1;
                $site->save();
            }
        }
    }

    function confirmUserEmailAction($confirmCode)
    {
        $verification = $this->verification->findByCodeType($confirmCode, "userEmail");

        if (!empty($verification)) {
            $user = $this->user->findByPk($verification->itemId);

            if (!empty($user)) {
                $user->active = 1;
                $user->save();
            }
        }
    }
}
