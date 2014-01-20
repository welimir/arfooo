<?php

class HtmlFilter
{
    public static function getFilteredHtml($html, $allowedTags, $allowedCssProperties)
    {
        require_once(Config::get('COMPONENTS_PATH') . 'htmlpurifier/library/HTMLPurifier.auto.php');

        $config = HTMLPurifier_Config::createDefault();
        $config->set('Core.Encoding', 'UTF-8');
        $config->set('HTML.Allowed', $allowedTags);
        $config->set('CSS.AllowedProperties', $allowedCssProperties);
        $config->set('Attr.AllowedFrameTargets', '_blank');

        $purifier = new HTMLPurifier($config);

        $cleanHtml = $purifier->purify($html);
        return $cleanHtml;
    }
}
