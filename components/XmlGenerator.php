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


class XmlElement extends DomElement
{
    function addProperty($propertyName, $value)
    {
        $this->appendChild(new DOMElement($propertyName, $value));
    }

    function addLink($location, $lastmod, $changefreq, $priority)
    {
        $item = new XmlElement("url");
        $this->appendChild($item);

        $item->addProperty('loc', $location);

        if ($lastmod != '') {
            $item->addProperty('lastmod', $lastmod);
        }
        if ($changefreq != '') {
            $item->addProperty('changefreq', $changefreq);
        }
        if ($priority != '') {
            $item->addProperty('priority', $priority);
        }
    }
}

class XmlGenerator extends DOMDocument
{
    function __construct()
    {
        parent::__construct('1.0', 'UTF-8');
        $this->formatOutput = true;
    }
}
