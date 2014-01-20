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
 * Class which is responsible for url routing, executing controllers actions
 */
class FrontController extends Controller
{
    private static $instance = null;
    private $executeDir = "";
    private $websiteDir;
    private $debug = false;

    /**
     * @var Router router
     */
    private $router;
    private $lastUrl;

    /**
     * Returns an instance of FrontController object
     * @return FrontController
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Generates the standard FrontController object
     */
    public function __construct($router = null)
    {
        parent::__construct();

        $this->localDir = "";
        $this->loadSettings();
        $this->websiteDir = substr(strstr(preg_replace("#^http://#", "", Config::get("siteRootUrl")), "/"), 1);
        if ($this->websiteDir) {
            $this->websiteDir = "/" . rtrim($this->websiteDir, "/");
        }
    }

    public function setRouter($router)
    {
        $router->setWebsiteDir($this->websiteDir);
        $this->router = $router;
    }

    /**
     * Retrieve main settings for application
     * @return array
     */
    public function loadSettings()
    {
        $cache = Cacher::getInstance();

        if (($settings = $cache->load("settings")) === null) {
            $settings = array();

            foreach ($this->setting->findAll(new Criteria(), "`key`, `value`") as $row) {
                $settings[$row['key']] = $row['value'];
            }

            $cache->save($settings, null, null, array("setting"));
        }

        foreach ($settings as $key => $value) {
            Config::set($key, $value);
        }

        $rawUrl = parse_url(Config::get("siteRootUrl"));
        Config::set("siteDomainUrl", "http://" . $rawUrl['host']);

        $errorHandler = ErrorHandler::getInstance();
        if (!Config::get('errorHandlerSaveToFileEnabled')) {
            $errorHandler->setOption('saveToFile', false);
        }

        if (!Config::get('errorHandlerDisplayErrorEnabled')) {
            $errorHandler->setOption('displayError', false);
        }
    }

    /**
     * Extract route part from request url
     * @return string
     */
    private function getUrlParams()
    {
        $removePattern = '#^' . preg_quote($this->websiteDir) . '#';
        $url = preg_replace($removePattern, '', $_SERVER["REQUEST_URI"]);

        if ($url == "/index.php") {
            $this->redirect(Config::get("siteRootUrl"), 301);
        }

        $url = preg_replace("#^/index.php#", "", $url);

        return $this->router->getControllerActionUrl($url);
    }

    public function setExecuteDir($dir)
    {
        $this->executeDir = $dir;
    }

    /**
     * Throws error if something is missed
     */
    protected function throwError($msg)
    {
        if ($this->debug) {
            $msg = str_replace(CODE_ROOT_DIR, "", $msg);
            $this->set("error", $msg);
            $this->viewFile = "error";
            echo $this->render();
        } else {
            if (!$this->router->defaultHandler($this->lastUrl)) {
                $this->return404();
            }
        }
    }

    /**
     * Dispatch an HTTP request to a controller/action.
     *
     * @param string $url Optional argument Url with routing informatins
     */
    public function dispatch($url = false, $return = false)
    {
        if (empty($this->router)) {
            $this->setRouter(new Router());
        }

        if (!$url) {
            $url = $this->getUrlParams();
        }

        $url = trim($url, "/");
        $route = $this->router->getRoute($url);

        if ($route['executeDir']) {
            $url = preg_replace("#^" . $route['executeDir'] . "/?#", "", $url);
        }

        $this->lastUrl = $url;
        $params = explode("/", $url);
        $index = 0;

        $route['path'] = $route['executeDir'] ? $route['executeDir'] . "/" : "";
        $this->setExecuteDir($route['executeDir']);
        $controllerDir = Config::get('CONTROLLERS_PATH');

        $controllerName = empty($params[$index]) ? "" : basename($params[$index]);
        $index++;
        $controllerAction = empty($params[$index]) ? "" : basename($params[$index]);

        if (empty($controllerName) && !empty($controllerAction)) {
            $this->return404();
        }
        if (empty($controllerName)) {
            $controllerName = "Main";
        }
        if (empty($controllerAction)) {
            $controllerAction = "index";
        }

        $controllerActionMethod = $controllerAction . "Action";
        $controllerClassName = NameTool::getControllerClassName($controllerName, $route['executeDir']);

        $controllerFileName = NameTool::getControllerFileName($controllerName);
        $controllerPath = $controllerDir . $controllerFileName;

        if (!isset($controllers[$controllerClassName])) {
            if (!file_exists($controllerPath)) {
                return $this->throwError("Missed controller file: $controllerPath");
            }

            require_once ($controllerPath);

            if (!class_exists($controllerClassName)) {
                return $this->throwError("Missed controller class" . ": $controllerClassName");
            }

            static $controllers = array();

            $controllers[$controllerClassName] = new $controllerClassName($this);
        }

        $controller = $controllers[$controllerClassName];
        $controller->action = $controllerAction;
        $controller->localDir = $route['path'];

        if (!is_callable(array($controller, $controllerActionMethod))) {
            return $this->throwError("Missed action method" . ": $controllerActionMethod");
        }

        if (is_callable(array($controller, "init"))) {
            call_user_func_array(array($controller, "init"), array());
        }

        $params = array_slice($params, 2);
        $result = call_user_func_array(array($controller, $controllerActionMethod), $params);

        if ($return || $result !== null) {
            return ($result !== null) ? $result : $controller->render();
        } else {
            echo $controller->render();
        }

    }
}
