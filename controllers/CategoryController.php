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


class CategoryController extends AppController
{
    function listAction()
    {
        //get category to display set by /site/category
        $parentCategoryId = Display::get("currentCategoryId", 0);
        $cache = Cacher::getInstance();

        $cacheItemName = "categoryMiddleHtml" . $parentCategoryId . Config::get("language") . "Template" . Config::get("templateName");

        //check that cached version exists
        if (($categoriesMiddleHtml = $cache->load($cacheItemName, false)) === null) {
            //retrieve all categories which have this $parentCategoryId alphabetically
            $c = new Criteria();
            $c->addOrder("position, name");
            $c->add("parentCategoryId", $parentCategoryId);

            //create assoctiation array with keys = categoryId and values category data
            $categoriesList = $this->category->getArray($c, "parentCategoryId, name, urlName, imageSrc, validatedSitesCount", null, true);

            //if exists some categories having this parent
            if (!empty($categoriesList)) {
                //get count of category subcategories
                $maxSubcategoriesCount = Config::get("countOfSubcategoriesUnderCategory");

                if ($maxSubcategoriesCount) {
                    //retrieve subcategories which have categories on this page
                    $c = new Criteria();
                    $c->addOrder("position, name");
                    $c->add("parentCategoryId", array_keys($categoriesList), "IN");

                    $subcategories = $this->category->findAll($c);

                    //foreach category create subcategories container
                    foreach ($categoriesList as $key => $category) {
                        $categoriesList[$key]['subcategories'] = array();
                    }

                    //foreach subcategories add it to parent category
                    foreach ($subcategories as $subcategory) {
                        $parentCategory = & $categoriesList[$subcategory['parentCategoryId']];

                        //check that $maxSubcategoriesCount isn't reached
                        if (count($parentCategory['subcategories']) < $maxSubcategoriesCount) {
                            $parentCategory['subcategories'][] = $subcategory;
                        }

                    }
                }

                //create standard array to be able create 2 columns table (much be indexed i, i+1)
                $categoriesList = array_values($categoriesList);
            }

            $this->set("categoriesList", $categoriesList);
            $categoriesMiddleHtml = $this->render();

            //store categories with subcategories on this page to cache
            $cache->save($categoriesMiddleHtml, $cacheItemName, false, array("category",
                                                                             "site"));
        }

        return $categoriesMiddleHtml;
    }

    function showAllAction()
    {
        if (!Config::get("allCategoriesPageEnabled")) {
            return $this->return404();
        }

        Display::set("adPage", "allcategories");
        //get all categories first parents then childs to build tree
        $c = new Criteria();
        $c->addOrder("parentCategoryId, name");
        $categories = $this->category->findAll($c, "categoryId, parentCategoryId, name, urlName, validatedSitesCount");
        $tree = new NavigationTree();

        foreach ($categories as $category) {
            $value = $category;

            //add node to tree
            $tree->addNode($category['categoryId'], $category['parentCategoryId'], $value);
        }

        //build tree
        $this->set("allCategories", $tree->render());
    }

    function isPossibleSubmissionAction()
    {
        $this->viewClass = "JsonView";
        $c = new Criteria();
        $c->add("categoryId", $this->request->categoryId);
        $c->add("possibleTender", 1);

        $this->set("status", $this->category->getCount($c) ? "ok" : "error");
    }

    function getChildsOptionListAction()
    {
        $this->viewClass = "JsonView";
        $categoryId = $this->request->id;

        $c = new Criteria();
        $c->addOrder("position");

        if (!empty($this->request->all)) {
            $parents = $this->category->getParents($categoryId);
            $parentIds = array(0);
            foreach ($parents as $parent) {
                $parentIds[] = $parent['categoryId'];
            }

            $levels = array();
            foreach ($parentIds as $parentId) {
                $newLevel['selectedId'] = $parentId;
                $newLevel['childs'] = $this->category->getChilds($parentId, false, $c, "categoryId as id, name, possibleTender");
                $levels[] = $newLevel;
            }

            $this->set("levels", $levels);
        } else {
            $childs = $this->category->getChilds($categoryId, false, $c, "categoryId as id, name, possibleTender");
            $this->set("childs", $childs);
        }
    }
}
