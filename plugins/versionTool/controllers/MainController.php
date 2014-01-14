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

class Plugins_VersionTool_MainController extends AppController
{ 
    private $checkedBaseVersion = "1.0.0"; 
    
    function indexAction()
    {
        
    }
    
    function checkVersionAction()
    {
        require(CODE_ROOT_DIR."config/version.php");

        $this->set("checkedBaseVersion", $this->checkedBaseVersion);
        $this->set("correctVersion", ($currentVersion == $this->checkedBaseVersion));
    }
    
    function displayCurrentVersionAction()
    {
        require(CODE_ROOT_DIR."config/version.php");
        $this->set("currentVersion", $currentVersion);   
    }
} 

?>