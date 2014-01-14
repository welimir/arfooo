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


class AppRouter extends Router
{
    public function __construct()
    {
        parent::__construct();
        self::loadPluginRoutes();

        if (Config::get("urlRewriting")) {
            self::addRewrites(CODE_ROOT_DIR . "config/rewrite.php");
        }
    }

    public static function loadPluginRoutes()
    {
        $dir = new DirectoryIterator(CODE_ROOT_DIR . "plugins/");

        foreach ($dir as $file) {
            if ($file->isDot()) {
                continue;
            }
            $executeDir = 'plugins/' . $file->getFileName();
            self::$routes['^' . $executeDir . '*'] = array("executeDir" => $executeDir);
        }
    }

    public function getControllerActionUrl($url)
    {
        $urlParts = @parse_url($url);

        if (!empty($urlParts['query']) && !empty($urlParts['path'])) {
            $filters = array_map('preg_quote', Model::factoryInstance('setting')->getCampaignFilters());

            foreach ($filters as &$filter) {
                $filter = str_replace('\\*', '.*', $filter);
            }
            $pattern = '#^(?:' . implode('|', $filters) . ')$#';
            if (preg_match($pattern, $urlParts['query'])) {
                $url = $urlParts['path'];
            }
        }
        return parent::getControllerActionUrl($url);
    }

    public static function getResourceUrl($url, $absolute = true)
    {
        switch ($url) {
            case "/uploads/images_categories/":
            case "/uploads/images_categories/defaultCategoryImage.gif":
                $url = "/templates/" . Config::get("templateName") . "/images/defaultCategoryImage.gif";
                break;

            case "/uploads/images_thumbs/default.jpg":
                $url = "/templates/" . Config::get("templateName") . "/images/default.jpg";
                break;
        }

        return parent::getResourceUrl($url, $absolute);
    }

    public static function getObjectUrl($object, $type, $absolute = false)
    {
        switch ($type) {
            case "tag":
                $urlParts = array("/site/tag/%d/%s/%d",
                                  $object['tagId'],
                                  NameTool::strToAscii($object['tag']),
                                  isset($object['page']) ? $object['page'] : 1);
                break;

            case "keyword":
                $urlParts = array("/site/keyword/%d/%s/%d",
                                  $object['keywordId'],
                                  NameTool::strToAscii($object['keyword']),
                                  isset($object['page']) ? $object['page'] : 1);
                break;

            case "category":
                $urlParts = array("/site/category/%d/%s/%d",
                                  $object['categoryId'],
                                  Config::get("advancedUrlRewritingEnabled") ? $object['urlName'] : NameTool::strToAscii($object['name']),
                                  isset($object['page']) ? $object['page'] : 1);
                break;

            case "keyword":
                $urlParts = array("/site/keyword/%d/%s/%d",
                                  $object['keywordId'],
                                  $object['keyword'],
                                  isset($object['page']) ? $object['page'] : 1);
                break;

            case "siteDetails":

                $titleUrl = NameTool::strToAscii($object['siteTitle']);

                if (Config::get("advancedUrlRewritingEnabled")) {
                    $categoryUrl = "";
                    $categoryParents = $object['categoryParents'];

                    foreach ($categoryParents as $categoryParent) {
                        if ($categoryUrl) {
                            $categoryUrl .= "\\";
                        }
                        $categoryUrl .= NameTool::strToAscii($categoryParent['name']);
                    }

                    $urlParts = array("/site/details/%d/%s/%s",
                                      $object['siteId'],
                                      $categoryUrl,
                                      $titleUrl);
                } else {
                    $urlParts = array("/site/details/%d/%s",
                                      $object['siteId'],
                                      $titleUrl);
                }

                break;
        }

        $url = AppRouter::getRewrittedUrl($urlParts);

        if ($absolute) {
            $url = Config::get("siteDomainUrl") . $url;
        }

        return $url;
    }

    public static function getHostNameFromUrl($url)
    {
        $urlParts = @parse_url($url);
        if (!empty($urlParts['host'])
            && !empty($urlParts['scheme'])
            && $urlParts['scheme'] == "http"
        ) {
            return $urlParts['scheme'] . "://" . $urlParts['host'];
        } else {
            return '';
        }
    }

    public function defaultHandler($url)
    {
        if (preg_match('#^uploads/images_thumbs/([a-z0-9]+)/.*-([a-z0-9.]+)$#', $url, $matches)) {
            $filename = CODE_ROOT_DIR . '/uploads/images_thumbs/' . basename($matches[1]) . '/' . basename($matches[2]);
            if (file_exists($filename)) {
                $buff = file_get_contents($filename);
                header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($filename)) . ' GMT');
                header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 60 * 60 * 24 * 30) . ' GMT');
                header('Content-Length: ' . strlen($buff));
                header('Content-Type: image/' . pathinfo($filename, PATHINFO_EXTENSION));
                echo $buff;
                exit;
            }
        }

        if (preg_match('#^(.*)-p(\d+)$#', $url, $m)) {
            $actionUrl = '/site/category//' . str_replace("/", "\\", $m[1]) . '/' . $m[2];
        } else {
            $actionUrl = '/site/category//' . str_replace("/", "\\", $url);
        }

        FrontController::getInstance()->dispatch($actionUrl);
        return true;
    }
}
