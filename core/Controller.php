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
 * Abstract class Controller from MVC design pattern
 */
abstract class Controller extends Object
{
    public $action;
    protected $userId;

    /**
     * @var Session session
     */
    public $session;

    /**
     * @var Request request
     */
    protected $request;
    /**
     * @var Response response
     */
    protected $response;

    protected $acl;

    protected $autoRender = true;
    public $name;
    public $viewVars = array();
    public $viewFile;
    protected $viewClass = "TemplateLiteView";
    public $localDir = "";
    public $niceName = "";
    protected $models = array();
    protected $data;

    /**
     * Generates the standard Controller object
     */
    public function __construct()
    {
        $this->name = substr(get_class($this), 0, -10); // "Controller" length
        $names = explode("_", $this->name);

        $this->niceName = $names[count($names) - 1];
        $this->niceName[0] = strtolower($this->niceName[0]);

        $unsetFields = array_merge($this->models, array("userId",
                                                        "session",
                                                        "request",
                                                        "response",
                                                        "acl"));

        foreach ($unsetFields as $unsetField) {
            unset($this->$unsetField);
        }
    }

    public function __get($name)
    {
        switch ($name) {
            case "session":
                $this->session = Session::getInstance();
                break;

            case "request":
                $this->request = Request::getInstance();
                break;

            case "response":
                $this->response = Response::getInstance();
                break;

            case "acl":
                $this->acl = Acl::getInstance();
                break;

            case "userId":
                $this->userId = $this->session->get("userId");
                break;

            default:
                $this->$name = Model::factoryInstance($name);
        }

        return $this->$name;
    }

    /**
     * Set variable which will be passed to View
     * @param  string|array $p1 containe name or association array
     * @param  string $p2 value of variable
     */
    protected function set($p1, $p2 = null)
    {
        if ($p2 === null && is_array($p1)) {
            foreach ($p1 as $key => $val) {
                $this->viewVars[$key] = $val;
            }
        } else {
            $this->viewVars[$p1] = $p2;
        }
    }

    /**
     * Set error/info messages which will be passed to View
     * @param  string $msg Message
     */
    protected function throwInfo($msg)
    {
        if ($msg{0} == "-") {
            $this->set("errorMessage", substr($msg, 1));
        } else {
            $this->set("okMessage", $msg);
        }
    }

    /**
     * Create module link to navigate between actions in controller
     * @param  string $action Action name in controller
     * @return string full url to action
     */
    protected function moduleLink($action = "", $absolute = true)
    {
        $url = "";

        if ($this->localDir) {
            $url .= "/" . rtrim($this->localDir, "/") . "";
        }

        $url = $url . "/" . $this->niceName;

        if ($action) {
            $url .= "/" . $action;
        }

        $url = AppRouter::getRewrittedUrl($url, $absolute);

        if ($url[0] != "/" && $absolute) {
            $url .= "/" . $url;
        }

        return $url;
    }

    /**
     * Render associated View
     */
    public function render()
    {
        if (!$this->autoRender) {
            return "";
        }
        $view = new $this->viewClass();

        return $view->render($this);
    }

    /**
     * Redirect to spedified url
     * @param  string $url Url
     */
    protected function redirect($url, $httpCode = 302)
    {
        header("Location: $url", true, $httpCode);
        exit();
    }

    protected function return404()
    {
        header('Status: 404 Not Found');
        header('HTTP/1.0 404 Not Found');
        $this->niceName = "front";
        $this->viewFile = "404";
        Display::set("adPage", "error404");
        echo $this->render();
        exit();
    }

}
