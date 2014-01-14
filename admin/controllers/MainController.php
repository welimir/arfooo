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


class Admin_MainController extends AppController
{
    /**
     * set access privileges
     */
    function init()
    {
        $this->acl->allow("administrator", $this->name, "*");
        $this->acl->allow("guest", $this->name, "logIn");
        $this->acl->allow("guest", $this->name, "lostPassword");

        if (!$this->acl->isAllowed($this->session->get("role"), $this->name, $this->action)) {
            $this->redirect(AppRouter::getRewrittedUrl("/admin/main/logIn"));
        }
    }

    /**
     * Display admin index page
     */
    function indexAction()
    {
        $this->set("databaseSize", $this->database->getTotalSize());
        $this->set("waitingSitesCount", $this->statistic->getCountOfSitesWithStatus("waiting"));
        $this->set("validatedSitesCount", $this->statistic->getCountOfSitesWithStatus("validated"));
        $this->set("refusedSitesCount", $this->statistic->countOfAllRefusals());
        $this->set("bannedSitesCount", $this->statistic->getCountOfSitesWithStatus("banned"));

        $c = new Criteria();
        $c->add("role", "webmaster");
        $this->set("webmastersCount", $this->user->getCount($c));

        $this->set("categoriesCount", $this->category->getCount());
        $this->set("keywordsCount", $this->keyword->getCount());
        require (CODE_ROOT_DIR . "config/version.php");
        $this->set("directoryVersion", $currentVersion);
    }

    /**
     * Display login form and login admin
     */
    function logInAction()
    {
        if (isset($this->request->login) && isset($this->request->password)) {
            if ($this->session->loginUser($this->request->login, md5($this->request->password), "login", "administrator")) {
                $httpClient = new HttpClient();
                $this->session->set("scriptLastVersion", $httpClient->getSiteContent("http://script.arfooo.com/version/version.html", false));
                $this->redirect($this->moduleLink("index"));
            } else {
                $this->set("loginError", 1);
            }
        }
    }

    /**
     * Logout admin
     */
    function logOutAction()
    {
        $this->session->destroy();
        $this->redirect($this->moduleLink());
    }

    /**
     * Display lost password form and send it to user email
     */
    function lostPasswordAction()
    {
        //if no posta data only display form
        if (empty($this->request->email)) {
            return;
        }

        //search that email is correct
        $c = new Criteria();
        $c->add("email", $this->request->email);
        $c->add("role", "administrator");
        $user = $this->user->find($c);

        if (empty($user)) {
            return;
        }
        //generate and send new password
        $newPassword = $user->generateNewPassword();

        Mailer::getInstance()->sendLostPassword($user->email, $newPassword);

        $this->redirect($this->moduleLink("logIn"));
    }

    /**
     * Clear directory for make data fresh
     */
    private function clearDir($path)
    {
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::CHILD_FIRST);

        $exclude = array('.htaccess', '..', '.');
        foreach ($iterator as $file) {
            if (in_array($file->getFilename(), $exclude)) {
                continue;
            }
            if ($file->isDir()) {
                rmdir($file->getPathname());
            } else {
                unlink($file->getPathname());
            }
        }
    }

    function createUrlNames()
    {
        $withParents = Config::get('advancedUrlRewritingParentsEnabled');
        set_time_limit(600);
        $categories = $this->category->findAll(null, "categoryId, parentCategoryId, name, urlName");

        $tree = new NavigationTree();

        foreach ($categories as $category) {
            $tree->addNode($category['categoryId'],
                           $category['parentCategoryId'],
                           array("name" => $category['name'], "urlName" => $category['urlName']));
        }

        $connections = $tree->getAllConnections();
        $urlNames = array("");

        foreach ($connections as $connection) {
            $urlName = NameTool::strToAscii($connection['value']['name']);
            if ($withParents) {
                $urlName = ltrim($urlNames[$connection['depth'] - 1] . "\\" . $urlName, "\\");
                $urlNames[$connection['depth']] = $urlName;
            }

            $urlName = $this->category->getFreeUrlName($urlName, $connection['categoryId']);

            if ($connection['value']['urlName']
                && $connection['value']['urlName'] != $urlName
                && !$this->rewrite->findByPk($connection['value']['urlName'])
            ) {
                $rewrite = new RewriteRecord();
                $rewrite->originalUrl = $connection['value']['urlName'];
                $rewrite->rewrittedUrl = $urlName;
                $rewrite->save();
            }

            $this->category->updateByPk(array("urlName" => $urlName), $connection['categoryId']);
        }
    }

    /**
     * Clear actions
     */
    function clearAction()
    {
        $cmd = "";

        foreach (array("topHits", "topReferrers", "fileCache", "googleCache",
                       "createUrlNames", "categoryOrder") as $opt) {
            if ($this->request->hasValue($opt)) {
                $cmd = $opt;
            }
        }

        switch ($cmd) {
            case "topHits":
                $this->hit->removeAll();
                break;

            case "topReferrers":
                $this->otherReferrerSite->removeAll();
                break;

            case "fileCache":
                $cache = Cacher::getInstance();
                $cache->clean("all");
                $this->clearDir(CODE_ROOT_DIR . "compiled/");
                break;

            case "googleCache":
                $this->cacheGoogleDetail->removeAll();
                break;

            case "createUrlNames":
                $this->createUrlNames();
                break;

            case "categoryOrder":
                $this->category->resetOrder();
                break;
        }

        $this->redirect($this->moduleLink());
    }
}
