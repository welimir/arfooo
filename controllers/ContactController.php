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


class ContactController extends AppController
{
    /**
     * Display contact form
     */
    function indexAction()
    {
        Display::set("adPage", "contact");

        if (!Config::get("contactPageEnabled")) {
            return $this->return404();
        }
    }

    function problemPopupAction($itemId)
    {
        $item = $this->site->findByPk($itemId);
        if (empty($item)) {
            $this->return404();
        }
        $this->set("item", $item);
    }

    function saveItemProblemAction()
    {
        if (empty($this->request->siteId)
            || !($site = $this->site->findByPk($this->request->siteId))
        ) {
            $this->return404();
        }

        $this->viewClass = "JsonView";

        $errorMessage = $this->siteProblem->validate($this->request);

        if (Config::get('captchaEnabledOnContactForm')
            && !$errorMessage
            && !$this->captchaCode->validatePublicAndPrivateCodes($this->request)
        ) {
            $errorMessage = 'You did not guess the security code.';
        }

        if (empty($errorMessage)) {
            $itemProblem = new SiteProblemRecord();
            $itemProblem->fromArray($this->request->getArray(array("siteId",
                                                                   "type",
                                                                   "description")));
            $itemProblem->save();

            if (Config::get("sendEmailsOnSiteProblem")) {
                Mailer::getInstance()->sendNewSiteProblemNotificationToAdmin($site);
            }

            $this->set("status", "ok");
        } else {
            $this->set("status", "error");
            $this->set("message", _t($errorMessage));
        }
    }

    function contactPopupAction($itemId)
    {
        $item = $this->site->findByPk($itemId);
        if (empty($item)) {
            $this->return404();
        }

        $user = $this->user->findByPk($item->webmasterId);
        $this->set("item", $item);
        $this->set("user", $user);
    }

    function sendMessageToUserAction()
    {
        $this->viewClass = "JsonView";
        $itemId = $this->request->siteId;
        $item = $this->site->findByPk($itemId);
        if (empty($item)) {
            $this->return404();
        }

        $errorMessage = "";

        if (Config::get('captchaEnabledOnContactForm')
            && $this->session->get("role") != "administrator"
            && $this->session->get("role") != "moderator"
            && !$errorMessage
            && !$this->captchaCode->validatePublicAndPrivateCodes($this->request)
        ) {
            $errorMessage = 'You did not guess the security code.';
        }

        if (empty($errorMessage)) {
            Mailer::getInstance()->sendContactEmailToUser($item->webmasterEmail,
                                                          $this->request->title,
                                                          $this->request->description,
                                                          $this->request->yourEmail);

            $this->set("status", "ok");
        } else {
            $this->set("status", "error");
            $this->set("message", _t($errorMessage));
        }
    }

    function sendMessageToAdminAction()
    {
        $this->viewClass = "JsonView";

        $errorMessage = "";

        if (Config::get('captchaEnabledOnContactForm')
            && !$errorMessage
            && !$this->captchaCode->validatePublicAndPrivateCodes($this->request)
        ) {
            $errorMessage = 'You did not guess the security code.';
        }

        if (empty($errorMessage)) {
            Mailer::getInstance()->sendEmail(Mailer::getInstance()->getAdminEmail(),
                                             $this->request->title,
                                             $this->request->description,
                                             $this->request->yourEmail);

            $this->set("status", "ok");
        } else {
            $this->set("status", "error");
            $this->set("message", _t($errorMessage));
        }
    }
}
