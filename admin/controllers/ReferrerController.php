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


class Admin_ReferrerController extends AppController
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
     * Display comment all or for specified site
     */
    function indexAction($page = 1)
    {
        $page = intval($page);
        $perPage = 50;
        $totalPages = ceil($this->site->getCount() / $perPage);

        $this->set("pageNavigation", array("baseLink" => "/admin/referrer/index/",
                                           "totalPages" => $totalPages,
                                           "currentPage" => $page));

        $this->set("sites", $this->siteList->getSites($page, $perPage));
    }

    function resetAction($siteId)
    {
        $this->site->updateByPk(array(
        "referrerTimes" => 0), $siteId);
        $this->redirect($this->moduleLink());
    }
}
