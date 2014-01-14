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


class AllopassCodeModel extends Model
{
    protected $primaryKey = "code";

    public function cleanUpOvertimed($secondsInterval)
    {
        $c = new Criteria();
        $c->add("DATE_ADD(useDate, INTERVAL " . intval($secondsInterval) . " SECOND) <= NOW()");
        $this->del($c);
    }
}

class AllopassCodeRecord extends ModelRecord
{

}
