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


class CategoryModel extends Model
{
    protected $primaryKey = "categoryId";
    protected $dbTable = "categories";

    function getChilds($categoryId, $recursive = false, $c = null, $fields = "*")
    {
        if ($c === null) {
            $c = new Criteria();
            $c->addOrder("name");
        } else {
            $c = clone $c;
        }

        if ($recursive) {
            $c->addInnerJoin("categories", "categories.categoryId", "categoryparents.childId");
            return $this->categoryParent->getChilds($categoryId, true, $c, $fields);
        } else {
            $c->add("parentCategoryId", $categoryId);
            return $this->findAll($c, $fields);
        }
    }

    function getParents($categoryId)
    {
        $c = new Criteria();
        $c->addInnerJoin("categories", "categories.categoryId", "categoryparents.parentId");
        $fields = "categoryId, name, urlName, navigationName";

        return $this->categoryParent->getParents($categoryId, $c, $fields);
    }

    function createOptionsList($onlyPossibleTender = false)
    {
        $categories = Model::factoryInstance("categoryParent")->getCategoriesForSelect();
        $tree = new NavigationTree();

        foreach ($categories as $category) {
            $value = array("name" => $category->name);
            $tree->addNode($category->categoryId, $category->parentId, $value);
        }

        $results = $tree->getFullOptionList();

        if ($onlyPossibleTender) {
            $categoryPossible = $this->category->getArray(null, "possibleTender");

            foreach ($results as $key => $result) {
                if (!$categoryPossible[$key]) {
                    unset($results[$key]);
                }
            }
        }

        asort($results);
        return $results;
    }

    function updateValidatedSitesCount($categoriesIds = array())
    {
        $prefix = Config::get("DB_PREFIX");

        $sql = "UPDATE " . $prefix . "categories c SET validatedSitesCount = ( SELECT count( * )
                FROM " . $prefix . "sites s, " . $prefix . "categoryparents cp
                WHERE status = 'validated'
                AND cp.parentId = c.categoryId
                AND (cp.childId = s.categoryId OR EXISTS (SELECT * FROM " . $prefix . "siteadditionalcategories ac WHERE ac.categoryId = cp.childId AND ac.siteId = s.siteId)))";

        if (!empty($categoriesIds)) {
            $sql .= " WHERE categoryId IN (" . implode(",", $categoriesIds) . ")";
        }

        $this->db->sqlQuery($sql);
    }

    function del(Criteria $c)
    {
        $condition = $c->getCondition("categoryId");
        $categoryId = $condition['value'];

        $childCategoriesIds = array_map(create_function('$category', 'return $category[\'categoryId\'];'), $this->getChilds($categoryId, true));

        $parentIds = array_map(create_function('$category', 'return $category[\'categoryId\'];'), $this->getParents($categoryId));

        //creating list of items to delete
        $c = new Criteria();
        $c->add("categoryId", $childCategoriesIds, "IN");

        $itemIds = $this->site->getArray($c, "siteId", false);

        //delete all categories and subcategoeis
        $c = new Criteria();
        $c->add("categoryId", $childCategoriesIds, "IN");
        parent::del($c);

        $this->extraFieldCategory->del($c);

        $c = new Criteria();
        $c->add("childId", $childCategoriesIds, "IN");
        $c->addOr("parentId", $childCategoriesIds, "IN");
        $this->categoryParent->del($c);

        //deleting items
        foreach ($itemIds as $itemId) {
            $c = new Criteria();
            $c->add("siteId", $itemId);
            $this->site->del($c, false);
        }

        $this->updateValidatedSitesCount($parentIds);

        Cacher::getInstance()->clean("tag", array("category", "site"));
    }

    function insert($data)
    {
        parent::insert($data);
        Cacher::getInstance()->clean("tag", array("category"));
    }

    function update($data, Criteria $c)
    {
        parent::update($data, $c);
        $this->updateValidatedSitesCount();
        Cacher::getInstance()->clean("tag", array("category"));
    }

    function findClosestParent($categoryId, $c)
    {
        $c->addInnerJoin("categoryparents", "categoryParents.parentId", "categories.categoryId");
        $c->add("categoryparents.childId", $categoryId);
        $c->addOrder("depth");
        $c->setLimit(1);

        return $this->find($c);
    }

    function getFreeUrlName($baseUrlName, $excludeCategoryId = false)
    {
        $baseUrlName = NameTool::strToAscii($baseUrlName, "_\\");
        $lp = 0;

        do {
            $lp++;
            $urlName = $baseUrlName;
            $urlName .= ($lp > 1) ? $lp : "";
            if (in_array($urlName, array('admin', 'moderation', 'webmaster'))) {
                $exists = true;
            } else {
                $c = new Criteria();
                $c->add("urlName", $urlName);
                if ($excludeCategoryId) {
                    $c->add("categoryId", $excludeCategoryId, "!=");
                }
                $exists = $this->category->getCount($c);
            }
        }while($exists);

        return $urlName;
    }

    public function resetOrder()
    {
        $c = new Criteria();
        $this->update(array('position' => 0), $c);
    }
}

class CategoryRecord extends ModelRecord
{
    function getParentsData()
    {
        return Model::factoryInstance("categoryParent")->getParentsData($this->categoryId);
    }

    function changeParent($newParentId)
    {
        $c = new Criteria();
        if (Model::factoryInstance("categoryParent")->isChild($this->categoryId, $newParentId)) {
            return false;
        }

        $this->parentCategoryId = $newParentId;
        return true;
    }
}
