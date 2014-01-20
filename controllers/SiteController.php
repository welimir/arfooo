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


class SiteController extends AppController
{
    /**
     * Get random sites on index page
     */
    function randomListAction()
    {
        $cache = Cacher::getInstance();

        //get last time generated
        $generationDate = Config::get('selectionGenerationDate');

        $period = Config::get('selectionPeriod');
        $todayDate = date("Y-m-d");

        //if doesn't exists last refresh or is overtime
        $refreshNeeded = (!preg_match('#^[0-9]{4}-[0-9]{2}-[0-9]{2}$#', $generationDate) || strtotime($generationDate . "+" . $period . " days") <= strtotime($todayDate));

        $cacheItemName = "indexRandomSites" . Config::get("language") . "Template" . Config::get("templateName");

        //if force refresh or cache donesn't exists
        if ($refreshNeeded || ($indexRandomSitesHtml = $cache->load($cacheItemName, false)) === null) {
            $data = $this->siteList->getIndexRandomList($refreshNeeded);
            $this->set("randomSites", $data);
            $indexRandomSitesHtml = $this->render();
            $cache->save($indexRandomSitesHtml, $cacheItemName, false, array("site", "setting"));
        }

        return $indexRandomSitesHtml;
    }

    /**
     * Display news sites
     */
    function newsAction()
    {
        if (!Config::get("newsEnabled")) {
            $this->return404();
        }
        //set adPage for ads
        Display::set("adPage", "news");
        $this->set("newSites", $this->siteList->getNewValidatedSites());
    }

    /**
     * Display sites inside this specified category
     */
    function categoryAction($categoryId, $urlName, $page = 1)
    {
        $page = intval($page);
        $c = new Criteria();

        if (Config::get("advancedUrlRewritingEnabled") && empty($categoryId)) {
            if (empty($urlName)) {
                $this->return404();
            }

            $c->add("urlName", $urlName);
        } else {
            if (empty($categoryId)) {
                $this->return404();
            }

            $c->add("categoryId", $categoryId);
        }

        $category = $this->category->find($c);

        if (empty($category)) {

            if (Config::get("advancedUrlRewritingEnabled")) {
                $rewrite = $this->rewrite->findByPk($urlName);

                if ($rewrite) {
                    $this->redirect(AppRouter::getRewrittedUrl('/' . $rewrite->rewrittedUrl . '/'), 301);
                }
            }

            $this->return404();
        }

        if ($categoryId && Config::get("advancedUrlRewritingEnabled")) {
            $category->page = $page;
            $this->redirect(AppRouter::getObjectUrl($category, "category"), 301);
        }

        $categoryId = $category->categoryId;

        //set adPage for ads
        Display::set("adPage", "category" . $categoryId);

        //set current category for included menus, categories listings
        Display::set("currentCategoryId", $categoryId);
        Display::set("categoryRssHref", AppRouter::getRewrittedUrl("/rss/category/$categoryId"));

        if (!Config::get("advancedUrlRewritingEnabled")
            && NameTool::strToAscii($category->name) != $urlName
        ) {
            $category->page = $page;
            $this->redirect(AppRouter::getObjectUrl($category, "category"), 301);
        }

        //set cookie for future use during site submistion to select last category
        setcookie('lastVisitedCategoryId', $categoryId);

        //get validated sites in this category
        $sites = $this->siteList->getValidatedSitesInCategory($categoryId, $page);

        $this->set("category", $category);
        $this->set("categoryParentsData", $this->category->getParents($categoryId));
        $this->set("siteCategoryLink", $this->moduleLink("category/"));
        $this->set("sitesInCategory", $sites);

        //prepare pagination data
        $c = new Criteria();
        $c->add("categoryId", $categoryId);
        $c->add("status", "validated");

        $totalPages = ceil($this->site->getCount($c) / Config::get("sitesPerPageInCategory"));

        $urlName = Config::get("advancedUrlRewritingEnabled") ? $category->urlName : NameTool::strToAscii($category->name);

        $this->set("pageNavigation", array("baseLink" => "/site/category/$categoryId/$urlName/",
                                           "totalPages" => $totalPages,
                                           "currentPage" => $page,
                                           "title" => $category->name));
    }

    /**
     * Display sites which have specified keyword
     */
    function keywordAction($keywordId, $name, $page)
    {
        //if this action is disabled
        if (!Config::get('keywordsEnabled')) {
            return $this->return404();
        }

        //set adPage for ads
        Display::set("adPage", "keyword" . $keywordId);

        //get keyword data
        $keyword = $this->keyword->findByPk($keywordId);
        $this->set("keyword", $keyword);

        if (empty($keyword)) {
            return $this->return404();
        }

        if (NameTool::strToAscii($keyword->keyword) != $name) {
            $keyword->page = $page;
            $this->redirect(AppRouter::getObjectUrl($keyword, "keyword"), 301);
        }

        //get sites which containt this keyword
        $keywordSites = $this->siteList->getSitesThatOwnAKeyword($keywordId, $page);
        $this->set("keywordSites", $keywordSites);

        //prepare pagination data
        $c = new Criteria();
        $c->add("status", "validated");
        $c->addInnerJoin("keywordsofsites", "keywordsofsites.siteId", "sites.siteId");
        $c->add("keywordsofsites.keywordId", $keywordId);

        $totalPages = ceil($this->site->getCount($c) / Config::get("sitesPerPageInKeywords"));

        $this->set("pageNavigation", array("baseLink" => "/site/keyword/$keywordId/$name/",
                                           "totalPages" => $totalPages,
                                           "currentPage" => $page,
                                           "title" => $keyword->keyword));
    }

    /**
     * Display Top hits sites
     */
    function topHitsAction()
    {
        //if this action is disabled
        if (!Config::get("hitsEnabled")) {
            return $this->return404();
        }

        //set adPage for ads
        Display::set("adPage", "topHits");

        //will display hitsCount on included /site/item.tpl
        Display::set("hitsCountInListItem", true);

        $this->set("topHitSites", $this->siteList->getValidatedTopVisitedSites());
    }

    /**
     * Display Top notes sites
     */
    function topNotesAction()
    {
        //if this action is disabled
        if (!Config::get("notationsEnabled")) {
            return $this->return404();
        }

        //set adPage for ads
        Display::set("adPage", "topNotes");

        //will display notesCount on included /site/item.tpl
        Display::set("notesCountInListItem", true);

        //retrieve validated top notes sites
        $this->set("topNoteSites", $this->siteList->getValidatedTopElectedSites());
    }

    /**
     * Display Top rank sites
     */
    function topRankAction($pageRank = false)
    {
        //if this action is disabled
        if (!Config::get("topRankEnabled")) {
            return $this->return404();
        }

        //check correct pageRank range
        if ($pageRank && ((int) $pageRank < 1 || (int) $pageRank > 10)) {
            return $this->return404();
        }

        //set adPage for ads
        Display::set("adPage", "topRank");

        //will display pageRankImg on included /site/item.tpl
        Display::set("pageRankImgInListItem", true);
        $this->set("pageRank", $pageRank);

        //get validated top rank sites
        $this->set("topRankSites", $this->siteList->getValidatedTopRankSites($pageRank));
    }

    /**
     * Display Top referrers sites
     */
    function topReferrersAction()
    {
        //if this action is disabled
        if (!Config::get("topReferrersEnabled")) {
            return $this->return404();
        }

        //set adPage for ads
        Display::set("adPage", "topReferrers");

        //will display referrersCount on included /site/item.tpl
        Display::set("referrersCountInListItem", true);

        $this->otherReferrerSite->checkReset();
        //get validated topReferrers
        $this->set("topReferrerSites", $this->siteList->getValidatedTopReferrersSites());
    }

    /**
     * Display site details page
     */
    function detailsAction($siteId, $niceUrl)
    {
        //set adPage for ads
        Display::set("adPage", "site" . $siteId);

        $cache = Cacher::getInstance();
        $cacheLifeTime = Config::get("siteDetailsCacheLifeTime");

        if (!Config::get("siteDetailsCacheEnabled")
            || ($site = $cache->load("siteDetails$siteId", true, $cacheLifeTime)) === null
        ) {
            //get site data
            $site = $this->site->getSiteWithDetails($siteId);
            if (empty($site) || $site->status != "validated") {
                return $this->return404();
            }

            $this->site->attachParents($site);

            //check passed siteTitle is url is correct
            $siteDetailsUrl = AppRouter::getObjectUrl($site, "siteDetails");
            if ($siteDetailsUrl != $_SERVER['REQUEST_URI']) {
                $this->redirect($siteDetailsUrl, 301);
            }

            $this->site->attachExtraFields($site);
            $site->photos = $this->photo->getItemPhotos($siteId);

            //get site keywords
            $site->keywords = $site->getKeywords();

            //get google details
            $googleStats = new GoogleStats();
            $results = $googleStats->getGoogleDetailsOfSiteIfCached($site->url);

            //if results exists pass them to template
            if ($results) {
                $site->pageRank = $results['pageRank'];
                $site->backlinksCount = $results['backlinksCount'];
                $site->indexedPagesCount = $results['indexedPagesCount'];
            } else {
                //if no use ajax to reduce site generation time
                $this->set("ajaxGoogleDetails", true);
            }

            if (Config::get("showRandomSitesInDetails")) {
                $site->randomSites = $site->getSimilarSites();
            }

            $site->comments = $this->comment->getSiteValidatedComments($siteId);

            if (Config::get("siteDetailsCacheEnabled")) {
                $cache->save($site, null, null, array("site", "site" . $siteId));
            }
        } else {
            //check passed siteTitle is url is correct
            $siteDetailsUrl = AppRouter::getObjectUrl($site, "siteDetails");
            if ($siteDetailsUrl != $_SERVER['REQUEST_URI']) {
                $this->redirect($siteDetailsUrl, 301);
            }
        }

        //set category id where site is placed to retrieve predefinitions in ads module
        Display::set("adSiteCategoryId", $site->categoryId);

        //set site rss href
        Display::set("siteRssHref", AppRouter::getRewrittedUrl("/rss/site/".$site->siteId));

        //set META keywords in HEAD section
        $this->set("metaKeywords", implode(", ", array_map(create_function('$a', 'return $a["keyword"];'), $site->keywords)));

        //set META description in HEAD section
        $this->set("metaDescription", utf8_substr(preg_replace("#\r?\n#", "", strip_tags($site->description)), 0, 200));

        //check passed siteTitle is url is correct
        $siteDetailsUrl = AppRouter::getObjectUrl($site, "siteDetails");
        if ($siteDetailsUrl != $_SERVER['REQUEST_URI']) {
            $this->redirect($siteDetailsUrl, 301);
        }

        $this->siteHtml->configureSiteHtmlDisplay($site);

        //set site data
        $this->set("site", $site);

        if (Config::get("googleMapEnabled")) {
            $this->set("googleMap", $site->getGoogleMap());
        }

        if (Config::get("remoteRssParsingEnabled") && !empty($site['rssFeedOfSite'])) {
            define("MAGPIE_OUTPUT_ENCODING", "UTF-8");
            define("MAGPIE_DETECT_ENCODING", true);

            // Define cache's maximum age
            define('MAGPIE_CACHE_AGE', 60 * 60 * 24 * intval(Config::get('magpieRssCacheMaxAgeDays')));

            require_once (Config::get('COMPONENTS_PATH') . 'magpierss/rss_fetch.php');
            $rss = @fetch_rss($site['rssFeedOfSite']);

            if (!empty($rss)) {

                $remoteRss = array("items" => array(), "channel" => $rss->channel);

                $items = array_slice($rss->items, 0, Config::get("numberOfItemsForRssParsing"));

                foreach ($items as $item) {
                    if (isset($item['description'])) {
                        // Strip tags from each item's description
                        $item['description'] = strip_tags(html_entity_decode($item['description'], ENT_COMPAT, 'UTF-8'));
                    }

                    if (!isset($item['link']) && isset($item['link_'])) {
                        $item['link'] = $item['link_'];
                    }

                    if (!empty($item['link']) && !empty($item['title'])) {
                        $remoteRss['items'][] = $item;
                    }
                }

                $this->set("remoteRss", $remoteRss);
            }
        }
    }

    /**
     * Retrieve google details and return result to ajaax query
     */
    function getGoogleDetailsAction()
    {
        $site = $this->site->findByPk($this->request->siteId, "url");
        if (empty($site)) {
            return $this->return404();
        }

        $googleStats = new GoogleStats();
        $results = $googleStats->getGoogleDetailsOfSite($site->url);

        $this->set($results);
        $this->viewClass = "JsonView";
    }

    /**
     * Display sites which contain tag
     */
    function tagAction($tagId, $tag, $page = 1)
    {
        $searchTag = $this->searchTag->findByPk($tagId);

        if (empty($searchTag)
            || NameTool::strToAscii($searchTag->tag) != $tag
            || $searchTag->banned
        ) {
            return $this->return404();
        }

        //set adPage for ads
        Display::set("adPage", "tag" . $tagId);
        $searchedSites = array();

        //get sites which containt searched phrase
        $searchedSites = $this->siteSearcher->searchValidated(array("phrase" => $searchTag->tag), $page);

        //prepare data for pagination
        $totalPages = ceil($this->siteSearcher->getFoundRowsCount() / Config::get("sitesPerPageInSearch"));

        //set founded sites and paginations data
        $this->set("searchTag", $searchTag);
        $this->set("searchedSites", $searchedSites);
        $this->set("pageNavigation", array("baseLink" => "/site/tag/$tagId/" . NameTool::strToAscii($tag) . "/",
                                           "totalPages" => $totalPages,
                                           "currentPage" => $page,
                                           "title" => $tag));

    }

    /**
     * Display sites which containt searched phrase
     */
    function searchAction($searchQuery = "")
    {
        //set adPage for ads
        Display::set("adPage", "search");
        Display::set("searchPanel", true);

        $searchedItems = array();
        $this->request->fromArray($_GET);

        $searchValues = $this->request->toArray();
        $this->set("searchValuesJson", JsonView::php2js($searchValues));

        $page = !empty($this->request->page) ? $this->request->page : 1;
        $resultsCount = 0;

        //if something was searched
        if (!empty($searchValues)) {
            //get sites which containt searched phrase
            $searchedItems = $this->siteSearcher->searchValidated($searchValues, $page);
            $resultsCount = $this->siteSearcher->getFoundRowsCount();

            //if this phrase have matched sites save tag
            if (!empty($searchedItems) && !empty($this->request->phrase)) {
                $this->searchTag->addSearchTag($this->request->phrase, $searchedItems[0]);
            }

            $this->set('searchValues', $searchValues);
            //prepare data for pagination
            $totalPages = empty($searchedItems) ? 0 : ceil($resultsCount / Config::get("sitesPerPageInSearch"));
        } else {
            //nothing was searched
            $searchedItems = array();
            $totalPages = 0;
            $page = 1;
        }

        $this->set("resultsCount", $resultsCount);
        $this->set("searchedSites", $searchedItems);

        $searchArray = array();

        foreach (explode("&", ltrim($searchQuery, "?")) as $searchPair) {
            if (strpos($searchPair, "=") === false) {
                continue;
            }

            list ($key, $value) = explode("=", $searchPair);
            if (!$value || in_array($key, array("page", "search"))) {
                continue;
            }

            $searchArray[urldecode($key)] = urldecode($value);
        }

        $paginationBaseLink = "/site/search/?" . str_replace("%", "%%", http_build_query($searchArray)) . "&page=";

        $this->set("pageNavigation", array("baseLink" => $paginationBaseLink,
                                           "totalPages" => $totalPages,
                                           "currentPage" => $page));
    }

    /**
     * Action executed when user click on image, site link before he is redirected to it
     */
    function visitAction()
    {
        $this->autoRender = false;
        if (empty($this->request->siteId)) {
            return;
        }

        $siteId = $this->request->siteId;
        $currentDate = date('d.m.Y');
        $cookieName = md5('site' . $siteId);

        //if can count this vote
        $ip = $this->request->getIp();
        $type = "vis";

        if ((!isset($_COOKIE[$cookieName])
            || $_COOKIE[$cookieName] != $currentDate)
            && !$this->visit->exists($ip, $type, $siteId, 24)
        ) {
            $visit = new VisitRecord();
            $visit->ip = $ip;
            $visit->type = $type;
            $visit->id = $siteId;
            $visit->save();

            //set cookie to next midnight
            setcookie($cookieName, $currentDate, mktime(0, 0, 0, date('n'), date('j'), date('Y')) + 60 * 60 * 24);

            //save vote
            $this->hit->insertHit($ip, $siteId);
        }
    }

    /**
     * Action executed when donesn't exists cached site image and caching is ON
     * Retrieve image from external source and store it
     */
    function getThumbAction($siteId)
    {
        $site = $this->site->findByPk($siteId, "siteId, url, imageSrc");

        if (empty($site)) {
            $this->return404();
        }

        try {
            //download image and sotre it to cache
            $site->downloadAndCacheThumb();
            //get web path to that
            $site->updateImageSrc(false);
            $imageLocation = $site->imageSrc;
        } catch (Exception $e) {
            //if something goes wrong, generator timouts, wrong image display default
            $imageLocation = $site->getDefaultImageSrc();
        }

        //redirect to image location
        $this->redirect($imageLocation);
    }
}
