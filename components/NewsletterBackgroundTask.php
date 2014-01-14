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


class NewsletterBackgroundTask extends BackgroundTask
{
    protected $taskId = "newsletter";
    private $mailer;
    private $timeDelay;

    protected function beforeInit()
    {
        $this->data = $this->request->getArray(array("subject", "text", "mailsPerMinute", "newsletterType", 'fromEmail'));
        $message = $this->customMessage->findByPk("newsletterFooter");
        $this->data['newsletterFooterDescription'] = $message->description;

        if ($this->data['newsletterType'] == 'csv') {
            $csvFile = new UploadedFile('csvFile');
            if ($csvFile->wasUploaded()) {
                $this->data['emails'] = array_values(
                    file($csvFile->getTempName(), FILE_IGNORE_NEW_LINES)
                );
            } else {
                $this->data['emails'] = array();
            }
        }
    }

    public function getEmails($type = 'all')
    {
        $emails = array();
        if ($type == "all") {
            $c = new Criteria();
            $c->add("role", "webmaster");
            $emails = array_values($this->user->getArray($c, "email"));
        }

        $c = new Criteria();
        $c->add("active", 1);
        $emails = array_merge($emails, array_values($this->newsletterEmail->getArray($c, "email")));

        $c = new Criteria();

        if ($type != "all") {
            $c->add("newsletterActive", 1);
        }

        $sites = $this->site->findAll($c, "DISTINCT webmasterEmail");

        foreach ($sites as $site) {
            if ($site['webmasterEmail']) {
                array_push($emails, $site['webmasterEmail']);
            }
        }

        $emails = array_merge(array_unique($emails));
        return $emails;
    }

    protected function loadItems()
    {
        $emails = array();

        switch ($this->data['newsletterType']) {
            case 'csv':
                $emails = $this->data['emails'];
                break;

            case 'admin':
                $emails[] = Mailer::getInstance()->getAdminEmail();
                break;

            default:
                $emails = $this->getEmails($this->data['newsletterType']);
        }

        $this->items = $emails;
    }

    protected function beforeParsing()
    {
        $this->mailer = Mailer::getInstance();
        $mailsPerMinute = max(1, $this->data['mailsPerMinute']);
        $this->timeDelay = floor(60 / $mailsPerMinute);
    }

    protected function parseItem($email)
    {
        $text = $this->data['text'];
        $verification = $this->verification->addVerification(null, "newsletterEmailDel", $email);
        $unsubscribeLink = Config::get("siteRootUrl") . AppRouter::getRewrittedUrl("/newsletter/confirmNewsletterEmailDel/" . $verification->code, false);
        $text .= str_replace("[unsubscribe link]", $unsubscribeLink, $this->data['newsletterFooterDescription']);
        $this->mailer->sendEmail($email, $this->data['subject'], $text, $this->data['fromEmail']);
        if ($this->parsedItems < $this->totalItems) {
            sleep($this->timeDelay);
        }
    }

    protected function afterParsing()
    {
        Mailer::getInstance()->sendNewsletterTaskFinished();
    }

}
