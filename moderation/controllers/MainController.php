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


class Moderation_MainController extends AppController
{
    function init()
    {
        $this->acl->allow('moderator', $this->name, "*");
        $this->acl->allow('guest', $this->name, "logIn");
        $this->acl->allow('guest', $this->name, "lostPassword");

        if (!$this->acl->isAllowed($this->session->get("role"), $this->name, $this->action)) {
            $this->redirect($this->moduleLink("logIn"));
        }
    }

    function indexAction()
    {
        $this->redirect(AppRouter::getRewrittedUrl("/moderation/site/waiting"));
    }

    function logInAction()
    {
        if (isset($this->request->email) && isset($this->request->password)) {
            if ($this->session->loginUser($this->request->email, md5($this->request->password), "email", "moderator")) {
                $this->redirect($this->moduleLink());
            } else {
                $this->set("loginError", 1);
            }
        }
    }

    function logOffAction()
    {
        $this->session->destroy();
        $this->redirect($this->moduleLink("logIn"));
    }

    function saveNewPasswordAction()
    {
        if (!empty($this->request->newPassword)
            && $this->request->newPassword == $this->request->repeatedNewPassword
        ) {
            $this->user->updateByPk(array("password" => md5($this->request->newPassword)),
                                    $this->userId);
        }

        $this->redirect($this->moduleLink());
    }

    function changePasswordAction()
    {

    }

    function lostPasswordAction()
    {
        if (empty($this->request->email)) {
            return;
        }

        $c = new Criteria();
        $c->add("email", $this->request->email);
        $c->add("role", "moderator");
        $user = $this->user->find($c);

        if (empty($user)) {
            return;
        }

        $newPassword = $user->generateNewPassword();

        Mailer::getInstance()->sendLostPassword($user->email, $newPassword);

        $this->redirect($this->moduleLink("logIn"));
    }
}
