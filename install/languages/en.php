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

/* !! set this value to the current language name, when creating new languages !! */
$languageName = 'English';

/*  English language dictionary
	To create another language, 
	please, copy this file and replace 
	expressions with the same ones in the 
	new language.
	
	The file should be posted in /languages 
	folder. Its name sould be LanguageName.php,
	where LanguageName is the language, shown 
	in the CMS as an language option.
*/

$language = array();

/* INSTALLATION TEXTS */

// Installation - introduction
$language['step2_title'] = 'Arfooo Directory Setup';
$language['step2_welcome'] = 'Welcome';
$language['step2_desc1'] = 'Welcome to Arfooo Directory installation process which take less than 5 minutes of your time.';
$language['step2_desc2'] = 'You can browse the';
$language['step2_desc3'] = 'ReadMe';
$language['step2_desc4'] = 'file if you want to learn more.';
$language['step2_desc5'] = 'Otherwise, it will guide you and fill in the various fields that will be presented before using your new free and open source directory platform, the most powerful in the world.';
$language['step2_url'] = '../documentation/en/readme.html';
$language['step2_desc6'] = 'If all permissions are not green, change your CHOMOD manually via your FTP software for example.';
$language['step2_desc7'] = 'If despite your change, permissions are not always green, continue the setup without worry about.';

// Installation - test
$language['Arfooo Directory PHP/MYSQL setup'] = '';
$language['PHP, Libraries, Modules'] = '';
$language['PHP version'] = '';
$language['MySQL is Present'] = '';
$language['XML is Present'] = '';
$language['GD is Present'] = '';
$language['mod_rewrite is Present'] = '';
$language['The cache/ directory is writable'] = '';
$language['The save/ directory is writable'] = '';
$language['The uploads/images_categories/ directory is writable'] = '';
$language['The uploads/images_thumbs/ directory is writable'] = '';
$language['The compiled/ directory is writable'] = '';
$language['The config/db.php is writable'] = '';
$language['Permissions'] = '';
$language['Continue'] = '';
$language['Yes'] = '';
$language['No'] = '';

// Installation - database parametres
$language['Database Parameters'] = '';
$language['Server Address'] = 'Database Host';
$language['step3_user_name'] = 'User Name';
$language['Password'] = '';
$language['Database Name'] = '';
$language['Tables Prefix'] = '';

// Installation - tables
$language['Creating tables'] = '';
$language['Create table'] = '';
$language['MySQL version'] = '';

// Installation - admin details
$language['Creating the Administrator'] = 'Create your administrator account';
$language['Login'] = 'Username';
$language['Password'] = '';
$language['Repeat password'] = '';
$language['E-mail'] = '';
$language['Password is not exactly repeated.'] = '';

// Installation - success
$language['step6_success'] = 'Success!';
$language['step6_desc1'] = 'Arfooo Directory has been installed successfully.';
$language['step6_desc2'] = 'You can now logIn and manage your directory.';
$language['step6_button'] = 'Log In';

// END

foreach ($language as $key => $val)
{
	$language[$key] = str_replace("'", "`",$val);
}

// set values of English expressions same as keys
if ($languageName == 'English')
{
	foreach ($language as $key => $val)
	{
		if ($val == '')
			$language[$key] = $key;
	}
}
?>