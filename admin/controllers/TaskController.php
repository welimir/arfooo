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


class Admin_TaskController extends AppController
{
    private $backgroundTask;

    function init()
    {
        $this->acl->allow("administrator", $this->name, "*");
        $this->acl->allow("guest", $this->name, "start");
        $this->acl->allow("guest", $this->name, "nextStart");

        if (!$this->acl->isAllowed($this->session->get("role"), $this->name, $this->action)) {
            $this->redirect(AppRouter::getRewrittedUrl("/admin/main/logIn"));
        }

        if (in_array($this->request->taskId, array("newsletter",
                                                   "siteHttpCode",
                                                   "siteBacklink",
                                                   "siteThumb",
                                                   "siteDuplicateContent"))) {
            $className = ucfirst($this->request->taskId) . "BackgroundTask";
            $this->backgroundTask = new $className();
        }

        $this->viewClass = "JsonView";
    }

    function getStatusAction()
    {
        $this->set($this->backgroundTask->getStatus());
    }

    function pauseAction()
    {
        $this->set("result", $this->backgroundTask->pause());
    }

    function resumeAction()
    {
        $this->set("result", $this->backgroundTask->resume());
    }

    function stopAction()
    {
        $this->set("result", $this->backgroundTask->stop());
    }

    function startAction()
    {
        $this->backgroundTask->start();
    }

    function nextStartAction()
    {
        $this->backgroundTask->nextStart();
    }

    function initAction()
    {
        $this->backgroundTask->init();
        $this->backgroundTask->fork($this->moduleLink("start"));
    }
}
