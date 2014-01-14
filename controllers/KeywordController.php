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


class KeywordController extends AppController
{
    /**
     * Show keywords starting with letter
     */
    function showAction($letter)
    {
        if (!Config::get('keywordsEnabled') || !preg_match("#^[A-Z0-9]$#", $letter)) {
            return $this->return404();
        }

        //set adPage for display
        Display::set("adPage", "letter$letter");

        $keywordGroups = array();

        //retrieve keywors which start with $letter
        $keywords = $this->keyword->getKeywordsWithPrefix($letter);
        $keywordIds = array();

        foreach ($keywords as $keyword) {
            $keywordIds[] = $keyword['keywordId'];
        }

        //Count validated sites which contain keyword
        $c = new Criteria();
        $c->add("keywordId", $keywordIds, "IN");
        $c->addGroup("keywordId");
        $c->addInnerJoin("sites", "sites.siteId", "keywordsofsites.siteId");
        $c->add("status", "validated");
        $sitesCountsForKeyword = $this->keywordsOfSite->getArray($c, "count(*)", "keywordId");

        //foreach keyword on this page check have many sites include it and push it to prefix group
        foreach ($keywords as $keyword) {
            //if some site have this keyword
            if (isset($sitesCountsForKeyword[$keyword['keywordId']])) {
                $keyword['count'] = $sitesCountsForKeyword[$keyword['keywordId']];
            } else {
                //if no set counter to default 0
                $keyword['count'] = 0;
            }

            //if group for this prefix doesn't exists so far
            if (!isset($keywordGroups[$keyword['prefix']]['keywords'])) {
                //create group for this prefix
                $keywordGroups[$keyword['prefix']]['keywords'] = array();
            }

            //add keyword to prefix group
            $keywordGroups[$keyword['prefix']]['keywords'][] = $keyword;
        }

        $this->set("letter", $letter);
        $this->set("keywordGroups", $keywordGroups);
    }
}
