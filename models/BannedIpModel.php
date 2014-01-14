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


class BannedIpModel extends Model
{
    protected $primaryKey = "banId";

    function isBanned($ip)
    {
        if (empty($ip)) {
            return true;
        }

        $bannedIps = $this->findAll(null, "remoteIp");

        foreach ($bannedIps as $bannedIp) {
            if (preg_match("#^" . str_replace("\\*", ".*", preg_quote($bannedIp['remoteIp'])) . "$#i", $ip)) {
                return true;
            }
        }

        return false;
    }
}

class BannedIpRecord extends ModelRecord
{

}
