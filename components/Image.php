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

class Image
{
    private $width;
    private $height;
    private $path;
    private $jpegQuality = 90;
    public $im;

    public function __construct($srcPath = null)
    {
        if ($srcPath) {
            $this->loadFromFile($srcPath);
        }
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function loadFromFile($path)
    {
        if (!file_exists($path)) {
            throw new Exception("Podany plik nie istnieje");
            return false;
        }

        switch ($this->getFileExtension($path)) {
            case 'jpg':
            case 'jpeg':
                $im = imagecreatefromjpeg($path);
                break;

            case 'gif':
                $im = imagecreatefromgif($path);
                break;

            case 'png':
                $im = imagecreatefrompng($path);
                break;

            default:
                throw new Exception("Nie rozpoznano formatu pliku");
                return false;
        }

        if (!$im) {
            throw new Exception("Wczytanie obrazka zakonczylo sie niepowodzeniem");
            return false;
        }

        $this->im = $im;
        $this->width = imagesx($this->im);
        $this->height = imagesy($this->im);
    }

    private function getFileExtension($path)
    {
        return (preg_match("#\.([^\.]+)$#", $path, $m)) ? strtolower($m[1]) : "";
    }

    public function createNew($width, $height)
    {
        $this->im = imagecreatetruecolor($width, $height);
    }

    public function saveToFile()
    {
        switch ($this->getFileExtension($this->path)) {
            case 'jpg':
            case 'jpeg':
                imagejpeg($this->im, $this->path, $this->jpegQuality);
                break;

            case 'gif':
                imagegif($this->im, $this->path);
                break;

            case 'png':
                imagepng($this->im, $this->path);
                break;

            default:
                return false;
        }

        return true;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getHeight()
    {
        return $this->height;
    }
}
