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


class Admin_SiteProblemController extends AppController
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
     * Delete item
     */
    function deleteAction($problemId)
    {
        $referer = $this->request->getRefererUrl();
        $this->siteProblem->delByPk($problemId);
        $this->redirect($referer);
    }

    function indexAction()
    {
        $c = new Criteria();
        $c->addInnerJoin("sites", "sites.siteId", "siteproblems.siteId");
        $this->set("siteProblems", $this->siteProblem->findAll($c, "siteproblems.*, siteTitle"));
    }
}
