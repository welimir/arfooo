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


class SiteDuplicateContentBackgroundTask extends BackgroundTask
{
    protected $taskId = "siteDuplicateContent";

    /**
     * @var GoogleDuplicateChecker
     */
    private $duplicateChecker;

    protected function loadItems()
    {
        $c = new Criteria();
        $c->add('status', 'validated');
        $this->items = $this->site->findAll($c, 'siteId, description');
    }

    protected function beforeParsing()
    {
        $this->duplicateChecker = new GoogleDuplicateChecker();
        $this->duplicateChecker
            ->setPhrasesToCheckCount(
                Config::get('duplicateContentCheckerPhrasesToCheckCount')
            )
            ->setWordsInPhraseCount(
                Config::get('duplicateContentCheckerWordsInPhraseCount')
            )
            ->setAllowableDuplicatedPhrasesCount(
                Config::get('duplicateContentCheckerAllowableDuplicatedPhrasesCount')
            );
    }

    protected function parseItem($site)
    {
        $isDuplicateContent = $this->duplicateChecker->isDuplicateContent($site['description']) ? '1' : '0';
        $this->site->updateByPk(array('isDuplicateContent' => $isDuplicateContent), $site['siteId']);
    }

    protected function afterParsing()
    {
        Mailer::getInstance()->sendDuplicateContentTaskFinished();
    }
}
