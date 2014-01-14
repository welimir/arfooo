<?php

class AppTemplateLiteView extends TemplateLiteView
{
    private static $adsLoaded = false;
    private static $adsOnPage;
    private static $adCriterias;
    private static $predefinitions;
    private static $pageIsPredefinied;
    private static $predefinitionTypeName;
    private static $translate;
    private static $gzipHandlerStarted;

    public function __construct()
    {
        parent::__construct();

        $tpl = $this->templateLite;
        $tpl->register_prefilter('cacheLangs');
        $tpl->compile_check = Config::get("templateCompileCheckEnabled") ? true : false;

        if (Config::get("templateWhiteSpaceFilterEnabled")) {
            $tpl->load_filter("output", "trimwhitespace");
        }

        $tpl->register_modifier("action", array($this, "modifierAction"));
        $tpl->register_modifier("url", array($this, "modifierUrl"));
        $tpl->register_modifier("resurl", array($this, "modifierResUrl"));
        $tpl->register_modifier("objurl", array($this, "modifierObjUrl"));
        $tpl->register_modifier("realImgSrc", array($this, "realImgSrc"));
        $tpl->register_modifier("highlight", array($this, "highlight"));
        $tpl->register_modifier("domain", array($this, "domain"));

        $tpl->register_function("displayAd", array($this, "displayAd"));
        $tpl->register_function("display_time", array($this, "displayTime"));
        $tpl->register_function("saveReferrer", array($this, "saveReferrer"));
        $tpl->assign("session", new TemplateSession());

        if (!empty($_COOKIE['previewTemplateName']) && Session::getInstance()->get("role") == "administrator") {
            $this->templateName = basename($_COOKIE['previewTemplateName']);
        }

        if (Config::get("httpGzipCompressionEnabled") && !self::$gzipHandlerStarted) {
            @ob_start("ob_gzhandler");
            self::$gzipHandlerStarted = true;
        }
    }

    public static function session($params, &$tpl)
    {
        return Session::getInstance()->get($params['get']);
    }

    public static function modifierUrl()
    {
        return AppRouter::getRewrittedUrl(func_get_args());
    }

    public static function modifierObjUrl($object, $type, $absolute = false)
    {
        return AppRouter::getObjectUrl($object, $type, $absolute);
    }

    public static function modifierResUrl($string, $absolute = true)
    {
        return AppRouter::getResourceUrl($string, $absolute);
    }

    public static function modifierAction($string)
    {
        return FrontController::getInstance()->dispatch($string, true);
    }

    public static function realImgSrc($imgSrc, $type = "main", $size = "normal", $title = '')
    {
        if ($imgSrc) {
            $path = "/uploads/images_thumbs/" . UploadedFile::fileNameToPath($imgSrc);
        } else {
            $imgSrc = "DefaultMainPhoto.jpg";
            $path = "/templates/arfooo/images/";
        }

        switch ($size) {
            case "small":
                $imgSrc = "s" . $imgSrc;
                break;
            case "medium":
                $imgSrc = "m" . $imgSrc;
                break;
            case "nano":
                $imgSrc = "n" . $imgSrc;
                break;
        }

        if ($title) {
            $path .= NameTool::strToAscii($title) . '-';
        }
        $imgSrc = $path . $imgSrc;

        return AppRouter::getResourceUrl($imgSrc);
    }

    public static function highlight($string, $keywords)
    {
        $keywordsMatch = '';

        foreach ($keywords as $keyword) {
            if ($keywordsMatch != '') {
                $keywordsMatch .= "|";
            }
            $keywordsMatch .= str_replace('\*', '\w*', preg_quote($keyword, '#'));
        }

        $string = preg_replace('#(' . $keywordsMatch . ')#iu', '<b>\1</b>', $string);

        return $string;
    }

    public static function domain($string)
    {
        $urlParts = parse_url($string);
        $string = isset($urlParts['host']) ? $urlParts['host'] : $string;

        return $string;
    }

    public static function saveReferrer($params, &$tpl)
    {
        FrontController::getInstance()->dispatch("/main/saveReferrer");
    }

    public static function displayAd($params, &$tpl)
    {
        $place = $params['place'];
        $page = Display::get("adPage");
        if (empty($page)) {
            return "";
        }

        if (!self::$adsLoaded) {
            $page = Display::get("adPage");

            $cache = Cacher::getInstance();

            //get Ads ids on current page
            if (($data = $cache->load("adsOnPage" . $page)) === null) {
                $data = Model::factoryInstance("ad")->getAdsOnPage($page);
                $cache->save($data, null, null, array("adCriteria", "ad"));
            }

            self::$adsOnPage = $data;

            //load predefined settings
            if (($data = $cache->load("adsPredefinitions")) === null) {
                $data = Model::factoryInstance("ad")->getAllPredefinitions();
                $cache->save($data, null, null, array("adCriteria", "ad"));
            }

            self::$predefinitions = $data;

            if (preg_match("#^(site|keyword|category|letter|tag)#", $page, $match)) {
                self::$predefinitionTypeName = $match[1];
            }

            //load ads html content
            if (($data = $cache->load("adsAllCriterias")) === null) {
                $data = Model::factoryInstance("adCriteria")->getArray(null, "htmlContent");
                $cache->save($data, null, null, array("adCriteria"));
            }

            self::$adCriterias = $data;
            self::$adsLoaded = true;
            self::$pageIsPredefinied = (!empty(self::$adsOnPage['predefine']));
        }

        $htmlContent = "";

        if (!empty(self::$adsOnPage['general']) && !empty(self::$adsOnPage[$place])) {
            $adCriterionId = self::$adsOnPage[$place];

            if (!empty(self::$adCriterias[$adCriterionId])) {
                $htmlContent = self::$adCriterias[$adCriterionId];
            }
        } else {
            if (self::$pageIsPredefinied
                && (!isset(self::$adsOnPage['general']) || self::$adsOnPage['general'] == 1)
            ) {
                if (!empty(self::$predefinitions[self::$predefinitionTypeName][$place])) {
                    $adCriterionId = self::$predefinitions[self::$predefinitionTypeName][$place];

                    if (!empty(self::$adCriterias[$adCriterionId])) {
                        $htmlContent = self::$adCriterias[$adCriterionId];
                    }
                }
            }
        }

        return $htmlContent;
    }

    public static function displayTime($params, &$tpl)
    {
        $scriptEndTime = microtime(true);
        return "&nbsp; &nbsp; Generated in " . sprintf("%.3f", $scriptEndTime - $GLOBALS['scriptStartTime']) . " Queries: " . Display::get("queriesCount", 0);
    }

    public static function preFilterLangMatchCallback($matches)
    {
        $string = $matches[1];
        $translate = self::$translate;
        return $translate->getPhrase($string);
    }

    public static function preFilterLang($templateContent)
    {
        self::$translate = Translate::getInstance(Config::get("language"));
        $templateContent = str_replace('|objurl', '|@objurl', $templateContent);

        $pattern = '#\{\'([^\']+)\'\|lang\}#';

        $templateContent = preg_replace_callback($pattern, array("AppTemplateLiteView",
                                                                 "preFilterLangMatchCallback"),
                                                 $templateContent);

        return $templateContent;
    }
}

class TemplateSession implements ArrayAccess
{
    public function offsetGet($offset)
    {
        return Session::getInstance()->get($offset);
    }

    public function offsetExists($offset)
    {
        return Session::getInstance()->get($offset);
    }

    public function offsetSet($offset, $value)
    {}

    public function offsetUnset($offset)
    {}
}
