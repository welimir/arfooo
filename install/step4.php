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
session_start();
error_reporting(E_ALL);
require_once('languages/' . $_SESSION['selectedLanguage'] . '.php'); 

$chemin_includes_header = 'includes/';
include_once($chemin_includes_header.'header.php'); 

require_once("dbfunctions.php"); 
require_once("createdb.php");

function createDbConfig($dbHost, $dbUser, $dbPass, $dbName, $dbPrefix)
{
    $dbConfig['DB_HOST'] = $dbHost;
    $dbConfig['DB_USER'] = $dbUser;
    $dbConfig['DB_PASS'] = $dbPass;
    $dbConfig['DB_NAME'] = $dbName;
    $dbConfig['DB_PREFIX'] = $dbPrefix;
    $dbConfig['DB_INSTALLED'] = true;
    
    $data = "<?php\n \$dbConfig = " . var_export($dbConfig, true). ";\n ?>";
    file_put_contents("../config/db.php", $data);
}

$_SESSION['mysqlServer'] = $_POST['mysqlServer'];
$_SESSION['mysqlUser'] = $_POST['mysqlUser'];
$_SESSION['mysqlPassword'] = $_POST['mysqlPassword'];
$_SESSION['mysqlDatabaseName'] = $_POST['mysqlDatabaseName'];
$_SESSION['mysqlTablesPrefix'] = $_POST['mysqlTablesPrefix'];

dbConnect($_SESSION['mysqlServer'],
          $_SESSION['mysqlUser'],
          $_SESSION['mysqlPassword'],
          $_SESSION['mysqlDatabaseName']
          );

$mysqlVersion = mysql_get_server_info();    

$mysqlVersionCorrect = version_compare($mysqlVersion, "4.1", ">=");

if($mysqlVersionCorrect)
{
              
    createDbConfig($_POST['mysqlServer'],
                   $_POST['mysqlUser'],
                   $_POST['mysqlPassword'],
                   $_POST['mysqlDatabaseName'],
                   $_POST['mysqlTablesPrefix']);


                   
    $tablesList = createDbTables($_POST['mysqlTablesPrefix'],
                                 $_SESSION['siteRootUrl'],
                                 $_SESSION['selectedLanguage'],
                                 $_SESSION['urlRewriting']
                                 );
}
else
{
    $tablesList = array();
}
            
?>

<div class="title_h_3">
<?php echo $language['Creating tables']?>
</div>
<div class="column_in_table2">
<table class="table3" cellspacing="1">
<col class="col1-1" /><col class="col2-2" />
<tbody>
<tr class="line1">
    <td><?php echo $language['MySQL version']?>: </td>
    <td><span class="text_<?php echo  $mysqlVersionCorrect ? "green" : "red"?>_bold"><?php echo  $mysqlVersion ?></span></td>
</tr>


<?php
$alt = true;

foreach($tablesList as $tableName => $tableData)
{
$alt = !$alt;     
?>

<tr class="line<?php echo  $alt ? 1 : 2 ?>">
	<td><?php echo $language['Create table']?> <?php echo  $tableName ?>: <u><?php echo  $tableData['message'] ?></u> </td>
	<td><span class="text_<?php echo  $tableData['created'] ? "green" : "red" ?>_bold"><?php echo  $tableData['created'] ? 'Yes' : 'No' ?></span></td>
</tr>

<?php

}
?>

</tbody>
</table>
</div>

<form action="step5.php" method="post">
<div class="column_in_button">
<input type="submit" class="button" value="<?php echo $language['Continue']?>" />
</div>
</form>

<?php
$chemin_includes_footer = 'includes/';
include_once($chemin_includes_footer.'footer.php'); 
?>