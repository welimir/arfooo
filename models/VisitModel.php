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


class VisitModel extends Model
{
    function exists($ip, $type, $id, $hours)
    {
        $c = new Criteria();
        $c->add("type", $type);
        $c->add("DATE_ADD(ts, INTERVAL $hours HOUR) < NOW()");
        $this->del($c);

        $hours = intval($hours);

        $c = new Criteria();
        $c->add("ip", $ip);
        $c->add("type", $type);

        if ($id) {
            $c->add("id", $id);
        }

        return $this->getCount($c) ? true : false;
    }
}

class VisitRecord extends ModelRecord
{

}
