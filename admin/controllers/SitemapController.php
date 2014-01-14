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


class Admin_SitemapController extends AppController
{
    function init()
    {
        $this->acl->allow("administrator", $this->name, "*");

        if (!$this->acl->isAllowed($this->session->get("role"), $this->name, $this->action)) {
            $this->redirect(AppRouter::getRewrittedUrl("/admin/main/logIn"));
        }
    }

    function indexAction()
    {
        // add static links
        $urlRewriting = Config::get('urlRewriting');
        $siteRootUrl = Config::get('siteRootUrl');

        $siteMapGenerator = new SiteMapGenerator();
        $siteMapGenerator->setSavePath(CODE_ROOT_DIR);

        $siteMapGenerator->addLink($siteRootUrl, '', 'always', '1.0');

        if (Config::get("newsEnabled")) {
            $siteMapGenerator->addLink($siteRootUrl . AppRouter::getRewrittedUrl('/site/news', false), '', 'always', '1.0');
        }
        if (Config::get("rssNewsEnabled")) {
            $siteMapGenerator->addLink($siteRootUrl . AppRouter::getRewrittedUrl('/rss/news', false), '', 'always', '0.8');
        }
        if (Config::get("notationsEnabled")) {
            $siteMapGenerator->addLink($siteRootUrl . AppRouter::getRewrittedUrl('/site/topNotes', false), '', '', '0.8');
        }
        if (Config::get("hitsEnabled")) {
            $siteMapGenerator->addLink($siteRootUrl . AppRouter::getRewrittedUrl('/site/topHits', false), '', '', '0.8');
        }
        if (Config::get("topReferrersEnabled")) {
            $siteMapGenerator->addLink($siteRootUrl . AppRouter::getRewrittedUrl('/site/topReferrers', false), '', '', '0.8');
        }
        if (Config::get("topRankEnabled")) {
            $siteMapGenerator->addLink($siteRootUrl . AppRouter::getRewrittedUrl('/site/topRank', false), '', '', '0.8');
        }
        if (Config::get("allCategoriesPageEnabled")) {
            $siteMapGenerator->addLink($siteRootUrl . AppRouter::getRewrittedUrl('/category/showAll', false), '', 'weekly', '1.0');
        }
        if (Config::get("contactPageEnabled")) {
            $siteMapGenerator->addLink($siteRootUrl . AppRouter::getRewrittedUrl('/contact', false), '', '', '1.0');
        }
        // add all sites links
        $step = 1000;
        $maxSiteId = $this->site->get("MAX(siteId)");

        for ($startId = 0; $startId <= $maxSiteId; $startId += $step) {
            $c = new Criteria();
            $c->add("siteId", $startId, ">=");
            $c->add("siteId", $startId + $step, "<");
            $c->add("status", 'validated');

            $sites = $this->site->findAll($c, "siteId, siteTitle, creationDate, categoryId");
            $this->site->attachParents($sites);

            foreach ($sites as $site) {
                $siteMapGenerator->addLink(AppRouter::getObjectUrl($site, "siteDetails", true), date("Y-m-d", strtotime($site['creationDate'])), '', '1.0');
            }
        }

        // add all categories links
        $categories = $this->category->findAll(null, "categoryId, name, urlName");

        foreach ($categories as $category) {
            $siteMapGenerator->addLink(AppRouter::getObjectUrl($category, "category", true), "", '', '1.0');
        }

        $siteMapGenerator->endSiteMap();
    }
}
