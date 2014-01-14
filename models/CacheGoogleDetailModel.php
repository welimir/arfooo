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


class CacheGoogleDetailModel extends Model
{
    protected $primaryKey = "cachePageRankId";

    function deleteExpiredGoogleDetailsInCache($expirationPeriodInDays)
    {
        $expirationPeriodInDays = intval($expirationPeriodInDays);
        $c = new Criteria();
        $c->add("ADDDATE(generationDate, $expirationPeriodInDays) <= NOW()");
        $this->del($c);
    }

    function getGoogleDetailsFromCache($url)
    {
        $c = new Criteria();
        $c->add("url", $url);
        return $this->find($c);
    }

    function removeAll()
    {
        $c = new Criteria();
        $this->del($c);
    }

}

class CacheGoogleDetailRecord extends ModelRecord
{

}
