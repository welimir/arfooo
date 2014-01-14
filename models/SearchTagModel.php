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


class SearchTagModel extends Model
{
    protected $primaryKey = "tagId";

    public function handleSearchEngineReferrer($url)
    {
        if (!preg_match("#^http://www\.google\.\w{2,3}/search\?.*q=([^&]+)#", $url, $match)) {
            return;
        }

        $tag = $match[1];
        $this->addSearchTag($tag);
    }

    public function addSearchTag($tag, $site = null)
    {
        if (!Config::get("tagCloudEnabled")) {
            return;
        }
        if ($this->bannedTag->isBanned($tag)) {
            return;
        }

        $tag = strtr($tag, "+-<>()~*\"", "         ");
        $c = new Criteria();
        $c->add("tag", $tag);
        $searchTag = $this->find($c);
        $updateSearchTimes = true;

        if (!$searchTag) {
            if (empty($site)) {
                $site = $this->siteSearcher->searchValidatedSite($tag);
                if (empty($site)) {
                    return;
                }
            }

            $tagParts = explode(" ", $tag);

            foreach ($tagParts as $part) {
                if (stripos($site->description, $part) === false && stripos($site->siteTitle, $part) === false) {
                    return;
                }
            }

            $searchTag = new SearchTagRecord();
            $searchTag->tag = $tag;
            $searchTag->searchTimes = 0;
        } else {
            $ip = Request::getInstance()->getIp();
            $type = "tag";

            if (!$this->visit->exists($ip, $type, $searchTag->tagId, 24)) {
                $visit = new VisitRecord();
                $visit->ip = $ip;
                $visit->type = $type;
                $visit->id = $searchTag->tagId;
                $visit->save();
            } else {
                $updateSearchTimes = false;
            }
        }

        if ($updateSearchTimes) {
            $searchTag->searchTimes = $searchTag->searchTimes + 1;
            $searchTag->save();
        }
    }

    private function sortTag($a, $b)
    {
        return strcmp($a['tag'], $b['tag']);
    }

    public function getTagCloud()
    {
        $c = new Criteria();
        $c->addOrder("searchTimes DESC");
        $c->add("banned", "0");
        $c->setLimit(Config::get("numberOfTagInTagCloud"));
        $tags = $this->findAll($c);

        if (count($tags) < min(Config::get("numberOfTagInTagCloud"), Config::get("minNumberOfTagInTagCloud"))) {
            return array();
        }

        usort($tags, array($this, "sortTag"));

        $maxSearchTimes = 0;
        $minSearchTimes = pow(2, 32);

        $minSize = 1;
        $maxSize = 10;

        foreach ($tags as $tag) {
            $maxSearchTimes = max($maxSearchTimes, $tag['searchTimes']);
        }
        foreach ($tags as $tag) {
            $minSearchTimes = min($minSearchTimes, $tag['searchTimes']);
        }

        $range = $maxSearchTimes - $minSearchTimes;
        if ($range == 0) {
            $range = 1;
        }
        $step = ($maxSize - $minSize) / $range;

        foreach ($tags as &$tag) {
            $tag['size'] = intval($minSize + (($tag['searchTimes'] - $minSearchTimes) * $step));
        }

        return $tags;
    }

    function delByPattern($pattern)
    {
        $searchTags = $this->findAll(null, "*", true);

        foreach ($searchTags as $searchTag) {
            if (preg_match("#^" . str_replace("\\*", ".*", preg_quote($pattern)) . "$#i", $searchTag->tag)) {
                $searchTag->del();
            }
        }
    }
}

class SearchTagRecord extends ModelRecord
{
    public function save()
    {
        parent::save();

        $cache = Cacher::getInstance();
        $cache->clean("tag", array("searchTag"));
    }

    public function del()
    {
        parent::del();
        $cache = Cacher::getInstance();
        $cache->clean("tag", array("searchTag"));
    }
}
