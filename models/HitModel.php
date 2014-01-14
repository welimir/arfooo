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


class HitModel extends Model
{
    protected $primaryKey = "hitId";

    function removeAll()
    {
        $c = new Criteria();
        $this->del($c);
        $this->site->update(array("visitsCount" => 0), $c);
    }

    function insertHit($remoteIp, $siteId)
    {
        $hit = new HitRecord();
        $hit->remoteIp = $remoteIp;
        $hit->siteId = $siteId;
        $hit->save();

        $this->site->updateByPk(
            array('_visitsCount' => 'visitsCount + 1'),
            $siteId
        );
    }
}

class HitRecord extends ModelRecord
{

}
