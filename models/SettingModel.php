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


class SettingModel extends Model
{
    protected $primaryKey = "`key`";

    function set($key, $value)
    {
        $this->updateByPk(array("value" => $value), $key);
    }

    public function getCampaignFilters()
    {
        $filters = @unserialize(Config::get('campaignFilters'));
        if (empty($filters)) {
            $filters = array();
        }
        return $filters;
    }

    public function saveCampaignFilters($filters)
    {
        $this->setting->set('campaignFilters', serialize($filters));
        Cacher::getInstance()->clean('all');
    }
}

class SettingRecord extends ModelRecord
{

}
