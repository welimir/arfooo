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


class SiteThumbBackgroundTask extends BackgroundTask
{
    protected $taskId = "siteThumb";
    private $httpClient;
    private $thumbsPath;

    protected function loadItems()
    {
        $c = new Criteria();
        $this->items = $this->site->findAll($c, "siteId, url", true);
    }

    protected function beforeParsing()
    {
        $this->httpClient = new HttpClient();
        $this->thumbsPath = Config::get("SITES_THUMBS_PATH");
    }

    protected function parseItem($site)
    {
        try {
            $site->downloadAndCacheThumb(true);
        } catch (Exception $e) {

        }

        sleep(5);
    }

    protected function afterParsing()
    {
        Mailer::getInstance()->sendSiteThumbTaskFinished();
    }
}
