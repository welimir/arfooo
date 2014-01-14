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


/**
 * Class which make text translations
 */
class Translate extends Object
{
    private $translation;

    /**
     * Singleton instances - one per language
     */
    private static $instances = array();

    /**
     * Returns an instance of Translate for specified language
     * @param string $lang Specify destination language of translation
     */
    public static function getInstance($lang)
    {
        if (!isset(self::$instances[$lang])) {
            self::$instances[$lang] = new self($lang);
        }

        return self::$instances[$lang];
    }

    /**
     * Generates the standard translation object
     *
     * @param string $lang Specify destination language of translation
     */
    public function __construct($lang)
    {
        $dictionaryPath = Config::get("LANGUAGES_PATH") . $lang . ".php";

        if (!file_exists($dictionaryPath)) {
            $dictionaryPath = Config::get("LANGUAGES_PATH") . Config::get("DEFAULT_LANGUAGE") . ".php";
        }

        if (file_exists($dictionaryPath)) {
            $this->addDictionary($dictionaryPath);
        }
    }

    /**
     * Add dictionary for translations
     *
     * @param string $path Path to translation file
     */
    public function addDictionary($path)
    {
        include ($path);
        $this->translation = $language;
    }

    /**
     * Translate the given string
     *
     * @param  string $phrase Phrase to translate
     * @return string
     */
    public function getPhrase($phrase)
    {
        if (!isset($this->translation[$phrase])) {
            $this->translation[$phrase] = $phrase;
            return $phrase;
        } else {
            return $this->translation[$phrase];
        }
    }
}
