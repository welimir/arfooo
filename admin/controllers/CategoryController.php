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


class Admin_CategoryController extends AppController
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
     * Display category data (subcategories, sites inside, forms to add site in this category or set ads)
     */
    function indexAction($parentCategoryId = 0, $page = 1)
    {
        //if isn't root category = 0
        if ($parentCategoryId) {
            $perPage = 50;

            //get category data
            $currentCategory = $this->category->findByPk($parentCategoryId);

            //if this category doesn't exists'
            if (!$currentCategory) {
                return $this->return404();
            }

            //set category data
            $this->set("currentCategory", $currentCategory);

            //get validated sites inside this category
            $c = new Criteria();
            $c->setPagination($page, $perPage);
            $this->set("sites", $this->siteList->getSitesInCategory($parentCategoryId, $c));

            //prepare pagination data
            $c = new Criteria();
            $c->add("categoryId", $parentCategoryId);
            $c->add("status", "validated");

            $totalPages = ceil($this->site->getCount($c) / $perPage);

            $this->set("pageNavigation", array("baseLink" => "/admin/category/index/$parentCategoryId/",
                                               "totalPages" => $totalPages,
                                               "currentPage" => $page));

            $c = new Criteria();
            $c->add("role", "webmaster");
            $this->set("webmasters", $this->user->getArray($c, "email"));
            $this->set("tempId", md5(rand()));
        }

        //set this category id
        $this->set("parentCategoryId", $parentCategoryId);

        //get category parents path
        $this->set("categoryParentsData", $this->category->getParents($parentCategoryId));

        //get select menu for categories
        $this->set("categoriesSelect", $this->category->createOptionsList());

        //set data for site form
        $this->set("allKeywordsList", $this->keyword->generateSortedList());
        $this->set("yesNoOptions", array("0" => _t("No"), "1" => _t("Yes")));
        $this->set("priorites", range(0, 10));
        $this->set("adCriterias", $this->adCriteria->getSelectList());

        //get subcategories in this category
        $c = new Criteria();
        $c->addOrder("position");
        $c->addOrder("name");
        $this->set("categories", $this->category->getChilds($parentCategoryId, false, $c));

        require (CODE_ROOT_DIR . "config/flags.php");
        $this->set("countryFlags", $countryFlags);
    }

    /**
     * Get category data to edit and return to ajax query
     */
    function getCategoryDataAction()
    {
        $siteId = $this->request->categoryId;
        $site = $this->category->findByPk($siteId);
        $this->set($site->toArray());
        $this->viewClass = "JsonView";
    }

    /**
     * Display category edit form
     */
    function editAction($categoryId)
    {
        $category = $this->category->findByPk($categoryId);
        $this->set("category", $category);
        $this->set("categoryJson", JsonView::php2js($category));
        $this->set("categoryExtraFields", $this->extraField->getCategoryFields($categoryId));
        $this->set("categoriesSelect", $this->category->createOptionsList());
    }

    /**
     * Delete category
     */
    function deleteAction($categoryId)
    {
        $category = $this->category->findByPk($categoryId);

        if (empty($category)) {
            return $this->return404();
        }

        $redirect = AppRouter::getRewrittedUrl("/admin/category/index/" . $category->parentCategoryId);

        //delete category with everything what is connected with it
        $this->category->delByPk($categoryId);
        $this->redirect($redirect);
    }

    function saveCategoryAction()
    {
        $rebuild = false;
        $edit = (!empty($this->request->categoryId));
        $imageSrc = false;

        try {
            $file = new UploadedFile("categoryImage");
            $file->addFilter("extension", array("jpg", "gif", "png"));

            //check and save image
            if ($file->wasUploaded()) {
                $file->setSavePath(CODE_ROOT_DIR . 'uploads/images_categories/');
                $file->save();

                $imageSrc = $file->getSavedFileName();
            }

        } catch (Exception $e) {

        }

        if (!$edit && $imageSrc == false) {
            $imageSrc = 'defaultCategoryImage.gif';
        }

        //create and save new category
        $fields = $this->request->getArray(array("name", "urlName", "navigationName", "title",
                                                 "headerDescription", "possibleTender",
                                                 "description", "metaDescription",
                                                 "parentCategoryId", "forbidden"));

        if ($edit) {
            $category = $this->category->findByPk($this->request->categoryId);

            //handle categoryParentId change
            if ($category->parentCategoryId != $this->request->parentCategoryId
                && $category->changeParent($this->request->parentCategoryId)
            ) {
                $rebuild = true;
            }

        } else {
            $category = new CategoryRecord();
        }

        $category->fromArray($fields);

        if ($imageSrc) {
            if ($edit) {
                $category->removeImage();
            }
            $category->imageSrc = $imageSrc;
        }

        if (empty($category->urlName)) {
            $category->urlName = $category->name;
        }

        $excludeCategoryId = $edit ? $category->categoryId : false;
        $category->urlName = $this->category->getFreeUrlName($category->urlName, $excludeCategoryId);
        $category->save();

        if (!$edit) {
            $this->categoryParent->addNode($this->request->parentCategoryId, $category->categoryId);
        }

        if ($rebuild) {
            $this->categoryParent->moveNode($category->categoryId, $category->parentCategoryId);
            $this->category->updateValidatedSitesCount();
        }

        $redirect = AppRouter::getRewrittedUrl("/admin/category/index/" . $category->parentCategoryId);
        $this->redirect($redirect);
    }

    function savePositionsAction()
    {
        $this->viewClass = "JsonView";

        foreach ($this->request->positions as $fieldId => $position) {
            $this->category->updateByPk(array("position" => $position), $fieldId);
        }

        $this->set("status", "ok");
    }

    function saveSearchEngineExtraFieldSettingsAction()
    {
        $this->viewClass = "JsonView";
        $fields = $this->request->fields;

        $searchEngineSettings = serialize(array("fields" => $fields));

        $data = array("searchEngineSettings" => $searchEngineSettings);
        $this->category->updateByPk($data, $this->request->categoryId);

        $this->set("status", "ok");
    }
}
