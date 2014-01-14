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


class RefusalModel extends Model
{
    protected $primaryKey = "moderatorId";

    function updateRefusedSitesCount($moderatorId, $count)
    {
        $this->updateByPk(array("_refusedSitesCount" => "refusedSitesCount + $count"),
                          $moderatorId);

        $cache = Cacher::getInstance();
        $cache->clean("tag", array("refusal"));
    }
}

class RefusalRecord extends ModelRecord
{

}
