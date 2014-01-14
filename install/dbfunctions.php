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


function executeQueryWithPrefix($sql, $tablesPrefix)
{
    $sql = str_replace("CREATE TABLE `", "CREATE TABLE `" . $tablesPrefix, $sql);
    $sql = str_replace("INTO `", "INTO `" . $tablesPrefix, $sql);
    
    //echo $sql."<br>";
    
    return mysql_query($sql);
}

function dbConnect($server, $user, $pass, $dbName)
{

    /* install database with prefixed tables */

    mysql_connect($server, $user, $pass) or die('could not connect to mysql');;

    mysql_query('create database IF NOT EXISTS ' . $dbName);

    mysql_select_db($dbName) or die('could not select database');
}


?>