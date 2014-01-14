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


class BannedSiteModel extends Model
{
    protected $primaryKey = "banId";

    function isBanned($site)
    {
        if (empty($site)) {
            return true;
        }

        $bannedSites = $this->findAll(null, "site");

        foreach ($bannedSites as $bannedSite) {
            if (preg_match("#^" . str_replace("\\*", ".*", preg_quote($bannedSite['site'])) . "$#i", $site)) {
                return true;
            }
        }

        return false;
    }
}

class BannedSiteRecord extends ModelRecord
{

}
