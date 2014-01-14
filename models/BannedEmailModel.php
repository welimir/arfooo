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


class BannedEmailModel extends Model
{
    protected $primaryKey = "banId";

    function isBanned($email)
    {
        if (empty($email)) {
            return true;
        }

        $bannedEmails = $this->findAll(null, "email");

        foreach ($bannedEmails as $bannedEmail) {
            if (preg_match("#^" . str_replace("\\*", ".*", preg_quote($bannedEmail['email'])) . "$#i", $email)) {
                return true;
            }
        }

        return false;
    }
}

class BannedEmailRecord extends ModelRecord
{

}
