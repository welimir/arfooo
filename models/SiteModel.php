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


class SiteModel extends Model
{
    protected $primaryKey = "siteId";
    protected $dbTable = "sites";
    protected $name = "site";

    function selectWithNewFlag(Criteria $c, $fields = "*")
    {
        $noveltyPeriod = intval(Config::get("siteNoveltyPeriod"));
        $sites = $this->findAll($c, $fields . ", categoryId, packageId, ADDDATE(creationDate, $noveltyPeriod) > NOW() as isNew", true);
        $packageIds = array();

        foreach ($sites as $site) {
            if ($site->packageId) {
                $packageIds[$site->packageId] = true;
            }
            $site->packageImageSrc = "";
            $site->packageName = "";
            $site->updateImageSrc();
        }

        if (!empty($packageIds)) {
            $pc = new Criteria();
            $pc->add("packageId", array_keys($packageIds), "IN");
            $packages = $this->package->getArray($pc, "name, imageSrc", null, true);

            foreach ($sites as $site) {
                if (isset($packages[$site->packageId])) {
                    $site->packageImageSrc = $packages[$site->packageId]['imageSrc'];
                    $site->packageName = $packages[$site->packageId]['name'];
                }
            }
        }

        if (Config::get("advancedUrlRewritingEnabled")) {
            $this->attachParents($sites);
        }

        return $sites;
    }

    function generateNewSelection()
    {
        $c = new Criteria();
        $c->add("status", "validated");
        $c->add($this->getForbiddenRule());
        $c->addOrder("RAND()");
        $c->setLimit(Config::get('selectionSitesCount'));

        $siteIds = $this->site->getArray($c, "siteId");
        $siteIds = array_keys($siteIds);

        $this->setting->set('selectionSiteIds', implode(",", $siteIds));

        $todayDate = date('Y-m-d');
        $this->setting->set('selectionGenerationDate', $todayDate);

        $cache = Cacher::getInstance();
        $cache->clean("tag", array("site", "setting"));

        return $siteIds;
    }

    function getForbiddenRule()
    {
        $prefix = Config::get("DB_PREFIX");
        return "EXISTS(SELECT * FROM " . $prefix . "categories WHERE " . $prefix . "categories.categoryId=" . $prefix . "sites.categoryId AND forbidden='0')";
    }

    function getSiteWithDetails($siteId)
    {
        $c = new Criteria();
        $c->add("siteId", $siteId);
        $sites = $this->selectWithNewFlag($c);
        return $sites ? $sites[0] : false;
    }

    function addDefaultSortingOrder($c)
    {
        $order = Config::get("sitesSortyBy");
        if (!in_array($order, array("creationDate", "referrerTimes", "siteTitle"))) {
            $order = "creationDate";
        }

        if ($order == "referrerTimes") {
            $order .= " DESC";
        }
        $c->addOrder($order);
    }

    function addPageCriteria($c, $page, $resultsPerPage)
    {
        if (empty($page) || $page < 1) {
            $page = 1;
        }
        $c->setLimit($resultsPerPage);
        $c->setOffset(($page - 1) * $resultsPerPage);
    }

    function update($data, Criteria $c)
    {
        if (isset($data['address']) || isset($data['city']) || isset($data['country'])) {
            $data['_lng'] = "NULL";
            $data['_lat'] = "NULL";
        }

        if (isset($data['priority'])) {
            $data['reversePriority'] = -$data['priority'];
        }

        parent::update($data, $c);

        if (Config::get("siteDetailsCacheEnabled")) {
            $condition = $c->getCondition("siteId");

            if ($condition && !is_array($condition['value'])) {
                Cacher::getInstance()->clean("tag", array("site" . $condition['value']));
            }
        }

        //if status changed must recalculate validated, refused counts
        if (isset($data['status']) || isset($data['categoryId'])) {
            $this->updateStats();
        }
    }

    function del(Criteria $c, $updateStats = true)
    {
        $condition = $c->getCondition("siteId");

        $nc = new Criteria();
        $nc->addCondition($condition);

        parent::del($c);

        Model::factoryInstance("keywordsOfSite")->del($nc);
        Model::factoryInstance("comment")->del($nc, false);
        Model::factoryInstance("hit")->del($nc);

        $nc = new Criteria();
        $condition['key'] = "itemId";
        $nc->addCondition($condition);

        Model::factoryInstance("extraFieldValue")->del($nc);

        $photos = Model::factoryInstance("photo")->findAll($nc, "*", true);

        foreach ($photos as $photo) {
            $photo->del(false);
        }

        if ($updateStats) {
            $this->updateStats();
        }
    }

    function insert($data)
    {
        if (isset($data['priority'])) {
            $data['reversePriority'] = -$data['priority'];
        }

        parent::insert($data);
        $this->updateStats();
    }

    function updateStats()
    {
        $this->category->updateValidatedSitesCount();
        Cacher::getInstance()->clean("tag", array("site", "category", "keyword"));
    }

    function attachPhotos(&$item)
    {
        $photos = array();

        if ($item->photosCount) {
            foreach ($this->photo->getItemPhotos($item->siteId) as $photo) {
                $photos[] = array("thumbSrc" => AppRouter::getResourceUrl("/uploads/images_thumbs/" . UploadedFile::fileNameToPath($photo['src']) . "s" . $photo['src']),
                                  "photoId"  => $photo['photoId'],
                                  "name"     => "");
            }
        }

        $item->photos = $photos;
    }

    function attachKeywordIds(&$item)
    {
        $item->keywordIds = $item->getKeywordIds();
    }

    function fillExtraFields(&$item)
    {
        $extraFields = $this->extraField->getItemExtraFields($item);
        $extraFieldValues = array();

        foreach ($extraFields as $fieldId => $extraField) {
            $fieldName = 'extraField[' . $fieldId . ']';
            if ($extraField['type'] == 'checkbox') {
                $fieldName .= "[]";
            }

            if (in_array($extraField['type'], array('url', 'file'))) {
                foreach ($extraField['value'] as $key => $value) {
                    $extraFieldValues[$fieldName . '[' . $key . ']'] = $value;
                }
            } else {
                $extraFieldValues[$fieldName] = $extraField['value'];
            }
        }

        $item->fromArray($extraFieldValues);
    }

    function attachExtraFields(&$item)
    {
        $item->extraFields = $item->haveExtraFields ? $this->extraField->getItemExtraFields($item) : array();
    }

    function attachParents(&$object)
    {
        if (empty($object)) {
            return;
        }
        if ($object instanceof ModelRecord) {
            $items = array($object);
        } else {
            $items = & $object;
        }

        $categoryIds = array();

        foreach ($items as $item) {
            if (!empty($item['categoryParents'])) {
                continue;
            }
            $categoryIds[] = $item['categoryId'];
        }

        if (!empty($categoryIds)) {
            $categoryParents = $this->category->getParents($categoryIds);

            foreach ($items as &$item) {
                if (empty($categoryParents[$item['categoryId']])) {
                    continue;
                }

                $item['categoryParents'] = $categoryParents[$item['categoryId']];
            }
        }
    }
}

class SiteRecord extends ModelRecord
{
    function updateImageSrc($canBeOverwrittenByGalleryImage = true)
    {
        $this->imageSrc = $this->getThumbnailSrc($canBeOverwrittenByGalleryImage);
    }

    function getKeywordIds()
    {
        return $this->getKeywords(true);
    }

    function getSimilarSites()
    {
        $c = new Criteria();
        $c->add("categoryId", $this->categoryId);
        $c->add("siteId", $this->siteId, "!=");
        $c->add("status", "validated");

        if (Config::get("similarSiteKeywordMatch")) {
            if (empty($this->keywords)) {
                return array();
            }
            $keywordIds = implode(",", array_keys($this->keywords));
            $prefix = Config::get("DB_PREFIX");

            $c->add("EXISTS(SELECT * FROM " . $prefix . "keywordsofsites
                     WHERE " . $prefix . "keywordsofsites.siteId=" . $prefix . "sites.siteId AND keywordId IN ($keywordIds))");
        }

        $c->addOrder("RAND()");
        $c->setLimit(Config::get("randomSitesInDetailsCount"));
        $siteModel = Model::factoryInstance("site");
        $sites = $siteModel->findAll($c, "siteId, siteTitle, description, categoryId");

        if (Config::get("advancedUrlRewritingEnabled")) {
            $siteModel->attachParents($sites);
        }

        return $sites;
    }

    function getKeywords($onlyIds = false)
    {
        $values = array();

        if (!$this->haveKeywords) {
            return $values;
        }

        $c = new Criteria();
        $c->add("siteId", $this->siteId);

        if ($onlyIds) {
            $field = "keywordId";
        } else {
            $field = "keywords.keywordId, keyword";
            $c->addInnerJoin("keywords", "keywords.keywordId", "keywordsofsites.keywordId");
        }

        foreach (Model::factoryInstance("keywordsOfSite")->findAll($c, $field) as $keyword) {
            if ($onlyIds) {
                $values[] = $keyword['keywordId'];
            } else {
                $values[] = $keyword;
            }
        }

        return $values;
    }

    private function getThumbGeneratorSiteUrl()
    {
        $thumbsGeneratorUrl = Config::get("thumbsGeneratorUrl");

        if (stripos($thumbsGeneratorUrl, "[url]") !== false) {
            $url = str_ireplace("[url]", $this->url, $thumbsGeneratorUrl);
        } else {
            $url = $thumbsGeneratorUrl . $this->url;
        }

        return $url;
    }

    function downloadAndCacheThumb($forced = false)
    {
        $imageFileName = Config::get("SITES_THUMBS_PATH") . $this->siteId . ".jpg";

        if (!file_exists($imageFileName) || $forced) {
            if (!Config::get("thumbsGeneratorUrl")) {
                throw new Exception("thumbsGeneratorUrl not set");
            }

            $url = $this->getThumbGeneratorSiteUrl();
            $httpClient = new HttpClient();
            $thumbImage = $httpClient->getSiteContent($url, false, true, true);

            if ($thumbImage) {
                // check whether the image is valid
                if (function_exists('imagecreatefromstring')
                    && @imagecreatefromstring($thumbImage) === false
                ) {
                    throw new Exception("Downloaded thumb is not an image");
                }
                file_put_contents($imageFileName, $thumbImage);
            }
        }
    }

    function deleteImage()
    {
        $thumbsPath = Config::get("SITES_THUMBS_PATH");

        if (!empty($this->imageSrc)) {
            $oldFilePath = $thumbsPath . basename($this->imageSrc);

            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }

            $this->imageSrc = "";
        }
    }

    function updateAscreen()
    {
        $thumbsPath = Config::get("SITES_THUMBS_PATH");

        $im = @imagecreatefromjpeg(rtrim($this->url, "/") . "/ascreen.jpg");

        if (!empty($im) && @imagesx($im) <= 250 && @imagesy($im) <= 200) {
            do {
                // select new random name
                $imgSrc = rand(100000000000000000, 9999999999999999999) . ".jpg";
                $path = $thumbsPath . $imgSrc;
            } while (file_exists($path)); // while this name is already busy

            imagejpeg($im, $path, 90);

            $this->deleteImage();

            $this->imageSrc = $imgSrc;
            $this->ascreen = 1;
        }
    }

    function getDefaultImageSrc()
    {
        return AppRouter::getResourceUrl("/uploads/images_thumbs/default.jpg");
    }

    function getThumbnailSrc($canBeOverwrittenByGalleryImage = true)
    {
        if ($canBeOverwrittenByGalleryImage && (empty($this->url) || (Config::get("firstGalleryImageForThumbEnabled") && $this->firstGalleryImageSrc))) {
            if ($this->firstGalleryImageSrc) {
                return AppRouter::getResourceUrl("/uploads/images_thumbs/" . UploadedFile::fileNameToPath($this->firstGalleryImageSrc) . 's' . $this->firstGalleryImageSrc);
            } else {
                return $this->getDefaultImageSrc();
            }
        }

        $siteId = $this->siteId;

        if ($this->imageSrc) {
            return AppRouter::getResourceUrl("/uploads/images_thumbs/" . $this->imageSrc);
        } else {
            if (empty($this->url)) {
                return $this->getDefaultImageSrc();
            } else {
                if (Config::get('cacheSiteImagesEnabled') == 1) {
                    $fileName = $siteId . '.jpg';
                    $filePath = Config::get("SITES_THUMBS_PATH") . $fileName;

                    if (file_exists($filePath)) {
                        return AppRouter::getResourceUrl("/uploads/images_thumbs/" . $fileName);
                    } else {
                        return AppRouter::getRewrittedUrl("/site/getThumb/" . $siteId);
                    }
                } else {
                    if (Config::get("thumbsGeneratorUrl")) {
                        return $this->getThumbGeneratorSiteUrl();
                    } else {
                        return $this->getDefaultImageSrc();
                    }
                }
            }
        }
    }

    function updatePhotos()
    {
        $c = new Criteria();
        $c->add("itemId", $this->siteId);

        $imageSrc = "";
        $photosCount = Model::factoryInstance("photo")->getCount($c);

        if ($photosCount) {
            $c->addOrder("photoId");
            $c->setLimit(1);
            $imageSrc = Model::factoryInstance("photo")->get("src", $c);
        }

        $data = array("firstGalleryImageSrc" => $imageSrc,
                      "photosCount"          => $photosCount);

        Model::factoryInstance("site")->updateByPk($data, $this->siteId);
    }

    function getGoogleMap()
    {
        if (!Config::get('googleMapEnabled')
            || empty($this->address)
            || empty($this->city)
            || empty($this->country)
        ) {
            return false;
        }

        $googleMap = new GoogleMap();
        $googleMap->setZoomLevel(15);

        $longAddress = $this->address . ', ' . $this->city . ', ' . $this->country;
        $map = $googleMap->getScriptCode();

        try {
            try {
                if (!is_null($this->lat) && !is_null($this->lng)) {
                    $googleMap->addGeoPoint($this->lat, $this->lng, $longAddress);
                } else {
                    $point = $googleMap->addAddress($longAddress);

                    if ($point !== false) {
                        Model::factoryInstance('site')->updateByPk($point, $this->siteId);
                    }
                }
            } catch (Google_Map_AddressNotFoundException $e) {
                try {
                    // No valid points for google map then search by zipCode City
                    $googleMap->addAddress($this->zipCode . ', ' . $this->city . ', ' . $this->country);
                } catch (Google_Map_AddressNotFound_Exception $e) {
                     // No valid points for google map then search by country
                    $googleMap->addAddress($this->country);
                    $googleMap->setZoomLevel(12);
                }
            }

            $map .= $googleMap->getMapCode();
            return $map;

        } catch (Google_Map_ServiceException $e) {
            // geolocalization is temporary disabled for this IP, try user mode
            $googleMap->setZoomLevel(Config::get('googleMapZoom'));
            $googleMap->setZoomLevel(15);
            $map .= $googleMap->getUserSideMapCode(
                $this->address . ', ' . $this->city . ', ' . $this->country
            );
            return $map;
        } catch (Exception $e) {
            return '';
        }
    }
}
