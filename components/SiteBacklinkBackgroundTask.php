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


class SiteBacklinkBackgroundTask extends BackgroundTask
{
    protected $taskId = "siteBacklink";
    private $httpClient;

    protected function loadItems()
    {
        $c = new Criteria();
        $c->add("returnBond", "", "!=");
        $c->add('status', 'validated');
        $this->items = $this->site->findAll($c, "siteId, url, returnBond");
    }

    protected function beforeParsing()
    {
        $this->httpClient = new HttpClient();
    }

    protected function parseItem($site)
    {
        $backlinkExists = ($this->httpClient->checkBacklinkOnSite($site['returnBond'], Config::get("siteRootUrl"))) ? 1 : 0;
        $this->site->updateByPk(array("backlinkExists" => $backlinkExists), $site['siteId']);
    }

    protected function afterParsing()
    {
        Mailer::getInstance()->sendSiteBacklinkTaskFinished();
    }
}
