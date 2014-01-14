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


class Admin_TagController extends AppController
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

    function indexAction($page = 1)
    {
        $perPage = 25;

        $c = new Criteria();
        $c->addOrder("searchTimes DESC");
        $c->setPagination($page, $perPage);
        $tags = $this->searchTag->findAll($c);
        $this->set("tags", $tags);

        //prepare pagination data
        $totalPages = ceil($this->searchTag->getCount() / $perPage);

        $this->set("pageNavigation", array("baseLink" => "/admin/tag/index/",
                                           "totalPages" => $totalPages,
                                           "currentPage" => $page));
    }

    function banAction($tagId)
    {
        $tag = $this->searchTag->findByPk($tagId);
        $tag->banned = $tag->banned ? "0" : "1";
        $tag->save();

        $this->redirect($this->moduleLink());
    }

    function banTagAction()
    {
        $this->set("bannedTags", $this->bannedTag->getArray(null, "tag"));
    }

    function saveNewTagBanAction()
    {
        $bannedTags = preg_split("#\r?\n#", $this->request->bannedTags);
        foreach ($bannedTags as $tag) {
            $tag = trim($tag);
            if (empty($tag)) {
                continue;
            }

            $bannedTag = new BannedTagRecord();
            $bannedTag->tag = $tag;
            $bannedTag->save();

            $this->searchTag->delByPattern($tag);
        }

        $this->redirect($this->moduleLink("banTag"));
    }

    function deleteTagBanAction()
    {
        if (!empty($this->request->unbanTags)) {
            $c = new Criteria();
            $c->add("banId", $this->request->unbanTags, "IN");
            $this->bannedTag->del($c);
        }

        $this->redirect($this->moduleLink("banTag"));
    }

    function deleteAction($tagId)
    {
        $this->searchTag->delByPk($tagId);
        $this->redirect($this->moduleLink());
    }

    function showAction($tagId)
    {
        $this->set("tag", $this->searchTag->findByPk($tagId));
        $this->set("adCriterias", $this->adCriteria->getSelectList());
    }

    function saveTagAction($tagId)
    {
        $this->viewClass = "JsonView";

        $tag = $this->searchTag->findByPk($tagId);
        if (empty($tag)) {
            $this->return404();
        }

        $tag->fromArray($this->request->getArray(array("searchTimes")));
        $tag->save();

        $this->set("status", "ok");
    }
}
