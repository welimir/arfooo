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


class AdCriteriaModel extends Model
{
    protected $primaryKey = "adCriterionId";

    function getSelectList()
    {
        return (array("0" => "ad off") + $this->getArray(null, "name"));
    }

    function del(Criteria $c)
    {
        $condition = $c->getCondition("adCriterionId");

        $nc = new Criteria();
        $nc->addCondition($condition);

        parent::del($c);

        Model::factoryInstance("ad")->del($nc);
    }
}

class AdCriteriaRecord extends ModelRecord
{

}
