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


class GoogleDuplicateChecker
{
    const API_URL = 'http://ajax.googleapis.com/ajax/services/search/web';

    private $_phrasesToCheckCount = 3;
    private $_wordsInPhraseCount = 6;
    private $_allowableDuplicatedPhrasesCount = 0;

    private $_logger = false;

    /**
     * @return GoogleDuplicateChecker
     */
    public function setPhrasesToCheckCount($count)
    {
        $this->_phrasesToCheckCount = $count;
        return $this;
    }

    /**
     * @return GoogleDuplicateChecker
     */
    public function setWordsInPhraseCount($count)
    {
        $this->_wordsInPhraseCount = $count;
        return $this;
    }

    /**
     * @return GoogleDuplicateChecker
     */
    public function setAllowableDuplicatedPhrasesCount($count)
    {
        $this->_allowableDuplicatedPhrasesCount = $count;
        return $this;
    }

    protected function _log($txt)
    {
        if ($this->_logger) {
            file_put_contents(CODE_ROOT_DIR . 'duplicate.html', nl2br($txt), FILE_APPEND);
        }
    }

    public function isDuplicateContent($content)
    {
        $this->_log("-------------------------------\n");
        $words = preg_split('/\s+/', strip_tags(html_entity_decode($content, ENT_COMPAT, 'UTF-8')));
        $chunks = array_chunk($words, $this->_wordsInPhraseCount);
        $chunkRandKeys = (array)array_rand($chunks, min($this->_phrasesToCheckCount, count($chunks)));

        $duplicates = 0;
        foreach ($chunkRandKeys as $key) {
            $phrase = '"' . implode(' ', $chunks[$key]) . '"';
            $phrase .= ' -site:' . Config::get('siteRootUrl');
            $this->_log("<b>Checking $phrase</b>\n");
            $url = self::API_URL . '?v=1.0&q=' . urlencode($phrase);
            $this->_log("Url: $url\n");
            $buff = @file_get_contents($url);
            $response = json_decode($buff, true);
            $this->_log(print_r($response, true));

            // has some results
            if (!empty($response['responseData']['results'])) {
                $this->_log("duplicate phrase\n");
                $duplicates++;
            } else {
                $this->_log("unique phrase\n");
            }
            if ($duplicates > $this->_allowableDuplicatedPhrasesCount) {
                $this->_log("\n<b>Duplicate content detected</b>\n\n");
                return true;
            }
        }

        $this->_log("\n<b>Text is unique</b>\n\n");
        return false;
    }
}
