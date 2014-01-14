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

function getAvailableLanguages()
{
    $languages = array(); 
    $dir = opendir('languages/'); 
    
    while($file = readdir($dir)) 
    {
        if($file == '.' || $file == '..' || !preg_match("#^(.*)\.php$#", $file, $matches))continue;

        $languageCode = $matches[1];
        $fp = fopen('languages/'.$file, "r");
        $languageName = "";
        
        while(!feof($fp) && !$languageName)
        {
            $line = fgets($fp);
            if(preg_match("#languageName = '(.*?)';#", $line, $matches))
            {
                $languageName = $matches[1];
                $languages[$languageCode] = $languageName;
            }
        }
        
        fclose($fp);

    }
    
    asort($languages);
    return $languages;
}

require_once('languages/en.php');  

$chemin_includes_header = 'includes/';
include_once($chemin_includes_header.'header.php'); 
?>

    <script type="text/javascript">
        function addFullSiteUrlBeforePost()
        {
            document.forms.installForm.siteRootUrl.value = window.location.href.replace('install/index.php', '').replace('install/', '').replace('install', '');

            return true;
        }
    </script>


<div class="title_h_2">
Welcome to Arfooo Directory setup
</div>

<form action="step2.php" method="post" id="installForm" onsubmit="return addFullSiteUrlBeforePost()"> 
<fieldset class="column_in">

<div class="form">
<label class="title">Language</label>
<div class="infos"><select name="selectedLanguage">
<?php
// get languages list
$languagesList = getAvailableLanguages();
$currentLanguageCode = 'en';
                       
foreach($languagesList as $languageCode => $languageName)
{
    ?>
    <option value="<?php echo $languageCode; ?>"<?php if ($languageCode == $currentLanguageCode) echo ' selected="selected"'; ?>> <?php echo $languageName; ?> </option>       
    <?php
}
?>
		</select></div>
</div>

<div class="form">
<label class="title">Enable URL rewrite</label>
<div class="infos"><input type="radio" name="urlRewriting" value="1"> ON &nbsp;&nbsp;<input type="radio" name="urlRewriting" value="0" checked="checked"> OFF</div>
</div>
</fieldset>


<div class="column_in_button">
<input type="submit" class="button" value="Continue" />
<input type="hidden" name="siteRootUrl" value="" />  
</div>
</form> 

<?php
$chemin_includes_footer = 'includes/';
include_once($chemin_includes_footer.'footer.php'); 
?>