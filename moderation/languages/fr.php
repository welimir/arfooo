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


/* Moderation Texts */

// all
$language['Management'] = 'Management';
$language['button_save'] = 'Sauvegarder';
$language['button_delete'] = 'Supprimer';
$language['link_edit'] = 'Editer';
$language['link_delete'] = 'Supprimer';
$language['On'] = 'Oui';
$language['Off'] = 'Non';
$language['Yes'] = 'Oui';
$language['No'] = 'Non';
$language['Root'] = 'Index';
$language['Do you really want to delete it?'] = 'Voulez-vous vraiment supprimer?';


//// --> template/templateName/extraField/
// itemForm.tpl


//// --> template/templateName/front/
// 404.tpl


//// --> template/templateName/includes/
// footer.tpl & footerLogin.tpl
$language['includesFooter_powered'] = 'Propulsé par';
$language['includesFooter_link'] = 'http://www.arfooo.com/';
$language['includesFooter_arfooo'] = 'Arfooo Annuaire';
$language['includesFooter_date'] = '2007 - ' . date('Y');

// header.tpl
$language['includesHeader_language'] = 'fr';

// pageNavigation.tpl
$language['includesPageNavigation_pages'] = 'Pages';


//// --> template/templateName/main/
// changePassword.tpl
$language['mainChangePassword_html_title'] = 'Modérateur - Changer votre mot de passe';
$language['mainChangePassword_meta_description'] = 'Modérateur - Changer votre mot de passe';
$language['mainChangePassword_arbo'] = 'Modérateur - Changer votre mot de passe';
$language['mainChangePassword_h1'] = 'Modérateur - Changer votre mot de passe';
$language['mainChangePassword_new_pass'] = 'Nouveau mot de passe';
$language['mainChangePassword_repeat_new_pass'] = 'Répéter le mot de passe';

// logIn.tpl
$language['mainLogIn_html_title'] = 'Se connecter à la modération d\'Arfooo Annuaire';
$language['mainLogIn_meta_description'] = 'Se connecter à la modération d\'Arfooo Annuaire';
$language['mainLogIn_login'] = 'Email';
$language['mainLogIn_pass'] = 'Mot de passe';
$language['mainLogIn_button_login'] = 'Se connecter';
$language['mainLogIn_forgot_pass'] = 'Mot de passe oublié?';

// lostPassword.tpl
$language['lostPassword_html_title'] = 'Mot de passe oublié';
$language['lostPassword_meta_description'] = 'Mot de passe oublié';
$language['lostPassword_desc'] = 'Merci de saisir votre adresse e-mail. Un nouveau mot de passe vous sera envoyé par e-mail.';
$language['lostPassword_email'] = 'Email';
$language['lostPassword_button'] = 'Générer un nouveau mot de passe';


//// --> template/templateName/memu/
// /menuheader/menuheader.tpl
$language['menuMenuHeader_directory'] = 'Annuaire';
$language['menuMenuHeader_users'] = 'Utilisateurs';

// /menuleft/menuleftIndex.tpl
$language['menuLeftIndex_site_cat'] = 'Sites et catégories';
$language['menuLeftIndex_pending'] = 'Sites en attente';

// /menuleft/menuleftUsers.tpl
$language['menuLeftUsers_users'] = 'Utilisateurs';
$language['menuLeftUsers_change_pass'] = 'Changer votre mot de passe';

// /menuleft/login.tpl
$language['menuLeftLogIn_login'] = 'Vous êtes connecté en tant que';
$language['menuLeftLogIn_logout'] = 'Déconnexion';


//// --> template/templateName/site/
// edit.tpl
$language['siteEdit_html_title'] = 'Modifier le site';
$language['siteEdit_meta_description'] = 'Modifier le site';
$language['siteEdit_arbo'] = 'Modifier le site';
$language['siteEdit_h1'] = 'Modifier le site';
$language['siteEdit_cat'] = 'Catégories';
$language['siteEdit_images'] = 'Images';
$language['siteEdit_add_images'] = 'Ajouter des images';
$language['siteEdit_general_information'] = 'Informations générales';
$language['siteEdit_language_site'] = 'Langue du site';
$language['siteEdit_select_language_site'] = 'Sélectionnez la langue du site';
$language['siteEdit_webmaster_email'] = 'Email du webmaster';
$language['siteEdit_webmaster_contact'] = 'Contacter le webmaster';
$language['siteEdit_webmaster_name'] = 'Nom du webmaster';
$language['siteEdit_website_title'] = 'Titre du site';
$language['siteEdit_website_url'] = 'Adresse du site (Url)';
$language['siteEdit_button_metas'] = 'Metas';
$language['siteEdit_display_website'] = 'Voir le site';
$language['siteEdit_rss_feed_title'] = 'Titre du flux RSS';
$language['siteEdit_rss_feed_url'] = 'Adresse du flux RSS (Url)';
$language['siteEdit_display_rss_feed'] = 'Voir le flux RSS';
$language['siteEdit_backlink_url'] = 'Adresse du lien retour (URL)';
$language['siteEdit_website_desc'] = 'Description du site';
$language['siteEdit_additional_fields'] = 'Champs supplémenaires';
$language['siteEdit_select_keywords'] = 'Sélectionnez vos mots clés';
$language['siteEdit_select_keyword'] = 'Sélectionnez votre mot clé';
$language['siteEdit_keyword'] = 'Mot clé';
$language['siteEdit_company_info'] = 'Informations sur votre société / Permet d\'apparaître sur google map';
$language['siteEdit_adress'] = 'Adresse';
$language['siteEdit_display_google_maps'] = 'Voir Google Maps';
$language['siteEdit_postal_code'] = 'Code postal';
$language['siteEdit_city'] = 'Ville';
$language['siteEdit_country'] = 'Pays';
$language['siteEdit_phone'] = 'Téléphone';
$language['siteEdit_fax'] = 'Fax';
$language['siteEdit_other_settings'] = 'Autres informations, configuration';
$language['siteEdit_search_partner'] = 'Recherche de partenaire';
$language['siteEdit_hits_numbers'] = 'Nombre de hits';
$language['siteEdit_rating_number'] = 'Nombre de notes';
$language['siteEdit_rating_average'] = 'Moyenne des notes';
$language['siteEdit_visitors_sent'] = 'Nombre de visiteurs envoyés';
$language['siteEdit_website_problem'] = 'Le site a un problème';
$language['siteEdit_websiste_status'] = 'Statut';
$language['siteEdit_websiste_approved'] = 'Validé';
$language['siteEdit_websiste_pending'] = 'En attente';
$language['siteEdit_websiste_banned'] = 'Banni';
$language['siteEdit_website_priority'] = 'Priorité';
$language['siteEdit_website_payment_detail'] = 'Détails';
$language['siteEdit_payment_free'] = 'Gratuit';
$language['siteEdit_payment_premium'] = 'Privilège';
$language['siteEdit_payment_status'] = 'Statut du paiement';
$language['siteEdit_payment_status_pending'] = 'En attente';
$language['siteEdit_payment_status_denied'] = 'Refusé';
$language['siteEdit_payment_status_paid'] = 'Payé';
$language['siteEdit_webmaster_IP'] = 'IP';
$language['siteEdit_thumbs'] = 'Thumbs';
$language['siteEdit_update_thumbs'] = 'Mettre à jour le thumbs';
$language['siteEdit_delete_thumbs'] = 'Supprimer le thumbs et afficher l\'ascreen';
$language['siteEdit_delete_ascreen'] = 'Supprimer l\'ascreen et afficher le thumbs';
$language['siteEdit_checking_website'] = 'Vérification du site en cours...';
$language['siteEdit_delete_image'] = 'Voulez-vous vraiment supprimer cette image?';
$language['siteEdit_website_comments'] = 'Commentaires du site';
$language['siteEdit_th_comments'] = 'Commentaires';
$language['siteEdit_th_users'] = 'Utilisateurs';
$language['siteEdit_th_date'] = 'Date';
$language['siteEdit_th_ip'] = 'IP';
$language['siteEdit_th_validated'] = 'Validé';
$language['siteEdit_ban_ip'] = 'Bannir IP';
$language['siteEdit_ad_website_detail'] = 'Publicité sur la page détail du site';

// waiting.tpl
$language['siteWaiting_html_title'] = 'Sites en attente';
$language['siteWaiting_meta_description'] = 'Sites en attente';
$language['siteWaiting_arbo'] = 'Sites en attente';
$language['siteWaiting_h1'] = 'Sites en attente';
$language['siteWaiting_edit_website'] = 'Modifier le site';
$language['siteWaiting_description'] = 'Description';
$language['siteWaiting_rss_feed'] = 'Flux RSS';
$language['siteWaiting_keywords'] = 'Mots clés';
$language['siteWaiting_cat'] = 'Catégorie';
$language['siteWaiting_suggest_cat'] = 'Catégories suggérées';
$language['siteWaiting_suggest_key'] = 'Mots clés suggérés';
$language['siteWaiting_backlink'] = 'Lien retour';
$language['siteWaiting_payment_detail'] = 'Détails';
$language['siteWaiting_payment_free'] = 'Gratuit';
$language['siteWaiting_payment_premium'] = 'Payant';
$language['siteWaiting_payment_status'] = 'Statut du paiement';
$language['siteWaiting_payment_pending'] = 'En attente';
$language['siteWaiting_payment_denied'] = 'Refusé';
$language['siteWaiting_payment_paid'] = 'Payé';
$language['siteWaiting_email_confirmed'] = 'Email confirmé';
$language['siteWaiting_select_email'] = 'Sélectionner le type d\'email';
$language['siteWaiting_email_default'] = 'Défaut';
$language['siteWaiting_email_custo'] = 'Personnalisé';
$language['siteWaiting_predefined_email'] = 'Email prédéfini';
$language['siteWaiting_select_customized_email'] = 'Sélectionner votre email si nécessaire';
$language['siteWaiting_subject'] = 'Sujet';
$language['siteWaiting_message'] = 'Message';
$language['siteWaiting_validate'] = 'Valider';
$language['siteWaiting_refuse'] = 'Refuser';
$language['siteWaiting_ban'] = 'Bannir';
$language['siteWaiting_button_check'] = 'Tout cocher';
$language['siteWaiting_button_ok'] = 'OK';

/* Moderation Texts END */
	
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