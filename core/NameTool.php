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
 * Class which handle naming convenction
 */
class NameTool
{
    /**
     * Get camelized version of string
     * @param  string $underscoredString Underscore string
     * @return string
     */
    public static function camelize($underscoredString)
    {
        $camelized = str_replace(" ", "", ucwords(str_replace("_", " ", $underscoredString)));
        return $camelized;
    }

    /**
     * Get underscored version of string
     * @param  string $camelcasedString CamelCased string
     * @return string
     */
    public static function underscore($camelcasedString)
    {
        $underscore = strtolower(preg_replace('/(?>=\\w)([A-Z])/', '_\\1', $camelcasedString));
        return $underscore;
    }

    /**
     * Get controller file name basing on its name
     * @param  string $controllerName Name of controller
     * @return string
     */
    public static function getControllerFileName($controllerName)
    {
        $path = ucfirst($controllerName) . "Controller.php";
        return $path;
    }

    /**
     * Add extension to template path
     * @param  string $path withoout extension
     * @return string
     */
    public static function getTemplateFileName($path)
    {
        $path .= ".tpl";
        return $path;
    }

    /**
     * Get controller class name basing on its name and path where is placed
     * @param  string controller_name Controller name
     * @return string
     */
    public static function getControllerClassName($controllerName, $path = "")
    {
        $className = "";

        if ($path) {
            $parts = explode("/", $path);
            foreach ($parts as $dir) {
                $className .= ucfirst(strtolower($dir)) . "_";
            }
        }

        $className .= self::camelize($controllerName) . "Controller";
        return $className;
    }

    public static function formatByteSize($totalSize)
    {
        $unit = "B";

        if ($totalSize >= 1024) {
            $totalSize /= 1024;
            $unit = "KB";
        }

        if ($totalSize >= 1024) {
            $totalSize /= 1024;
            $unit = "MB";
        }

        return round($totalSize, 1) . " " . $unit;
    }

    public static function strToAscii($title, $allowChars = "")
    {
        if (!function_exists("utf8_to_ascii")) {
            require_once (Config::get('COMPONENTS_PATH') . "phputf8/utils/utf8_to_ascii.php");
        }

        $title = utf8_to_ascii($title);

        $specialChars = array(' ', '\'');
        $normalChars = array('-', '-');

        $stringMaxLength = 70;

        $newTitle = substr(preg_replace("#\-$#",
                                        '',
                                        preg_replace("#\-+#",
                                                     '-',
                                                     strtolower(preg_replace("#[^A-Za-z0-9" . preg_quote($allowChars) . "]#",
                                                                             '-',
                                                                             str_replace($specialChars,
                                                                                         $normalChars,
                                                                                         htmlspecialchars_decode($title)))))),
                           0,
                           $stringMaxLength);

        return $newTitle;
    }
}
