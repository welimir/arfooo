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


class Admin_KeywordController extends AppController
{
    protected $alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

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
     * Display alphabet index
     */
    function indexAction()
    {
        $letters = preg_split('##', $this->alphabet, -1, PREG_SPLIT_NO_EMPTY);
        $this->set("letters", $letters);
    }

    /**
     * Save new keyword
     */
    function saveNewAction()
    {
        $keyword = new KeywordRecord();
        $keyword->keyword = $this->request->keyword;
        $keyword->description = $this->request->description;
        $keyword->save();
        $this->redirect($this->request->getRefererUrl());
    }

    /**
     * Check that this keyword is busy
     */
    function checkIsBusyAction()
    {
        $c = new Criteria();
        $c->add("keyword", $this->request->keyword);
        echo $this->keyword->getCount($c) ? "false" : "true";
        $this->autoRender = false;
    }

    /**
     * Show sites list which have this keyword
     */
    function showAction($keywordId)
    {
        $this->set("keyword", $this->keyword->findByPk($keywordId));
        $this->set("keywordSites", $this->siteList->getSitesThatOwnAKeyword($keywordId));
        $this->set("adCriterias", $this->adCriteria->getSelectList());
    }

    /**
     * Show keywords starting with this letter
     */
    function letterAction($letter)
    {
        //split alphabet to letters
        $letters = preg_split('##', $this->alphabet, -1, PREG_SPLIT_NO_EMPTY);
        $this->set("letters", $letters);

        $keywordGroups = array();

        //get keywords with prefix
        $keywords = $this->keyword->getKeywordsWithPrefix($letter);

        foreach ($keywords as $keyword) {
            //if doesen't exists so far this prefix group create it
            if (!isset($keywordGroups[$keyword['prefix']]['keywords'])) {
                $keywordGroups[$keyword['prefix']]['keywords'] = array();
            }

            //add keywrods to this prefix group
            $keywordGroups[$keyword['prefix']]['keywords'][] = $keyword;
        }

        //current letter
        $this->set("selectedLetter", $letter);

        //set keywords groups
        $this->set("keywordGroups", $keywordGroups);
        $this->set("adCriterias", $this->adCriteria->getSelectList());
    }

    /**
     * Display keyword edit form
     */
    function editAction($keyId)
    {
        $keyword = $this->keyword->findByPk($keyId);
        $this->set("keywordId", $keyId);
        $this->set("keyword", $keyword);
    }

    /**
     * Save edited keyword data
     */
    function saveEditAction($keywordId)
    {
        $this->keyword->updateByPk(array("keyword"     => $this->request->keyword,
                                         "description" => $this->request->description), $keywordId);
        $this->redirect($this->moduleLink());
    }

    /**
     * Delete keyword
     */
    function deleteAction($keyId)
    {
        $this->keyword->delByPk($keyId);
        $this->redirect($this->moduleLink());
    }
}
