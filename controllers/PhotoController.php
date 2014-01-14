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


class PhotoController extends AppController
{
    /**
     * Initailize controller set access privileges
     */
    public function init()
    {
        $this->acl->allow('webmaster', $this->name, "*");
        $this->acl->allow('guest', $this->name, "save");
        $this->acl->allow('guest', $this->name, "delete");
        $this->acl->allow('guest', $this->name, "edit");
        $this->acl->allow('guest', $this->name, "saveEdit");

        if (!$this->acl->isAllowed($this->session->get("role"), $this->name, $this->action)) {
            $this->redirect($this->moduleLink("logIn"));
        }
    }

    public function deleteAction()
    {
        $this->viewClass = "JsonView";
        $photo = $this->_getPhotoWithAclCheck($this->request->uniqueId);
        $photo->del();
    }

    public function saveAction()
    {
        $this->viewClass = "JsonView";

        $photoType = "gallery";
        $galleryPhotosMaxCount = Config::get("itemGalleryImagesMaxCount");
        $itemId = !empty($this->request->itemId) ? $this->request->itemId : 0;
        $tempId = !empty($this->request->tempId) ? $this->request->tempId : 0;

        if ($itemId) {
            $item = $this->site->findByPk($itemId);

            if (empty($item) || (!in_array($this->session->get("role"), array("administrator", "moderator")) && $item->webmasterId != $this->userId)) {
                $this->return404();
            }
        }

        try {
            $uploadedFile = new UploadedFile("file");
            $uploadedFile->addFilter("extension", array("jpg", "jpeg", "gif", "png"));
            $uploadedFile->addFilter("maxSize", intval(Config::get("itemGalleryImageMaxWeight")) * 1024);

            $errorMessage = "";
            $wasUploaded = false;

            if (!$uploadedFile->wasUploaded()) {
                throw new Exception("Photo wasn't uploaded");
            }

            $uploadedFile->validate();

            $savePath = Config::get("SITES_THUMBS_PATH");
            $uploadedFile->setSavePath($savePath);
            $uploadedFile->setAutoCreateDirs(true);
            $uploadedFile->save();
            $savePath = $uploadedFile->getSavePath();

            $fileName = $uploadedFile->getSavedFileName();

            $imageResizer = new ImageResizer();

            if ($photoType == "gallery") {
                if ($this->photo->getSitePhotosCount($itemId, $tempId) >= $galleryPhotosMaxCount) {
                    throw new Exception("Maximum photo count $galleryPhotosMaxCount was reached");
                }

                $photo = new PhotoRecord();
                $photo->itemId = $itemId;

                if ($tempId) {
                    $photo->tempId = $tempId;
                }

                $imageResizer->resize($savePath . $fileName, $savePath . "m" . $fileName, Config::get("mediumThumbWidth"), Config::get("mediumThumbHeight"), true, true);
                $imageResizer->resize($savePath . $fileName, $savePath . "s" . $fileName, Config::get("smallThumbWidth"), Config::get("smallThumbHeight"), true, true);
                $imageResizer->resize($savePath . $fileName, $savePath . "n" . $fileName, Config::get("microThumbWidth"), Config::get("microThumbHeight"), true, true);

                if (Config::get("imageWatermarkEnabled")) {
                    $imageResizer->addTag($savePath . $fileName, $savePath . $fileName);
                }

                $photo->src = $fileName;
                $photo->save();

                if (!empty($item)
                    && !Config::get('automaticSiteValidation')
                    && !in_array($this->session->get("role"), array("administrator", "moderator"))
                ) {
                    $item->status = 'waiting';
                    $item->save();
                }
            }

            $this->set("status", "ok");
            $this->set("file", array("thumbSrc"  => Config::get("siteRootUrl") . str_replace(CODE_ROOT_DIR, "", $savePath) . "s" . $fileName,
                                      "photoId"  => $photo->photoId,
                                      "uniqueId" => $photo->photoId,
                                      "name"     => $uploadedFile->getOriginalName()));
        } catch (Exception $e) {
            $this->set("status", "error");
            $this->set("message", $e->getMessage());
        }
    }

    public function editAction($photoId, $tempId = null)
    {
        if ($tempId) {
            $this->request->tempId = $tempId;
        }
        $this->set('photo', $this->_getPhotoWithAclCheck($photoId));
        $this->set('tempId', $tempId);
    }

    public function saveEditAction()
    {
        $this->viewClass = 'JsonView';

        $photo = $this->_getPhotoWithAclCheck($this->request->photoId);
        $photo->altText = $this->request->altText;
        $photo->save();

        $this->set('status', 'ok');
        $this->set('message', _t('Alt text has been updated'));
    }

    protected function _getPhotoWithAclCheck($photoId)
    {
        $photo = $this->photo->findByPk($photoId);

        if (empty($photo)) {
            $this->return404();
        }

        $allow = (in_array($this->session->get("role"), array("administrator", "moderator")));

        if (!$allow) {
            if ($photo->itemId) {
                $item = $this->site->findByPk($photo->itemId);
                $allow = (!empty($item) && $item->webmasterId == $this->userId);
            } else {
                $allow = (!empty($this->request->tempId) && $this->request->tempId == $photo->tempId);
            }
        }

        if (!$allow) {
            $this->return404();
        }

        return $photo;
    }
}
