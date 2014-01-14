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


class CategoryParentModel extends ParentModel
{
    protected $categoryModelName = "category";
    protected $categoryParentKey = "parentCategoryId";

    function getCategoriesForSelect()
    {
        $c = new Criteria();
        $c->addOrder("parentId");
        $c->addInnerJoin("categories", "categories.categoryId", "categoryparents.childId");
        $c->add("depth", 1);

        return $this->findAll($c, "categoryparents.childId as categoryId, categoryparents.parentId, name, possibleTender", true);
    }
}

class CategoryParentRecord extends ParentRecord
{

}
