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


class StatisticModel extends Model
{
    function __construct()
    {
        $this->cache = Cacher::getInstance();
    }

    function getCountOfSitesWithStatus($type)
    {
        if (($data = $this->cache->load("websitesStatusCount" . $type)) === null) {
            $c = new Criteria();
            $c->add("status", $type);
            $data = $this->site->getCount($c);
            $this->cache->save($data, null, null, array("site"));
        }

        return $data;
    }

    function countOfAllRefusals()
    {
        if (($data = $this->cache->load("refusalsCount")) === null) {
            $data = $this->refusal->get("SUM(refusedSitesCount)", new Criteria());
            $this->cache->save($data, null, null, array("refusal"));
        }

        return $data;
    }

    function getCategoriesTotalCount()
    {
        if (($data = $this->cache->load("categoriesCount")) === null) {
            $data = $this->category->getCount();
            $this->cache->save($data, null, null, array("category"));
        }

        return $data;
    }

    function getCountOfKeywords()
    {
        if (($data = $this->cache->load("keywordsCount")) === null) {
            $data = $this->keyword->getCount();
            $this->cache->save($data, null, null, array("keyword"));
        }

        return $data;
    }

    function getCountOfUsersWithRole($role)
    {
        if (($data = $this->cache->load("usersWithRole" . ucfirst($role))) === null) {
            $c = new Criteria();
            $c->add("role", $role);
            $data = $this->user->getCount($c);
            $this->cache->save($data, null, null, array("user"));
        }

        return $data;
    }

    function getAllStats()
    {
        $statistic = array();

        if (Config::get("displayValidatedSitesCount")) {
            $statistic["validatedSitesCount"] = $this->getCountOfSitesWithStatus("validated");
        }
        if (Config::get("displayWaitingSitesCount")) {
            $statistic["waitingSitesCount"] = $this->getCountOfSitesWithStatus("waiting");
        }
        if (Config::get("displayRefusedSitesCount")) {
            $statistic["refusedSitesCount"] = $this->countOfAllRefusals();
        }
        if (Config::get("displayBannedSitesCount")) {
            $statistic["bannedSitesCount"] = $this->getCountOfSitesWithStatus("banned");
        }
        if (Config::get("displayAllCategoriesCount")) {
            $statistic["allCategoriesCount"] = $this->getCategoriesTotalCount();
        }
        if (Config::get("displayKeywordsCount")) {
            $statistic["keywordsCount"] = $this->getCountOfKeywords();
        }
        if (Config::get("displayWebmastersCount")) {
            $statistic["webmastersCount"] = $this->getCountOfUsersWithRole("webmaster");
        }
        return $statistic;

    }

    function getModeratorsStats()
    {
        $stats = array();

        $c = new Criteria();
        $c->addGroup("moderatorId");
        $c->add("status", "banned");
        $stats['banned'] = $this->site->getArray($c, "moderatorId, COUNT(*) as bannedSitesCount", "moderatorId", true);

        $c = new Criteria();
        $c->addGroup("moderatorId");
        $c->add("status", "validated");
        $stats['validated'] = $this->site->getArray($c, "moderatorId, COUNT(*) as validatedSitesCount", "moderatorId", true);

        $c = new Criteria();
        $stats['refused'] = $this->refusal->getArray($c, "moderatorId, refusedSitesCount", "moderatorId", true);

        return $stats;
    }
}
