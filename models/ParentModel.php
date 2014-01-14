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


abstract class ParentModel extends Model
{
    protected $categoryModelName = "category";
    protected $categoryParentKey = "categoryParentId";

    public function addNode($parentId, $childId)
    {
        //retrieve list of parent categories
        $parentCategories = $this->getParents($parentId);

        //save root connection if have no parent
        if (!$parentId) {
            $this->insert(array("parentId" => 0,
                                "childId"  => $childId,
                                "depth"    => 1));
        }

        //save connections add for each parent new connection with child
        foreach ($parentCategories as $category) {
            $this->insert(array("parentId" => $category['parentId'],
                                "childId"  => $childId,
                                "depth"    => $category['depth'] + 1));
        }

        //save myself connection
        $this->insert(array("parentId" => $childId,
                            "childId"  => $childId,
                            "depth"    => 0));
    }

    public function moveNode($nodeId, $parentId)
    {
        //to don't have $nodeId in parents
        $c = new Criteria();
        $c->add("depth", 0, ">");
        $parents = $this->getParents($nodeId, $c);
        $childs = $this->getChilds($nodeId, true);

        $c = new Criteria();
        $c->add("parentId", array_map(create_function('$c', 'return $c[\'parentId\'];'), $parents), "IN");
        $c->add("childId", array_map(create_function('$c', 'return $c[\'childId\'];'), $childs), "IN");
        $this->del($c);

        if ($parentId) {
            $newParents = $this->getParents($parentId);
        } else {
            $newParents = array(array('parentId' => 0, 'depth' => 0));
        }

        foreach ($newParents as $parent) {
            foreach ($childs as $child) {
                $this->insert(array("parentId" => $parent['parentId'],
                                    "childId"  => $child['childId'],
                                    "depth"    => $parent['depth'] + $child['depth'] + 1));
            }
        }
    }

    public function getParents($childId, Criteria $c = null, $fields = null)
    {
        if ($c === null) {
            $c = new Criteria();
        }
        $c->addOrder("depth DESC");

        if (empty($fields)) {
            $fields = $this->dbTable . ".parentId, depth";
        }

        if (is_array($childId)) {
            $c->add($this->dbTable . ".childId", array_unique($childId), "IN");
            $fields .= "," . $this->dbTable . ".childId";

            $results = $this->findAll($c, $fields);
            $parents = array();

            foreach ($results as $result) {
                $resultChildId = $result['childId'];
                if (!isset($parents[$resultChildId])) {
                    $parents[$resultChildId] = array();
                }

                unset($result['childId']);
                $parents[$resultChildId][] = $result;
            }

            return $parents;
        } else {
            $c->add($this->dbTable . ".childId", $childId);
            return $this->findAll($c, $fields);
        }
    }

    public function getChilds($parentId, $recursive = false, Criteria $c = null, $fields = null)
    {
        if (empty($c)) {
            $c = new Criteria();
        }
        if (empty($fields)) {
            $fields = "childId";
            if ($recursive) {
                $fields .= ", depth";
            }
        }

        $c->add("parentId", $parentId);

        if (!$recursive) {
            $c->add("depth", 1);
        } else {
            $c->addOrder("depth");
        }

        return $this->findAll($c, $fields);
    }

    public function isChild($parentId, $childId)
    {
        $c = new Criteria();
        $c->add("parentId", $parentId);
        $c->add("childId", $childId);

        return $this->getCount($c) ? true : false;
    }

    public function rebuildTable()
    {
        $c = new Criteria();

        $this->del($c);

        $categoryModel = Model::factoryInstance($this->categoryModelName);
        $categoryPrimaryKey = $categoryModel->getPrimaryKey();

        $categories = $categoryModel->findAll($c, $categoryPrimaryKey . "," . $this->categoryParentKey);

        $tree = new NavigationTree();
        foreach ($categories as $category) {
            $tree->addNode($category[$categoryPrimaryKey], $category[$this->categoryParentKey]);
        }

        $connections = $tree->getAllConnections();

        foreach ($connections as $connection) {
            $this->addNode($connection['parentCategoryId'], $connection['categoryId']);
        }
    }
}

abstract class ParentRecord extends ModelRecord
{

}
