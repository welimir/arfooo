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


class SiteHttpCodeBackgroundTask extends BackgroundTask
{
    protected $taskId = "siteHttpCode";
    private $httpClient;

    protected function beforeParsing()
    {
        $this->httpClient = new HttpClient();
    }

    protected function loadItems()
    {
        $c = new Criteria();
        $c->add('status', 'validated');
        $this->items = $this->site->findAll($c, "siteId, url");
    }

    protected function parseItem($site)
    {
        $httpCode = $this->httpClient->checkResponseCodeOfSite($site['url']);
        $this->site->updateByPk(array("httpCode" => $httpCode), $site['siteId']);
    }
}
