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


class Mailer extends Model
{
    private static $instance = null;
    private $adminEmail;
    private $inboxDebug = false;
    private $sendRealEmail = true;
    private $charset = "UTF-8";

    /**
     * @return Mailer
     */

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    function __construct()
    {
        parent::__construct();

        $c = new Criteria();
        $c->add("role", "administrator");
        $c->setLimit(1);
        $admin = $this->user->find($c, "email");
        $this->adminEmail = $admin->email;
    }

    function getAdminEmail()
    {
        return $this->adminEmail;
    }

    function sendAdminNotification($site)
    {
        $message = $this->customMessage->findByPk("submitSite");
        $this->sendEmailToAdmin($message->title, $this->replaceTags($message->description, $site));
    }

    function sendEmailToAdmin($subject, $message, $fromEmail = "")
    {
        return $this->sendEmail($this->adminEmail, $subject, $message, $fromEmail);
    }

    function replaceTags($message, $site = null)
    {
        $replacements = array("[name of directory]"     => Config::get("siteTitle"),
                              "[url of your directory]" => Config::get("siteRootUrl"));
                              
        if ($site) {
                              
            $this->site->attachParents($site);
            $detailsUrl = AppRouter::getObjectUrl($site, "siteDetails", true);

            $category = $this->category->findByPk($site->categoryId, "name");
            $siteDescription = (utf8_strlen($site->description) > 100) ? utf8_substr($site->description, 0, 100) : $site->description;

            $replacements += array(
                "[site name]"               => $site->siteTitle,
                "[name of the category]"    => $category->name,
                "[url site details]"        => $detailsUrl,
                "[url site]"                => $site->url,
                "[description of the site]" => $siteDescription,
                "[site type]"               => ($site->siteType == "basic") ? _t("Free") : _t("Privilege"));
        }

        $message = strtr($message, $replacements);

        return $message;
    }

    function sendSiteStateUpdate($webmasterEmail, $site, $subject = false, $description = false)
    {
        switch ($site['status']) {
            case "validated":
                $messageId = "validateSite";
                break;

            case "refused":
                $messageId = "refuseSite";
                break;

            case "banned":
                $messageId = "banSite";
                break;
        }

        static $cachedMessages = array();

        if (!isset($cachedMessages[$messageId])) {
            $cachedMessages[$messageId] = $this->customMessage->findByPk($messageId);
        }

        $message = $cachedMessages[$messageId];

        if (!$description) {
            $description = $message->description;
        }

        $description = $this->replaceTags($description, $site);

        if (!$subject) {
            $subject = $message->title;
        }

        $this->sendEmail($webmasterEmail, $subject, $description);

    }

    function sendNewsletterTaskFinished()
    {
        $this->sendEmailToAdmin(_t('Sending the newsletter is finished successfully.'), _t('Sending the newsletter is finished successfully.') . _t('You can go in your administration for further informations.'));
    }

    function sendSiteBacklinkTaskFinished()
    {
        $this->sendEmailToAdmin(_t('The search for backlinks is finished successfully.'), _t('The search for backlinks is finished successfully.') . _t('You can go in your administration for further informations.'));
    }

    function sendDuplicateContentTaskFinished()
    {
        $this->sendEmailToAdmin(_t('The search for duplicate content is finished successfully.'), _t('The search for duplicate content is finished successfully.') . _t('You can go in your administration for further informations.'));
    }

    function sendSiteThumbTaskFinished()
    {
        $this->sendEmailToAdmin(_t('The updating of thumbs is finished successfully.'), _t('The updating of thumbs is finished successfully.') . _t('You can go in your administration for further informations.'));
    }

    function sendWebmasterNotification($site, $webmasterEmail)
    {
        $message = $this->customMessage->findByPk("webmasterSubmitSite");
        $this->sendEmail($webmasterEmail, $message->title, $this->replaceTags($message->description, $site));
    }

    function sendEmailConfirmation($messageId, $email, $confirmLink)
    {
        $message = $this->customMessage->findByPk($messageId);
        $message->description = str_replace("[confirm link]", $confirmLink, $message->description);
        $this->sendEmail($email, $message->title, $this->replaceTags($message->description));
    }

    function sendLostPassword($userEmail, $newPassword)
    {
        $this->sendEmail($userEmail, _t('Annuaire - new webmaster password'), _t('Your new password is') . ' ' . $newPassword);
    }

    function sendContactEmailToUser($email, $title, $text, $fromEmail)
    {
        $message = $this->customMessage->findByPk("webmasterContact");

        $text = str_replace(array("[message]", "[sender email]"),
                            array($text, $fromEmail),
                            $message->description);

        $this->sendEmail($email, $title, $text);
    }

    function sendNewCommentNotificationToAdmin($site)
    {
        $message = $this->customMessage->findByPk("newComment");
        $this->sendEmailToAdmin($message->title, $this->replaceTags($message->description, $site));
    }

    function sendNewSiteProblemNotificationToAdmin($site)
    {
        $message = $this->customMessage->findByPk("newSiteProblem");
        $this->sendEmailToAdmin($message->title, $this->replaceTags($message->description, $site));
    }

    function createMailHeaders($from)
    {
        $mailheaders = "From: $from\n";
        $mailheaders .= "Reply-To: $from\n";
        $mailheaders .= "MIME-version: 1.0\n";
        $mailheaders .= "Content-type: text/html; charset=" . $this->charset . "\n";

        return $mailheaders;
    }

    function sendEmail($email, $subject, $text, $fromEmail = "")
    {
        if ($fromEmail == "") {
            $fromEmail = $this->adminEmail;
        }
        $headers = $this->createMailHeaders($fromEmail);

        $specialChars = array('Ŕ','Á','Â','Ă','Ä','Ĺ','Ć','ŕ','a','á','â','ă','ä','ĺ','ć','Č','É','Ę','Ë','č','e','é','ę','ë','e','Ě','Í','Î','Ď','ě','í','î','ď','Ň','Ó','Ô','Ő','Ö','Ř','ň','ó','ô','ő','ö','ř','Ů','Ú','Ű','Ü','ů','ú','ű','ü','ß','Ç','ç','Đ','đ','Ń','ń','Ţ','ţ','Ý' );
        $normalChars  = array('A','A','A','A','A','A','A','a','a','a','a','a','a','a','a','E','E','E','E','e','e','e','e','e','e','I','I','I','I','i','i','i','i','O','O','O','O','O','O','o','o','o','o','o','o','U','U','U','U','u','u','u','u','B','C','c','D','d','N','n','P','p','Y' );
        $subject = str_replace($specialChars, $normalChars, $subject);

        if ($this->inboxDebug) {
            $str = "<hr>";
            $str .= "<b>Time</b> " . date("Y-m-d G.i:s") . "<br>";
            $str .= "<b>Email:</b> $email<br>";
            $str .= "<b>Topic:</b> $subject<br>";
            $str .= "<b>Text:</b> $text<br>";
            $str .= "<b>Headers:</b> $headers<br>";

            $fp = fopen(CODE_ROOT_DIR . "inbox.html", "a");
            fwrite($fp, $str);
            fclose($fp);
        }

        if ($this->sendRealEmail) {
            @mail($email, $subject, $text, $headers);
        }

        return true;
    }
}
