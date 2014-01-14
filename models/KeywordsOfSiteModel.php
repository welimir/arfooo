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


class KeywordsOfSiteModel extends Model
{
    protected $primaryKey = "keywordOfSiteId";

    function storeKeywords($siteId, $keywords, $maxKeywordCount = null)
    {
        $c = new Criteria();
        $c->add("siteId", $siteId);
        $this->del($c);

        $keywords = array_unique($keywords);
        if ($maxKeywordCount === null) {
            $maxKeywordCount = Config::get("maxKeywordsCountPerSite");
        }

        if (count($keywords) > $maxKeywordCount) {
            return;
        }

        $keywordsCount = 0;

        foreach ($keywords as $keywordId) {
            if (empty($keywordId)) {
                continue;
            }

            $keywordsCount++;
            $keywordOfSite = new KeywordsOfSiteRecord();
            $keywordOfSite->keywordId = $keywordId;
            $keywordOfSite->siteId = $siteId;
            $keywordOfSite->save();
        }

        $this->site->updateByPk(array("haveKeywords" => $keywordsCount ? "1" : "0"), $siteId);
    }
}

class KeywordsOfSiteRecord extends ModelRecord
{

}
