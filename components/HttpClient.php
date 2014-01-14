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


class HttpClient
{
    public $additionalServerUrl;

    function getSiteContent($url, $header = true, $body = true, $canRedirect = false, $method = "GET", $postData = "")
    {
        $ch = curl_init();

        if ($this->additionalServerUrl) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_URL, $this->additionalServerUrl);
            curl_setopt($ch, CURLOPT_POSTFIELDS, array("url" => $url));
        } else {
            curl_setopt($ch, CURLOPT_URL, $url);
        }

        if ($method == "POST") {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, $header);
        curl_setopt($ch, CURLOPT_NOBODY, !$body);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en; rv:1.8.1.4) Gecko/20070515 Firefox/2.0.0.4');
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        if ($canRedirect) {
            return $this->curlExecRedirect($ch, $header);
        } else {
            return curl_exec($ch);
        }
    }

    function curlExecRedirect($ch, $header = true) {
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $buff = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $headerSeparator = "\r\n\r\n";

        if (in_array($httpCode, array(301, 302))) {
            list($head) = explode($headerSeparator, $buff, 2);
            preg_match('#^Location:(.*?)$#m', $head, $match);
            $newUrl = trim($match[1]);
            $originalUrlParts = parse_url(curl_getinfo($ch, CURLINFO_EFFECTIVE_URL));

            if (!preg_match('#^http://#', $newUrl)) {
                if ($newUrl[0] != '/') {
                    if (!isset($originalUrlParts['path'])
                        || ($pos = strrpos($originalUrlParts['path'], '/')) === false
                    ) {
                        $newUrl = '/' . $newUrl;
                    } else {
                        $newUrl = substr($originalUrlParts['path'], 0, $pos + 1) . $newUrl;
                    }
                }

                $newUrl = 'http://' . $originalUrlParts['host'] . $newUrl;
            }

            curl_setopt($ch, CURLOPT_URL, $newUrl);
            $buff = curl_exec($ch);
        }

        if (!$header && $buff !== false) {
            $pos = strpos($buff, $headerSeparator);
            if ($pos === false) {
                return false;
            }

            $buff = substr($buff, $pos + strlen($headerSeparator));
        }

        return $buff;
    }

    function checkResponseCodeOfSite($url)
    {
        $siteContent = $this->getSiteContent($url);
        $responseCode = preg_match('#^HTTP/1.1 (\d+)#', $siteContent, $m) ? $m[1] : 0;
        return $responseCode;
    }

    function checkBacklinkOnSite($url, $backlink)
    {
        if (!preg_match("#^http://.+#", $url)) {
            return false;
        }
        $backlink = rtrim($backlink, "/");

        $siteContent = $this->getSiteContent($url);
        if (preg_match('#<meta[^>]*nofollow#i', $siteContent)) {
            return false;
        }

        $backlinkExists = ($siteContent && preg_match('#href=["\']' . preg_quote($backlink) . '#', $siteContent));

        return $backlinkExists;
    }

    function getMetaValues($url)
    {
        $resultSet = array('title' => '',
                           'description' => '',
                           'author' => '',
                           'content-type' => '');

        $siteContent = $this->getSiteContent($url);

        if (!$siteContent) {
            return $resultSet;
        }

        // get title
        $resultSet['title'] = (preg_match("#<title>(.*?)</title>#", $siteContent, $matches)) ? $matches[1] : '';

        // get meta tags
        preg_match_all("#<meta.*?>#", $siteContent, $matches);
        $metaTags = $matches[0];

        // iterate all meta tags
        foreach ($metaTags as $metaTag) {
            preg_match_all('#(name|http-equiv|content)="(.*?)"#i', $metaTag, $attributes, PREG_SET_ORDER);

            $propertyName = '';
            $propertyValue = '';

            // iterate all attributes of this meta tag
            foreach ($attributes as $attribute) {
                switch (strtolower($attribute[1])) {
                    case 'name':
                    case 'http-equiv':
                        $propertyName = strtolower($attribute[2]);
                        break;

                    case 'content':
                        $propertyValue = $attribute[2];
                        break;
                }
            }

            if ($propertyName && $propertyValue && isset($resultSet[$propertyName])) {
                $resultSet[$propertyName] = $propertyValue;
            }
        }

        $charset = "iso-8859-1";

        if (preg_match("#charset=([\w-]+)#i", $resultSet['content-type'], $match)) {
            $charset = $match[1];
        }

        foreach ($resultSet as $key => $value) {
            $utfValue = @iconv($charset, "utf-8//ignore", $value);

            $resultSet[$key] = ($utfValue === false) ? utf8_encode($value) : $utfValue;

        }

        return $resultSet;
    }
}
