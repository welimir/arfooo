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


class ExtraFieldController extends AppController
{
    function getByCategoryIdAction()
    {
        $categoryId = $this->request->categoryId;
        $this->set("categoryId", $categoryId);
        $modes = array("itemForm", "search", "searchEdit");

        if (!empty($this->request->mode) && in_array($this->request->mode, $modes)) {
            $mode = $this->request->mode;
        } else {
            $mode = "itemForm";
        }

        $extraFields = $this->extraField->getCategoryFieldsWithOptions($categoryId);
        $this->set("extraFields", $extraFields);

        switch ($mode) {
            case "searchEdit":
                $mode = "search";
                $this->set("edit", true);
                //nobreak

            case "search":
                $c = new Criteria();
                $c->add("searchEngineSettings", "", "!=");
                $category = $this->category->findClosestParent($categoryId, $c);

                if (!empty($category) && !empty($category->searchEngineSettings)) {
                    $searchEngineSettings = unserialize($category->searchEngineSettings);
                    $this->set("searchEngineSettings", $searchEngineSettings);
                }
                break;

        }

        $searchCategories = array();

        $c = new Criteria();
        $c->add("depth", 2, "<=");
        $c->addOrder("depth, position");

        foreach ($this->category->getChilds(0, true, $c) as $category) {
            if ($category['parentCategoryId']) {
                $searchCategories[$category['parentCategoryId']]['subcategories'][] = $category;
            } else {
                $searchCategories[$category['categoryId']] = $category;
                $searchCategories[$category['categoryId']]['subcategories'] = array();
            }
        }

        $this->set("searchCategories", $searchCategories);
        $this->viewFile = $mode;
    }

    public function deleteExtraFieldValueAction($siteId, $fieldId)
    {
        $site = $this->site->findByPk($siteId);

        if ($site && ($site->webmasterId == $this->userId || $this->session->get('role') == 'administrator')) {
            $this->extraFieldValue->deleteFieldValue($siteId, $fieldId);
        }
        $this->viewClass = 'JsonView';
        $this->set('status', 'ok');
    }
}
