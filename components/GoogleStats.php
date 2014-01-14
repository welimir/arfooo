<?php

class GoogleStats
{
    private $extractionWay;
    private $additionalServerUrl;
    public $debug = false;

    function getSearcherValue($url, $searcher = "google")
    {
        $url = urlencode(preg_replace("#^http://#", "", $url));

        $searcherUrls = array('google' => 'http://www.google.com/search?hl=en&q=site%3A' . $url,
                              'googlebl' => 'http://www.google.com/search?hl=en&q=link%3A' . $url);

        $searcherPats = array('google' => "#</b> of (?:about )?<b>([\d,]+)</b>#",
                              'googlebl' => "#</b> of (?:about )?<b>([\d,]+)</b>#");

        if (!array_key_exists($searcher, $searcherUrls)) {
            $searcher = "google";
        }

        $sourceUrl = $searcherUrls[$searcher];

        $httpClient = new HttpClient();

        if ($this->extractionWay == 2) {
            $httpClient->additionalServerUrl = $this->additionalServerUrl;
        }

        $buff = $httpClient->getSiteContent($sourceUrl);

        if ($this->debug) {
            echo $buff;
        }

        if (!preg_match($searcherPats[$searcher], $buff, $m)) {
            $count = 0;
        } else {
            $count = str_replace(",", "", $m[1]);
            $count = intval($count);
        }

        return $count;
    }

    function getBacklinksCount($url)
    {
        return $this->getSearcherValue($url, "googlebl");
    }

    function getIndexedPagesCount($url)
    {
        return $this->getSearcherValue($url, "google");
    }

    function getPageRank($url)
    {
        $gpr = new GooglePageRanker();
        $gpr->debug = $this->debug;
        return $gpr->getPageRank($url, $this->additionalServerUrl);
    }

    function getGoogleDetailsOfSiteIfCached($url)
    {
        if (!Config::get('pageRankCachingEnabled')) {
            return false;
        }

        $siteStats = Model::factoryInstance("cacheGoogleDetail")->getGoogleDetailsFromCache($url);

        if (empty($siteStats)) {
            return false;
        }

        return $siteStats->toArray();
    }

    function getGoogleDetailsOfSite($url, $forcedWay = false)
    {
        $this->extractionWay = $forcedWay ? $forcedWay : Config::get("wayForPagerankExtraction");

        if ($this->extractionWay == 2) {
            $this->additionalServerUrl = Config::get("additionalServerUrl");
        }

        $cachedGoogleDetail = Model::factoryInstance("cacheGoogleDetail");

        if (!$forcedWay && Config::get('pageRankCachingEnabled') == 1) {
            // try to take the pagerank from the cache
            $siteStats = $cachedGoogleDetail->getGoogleDetailsFromCache($url);

            if (!empty($siteStats)) {
                return $siteStats->toArray();
            }
        }

        // if rank is not in cache
        // get it and put in the cache
        $results = array();

        $results['pageRank'] = $this->getPageRank($url);
        $results['backlinksCount'] = $this->getBacklinksCount($url);
        $results['indexedPagesCount'] = $this->getIndexedPagesCount($url);

        if (!$forcedWay && Config::get('pageRankCachingEnabled')) {
            if (empty($siteStats)) {
                $siteStats = new CacheGoogleDetailRecord();
                $siteStats->url = $url;
            }

            $siteStats->fromArray($results);
            $siteStats->save();
            
            $c = new Criteria();
            $c->add("url", $url);
            
            foreach(Model::factoryInstance("site")->findAll($c, "siteId") as $site) {
                Model::factoryInstance("site")->updateByPk(array("pageRank" => $results['pageRank']),
                                                           $site['siteId']);
            }
        }

        return $results;
    }

}
