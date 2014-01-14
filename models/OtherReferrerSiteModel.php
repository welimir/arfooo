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


class OtherReferrerSiteModel extends Model
{
    protected $primaryKey = "referrerSiteId";

    function removeAll()
    {
        $c = new Criteria();
        $this->del($c);
        $this->site->update(array("referrerTimes" => 0), $c);

        $todayDate = date("Y-m-d");
        $this->setting->set('topReferrersLastResetDate', $todayDate);
        Cacher::getInstance()->clean("tag", array("setting"));
    }

    function incReferrerTimesOfSiteIfSiteIsInscripted($referrerUrl)
    {
        $hostName = AppRouter::getHostNameFromUrl($referrerUrl);
        if (empty($hostName)) {
            return;
        }

        $c = new Criteria();
        $c->add("url", str_replace(array("%", "_"), "", $hostName) . "%", "LIKE");
        $this->site->update(array("_referrerTimes" => "referrerTimes + 1"), $c);
    }

    function saveRefferingFromNotRegisteredSite($referrerUrl)
    {
        $hostName = AppRouter::getHostNameFromUrl($referrerUrl);
        if (empty($hostName)) {
            return;
        }

        $c = new Criteria();
        $c->add("url", $hostName);

        if ($this->getCount($c)) {
            $this->update(array("_ReferrerTimes" => "ReferrerTimes + 1"), $c);
        } else {
            $record = new OtherReferrerSiteRecord();
            $record->url = $hostName;
            $record->referrerTimes = 1;
            $record->save();
        }

    }

    function checkReset()
    {
        $removalNeeded = false;

        $todayDate = date("Y-m-d");
        $lastResetDate = Config::get('topReferrersLastResetDate');

        if (!preg_match('#^[0-9]{4}-[0-9]{2}-[0-9]{2}$#', $lastResetDate, $match)) {
            // invalid date
            $removalNeeded = true;
        } else {
            $todayTime = strtotime($todayDate);
            $nextRefreshTime = strtotime($lastResetDate . " + " . Config::get('deletionPeriodOfTopReferrers') . " days");

            if ($nextRefreshTime <= $todayTime) {
                $removalNeeded = true;
            }
        }

        if ($removalNeeded) {
            $this->removeAll();
        }
    }

    function saveReferrer($referrerUrl)
    {
        $this->checkReset();

        $ip = Request::getInstance()->getIp();
        $type = "ref";

        if (!$this->visit->exists($ip, $type, null, 24)) {
            $this->incReferrerTimesOfSiteIfSiteIsInscripted($referrerUrl);
            $this->saveRefferingFromNotRegisteredSite($referrerUrl); // save for registered sites too

            $visit = new VisitRecord();
            $visit->ip = $ip;
            $visit->type = $type;
            $visit->save();
        }
    }
}

class OtherReferrerSiteRecord extends ModelRecord
{

}
