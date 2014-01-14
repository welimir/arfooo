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


class Admin_SettingController extends AppController
{
    private $settingsCheckboxFields = array(
    "supportedUrlSchemes",
    "searchEngineSearchIn");

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
     * Display most of configuration options
     */
    function indexAction()
    {
        $this->set("languageOptions", $this->getAvailableLanguages());
        $settings = $this->setting->getArray(null, "value");

        foreach ($this->settingsCheckboxFields as $fieldName) {
            $values = $settings[$fieldName];
            unset($settings[$fieldName]);
            $settings[$fieldName . "[]"] = explode("|", $values);
        }

        $admin = $this->user->findByPk($this->userId, "email");
        $settings['adminEmail'] = $admin->email;
        $this->set("settingJSON", JsonView::php2js($settings));
    }

    /**
     * Get available language in language dir
     */
    function getAvailableLanguages()
    {
        $languages = array();
        $dir = new DirectoryIterator(CODE_ROOT_DIR . 'admin/languages/');

        foreach ($dir as $file) {
            //is language file
            if ($file->isDot() || !preg_match("#^(.*)\.php$#", $file->getFilename(), $matches)) {
                continue;
            }
            //get language code basing on file name
            $languageCode = $matches[1];
            $fp = fopen('languages/' . $file->getFilename(), "r");
            $languageName = "";

            //read lines to get languageName
            while (!feof($fp) && !$languageName) {
                $line = fgets($fp);

                //check this line contain languageName variable
                if (preg_match("#languageName = '(.*?)';#", $line, $matches)) {
                    //if yes save it and push this language to array
                    $languageName = $matches[1];
                    $languages[$languageCode] = $languageName;
                }
            }

            fclose($fp);

        }

        //sort alphabetically array en => English with asort
        asort($languages);
        return $languages;
    }

    /**
     * Save main settings
     */
    function saveAction()
    {
        if (empty($this->request->urlRewriting)) {
            $this->request->advancedUrlRewritingEnabled = "0";
        }

        //foreach posted setting save it to db
        foreach ($this->request as $key => $value) {
            //if admin email changed
            if ($key == "adminEmail") {
                $this->user->updateByPk(array(
                "email" => $value), $this->userId);
            }

            if (in_array($key, $this->settingsCheckboxFields) && is_array($value)) {
                $value = implode("|", $value);
            }

            $this->setting->set($key, $value);
            Config::set($key, $value);
        }

        $watermark = new UploadedFile("imageWatermarkFile");
        $watermark->addFilter("extension", array("jpg", "gif", "png"));

        if ($watermark->wasUploaded()) {
            try {
                $watermark->validate();

                $watermarkImageSrc = "watermark." . $watermark->getFileExtension();

                $watermark->setSavePath(CODE_ROOT_DIR . "uploads/custom/");
                $watermark->setFileName($watermarkImageSrc);
                $watermark->save();

                $this->setting->set("watermarkImageSrc", $watermarkImageSrc);
            } catch (Exception $e) {

            }

        }

        //if generate new selection
        if (isset($this->request->newSelectionButton)) {
            $this->site->generateNewSelection();
        }

        //if reset top referrers
        if (isset($this->request->resetTopReferrersButton)) {
            $this->otherReferrerSite->removeAll();
        }

        $cache = Cacher::getInstance();
        $cache->clean("all");

        $this->redirect($this->moduleLink());
    }

    /**
     * Save edited customMessage
     */
    function saveEditMessageAction()
    {
        $keyId = $this->request->get("messageId");
        $fields = array("title", "description");

        if (!empty($this->request->userText)) {
            $fields[] = "userText";
        }

        $data = $this->request->getArray($fields);
        $this->customMessage->updateByPk($data, $keyId);

        if (in_array($keyId, array("directoryDescription", "directoryCondition"))) {
            Cacher::getInstance()->delete($keyId);
        }

        $this->redirect($this->moduleLink("email"));
    }

    /**
     * Show forms to edit custom emails
     */
    function emailAction()
    {
        $c = new Criteria();
        $c->add("type", "email");
        $this->set("emails", $this->customMessage->findAll($c));
    }

    function editEmailAction($messageId)
    {
        $message = $this->customMessage->findByPk($messageId);
        $this->set("message", $message);
    }

    function deleteEmailAction($messageId)
    {
        $c = new Criteria();
        $c->add("messageId", $messageId);
        $c->add("userDefined", "1");
        $this->customMessage->del($c);

        $this->redirect($this->moduleLink("email"));
    }

    function saveNewEmailAction()
    {
        $message = new CustomMessageRecord();
        $message->fromArray($this->request->getArray(array("title", "description", "userText")));
        $message->messageId = substr("own" . md5(rand()), 0, 20);
        $message->save();

        $this->redirect($this->moduleLink("email"));
    }

    /**
     * Show form to edit custom directoryDescription
     */
    function descriptionAction()
    {
        $this->set("message", $this->customMessage->findByPk("directoryDescription"));
    }

    /**
     * Show form to edit custom directoryCondition
     */
    function conditionAction()
    {
        $this->set("message", $this->customMessage->findByPk("directoryCondition"));
    }

    /**
     * Test google retrieving data
     */
    function testGoogleAction($url, $forcedWay)
    {
        $googleStats = new GoogleStats();
        $googleStats->debug = true;
        $results = $googleStats->getGoogleDetailsOfSite($url, $forcedWay);
        $this->set("googleDetails", $results);
    }

    function paymentProcessorAction()
    {
        $this->set("paymentProcessors", $this->paymentProcessor->findAll());
    }

    function editPaymentProcessorAction($processorId)
    {
        $this->set("paymentProcessor", $this->paymentProcessor->findByPk($processorId));
    }

    function savePaymentProcessorAction($processorId)
    {
        $fields = array("displayName", "active", "currency");

        if ($processorId == "PayPal") {
            $fields = array_merge($fields, array("email", "testMode"));
        }

        $data = $this->request->getArray($fields);

        $paymentProcessor = $this->paymentProcessor->findByPk($processorId);
        $paymentProcessor->fromArray($data);
        $paymentProcessor->save();

        $this->redirect($this->moduleLink("paymentProcessor"));
    }

    function packageAction()
    {
        $this->set("packages", $this->package->findAll());
    }

    function savePackageAction($packageId = null)
    {
        $fields = array(
            'name', 'amount', 'allopassId', 'allopassNumber', 'priority',
            'description', 'siteDescriptionMaxLength', 'maxKeywordsCountPerSite',
            'backLinkMandatory', 'siteDescriptionHtmlEnabled',
            'siteDescriptionHtmlAllowedTags', 'siteDescriptionHtmlAllowedCssProperties',
            'siteDescriptionMinLength'
        );

        $data = $this->request->getArray($fields);

        $package = (empty($packageId)) ? new PackageRecord() : $this->package->findByPk($packageId);
        $package->fromArray($data);

        $siteImage = new UploadedFile("uploadImage");
        $siteImage->addFilter("extension", array("jpg", "png", "gif"));

        if ($siteImage->wasUploaded()) {
            $thumbsPath = Config::get("PACKAGES_THUMBS_PATH");
            $siteImage->setSavePath($thumbsPath);
            $siteImage->save();
            $newImageSrc = $siteImage->getSavedFileName();

            if ($newImageSrc) {
                if (!empty($package->imageSrc)) {
                    $oldFilePath = $thumbsPath . basename($package->imageSrc);

                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                $package->imageSrc = $newImageSrc;
            }

        }

        $package->save();

        $this->redirect($this->moduleLink("package"));
    }

    function editPackageAction($packageId)
    {
        $package = $this->package->findByPk($packageId);
        $this->set('displayRemoveImage', ($package->imageSrc ? true : false));
        $package->updateImageSrc();
        $this->set("package", $package);
        $this->set("packageJSON", JsonView::php2js($package));
        $this->set("priorities", range(0, 10));
    }

    function deletePackageAction($packageId)
    {
        $this->package->delByPk($packageId);
        $this->redirect($this->moduleLink("package"));
    }

    function deletePackageImageAction($packageId)
    {
        $package = $this->package->findByPk($packageId, 'imageSrc, packageId');
        if (empty($package)) {
            $this->return404();
        }

        $packageImage = Config::get('PACKAGES_THUMBS_PATH') . basename($package->imageSrc);

        if (file_exists($packageImage)) {
            unlink($packageImage);
        }

        $package->imageSrc = '';
        $package->save();

        $this->redirect($this->moduleLink("editPackage/$packageId"));
    }

    function sendTestEmailAction($messageId)
    {
        $c = new Criteria();
        $c->addOrder("RAND()");
        $c->setLimit(1);

        $site = $this->site->find($c);

        if ($site) {
            $mailer = Mailer::getInstance();
            $adminEmail = $mailer->getAdminEmail();
            $confirmLink = Config::get("siteRootUrl") . $this->moduleLink("confirmSiteEmail/testcode", false);

            switch ($messageId) {
                case "submitSite":
                    $mailer->sendAdminNotification($site);
                    break;

                case "webmasterSubmitSite":
                    $mailer->sendWebmasterNotification($site, $adminEmail);
                    break;

                case "validateSite":
                    $site->status = "validated";
                    $mailer->sendSiteStateUpdate($adminEmail, $site);
                    break;

                case "refuseSite":
                    $site->status = "refused";
                    $mailer->sendSiteStateUpdate($adminEmail, $site);
                    break;

                case "newsletterEmailAdd":
                case "newsletterEmailDel":
                case "siteEmail":
                case "userEmail":
                    $mailer->sendEmailConfirmation($messageId, $adminEmail, $confirmLink);
                    break;

                default:

                    $message = $this->customMessage->findByPk($messageId);

                    if ($message) {
                        $site->status = "validated";
                        $mailer->sendSiteStateUpdate($adminEmail, $site, $message->title, $message->description);
                    }
            }
        }

        $this->redirect($this->moduleLink("email"));
    }
}
