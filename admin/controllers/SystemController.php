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


class Admin_SystemController extends AppController
{
    function init()
    {
        $this->acl->allow("administrator", $this->name, "*");

        if (!$this->acl->isAllowed($this->session->get("role"), $this->name, $this->action)) {
            $this->redirect(AppRouter::getRewrittedUrl("/admin/main/logIn"));
        }
    }

    function indexAction()
    {
        $this->checkScriptVersion();
    }

    function checkScriptVersion()
    {
        require (CODE_ROOT_DIR . "config/version.php");

        $lastVersion = $this->session->get("scriptLastVersion");

        if (!$lastVersion) {
            $httpClient = new HttpClient();
            $lastVersion = $httpClient->getSiteContent("http://script.arfooo.com/version/version.html", false);
            if (!$lastVersion) {
                $lastVersion = "-";
            }
            $this->session->set("scriptLastVersion", $lastVersion);
        }

        $newVersionAvailable = version_compare($lastVersion, $currentVersion, ">");

        $this->set("currentVersion", $currentVersion);
        $this->set("lastVersion", $lastVersion);
        $this->set("newVersionAvailable", $newVersionAvailable);
    }

    function checkSecurityAction()
    {
        $this->checkScriptVersion();
        $this->set("installDirExists", is_dir(CODE_ROOT_DIR . "install"));
    }

    function optimizeAction()
    {
        if (isset($this->request->start)) {
            $this->database->optimize();
        }
    }

    function saveAction()
    {
        if (empty($this->request->saveMethod)) {
            return;
        }

        $this->database->createBackup($this->request->fileType, $this->request->saveMethod);

        if (strpos($this->request->saveMethod, "download") !== false) {
            $this->autoRender = false;
        }
    }

    function restoreAction()
    {
        $backupFile = new UploadedFile("backupFile");
        if (!$backupFile->wasUploaded()) {
            return;
        }

        $gzipMode = ($this->request->fileType == "gzip");
        $fileName = $backupFile->getTempName();
        $fp = $gzipMode ? gzopen($fileName, "r") : fopen($fileName, "r");
        $inString = false;
        $query = "";

        while (!feof($fp)) {
            $line = $gzipMode ? gzgets($fp) : fgets($fp);

            if (!$inString) {
                $isCommentLine = false;

                foreach (array("#", "--") as $commentTag) {
                    if (strpos($line, $commentTag) === 0) {
                        $isCommentLine = true;
                    }
                }

                if ($isCommentLine || trim($line) == "") {
                    continue;
                }
            }

            $deslashedLine = str_replace('\\', '', $line);

            if ((substr_count($deslashedLine, "'") - substr_count($deslashedLine, "\\'")) % 2) {
                $inString = !$inString;
            }

            $query .= $line;

            if (substr_compare(rtrim($line), ";", -1) == 0 && !$inString) {
                $this->database->sqlQuery($query);
                $query = "";
            }
        }
    }

    function thumbAction()
    {

    }

    function backlinkAction()
    {
        $c = new Criteria();
        $c->add("returnBond", "", "!=");
        $c->add("backlinkExists", "0");
        $this->set("sites", $this->site->findAll($c, "siteId, siteTitle, httpCode"));
    }

    function duplicateContentAction()
    {
        $c = new Criteria();
        $c->add('isDuplicateContent', '1');
        $this->set("sites", $this->site->findAll($c, "siteId, siteTitle"));
    }

    function informationAction()
    {
        $this->set("phpVersion", phpversion());
        $this->set("installDirExists", file_exists(CODE_ROOT_DIR . "install"));
        $this->set("cacheDirWritable", is_writable(CODE_ROOT_DIR . "cache"));
        $this->set("saveDirWritable", is_writable(CODE_ROOT_DIR . "save"));
        $this->set("imagesThumbsDirWritable", is_writable(CODE_ROOT_DIR . "uploads/images_thumbs"));
        $this->set("imagesCategoriesDirWritable", is_writable(CODE_ROOT_DIR . "uploads/images_categories"));
    }
}
