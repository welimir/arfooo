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


class SiteListModel extends SiteModel
{
    function getWaitingSites($siteId = false, $page = false, $perPage = false)
    {
        $sites = array();
        $c = new Criteria();
        $c->add("status", "waiting");

        if (Config::get("emailConfirmationEnabled") && !Config::get("registrationOfWebmastersEnabled")) {
            $c->addOrder("emailConfirmed = '1' DESC");
        }

        $c->addOrder("siteType = 'premium' DESC");
        $c->addOrder("returnBond = '' ASC");
        $c->addOrder("creationDate");

        if ($siteId) {
            $c->add("siteId", $siteId, is_array($siteId) ? "IN" : "=");
        }

        if ($page !== false) {
            $this->addPageCriteria($c, $page, $perPage);
        }

        $c->setCalcFoundRows(true);
        $sites = $this->selectWithNewFlag($c);

        foreach ($sites as $site) {
            $site->categoryParentsData = $this->category->getParents($site->categoryId);
            $site->keywords = $site->getKeywords();
        }

        return $sites;
    }

    function getIndexRandomList($refreshNeeded)
    {
        if (!$refreshNeeded) {
            $siteIds = explode(",", Config::get("selectionSiteIds"));
        }
        if ($refreshNeeded) {
            $siteIds = $this->generateNewSelection();
        }
        if (empty($siteIds)) {
            return array();
        }

        $c = new Criteria();
        $c->add("siteId", $siteIds, "IN");

        $sites = $this->selectWithNewFlag($c);
        $this->attachParents($sites);

        foreach ($sites as $key => $site) {
            $sites[$key] = $site;
        }

        return $sites;
    }

    function getNewValidatedSites()
    {
        $c = new Criteria();
        $c->add("status", "validated");
        $c->add($this->getForbiddenRule());
        $c->addOrder("creationDate DESC");
        $c->setLimit(Config::get('maxNewsCount'));

        $fields = "url, siteTitle, siteId, imageSrc, firstGalleryImageSrc, description, creationDate, countryCode";
        return $this->selectWithNewFlag($c, $fields);
    }

    function getValidatedTopVisitedSites()
    {
        $c = new Criteria();
        $c->add("visitsCount", 0, ">");
        $c->add("status", "validated");
        $c->add($this->getForbiddenRule());
        $c->addOrder("visitsCount DESC");
        $c->setLimit(Config::get('maxTopHitsCount'));

        return $this->selectWithNewFlag($c, "siteId, url, imageSrc, firstGalleryImageSrc, siteTitle, description, visitsCount, countryCode");
    }

    function getValidatedTopElectedSites()
    {
        $c = new Criteria();
        $c->add("votesAverage", 0, ">");
        $c->add("status", "validated");
        $c->add($this->getForbiddenRule());
        $c->addOrder("votesAverage DESC");
        $c->addOrder("votesCount DESC");
        $c->setLimit(Config::get('maxTopNotesCount'));

        return $this->selectWithNewFlag($c, "siteId, url, imageSrc, firstGalleryImageSrc, siteTitle, description, votesAverage, votesCount, countryCode");
    }

    function getValidatedTopRankSites($pageRank = false)
    {
        $c = new Criteria();
        $c->add("status", "validated");
        $c->add($this->getForbiddenRule());
        $c->addInnerJoin("cachegoogledetails", "cachegoogledetails.url", "sites.url");
        $c->addOrder("cachegoogledetails.pageRank DESC");
        $c->addOrder("siteId DESC");

        if ($pageRank !== false) {
            $c->add("cachegoogledetails.pageRank", $pageRank);
        }

        $c->setLimit(Config::get('maxTopRankCount'));

        return $this->selectWithNewFlag($c, "siteId, sites.url, imageSrc, firstGalleryImageSrc, siteTitle, description, cachegoogledetails.pageRank, countryCode");
    }

    function getValidatedTopReferrersSites()
    {
        $c = new Criteria();
        $c->add("referrerTimes", 0, ">");
        $c->add("status", "validated");
        $c->add($this->getForbiddenRule());
        $c->addOrder("referrerTimes DESC");
        $c->setLimit(Config::get('maxTopReferrersCount'));

        return $this->selectWithNewFlag($c, "siteId, sites.url, imageSrc, firstGalleryImageSrc, siteTitle, description, referrerTimes, countryCode");
    }

    function getValidatedSitesInCategory($categoryId, $page = false, $perPage = false)
    {
        $c = new Criteria();
        if ($perPage === false) {
            $perPage = Config::get("sitesPerPageInCategory");
        }

        if ($page !== false) {
            $this->addPageCriteria($c, $page, $perPage);
        }

        $c->add("status", "validated");

        return $this->getSitesInCategory($categoryId, $c);
    }

    function getSitesInCategory($categoryId, Criteria $c = null)
    {
        if ($c === null) {
            $c = new Criteria();
        }

        $prefix = Config::get('DB_PREFIX');
        $c2 = new Criteria();
        if (Config::get('sitesInParentCategoriesEnabled')) {
            $c2->add(
                "EXISTS(
                    SELECT * FROM {$prefix}categoryparents cp
                    WHERE cp.childId = {$prefix}sites.categoryId
                    AND cp.parentId = ". intval($categoryId) . ')'
                );
        } else {
            $c2->add('categoryId', $categoryId);
        }

        $c3 = new Criteria();
        $c3->add('categoryId', $categoryId);
        $siteIds = $this->siteAdditionalCategory->getArray($c3, 'siteId', false);

        if ($siteIds) {
            $c2->addOr('sites.siteId', $siteIds, 'IN');
        }
        $c->add($c2);

        $c->addOrder("sites.reversePriority");
        $this->addDefaultSortingOrder($c);
        return $this->selectWithNewFlag($c);
    }

    function getSites($page = false, $perPage = 10)
    {
        $c = new Criteria();
        $c->addOrder("referrerTimes DESC");
        if ($page !== false) {
            $this->addPageCriteria($c, $page, $perPage);
        }

        return $this->selectWithNewFlag($c);
    }

    function getSitesThatOwnAKeyword($keywordId, $page = false)
    {
        $c = new Criteria();
        $c->add("status", "validated");
        $c->addInnerJoin("keywordsofsites", "keywordsofsites.siteId", "sites.siteId");
        $c->add("keywordsofsites.keywordId", $keywordId);
        $c->addOrder("priority DESC");
        $this->addDefaultSortingOrder($c);

        if ($page !== false) {
            $this->addPageCriteria($c, $page, Config::get("sitesPerPageInKeywords"));
        }

        return $this->selectWithNewFlag($c);
    }
}
