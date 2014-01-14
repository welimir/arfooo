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


class CommentModel extends Model
{
    protected $primaryKey = "commentId";

    function insert($data)
    {
        parent::insert($data);
        $siteId = $data['siteId'];
        $this->updateSiteCommentsCount($siteId);
    }

    function update($data, $c)
    {
        parent::update($data, $c);

        $comment = $this->find($c);
        $siteId = $comment->siteId;

        $this->updateSiteCommentsCount($siteId);
    }

    function del($c, $updateStats = true)
    {
        if ($updateStats) {
            $siteIds = array_unique($this->getArray($c, "siteId"));
        }

        parent::del($c);

        if ($updateStats) {
            foreach ($siteIds as $siteId) {
                $this->updateSiteCommentsCount($siteId);
            }
        }
    }

    function updateSiteCommentsCount($siteId)
    {
        $c = new Criteria();
        $c->add("siteId", $siteId);
        $c->add("validated", "1");

        $votesData = $this->find($c, "SUM(rating) as votesSum, COUNT(rating) as votesCount");
        $votesAverage = $votesData['votesCount'] ? $votesData['votesSum'] / $votesData['votesCount'] : 0;

        $data = array("votesAverage"  => $votesAverage,
                      "votesCount"    => $votesData['votesCount'],
                      "commentsCount" => $votesData['votesCount']);

        $this->site->updateByPk($data, $siteId);
    }

    function getSiteValidatedComments($siteId)
    {
        $c = new Criteria();
        $c->add("siteId", $siteId);
        $c->add("validated", "1");
        $c->addOrder("commentId DESC");

        return $this->comment->findAll($c);
    }

    function getCookieName($siteId)
    {
        return md5('siteComment' . $siteId);
    }

    function checkCanVote($siteId, $ip)
    {
        $cookieName = $this->getCookieName($siteId);

        $c = new Criteria();
        $c->add("siteId", $siteId);
        $c->add("remoteIp", $ip);
        $c->add("date > DATE_SUB(NOW(), INTERVAL 24 HOUR)");

        //if have commenting today
        return !((isset($_COOKIE[$cookieName])
                  && $_COOKIE[$cookieName] == date('d.m.Y'))
                  || ($this->getCount($c) > 0));
    }

    function setSiteCookie($siteId)
    {
        $urlParts = parse_url(Config::get("siteRootUrl"));
        $path = $urlParts['path'];

        setcookie($this->getCookieName($siteId), date('d.m.Y'), mktime(0, 0, 0, date('n'), date('j'), date('Y')) + 60 * 60 * 24, $path);
    }

    function validate($newComment)
    {
        $ip = $newComment->getIp();
        
        //if user is banned
        if ($this->bannedIp->isBanned($ip)) {
            return 'You are not allowed to post comments.';
        }
        
        if (!$this->checkCanVote($newComment->itemId, $ip)) {
            return 'You have already commented this site today.';
        }
        
        if((int)$newComment->rating < 1 || (int)$newComment->rating > 5) {
            return 'Rating must be in range 1-5';
        }
        return '';
    }
}

class CommentRecord extends ModelRecord
{

}
