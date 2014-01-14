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
 * Class which retrieve and store values to/from cache
 */
class Cacher extends DataAggregator
{
    private static $instance = null;
    private $lastId;
    private $lastSerialized;
    private $cacheDir;
    private $prefix = "arfooo_cache_";

    /**
     * Returns an instance of Cacher object
     * @return Cacher
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Generates the standard Cacher object
     */
    public function __construct()
    {
        $this->cacheDir = CODE_ROOT_DIR . "cache/";
    }

    /**
     * Generating filename of cache basing on id
     */
    private function idToFileName($id)
    {
        return $this->prefix . $id;
    }

    private function fileNameToId($fileName)
    {
        return substr($fileName, strlen($this->prefix));
    }

    private function getDataFilePath($id)
    {
        return $this->cacheDir . $this->idToFileName($id);
    }

    private function getInfoFilePath($id)
    {
        return $this->cacheDir . $this->idToFileName("info_" . $id);
    }

    public function save($buff, $id = null, $serialized = null, $tags = array())
    {
        clearstatcache();

        if ($id == null) {
            $id = $this->lastId;
        }
        if ($serialized === null) {
            $serialized = $this->lastSerialized;
        }

        $info = serialize(array("tags" => $tags));
        if ($serialized) {
            $buff = serialize($buff);
        }

        $this->saveFile($this->getDataFilePath($id), $buff);
        $this->saveFile($this->getInfoFilePath($id), $info);
    }

    private function loadCacheInfo($id)
    {
        $content = $this->loadFile($this->getInfoFilePath($id));
        return unserialize($content);
    }

    public function clean($mode = "all", $tags = array())
    {
        $dir = new DirectoryIterator($this->cacheDir);

        foreach ($dir as $file) {
            $fileName = $file->getFileName();
            if ($file->isDot() || substr_compare($this->prefix, $fileName, 0, strlen($this->prefix)) != 0 || $fileName == ".htaccess") {
                continue;
            }

            $id = $this->fileNameToId($file->getFileName());

            if (substr_compare("info_", $id, 0, 5) == 0) {
                continue;
            }

            switch ($mode) {
                case "all":
                    $this->delete($id);
                    break;

                case "tag":
                    $match = false;
                    $info = $this->loadCacheInfo($id);

                    foreach ($tags as $tag) {
                        if (in_array($tag, $info['tags'])) {
                            $match = true;
                            break;
                        }
                    }

                    if ($match) {
                        $this->delete($id);
                    }

                    break;

                default:
                    throw new Exception("Tag clean unsupported mode");
            }
        }
    }

    public function delete($id)
    {
        $this->deleteFile($this->getDataFilePath($id));
        $this->deleteFile($this->getInfoFilePath($id));
    }

    private function deleteFile($fileName)
    {
        clearstatcache();
        if (file_exists($fileName)) {
            unlink($fileName);
        }
    }

    private function saveFile($fileName, $content)
    {
        file_put_contents($fileName, $content);
    }

    private function loadFile($fileName)
    {
        return @file_get_contents($fileName);
    }

    public function load($id, $serialized = true, $lifeTime = null)
    {
        $this->lastId = $id;
        $this->lastSerialized = $serialized;

        $fileName = $this->getDataFilePath($id);

        if (file_exists($fileName) && (!$lifeTime || filemtime($fileName) > time() - $lifeTime)) {
            $buff = $this->loadFile($fileName);
            if ($serialized) {
                $buff = unserialize($buff);
            }
            return $buff;
        }

        return null;
    }
}
