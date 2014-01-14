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
?>

<div class="title_h_2">
<?php echo $language['Database Parameters']?>
</div>
<form action="step4.php" method="post">
<fieldset class="column_in">

<div class="form">
<label class="title"><?php echo $language['Server Address']?></label>
<div class="infos"><input type="text" class="input_text_medium" name="mysqlServer" value="localhost" /></div>
</div>

<div class="form">
<label class="title"><?php echo $language['step3_user_name']?></label>
<div class="infos"><input type="text" class="input_text_medium" name="mysqlUser" value="" /></div>
</div>

<div class="form">
<label class="title"><?php echo $language['Password']?></label>
<div class="infos"><input type="password" class="input_text_medium" name="mysqlPassword" value="" /></div>
</div>

<div class="form">
<label class="title"><?php echo $language['Database Name']?></label>
<div class="infos"><input type="text" class="input_text_medium" name="mysqlDatabaseName" value="" /></div>
</div>

<div class="form">
<label class="title"><?php echo $language['Tables Prefix']?></label>
<div class="infos"><input type="text" class="input_text_medium" name="mysqlTablesPrefix" value="Arfooo_" /></div>
</div>
</fieldset>


<div class="column_in_button">
<input type="submit" class="button" value="<?php echo $language['Continue']?>" />
</div>
</form>

<?php
$chemin_includes_footer = 'includes/';
include_once($chemin_includes_footer.'footer.php'); 
?>