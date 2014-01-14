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


class AdModel extends Model
{
    protected $primaryKey = "adId";

    function setAdOnPage($data)
    {
        $c = new Criteria();
        $c->add("page", $data['page']);
        $c->add("place", $data['place']);

        if ($data['adCriterionId'] == 0
            && !in_array($data['place'], array("general", "predefine"))
        ) {
            $this->del($c);
        } else {
            $ad = $this->ad->find($c);

            if ($ad) {
                $ad->adCriterionId = $data['adCriterionId'];
                $ad->save();
            } else {
                $ad = new AdRecord();
                $ad->fromArray($data);
                $ad->save();
            }
        }

        //if globall switch was set delete category specified settings
        if ($data['place'] == "general"
            && preg_match("#^predefine(Category|Site|Keyword|Letter|Tag)#", $data['page'], $match)
        ) {
            $pagePrefix = strtolower($match[1]);
            $c = new Criteria();
            $c->add("page LIKE '$pagePrefix%'");

            $c2 = new Criteria();
            $c2->add("place", "general");
            $c2->addOr("place", "predefine");

            $c->add($c2);

            $this->del($c);
        }
    }

    function getAdsOnPage($page)
    {
        $c = new Criteria();
        $c->add("page", $page);
        $ads = array();

        foreach ($this->findAll($c, "adCriterionId, place") as $ad) {
            $ads[$ad['place']] = $ad['adCriterionId'];
        }

        $globalSwitchOn = false;

        //checking global switches
        if (preg_match("#^(site|category|keyword|letter|tag)#", $page, $match)
            && strpos($page, "Custom") === false
        ) {
            $pagePrefix = $match[1];
            $c = new Criteria();
            $c->add("page", "predefine" . ucfirst($pagePrefix));
            $c->add("place", "general");
            $c->add("adCriterionId", 1);

            if ($this->getCount($c)) {
                $globalSwitchOn = true;
            }
        }

        //checking predefine in site category
        if (substr_compare("site", $page, 0, 4) == 0
            && strpos($page, "Custom") === false
        ) {
            //only check ads on in category if site haven't on
            if (empty($ads['general'])) {
                $siteId = substr($page, 4);

                $site = Model::factoryInstance("site")->findByPk($siteId, "categoryId");

                $categoryPredefine = $this->isSiteAdsPredefinedInCategory($site->categoryId);

                if ($categoryPredefine !== null) {
                    $globalSwitchOn = $categoryPredefine;
                }
            }

            $customCategorySiteAds = $this->getCustomCategorySiteAds($site->categoryId);

            if (!empty($customCategorySiteAds['general'])) {
                foreach ($customCategorySiteAds as $key => $value) {
                    if (!isset($ads[$key])) {
                        $ads[$key] = $customCategorySiteAds[$key];
                    }
                }
            }
        }

        if (!isset($ads['general'])) {
            $ads['general'] = $globalSwitchOn ? 1 : 0;
        }
        if (!isset($ads['predefine'])) {
            $ads['predefine'] = $globalSwitchOn ? 1 : 0;
        }

        return $ads;
    }

    function getAllPredefinitions()
    {
        $c = new Criteria();
        $c->add("page", array("predefineCategory",
                              "predefineSite",
                              "predefineKeyword",
                              "predefineLetter",
                              "predefineTag"),
                "IN");

        $predefinitions = array();

        foreach ($this->findAll($c) as $ad) {
            $key = strtolower(substr($ad['page'], 9));
            $predefinitions[$key][$ad['place']] = $ad['adCriterionId'];
        }

        return $predefinitions;

    }

    function isSiteAdsPredefinedInCategory($categoryId)
    {
        $c = new Criteria();
        $c->add("page", "category" . $categoryId);
        $c->add("place", "predefine");
        $ad = $this->find($c);

        if (empty($ad)) {
            return null;
        }

        return ($ad->adCriterionId == "1");
    }

    function getCustomCategorySiteAds($categoryId)
    {
        $c = new Criteria();
        $c->add("page", "siteCustomCategory" . $categoryId);
        $ads = array();

        foreach ($this->findAll($c, "adCriterionId, place") as $ad) {
            $ads[$ad['place']] = $ad['adCriterionId'];
        }

        return $ads;
    }
}

class AdRecord extends ModelRecord
{

}
