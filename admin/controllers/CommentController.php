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


class Admin_CommentController extends AppController
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
    function indexAction($validatedComment = 0, $page = 1)
    {
        $c = new Criteria();
        $c->add("validated", $validatedComment);

        //set pagination
        $perPage = 20;
        $totalCount = $this->comment->getCount($c);
        $totalPages = ceil($totalCount / $perPage);

        $this->set("pageNavigation", array("baseLink" => "/admin/comment/index/$validatedComment/",
                                           "totalPages" => $totalPages,
                                           "currentPage" => $page));

        $c->setPagination($page, $perPage);

        //set order
        $c->addOrder("date DESC");

        //because we must retrieve site status
        $c->addInnerJoin("sites", "sites.siteId", "comments.siteId");

        $this->set("validatedComment", $validatedComment);
        $this->set("comments", $this->comment->findAll($c));
    }

    /**
     * Update this comment
     */
    function saveAction()
    {
        $data = $this->request->getArray(array("text", "pseudo", "date"));
        $data['validated'] = '1';
        $this->comment->updateByPk($data, $this->request->commentId);

        $this->set("status", "OK");
        $this->viewClass = "JsonView";
    }

    /**
     * Delete this comment
     */
    function deleteAction()
    {
        $this->comment->delByPk($this->request->commentId);

        $this->set("status", "OK");
        $this->viewClass = "JsonView";
    }

    /**
     * Ban comment ip
     */
    function banIpAction()
    {
        $bannedIp = new BannedIpRecord();
        $bannedIp->remoteIp = $this->request->remoteIp;
        $bannedIp->save();

        $this->set("status", "OK");
        $this->viewClass = "JsonView";
    }
}
