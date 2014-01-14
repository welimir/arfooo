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

require_once("dbfunctions.php");
    
function setAdminInfo($login, $password, $email)
{
    // security issue: removes apostrophe from the string parameter (prevents sql injection)
    $magicGpc = get_magic_quotes_gpc();
    
    if(!$magicGpc)$login = addslashes($login); 
    if(!$magicGpc)$password = addslashes($password); 
    if(!$magicGpc)$email = addslashes($email); 
    
    $sql = "INSERT INTO `users` (`login`, `password`, `email`, `role`)
                   VALUES ('$login', MD5('$password'), '$email', 'administrator')";

    executeQueryWithPrefix($sql, $_SESSION['mysqlTablesPrefix']);
}    

dbConnect($_SESSION['mysqlServer'],
          $_SESSION['mysqlUser'],
          $_SESSION['mysqlPassword'],
          $_SESSION['mysqlDatabaseName']
          );

setAdminInfo($_POST['login'], $_POST['password'], $_POST['email']);

@mail("gestion@arfooo.com", "New install", $_SESSION['siteRootUrl']);

$chemin_includes_header = 'includes/';
include_once($chemin_includes_header.'header.php'); 
?>

<div class="title_h_3">
<?php echo  $language['step6_success'] ?>
</div>

<div class="column_in_text">
<?php echo $language['step6_desc1']?> 
<?php echo $language['step6_desc2']?>
</div>

<form action="../admin" method="post">
<div class="column_in_button">
<input type="submit" class="button2" value="<?php echo  $language['step6_button'] ?>" />
</div>
</form>

<?php
$chemin_includes_footer = 'includes/';
include_once($chemin_includes_footer.'footer.php'); 
?>