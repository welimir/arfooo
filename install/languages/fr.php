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
$languageName = 'Français';

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
$language['step2_welcome'] = 'Bienvenue';
$language['step2_desc1'] = 'Bienvenue dans le processus d\'installation de Arfooo Annuaire qui prendra moins de 5 minutes de votre temps.';
$language['step2_desc2'] = 'Vous pouvez parcourrir le fichier';
$language['step2_desc3'] = 'ReadMe';
$language['step2_desc4'] = 'si vous souhaitez en apprendre davantage.';
$language['step2_desc5'] = 'Autrement, laissez vous guider et remplissez les différents champs qui vous seront présentés avant de pouvoir utiliser votre nouvelle plateforme d\'annuaire gratuite et open source, la plus puissante au monde.';
$language['step2_url'] = '../documentation/fr/readme.html';
$language['step2_desc6'] = 'Si toutes les permissions ne sont pas vertes, merci de changer le CHOMOD manuellement via votre logiciel FTP par exemple.';
$language['step2_desc7'] = 'Si malgré vos changements, les permissions ne sont toujours pas au vert, continuez l\'installation sans vous en soucier.';

// Installation - test
$language['Arfooo Directory PHP/MYSQL setup'] = 'Installation du script PHP/MySQL Arfooo Annuaire';
$language['PHP, Libraries, Modules'] = 'PHP, Librairies, Modules';
$language['PHP version'] = 'Version de PHP';
$language['MySQL is Present'] = 'MySQL est présent';
$language['XML is Present'] = 'XML est présent';
$language['GD is Present'] = 'GD est présent';
$language['mod_rewrite is Present'] = 'mod_rewrite est présent';
$language['The cache/ directory is writable'] = 'Le dossier cache/ est accessible en écriture';
$language['The save/ directory is writable'] = 'Le dossier save/ est accessible en écriture';
$language['The uploads/images_categories/ directory is writable'] = 'Le dossier uploads/images_categories est accessible en écriture';
$language['The uploads/images_thumbs/ directory is writable'] = 'Le dossier uploads/images_thumbs/ est accessible en écriture';
$language['The compiled/ directory is writable'] = 'Le dossier compiled/ est accessible en écriture';
$language['The config/db.php is writable'] = 'Le fichier config/db.php est accessible en écriture';
$language['Permissions'] = 'Permissions';
$language['Continue'] = 'Continuer';
$language['Yes'] = 'Oui';
$language['No'] = 'Non';

// Installation - database parametres
$language['Database Parameters'] = 'Paramètres de la base de données';
$language['Server Address'] = 'Adresse du serveur';
$language['step3_user_name'] = 'Nom d\'utilisateur';
$language['Password'] = 'Mot de passe';
$language['Database Name'] = 'Nom de la base de données';
$language['Tables Prefix'] = 'Préfixe des tables';

// Installation - tables
$language['Creating tables'] = 'Création des tables';
$language['Create table'] = 'Créer la table';
$language['MySQL version'] = 'Version de MySQL';

// Installation - admin details
$language['Creating the Administrator'] = 'Création du compte de l\'administrateur';
$language['Login'] = 'Nom d\'utilisateur';
$language['Password'] = 'Mot de passe';
$language['Repeat password'] = 'Répéter le mot de passe';
$language['E-mail'] = 'Email';
$language['Password is not exactly repeated.'] = 'Les mot de passe indiqués ne sont pas identiques';

// Installation - success
$language['step6_success'] = 'Fin de l\'installation!';
$language['step6_desc1'] = 'Arfooo Annuaire a été installé avec succès.';
$language['step6_desc2'] = 'Vous pouvez maintenant vous connecter et gérer votre annuaire.';
$language['step6_button'] = 'Panneau d\'administration';

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