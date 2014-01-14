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


class UploadedFile
{
    private $formFieldName;
    public $fileName;
    public $fileExtension;
    private $filters = array();
    private $savePath;
    private $autoCreateDirs = false;

    function __construct($formFieldName)
    {
        $this->formFieldName = $formFieldName;
    }

    function addFilter($type, $value)
    {
        switch ($type) {
            case 'extension':
                $value = (array)$value;
                foreach ($value as &$extension) {
                    $extension = preg_replace('/^\*?\.?/', '', $extension);
                }
                break;
        }
        $this->filters[$type] = $value;
    }

    function wasUploaded()
    {
        return (!empty($_FILES[$this->formFieldName]) && $_FILES[$this->formFieldName]['error'] == 0);
    }

    function validate()
    {
        $formFieldName = $this->formFieldName;

        if (empty($_FILES[$formFieldName])) {
            throw new Exception("Uploaded file dosn't exists");
        }
        if ($_FILES[$formFieldName]['size'] == 0 || $_FILES[$formFieldName]['error'] != 0) {
            throw new Exception("Transmission error or file have 0 bytes");
        }

        if (!is_uploaded_file($_FILES[$formFieldName]['tmp_name'])) {
            throw new Exception("This isn't uploaded file");
        }
        $this->fileExtension = (preg_match("#\.([^\.]*)$#", $_FILES[$formFieldName]['name'], $m)) ? strtolower($m[1]) : "";

        if (in_array($this->fileExtension, array('php', 'php4', 'php5'))) {
            throw new Exception("PHP files can NOT be uploaded");
        }

        if (!empty($this->filters['extension'])
            && !in_array($this->fileExtension, $this->filters['extension'])
        ) {
            throw new Exception("Wrong file format. We accept only (" . implode(", ", $this->filters['extension']) . ")");
        }
        if (!empty($this->filters['maxSize'])
            && $_FILES[$formFieldName]['size'] > $this->filters['maxSize']
        ) {
            throw new Exception("Maximum allowable file size is " . NameTool::formatByteSize($this->filters['maxSize']) . " and your file have " . NameTool::formatByteSize($_FILES[$formFieldName]['size']));

        }
    }

    function getTempName()
    {
        return $_FILES[$this->formFieldName]['tmp_name'];
    }

    function getOriginalName()
    {
        return $_FILES[$this->formFieldName]['name'];
    }

    public static function fileNameToPath($fileName)
    {
        return substr($fileName, 0, 2) . "/";
    }

    public static function createDirsToFile($path, $fileName)
    {
        $currentPath = $path;
        $dirs = array_slice(explode("/", UploadedFile::fileNameToPath($fileName)), 0, -1);

        foreach ($dirs as $dir) {
            $currentPath .= $dir . "/";

            if (!is_dir($currentPath)) {
                $oldMask = umask(0);
                mkdir($currentPath, 0777);
                umask($oldMask);
            }
        }

        return $currentPath;
    }

    function save()
    {
        $errorMessage = $this->validate();

        if ($errorMessage) {
            return false;
        }
        $formFieldName = $this->formFieldName;

        if (!$this->fileName) {
            do {
                // select new random name
                $imgSrc = substr(md5(rand()), 0, 8) . "." . $this->fileExtension;
            } while (file_exists($this->savePath . $imgSrc)); // while this name is already busy


            $this->fileName = $imgSrc;
        }

        if ($this->autoCreateDirs) {
            $this->savePath = UploadedFile::createDirsToFile($this->savePath, $this->fileName);
        }

        if (move_uploaded_file($_FILES[$formFieldName]['tmp_name'], $this->savePath . $this->fileName)) {
            return true;
        }

        return false;
    }

    public function setSavePath($savePath)
    {
        $this->savePath = $savePath;
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    public function getSavePath()
    {
        return $this->savePath;
    }

    public function getSavedFileName()
    {
        return $this->fileName;
    }

    public function setAutoCreateDirs($value)
    {
        $this->autoCreateDirs = $value;
    }

    public function getFileExtension()
    {
        return $this->fileExtension;
    }
}
