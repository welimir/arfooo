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


class PhotoModel extends Model
{
    protected $primaryKey = "photoId";

    function getFields()
    {
        return $this->fields;
    }

    function getItemPhotos($itemId)
    {
        $c = new Criteria();
        $c->add("itemId", $itemId);
        $c->addOrder("photoId");

        return $this->findAll($c, "photoId, src, altText");
    }

    function getSitePhotosCount($itemId, $tempId = null)
    {
        $c = new Criteria();

        if ($tempId) {
            $c->add("tempId", $tempId);
        } else {
            $c->add("itemId", $itemId);
        }

        return $this->getCount($c);
    }

    function deleteFileIfExists($filePath)
    {
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    function deleteSitePhotoFiles($src)
    {
        if (empty($src)) {
            return;
        }

        $dirPath = Config::get("SITES_THUMBS_PATH") . UploadedFile::fileNameToPath($src);

        $this->deleteFileIfExists($dirPath . "s" . $src);
        $this->deleteFileIfExists($dirPath . "m" . $src);
        $this->deleteFileIfExists($dirPath . "n" . $src);
        $this->deleteFileIfExists($dirPath . $src);
    }
    
    function removeExpiredTempPhotos()
    {
        $c = new Criteria();
        $c->add('tempId IS NOT NULL');
        $c->add('addDate < DATE_SUB(NOW(), INTERVAL 24 HOUR)');
        
        $photos = $this->findAll($c, 'photoId, src', true);
        
        foreach ($photos as $photo) {
            $photo->del(false);
        }
    }
}

class PhotoRecord extends ModelRecord
{
    function deletePhotoFiles()
    {
        Model::factoryInstance("photo")->deleteSitePhotoFiles($this->src);
    }

    function del($updateItemPhotos = true)
    {
        $this->deletePhotoFiles();
        parent::del();

        if ($updateItemPhotos && $this->itemId) {
            Model::factoryInstance("site")->findByPk($this->itemId)->updatePhotos();
        }
    }

    function save()
    {
        parent::save();

        if ($this->itemId) {
            Model::factoryInstance("site")->findByPk($this->itemId)->updatePhotos();
        }
        
        if (rand(1, 10) <= 1) {
            Model::factoryInstance("photo")->removeExpiredTempPhotos();
        }
    }
}
