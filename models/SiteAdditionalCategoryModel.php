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


class SiteAdditionalCategoryModel extends Model
{
    protected $dbTable = 'siteadditionalcategories';

    public function getCategoryIdsBySiteId($siteId)
    {
        $c = new Criteria();
        $c->add('siteId', $siteId);
        return $this->getArray($c, 'categoryId', false);
    }
}

class SiteAdditionalCategoryRecord extends ModelRecord
{

}

