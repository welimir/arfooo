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


class RssController extends AppController
{
    /**
     * Add sites items to site rss xml object
     */
    function appendSites($channelNode, $sites)
    {
        foreach ($sites as $siteRecord) {
            $site = $siteRecord->toArray();

            // Site's permanent link
            $sitePermaLink = AppRouter::getObjectUrl($site, "siteDetails", true);
            $description = utf8_htmlspecialchars(utf8_htmlspecialchars(utf8_substr($site['description'], 0, 75)));

            $item = new XmlElement("item");
            $channelNode->appendChild($item);

            $item->addProperty('title', utf8_htmlspecialchars($site['siteTitle']));
            $item->addProperty('link', $sitePermaLink);
            $item->addProperty('description', $description);

            // must be for RSS in format: Wed, 15 Aug 2007 08:15:32 +0300
            $pubDate = date('D, j M Y H:i:s O', strtotime($site['creationDate']));
            $item->addProperty('pubDate', $pubDate);

            $item->addProperty('guid', $sitePermaLink);
        }
    }

    /**
     * Generate news RSS
     */
    function newsAction()
    {
        if (!Config::get("rssNewsEnabled")) {
            $this->return404();
        }
        $doc = new XmlGenerator();

        $rssNode = $doc->createElement('rss');
        $doc->appendChild($rssNode);

        $rssNode->setAttribute('version', '2.0');

        $channelNode = new XmlElement('channel');
        $rssNode->appendChild($channelNode);

        // add channel properties  //new DOMElement('
        $channelNode->addProperty('title', _t('News'));
        $channelNode->addProperty('link', Config::get('siteRootUrl') . AppRouter::getRewrittedUrl('/site/news', false));
        $channelNode->addProperty('description', _t('The new sites'));
        $channelNode->addProperty('language', 'fr-fr');
        $channelNode->addProperty('lastBuildDate', date('D, j M Y H:i:s O'));
        $channelNode->addProperty('generator', 'RSS Generator');

        $sites = $this->siteList->getNewValidatedSites();
        $this->appendSites($channelNode, $sites);

        $this->set("doc", $doc);
        $this->viewClass = "XmlView";
    }

    /**
     * Generate RSS for specified category
     */
    function categoryAction($categoryId)
    {
        if (!Config::get("rssCategoriesEnabled")) {
            $this->return404();
        }

        //get category data
        $category = $this->category->findByPk($categoryId);
        if (empty($category)) {
            return $this->return404();
        }

        $category = $category->toArray();
        $rawCategoryName = $category['name'];

        $doc = new XmlGenerator();

        $rssNode = $doc->createElement('rss');
        $doc->appendChild($rssNode);

        $rssNode->setAttribute('version', '2.0');

        $channelNode = new XmlElement('channel');
        $rssNode->appendChild($channelNode);

        //add channel properties
        $channelNode->addProperty('title', utf8_htmlspecialchars($rawCategoryName));
        $channelNode->addProperty('link', AppRouter::getObjectUrl($category, "category", true));

        $channelNode->addProperty('description', _t('Category') . ' ' . utf8_htmlspecialchars($rawCategoryName));
        $channelNode->addProperty('language', 'fr-fr');
        $channelNode->addProperty('lastBuildDate', date('D, j M Y H:i:s O'));
        $channelNode->addProperty('generator', 'RSS Generator');

        //retrieve validated sites in this category
        $sites = $this->siteList->getValidatedSitesInCategory($categoryId);
        $this->appendSites($channelNode, $sites);

        $this->set("doc", $doc);
        $this->viewClass = "XmlView";
    }

    /**
     * Generate RSS for specified site
     */
    function siteAction($siteId)
    {
        if (!Config::get("rssSitesEnabled")) {
            $this->return404();
        }

        //get category data
        $site = $this->site->findByPk($siteId);
        if (empty($site)) {
            return $this->return404();
        }

        $this->site->attachParents($site);
        $rawSiteTitle = $site['siteTitle'];

        $doc = new XmlGenerator();

        $rssNode = $doc->createElement('rss');
        $doc->appendChild($rssNode);

        $rssNode->setAttribute('version', '2.0');

        $channelNode = new XmlElement('channel');
        $rssNode->appendChild($channelNode);

        //add channel properties
        $channelNode->addProperty('title', utf8_htmlspecialchars($rawSiteTitle));
        $channelNode->addProperty('link', AppRouter::getObjectUrl($site, "siteDetails", true));

        $channelNode->addProperty('description', _t('Site') . ' ' . utf8_htmlspecialchars($rawSiteTitle));
        $channelNode->addProperty('language', 'fr-fr');
        $channelNode->addProperty('lastBuildDate', date('D, j M Y H:i:s O'));
        $channelNode->addProperty('generator', 'RSS Generator');

        $sites = array($site);
        $this->appendSites($channelNode, $sites);

        $this->set("doc", $doc);
        $this->viewClass = "XmlView";
    }
}
