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


class CommentController extends AppController
{
    public function saveCommentAction()
    {
        if (!Config::get('commentsEnabled')) {
            $this->return404();
        }

        $this->viewClass = "JsonView";
        $siteId = $this->request->itemId;
        $site = $this->site->findByPk($siteId);

        if (empty($site)) {
            return $this->return404();
        }

        $errorMessage = $this->comment->validate($this->request);

        if (Config::get('captchaEnabledOnComments')
            && !$errorMessage
            && !$this->captchaCode->validatePublicAndPrivateCodes($this->request)
        ) {
            $errorMessage = 'You did not guess the security code.';
        }

        if (empty($errorMessage)) {
            $comment = new CommentRecord();
            $comment->fromArray($this->request->getArray(array("pseudo",
                                                               "text",
                                                               "rating")));
            $comment->siteId = $site->siteId;
            $comment->validated = Config::get("automaticCommentValidation") ? 1 : 0;
            $comment->remoteIp = $this->request->getIp();
            $comment->save();

            if (Config::get("sendEmailsOnComment")) {
                Mailer::getInstance()->sendNewCommentNotificationToAdmin($site);
            }

            $this->comment->setSiteCookie($site->siteId);

            $this->set("status", "ok");
            if (Config::get("automaticCommentValidation")) {
                $this->set("message", _t('Your comment was saved'));
            } else {
                $this->set("message", _t('Your comment was saved. He is awaiting moderation and will be published if it is useful for surfers'));
            }
        } else {
            $this->set("status", "error");
            $this->set("message", _t($errorMessage));
        }
    }

    public function popupAction($itemId)
    {
        if (!Config::get('commentsEnabled')) {
            $this->return404();
        }

        $this->set("canVote", $this->comment->checkCanVote($itemId, $this->request->getIp()));
        $this->set("item", $this->site->findByPk($itemId));
    }
}
