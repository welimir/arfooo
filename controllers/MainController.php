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


class MainController extends AppController
{
    /**
     * Index page
     */
    function indexAction()
    {
        //set adPage
        Display::set("adPage", "index");

        //set META description
        $this->set("metaDescription", Config::get("siteDescription"));

        $cache = Cacher::getInstance();

        //retrieve predefinied html directoryDescription from db
        if (($message = $cache->load("directoryDescription")) === null) {
            $message = $this->customMessage->findByPk("directoryDescription")->toArray();
            $cache->save($message, null, null, array("custommessage"));
        }

        $this->set("directoryDescription", $message);
    }

    function saveReferrerAction()
    {
        $refererUrl = Request::getInstance()->getRefererUrl();

        if ($refererUrl) {
            $refererHost = AppRouter::getHostNameFromUrl($refererUrl);
            $directoryHost = AppRouter::getHostNameFromUrl(Config::get('siteRootUrl'));

            if ($refererHost && $refererHost != $directoryHost) {
                $this->otherReferrerSite->saveReferrer($refererUrl);
                $this->searchTag->handleSearchEngineReferrer($refererUrl);
            }

        }

        $this->autoRender = false;
    }
}
