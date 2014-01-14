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


class CustomMessageModel extends Model
{
    protected $primaryKey = "messageId";

    function getUserDefinedMessages()
    {
        $c = new Criteria();
        $c->add("userDefined", "1");
        return $this->getArray($c, "userText, title, description", null, true);
    }

    function getDirectoryCondition()
    {
        $cache = Cacher::getInstance();

        if (($message = $cache->load("directoryCondition")) === null) {
            $message = $this->customMessage->findByPk("directoryCondition")->toArray();
            $cache->save($message, null, null, array("custommessage"));
        }

        return $message;
    }
}

class CustomMessageRecord extends ModelRecord
{

}
