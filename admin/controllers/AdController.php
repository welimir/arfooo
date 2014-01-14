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


class Admin_AdController extends AppController
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
     * Display all criterions - managment page
     */
    function indexAction()
    {
        $c = new Criteria();
        $c->addOrder("name");
        $this->set("adCriterias", $this->adCriteria->findAll($c));
    }

    /**
     * Get criterions Ids for specified site return it to ajax query
     */
    function getAdsOnPageAction()
    {
        $ads = $this->ad->getAdsOnPage($this->request->page);
        $this->set($ads);
        $this->viewClass = "JsonView";
    }

    /**
     * Display form to edit ads on specified site
     */
    function inAction($page)
    {
        //list of sites which can be edited
        $pages = array("news", "topHits", "topNotes", "topRank", "topReferrers",
                       "search", "contact", "error404", "allcategories", "predefineCategory",
                       "predefineSite", "predefineKeyword", "predefineTag", "index");

        if (!in_array($page, $pages)) {
            $this->return404();
        }

        $itemsPerPage = 0;

        //determine siteItems slots count to display on this ads page
        switch ($page) {
            case "news":
                $itemsPerPage = Config::get("maxNewsCount");
                break;

            case "topHits":
                $itemsPerPage = Config::get("maxTopHitsCount");
                break;

            case "topNotes":
                $itemsPerPage = Config::get("maxTopNotesCount");
                break;

            case "topRank":
                $itemsPerPage = Config::get("maxTopRankCount");
                break;

            case "topReferrers":
                $itemsPerPage = Config::get("maxTopReferrersCount");
                break;

            case "search":
                $itemsPerPage = Config::get("sitesPerPageInSearch");
                break;

            case "contact":
            case "allcategories":
            case "error404":
                $itemsPerPage = 0;
                break;
        }

        $this->set("itemsPerPage", $itemsPerPage);

        //get all accessible criterions to choose
        $this->set("adCriterias", $this->adCriteria->getSelectList());

        //set adPage name to js know what is edited
        $this->set("adPage", $page);
        $this->set("adPageDescription", str_replace("_", " ", NameTool::underscore($page)));

        //if non standard page load indyvidual files
        if (in_array($page, array("predefineCategory", "predefineSite", "predefineKeyword",
                                  "predefineTag", "index", "keywordLetter"))) {
            if ($page == "predefineKeyword") {
                $this->set("adPage", "predefineKeyword");
                $this->set("adPage2", "predefineLetter");
            }

            $this->viewFile = "pages/" . $page;
        }
    }

    /**
     * Delete specified ad criterion
     */
    function deleteCriteriaAction($adCriterionId)
    {
        $this->adCriteria->delByPk($adCriterionId);

        //delete cache ads cache informations to be fresh
        Cacher::getInstance()->clean("tag", array("adCriteria", "ad"));
        $this->redirect($this->moduleLink());
    }

    /**
     * Display ad criterion edit form
     */
    function editCriteriaAction($adCriterionId)
    {
        $this->set("adCriteria", $this->adCriteria->findByPk($adCriterionId));
    }

    /**
     * saveEdited criterion
     */
    function saveAdCriteriaEditAction($adCriterionId)
    {
        //update criterai in db
        $data = $this->request->getArray(array("name", "htmlContent"));
        $this->adCriteria->updateByPk($data, $adCriterionId);

        //delete cache ads cache informations to be fresh
        Cacher::getInstance()->clean("tag", array("adCriteria"));
        $this->redirect($this->moduleLink());
    }

    /**
     * set ad for specified place on page
     */
    function updateAction()
    {
        $data = $this->request->getArray(array("place", "page", "adCriterionId"));

        $this->ad->setAdOnPage($data);

        //if predefinition was selected so force general switch
        if ($data['place'] == "predefine") {
            $data['place'] = "general";
            $this->ad->setAdOnPage($data);
        }

        //delete cache ads cache informations to be fresh
        Cacher::getInstance()->clean("tag", array("ad"));

        $this->set("result", true);
        $this->set("message", _t("Saved"));
        $this->viewClass = "JsonView";
    }

    /**
     * Save new criterion
     */
    function saveNewCriteriaAction()
    {
        $adcriteria = new AdCriteriaRecord();
        $adcriteria->name = $this->request->name;
        $adcriteria->htmlContent = $this->request->htmlContent;
        $adcriteria->save();

        Cacher::getInstance()->clean("tag", array("adCriteria"));
        $this->redirect($this->moduleLink());
    }
}
