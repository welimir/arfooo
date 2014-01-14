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
<script type="text/javascript">
    function validateRepeatedPassword()
    {
        var adminDetailsForm = document.forms.adminDetailsForm; 
        if (adminDetailsForm.password.value == adminDetailsForm.repeatPassword.value)
            return true;
        else
        {
            alert('<?php echo $language['Password is not exactly repeated.']; ?>');
            return false;
        }
    }
</script>
    
<div class="title_h_3">
<?php echo $language['Creating the Administrator']?>
</div>
<form action="step6.php" method="post" onsubmit="return validateRepeatedPassword()" id="adminDetailsForm">






<fieldset class="column_in2">

<div class="form">
<label class="title"><?php echo $language['Login']?></label>
<div class="infos"><input type="text" class="input_text_medium" name="login" value="" /></div>
</div>

<div class="form">
<label class="title"><?php echo $language['Password']?></label>
<div class="infos"><input type="password" class="input_text_medium" name="password" value="" /></div>
</div>

<div class="form">
<label class="title"><?php echo $language['Repeat password']?></label>
<div class="infos"><input type="password" class="input_text_medium" name="repeatPassword" value="" /></div>
</div>

<div class="form">
<label class="title"><?php echo $language['E-mail']?></label>
<div class="infos"><input type="text" class="input_text_medium" name="email" value="" /></div>
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