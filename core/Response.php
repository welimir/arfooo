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
 * Class which handle request
 */
class Response extends Object
{
    private static $instance = null;

    /**
     * Returns an instance of Request object
     * @return Request
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function setCookie($name, $value, $expire = 0)
    {
        setcookie($name, $value, $expire, preg_replace("#^http://[^/]+#", "", Config::get("siteRootUrl")));
    }
}
