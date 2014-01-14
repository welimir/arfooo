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


class MenuController extends AppController
{
    /**
     * Display left menu categories
     */
    function displayCategoriesAction()
    {
        //get category to display set in /site/category
        $parentId = Display::get("currentCategoryId", 0);
        $cacheItemName = "categoryMenuHtml" . $parentId . Config::get("language") . "Template" . Config::get("templateName");

        //check is this menu was cached before
        $cache = Cacher::getInstance();

        if (($categoriesHtml = $cache->load($cacheItemName, false)) === null) {
            $c = new Criteria();
            $c->addOrder('position, name');
            $categories = $this->category->getChilds($parentId, false, $c);

            $this->set("categories", $categories);
            $this->viewFile = "menuleft/categories";
            $categoriesHtml = $this->render();
            $cache->save($categoriesHtml, $cacheItemName, false, array("category"));
        }

        return $categoriesHtml;
    }

    /**
     * Display left menu keywords index
     */
    function displayKeywordsAction()
    {
        $cache = Cacher::getInstance();

        //set cache name separated for languages and templates name because save HTML
        $cacheItemName = "letterIndexHtml" . Config::get("language") . "Template" . Config::get("templateName");

        if (($keywordHtml = $cache->load($cacheItemName, false)) === null) {
            $lettersCount = array();

            //get keywords count which start for letter
            foreach ($this->keyword->getLetterIndex() as $row) {
                $lettersCount[$row['letter']] = $row['keywordsCount'];
            }

            //create letters list to display
            $ranges = array(range('A', 'Z'), range('0', '9'));
            $keywordParts = array();

            foreach ($ranges as $range) {
                $keywords = array();

                foreach ($range as $letter) {
                    $keywords[] = array("letter" => $letter,
                                        "counter" => isset($lettersCount[$letter]) ? $lettersCount[$letter] : 0);
                }

                //divide keywords for columns
                $keywordParts = array_merge($keywordParts, array_chunk($keywords, 10));
            }

            $this->set("keywordParts", $keywordParts);
            $this->viewFile = "menuleft/keywords";
            $keywordHtml = $this->render();

            $cache->save($keywordHtml, $cacheItemName, false, array("keyword"));
        }

        return $keywordHtml;
    }

    /**
     * Display left menu statistics
     */
    function displayStatisticsAction()
    {
        $cache = Cacher::getInstance();

        //set cache name separated for languages and templates name because save HTML
        $cacheItemName = "statisticHtml" . Config::get("language") . "Template" . Config::get("templateName");

        if (($statsHtml = $cache->load($cacheItemName, false)) === null) {
            //get stats defined in statistic model
            $this->set("statistic", $this->statistic->getAllStats());
            $this->viewFile = "menuleft/statistics";

            $statsHtml = $this->render();

            $cache->save($statsHtml, $cacheItemName, false, array("user",
                                                                  "site",
                                                                  "category",
                                                                  "keyword",
                                                                  "refusal"));
        }

        return $statsHtml;
    }

    /**
     * Display execution statistic
     */
    function displayExecutionStatsAction()
    {
        return $this->statistic->getExecutionStats();
    }

    function displayTagCloudAction()
    {
        //check is tag cloud was cached before
        $cache = Cacher::getInstance();
        $cacheItemName = "tagCloudHtml" . Config::get("language") . "Template" . Config::get("templateName");

        if (($tagCloudHtml = $cache->load($cacheItemName, false)) === null) {
            //get stats defined in statistic model
            $this->set("tags", $this->searchTag->getTagCloud());
            $this->viewFile = "menuright/tagCloud";

            $tagCloudHtml = $this->render();

            $cache->save($tagCloudHtml, $cacheItemName, false, array("searchTag"));
        }

        return $tagCloudHtml;
    }
}
