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
                 
$scriptStartTime = microtime(true);

ini_set("display_errors", "on");
ini_set("url_rewriter.tags","");
error_reporting(E_ALL);

require_once(CODE_ROOT_DIR."config/main.php");
require_once(Config::get('CORE_PATH')."Core.php");

ErrorHandler::getInstance();
