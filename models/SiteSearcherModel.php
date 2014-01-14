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


class SiteSearcherModel extends SiteModel
{
    function createSearchCriteria($phrase, $where = false)
    {
        $c = new Criteria();

        if ($phrase) {
            $rawPhrase = addslashes($phrase);
            $phrase = strtr($phrase, '+-><()~*"', ' ');
            $words = preg_split("#\s+#", $phrase);
            $booleanOperator = Config::get("searchEngineWordDefaultOperator") == "AND" ? "+" : "";
            $phrase = $booleanOperator . implode(" " . $booleanOperator, $words);

            $phrase = addslashes($phrase);

            $searchEngineSearchInFields = explode("|", Config::get("searchEngineSearchIn"));
            $fullTextSearchFields = array("siteTitle", "description");
            $searchInFields = "";

            foreach ($fullTextSearchFields as $field) {
                if (in_array($field, $searchEngineSearchInFields)) {
                    if ($searchInFields) {
                        $searchInFields .= ", ";
                    }
                    $searchInFields .= $field;
                }
            }

            if ($searchInFields) {
                $cc = new Criteria();
                $cc->add("MATCH ($searchInFields) AGAINST ('$phrase' IN BOOLEAN MODE)");

                $searchEngineLikeMethodEnabled = Config::get('searchEngineLikeMethodEnabled');
                $searchEngineLikeMethodWordMinLength = Config::get('searchEngineLikeMethodWordMinLength');
                $searchEngineLikeMethodWordMaxLength = Config::get('searchEngineLikeMethodWordMaxLength');

                if ($searchEngineLikeMethodEnabled) {
                    $conjunction = Config::get("searchEngineWordDefaultOperator") == 'AND' ? 'AND' : 'OR';
                    foreach ($words as $word) {
                        $strlen = strlen($word);
                        if ($strlen <= $searchEngineLikeMethodWordMaxLength
                            && $strlen >= $searchEngineLikeMethodWordMinLength
                        ) {
                            foreach ($fullTextSearchFields as $field) {
                                if (in_array($field, $searchEngineSearchInFields)) {
                                    $cc->add($field, "%" . str_replace(array("%", "?"), "", $word) . "%", "LIKE", $conjunction);
                                }
                            }
                        }
                    }
                }

                if (in_array("url", $searchEngineSearchInFields)) {
                    $cc->addOr("LOCATE( '$rawPhrase', url ) > 0 ");
                }
                $c->add($cc);
            }
        }

        if ($where) {
            $rawWhere = addslashes($where);

            $c2 = new Criteria();
            $c2->addOr("LOCATE( '$rawWhere', address ) > 0 ");
            $c2->addOr("LOCATE( '$rawWhere', city ) > 0 ");
            $c2->addOr("LOCATE( '$rawWhere', zipCode ) > 0 ");
            $c->add($c2);
        }

        return $c;
    }

    function searchValidated($values, $page = false)
    {
        $c = new Criteria();
        $c->add("status", "validated");
        $c->add($this->getForbiddenRule());
        $c->addOrder("sites.priority DESC");
        $this->addDefaultSortingOrder($c);

        if (!empty($values['phrase']) || !empty($values['where'])) {
            $phrase = !empty($values['phrase']) ? $values['phrase'] : false;
            $where = !empty($values['where']) ? $values['where'] : false;
            $c->add($this->createSearchCriteria($phrase, $where));
        }

        if (empty($values['categoryId']))
            $values['categoryId'] = 0;

        if (isset($values['categoryId'])) {
            $c->addInnerJoin("categoryparents", "categoryparents.childId", "sites.categoryId");
            $c->add("categoryparents.parentId", $values['categoryId']);

            if (!empty($values['extraField'])) {
                $c2 = $this->extraField->createExtraFieldsCriteria($values['categoryId'], $values['extraField']);
                $c->add($c2);
            }
        }

        if ($page !== false) {
            $c->setPagination($page, Config::get("sitesPerPageInSearch"));
        }

        $c->setCalcFoundRows(true);
        $items = $this->selectWithNewFlag($c);

        return $items;
    }

    function search($phrase, $page = false)
    {
        $c = $this->createSearchCriteria($phrase);
        if ($page !== false) {
            $this->addPageCriteria($c, $page, Config::get("sitesPerPageInSearch"));
        }
        return $this->selectWithNewFlag($c);
    }

    function searchValidatedSite($phrase)
    {
        $c = new Criteria();
        $c->add("status", "validated");

        $c2 = $this->createSearchCriteria($phrase);
        $c->add($c2);
        $c->setLimit(1);

        return $this->find($c, "url, description, siteTitle");
    }

    function getSearchValidatedCount($phrase)
    {
        $c = $this->createSearchCriteria($phrase);
        $c2 = new Criteria();
        $c2->add($c);
        $c2->add("status", "validated");
        return $this->getCount($c2);
    }

}
