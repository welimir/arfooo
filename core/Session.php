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
 * Class to handle PHP Session feature
 */
class Session extends Object
{
    private static $instance = null;

    /**
     * Returns an instance of Session object
     * @return Session
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Generates the standard Session object
     */
    private function __construct()
    {
        session_start();
        if ($this->get("role") == "administrator"
            || $this->loginUser($this->get("email"), $this->get("password"), "email", $this->get("role"))) {
            /* verified */
        } else {
            $request = Request::getInstance();

            if ($request->getCookie("rememberMe")
                && $this->loginUser($request->getCookie("email"), $request->getCookie("password"))) {
            /* verified */
            } else {
                $this->set("role", "guest");
            }
        }
    }

    /**
     * Login user and store user informations in session
     * @param  string $login User login
     * @param  string $pass User password
     * @param  string $mode authorization method email/login
     * @param  string $role webmaster/administrator/admin
     * @return boolean
     */
    function loginUser($login, $password, $mode = "email", $role = "webmaster")
    {
        if (empty($login)) {
            return false;
        }

        $users = new UserModel();

        $c = new Criteria();

        if ($mode == "login") {
            $c->add("login", $login);
        } else {
            $c->add("email", $login);
        }

        $c->add("password", $password);
        $c->add("role", $role);
        $c->add("active", "1");
        $row = $users->find($c);

        if (!empty($row)) {
            foreach ($row as $key => $value) {
                $this->set($key, $value);
            }

            if (empty($row['login'])) {
                $this->set("login", $row['email']);
            }

            return true;
        }

        return false;
    }

    /**
     * Delete session variable
     * @param string $key Name of key which should be deleted
     */
    public function del($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * Set session variable
     * @param string $key Name of variable
     * @param string $value Value
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Get session variable
     * @param string $key Name of variable
     */
    public function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : false;
    }

    /**
     * Destroy session, unset all variables
     */
    public function destroy()
    {
        $_SESSION = array();

        if (isset($_COOKIE[session_name()])) {
            Response::getInstance()->setCookie(session_name(), '', time() - 42000, '/');
        }

        session_destroy();
    }

    /**
     * Return array with session variables
     */
    public function toArray()
    {
        return $_SESSION;
    }
}
