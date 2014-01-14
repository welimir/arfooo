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


class SiteMapGenerator
{
    private $linksCountPerFile = 50000;
    private $totalLinksCount = 0;
    private $savePath = "";
    private $xml;
    private $fp;

    public function setLinksCountPerFile($linksCount)
    {
        $this->linksCountPerFile = $linksCount;
    }

    public function setSavePath($savePath)
    {
        $this->savePath = $savePath;
    }

    private function createNewSiteMapFile()
    {
        $lp = intval($this->totalLinksCount / $this->linksCountPerFile) + 1;
        if ($lp == 1) {
            $lp = "";
        }
        $filename = "sitemap$lp.xml";
        $this->fp = fopen($this->savePath . $filename, "w");

        $xml = $this->xml = new XmlWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString(' ');
        $xml->startDocument('1.0', 'UTF-8');
        $xml->startElement("urlset");
        $xml->writeAttribute("xmlns", "http://www.sitemaps.org/schemas/sitemap/0.9");

        fwrite($this->fp, $xml->flush());
    }

    public function addLink($location, $lastmod, $changefreq, $priority)
    {
        if ($this->totalLinksCount % $this->linksCountPerFile == 0) {
            if ($this->fp) {
                $this->endSiteMap();
            }
            $this->createNewSiteMapFile();
        }

        $this->totalLinksCount++;

        $xml = $this->xml;
        $xml->startElement("url");
        $xml->writeElement("loc", $location);

        if ($lastmod != "") {
            $xml->writeElement("lastmod", $lastmod);
        }
        if ($changefreq != "") {
            $xml->writeElement("changefreq", $changefreq);
        }
        if ($priority != "") {
            $xml->writeElement("priority", $priority);
        }
        $xml->endElement();
        fwrite($this->fp, $xml->flush());
    }

    public function endSiteMap()
    {
        $this->xml->endElement();
        fwrite($this->fp, $this->xml->flush());
        fclose($this->fp);
    }
}
