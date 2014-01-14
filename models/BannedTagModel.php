<?php
//
// copyright (c) Arfooo Annuaire (fr) and Arfooo Directory (en)
// by Guillaume Hocine (c) 2007 - 2010
// Developer Team : Adrian Galewski
// http://www.arfooo.com/ (fr) and http://www.arfooo.net/ (en)
// Licence Creative Commons http://creativecommons.org/licenses/by/2.0/fr/
//


class BannedTagModel extends Model
{
    protected $primaryKey = "banId";

    function isBanned($tag)
    {
        if (empty($tag)) {
            return true;
        }

        $bannedTags = $this->findAll(null, "tag");

        foreach ($bannedTags as $bannedTag) {
            if (preg_match("#^" . str_replace("\\*", ".*", preg_quote($bannedTag['tag'])) . "$#i", $tag)) {
                return true;
            }
        }

        return false;
    }
}

class BannedTagRecord extends ModelRecord
{

}
