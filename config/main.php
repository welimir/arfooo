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

class Config
{
    static $confVars = array();
    
    public static function get($name, $defaultValue = null)
    {
        return self::$confVars[$name];
    }
    
    public static function set($name, $value)
    {
        self::$confVars[$name] = $value;
    }
    
    public static function getAll()
    {
        return self::$confVars;
    }
    
    public static function add($confVars)
    {
        self::$confVars = array_merge(self::$confVars, $confVars);
    }
}

class Display
{
    static $confVars;
    
    public static function get($name, $defaultValue = null)
    {
        return isset(self::$confVars[$name]) ? self::$confVars[$name] : $defaultValue;
    }
    
    public static function set($name, $value)
    {
        self::$confVars[$name] = $value;
    }
    
    public static function getAll()
    {
        return self::$confVars;
    }
}

Config::set('DEFAULT_LANGUAGE', "en");
Config::set('DEFAULT_TEMPLATE_NAME', "arfooo");
Config::set('DEFAULT_CHARSET', "utf8");

Config::set('CONTROLLERS_PATH', CODE_ROOT_DIR."controllers/");
Config::set('MODELS_PATH', CODE_ROOT_DIR."models/"); 
Config::set('VIEWS_PATH', CODE_ROOT_DIR."views/"); 
Config::set('CORE_PATH', CODE_ROOT_DIR."core/"); 
Config::set('TEMPLATES_PATH', CODE_ROOT_DIR."templates/");
Config::set('COMPONENTS_PATH', CODE_ROOT_DIR."components/");
Config::set('LANGUAGES_PATH', CODE_ROOT_DIR."languages/");

Config::set('SITES_THUMBS_PATH', CODE_ROOT_DIR."uploads/images_thumbs/");
Config::set('PACKAGES_THUMBS_PATH', CODE_ROOT_DIR."uploads/images_packages/");

date_default_timezone_set(@date_default_timezone_get());

require_once(CODE_ROOT_DIR."config/db.php");

if(!empty($dbConfig['DB_INSTALLED']))
{
    foreach($dbConfig as $key => $value)
    {
        Config::set($key, $value);
    }
}
else
{
    $url = substr($_SERVER['SCRIPT_NAME'], 0, -strlen(basename($_SERVER['SCRIPT_NAME'])))."install";
    header("Location: $url");
    exit;
}
