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
 * Class which map urls to actions and actions to urls
 */
class Router
{
    protected static $routes = array();
    private static $rewrites = array();
    private static $reverseRewrites = array();
    private static $websiteDir;

    public function __construct()
    {
        $this->loadDefaultRoutes();
    }

    public function setWebsiteDir($dir)
    {
        self::$websiteDir = $dir;
    }

    public function loadDefaultRoutes()
    {
        require (CODE_ROOT_DIR . "config/routes.php");
        self::$routes = $routes;
    }

    public function addRewrites($file)
    {
        require ($file);
        self::$rewrites += $rewrites;
        self::$reverseRewrites += $reverseRewrites;
    }

    public function getControllerActionUrl($url)
    {
        if (!empty(self::$rewrites) && $url != "/") {
            foreach (self::$rewrites as $pattern => $replacements) {
                $replaced = 0;
                $url = preg_replace($pattern, $replacements, $url, -1, $replaced);
                if ($replaced) {
                    break;
                }
            }
        }

        return $url;
    }

    public static function getRewrittedUrl($urlParts, $absolute = true)
    {
        if (is_array($urlParts)) {
            for ($i = 1, $cnt = count($urlParts); $i < $cnt; $i++) {
                $urlParts[$i] = str_replace("/", " ", $urlParts[$i]);
            }

            $url = call_user_func_array('sprintf', $urlParts);
        } else {
            $url = $urlParts;
        }

        if (!empty(self::$reverseRewrites)) {
            foreach (self::$reverseRewrites as $pattern => $replacements) {
                $replaced = 0;
                $url = preg_replace($pattern, $replacements, $url, -1, $replaced);
                if ($replaced) {
                    break;
                }
            }

            $url = str_replace("\\", "/", $url);
        }

        if (!Config::get("urlRewriting")) {
            $url = "/index.php" . $url;
        }

        $url = ($absolute) ? self::$websiteDir . $url : ltrim($url, '/');
        return $url;
    }

    public static function getResourceUrl($url, $absolute = true)
    {
        $url = ($absolute) ? self::$websiteDir . $url : ltrim($url, '/');
        return $url;
    }

    public function addRoute($routePattern, $routeOptions)
    {
        self::$routes[$routePattern] = $routeOptions;
    }

    /**
     * Return controller dir and routing path for specified url
     *
     * @param string $url
     * @return array
     */
    public function getRoute($url)
    {
        foreach (self::$routes as $routePattern => $routeOptions) {
            if (preg_match('#' . $routePattern . '#', $url . '/')) {
                return $routeOptions;
            }
        }
    }

    public function defaultHandler($url)
    {
        return false;
    }
}
