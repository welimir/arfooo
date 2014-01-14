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


class KeywordModel extends Model
{
    protected $primaryKey = "keywordId";

    function getLetterIndex()
    {
        $c = new Criteria();
        $c->addGroup("letter");
        return $this->findAll($c, "UPPER(LEFT(keyword, 1)) as letter, COUNT(*) as keywordsCount");
    }

    function getKeywordsWithPrefix($keywordPrefix)
    {
        $keywordPrefix = addslashes($keywordPrefix);
        $c = new Criteria();
        $c->add("LEFT(keyword, 1) = '$keywordPrefix'");
        $c->addOrder("keyword");
        return $this->findAll($c, "keywordId, keyword, SUBSTRING(keyword, 1, 2) as prefix");
    }

    function generateSortedList()
    {
        $c = new Criteria();
        $c->addOrder("keyword");
        return $this->getArray($c, "keyword");
    }

    function del(Criteria $c)
    {
        parent::del($c);
        $this->site->updateStats();
    }

    function insert($data)
    {
        parent::insert($data);
        $this->site->updateStats();
    }

    function update($data, Criteria $c)
    {
        parent::update($data, $c);
        $this->site->updateStats();
    }
}

class KeywordRecord extends ModelRecord
{

}
