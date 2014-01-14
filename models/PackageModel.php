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


class PackageModel extends Model
{
    protected $primaryKey = "packageId";
}

class PackageRecord extends ModelRecord
{
    function updateImageSrc()
    {
        if ($this->imageSrc) {
            $this->imageSrc = AppRouter::getResourceUrl("/uploads/images_packages/" . $this->imageSrc);
        }
    }
}
