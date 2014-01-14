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
 * Basic class which give error handlers to every object
 */
class Object
{
    private $error;

    /**
     * Set error message
     * @param string $msg error message
     * @return boolean
     */
    protected function throwError($msg)
    {
        echo $msg;
        return $this->setLastError($msg);
    }

    /**
     * Retrieve last error from object
     * @return string
     */
    public function getLastError()
    {
        return $this->error;
    }

    protected function setLastError($msg)
    {
        $this->error = $msg;
        return false;
    }
}
