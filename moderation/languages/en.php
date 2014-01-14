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


/* Moderation Texts */

// all
$language['Management'] = 'Management';
$language['button_save'] = 'Save';
$language['button_delete'] = 'Delete';
$language['link_edit'] = 'Edit';
$language['link_delete'] = 'Delete';
$language['On'] = 'On';
$language['Off'] = 'Off';
$language['Yes'] = 'Yes';
$language['No'] = 'No';
$language['Root'] = 'Root';
$language['Do you really want to delete it?'] = 'Do you really want to delete it?';


//// --> template/templateName/extraField/
// itemForm.tpl


//// --> template/templateName/front/
// 404.tpl


//// --> template/templateName/includes/
// footer.tpl & footerLogin.tpl
$language['includesFooter_powered'] = 'Powered by';
$language['includesFooter_link'] = 'http://www.arfooo.net/';
$language['includesFooter_arfooo'] = 'Arfooo Directory';
$language['includesFooter_date'] = '2007 - ' . date('Y');   

// header.tpl
$language['includesHeader_language'] = 'en';

// pageNavigation.tpl
$language['includesPageNavigation_pages'] = 'Pages';


//// --> template/templateName/main/
// changePassword.tpl
$language['mainChangePassword_html_title'] = 'Moderator - Change your password';
$language['mainChangePassword_meta_description'] = 'Moderator - Change your password';
$language['mainChangePassword_arbo'] = 'Moderator - Change your password';
$language['mainChangePassword_h1'] = 'Moderator - Change your password';
$language['mainChangePassword_new_pass'] = 'New password';
$language['mainChangePassword_repeat_new_pass'] = 'Repeat new password';

// LogIn.tpl
$language['mainLogIn_html_title'] = 'Login to Arfooo Directory Moderator panel';
$language['mainLogIn_meta_description'] = 'Login to Arfooo Directory Moderator panel';
$language['mainLogIn_login'] = 'Email';
$language['mainLogIn_pass'] = 'Password';
$language['mainLogIn_button_login'] = 'Log In';
$language['mainLogIn_forgot_pass'] = 'Forgot your password?';

// lostPassword.tpl
$language['lostPassword_html_title'] = 'Forgotten password';
$language['lostPassword_meta_description'] = 'Forgotten password';
$language['lostPassword_desc'] = 'Thank you enter your e-mail. A new password will be sent by e-mail.';
$language['lostPassword_email'] = 'Email';
$language['lostPassword_button'] = 'Generate a new password';


//// --> template/templateName/memu/
// /menuheader/menuheader.tpl
$language['menuMenuHeader_directory'] = 'Directory';
$language['menuMenuHeader_users'] = 'Users';

// /menuleft/menuleftIndex.tpl
$language['menuLeftIndex_site_cat'] = 'Websites and categories';
$language['menuLeftIndex_pending'] = 'Pending websites';

// /menuleft/menuleftUsers.tpl
$language['menuLeftUsers_users'] = 'Users';
$language['menuLeftUsers_change_pass'] = 'Change password';

// /menuleft/login.tpl
$language['menuLeftLogIn_login'] = 'You are logged in as';
$language['menuLeftLogIn_logout'] = 'Logout';


//// --> template/templateName/site/
// edit.tpl
$language['siteEdit_html_title'] = 'Edit website';
$language['siteEdit_meta_description'] = 'Edit website';
$language['siteEdit_arbo'] = 'Edit website';
$language['siteEdit_h1'] = 'Edit website';
$language['siteEdit_cat'] = 'Categories';
$language['siteEdit_images'] = 'Images';
$language['siteEdit_add_images'] = 'Add images';
$language['siteEdit_general_information'] = 'General information';
$language['siteEdit_language_site'] = 'Website language';
$language['siteEdit_select_language_site'] = 'Select website language';
$language['siteEdit_webmaster_email'] = 'Webmaster email';
$language['siteEdit_webmaster_contact'] = 'Webmaster contact';
$language['siteEdit_webmaster_name'] = 'Webmaster name';
$language['siteEdit_website_title'] = 'Website title';
$language['siteEdit_website_url'] = 'Website address (URL)';
$language['siteEdit_button_metas'] = 'Metas';
$language['siteEdit_display_website'] = 'Display website';
$language['siteEdit_rss_feed_title'] = 'RSS feed title';
$language['siteEdit_rss_feed_url'] = 'RSS feed address (URL)';
$language['siteEdit_display_rss_feed'] = 'Display RSS feed';
$language['siteEdit_backlink_url'] = 'Backlink adress (URL)';
$language['siteEdit_website_desc'] = 'Website description';
$language['siteEdit_additional_fields'] = 'Additional fields';
$language['siteEdit_select_keywords'] = 'Select your keywords';
$language['siteEdit_select_keyword'] = 'Select your keyword';
$language['siteEdit_keyword'] = 'Keyword';
$language['siteEdit_company_info'] = 'Information about your company / Shows details on Google Maps';
$language['siteEdit_adress'] = 'Adress';
$language['siteEdit_display_google_maps'] = 'Display Google Maps';
$language['siteEdit_postal_code'] = 'Postal code';
$language['siteEdit_city'] = 'City';
$language['siteEdit_country'] = 'Country';
$language['siteEdit_phone'] = 'Phone number';
$language['siteEdit_fax'] = 'Fax number';
$language['siteEdit_other_settings'] = 'Other information, settings';
$language['siteEdit_search_partner'] = 'Search partnership';
$language['siteEdit_hits_numbers'] = 'Number of hits';
$language['siteEdit_rating_number'] = 'Number of rating';
$language['siteEdit_rating_average'] = 'Average rating';
$language['siteEdit_visitors_sent'] = 'Number of visitors sent';
$language['siteEdit_website_problem'] = 'The website has a problem';
$language['siteEdit_websiste_status'] = 'Status';
$language['siteEdit_websiste_approved'] = 'Approved';
$language['siteEdit_websiste_pending'] = 'Pending';
$language['siteEdit_websiste_banned'] = 'Banned';
$language['siteEdit_website_priority'] = 'Priority order';
$language['siteEdit_website_payment_detail'] = 'Detail';
$language['siteEdit_payment_free'] = 'Free';
$language['siteEdit_payment_premium'] = 'Premium';
$language['siteEdit_payment_status'] = 'Payment status';
$language['siteEdit_payment_status_pending'] = 'Pending';
$language['siteEdit_payment_status_denied'] = 'Denied';
$language['siteEdit_payment_status_paid'] = 'Paid';
$language['siteEdit_webmaster_IP'] = 'IP';
$language['siteEdit_thumbs'] = 'Thumbs';
$language['siteEdit_update_thumbs'] = 'Update thumbs';
$language['siteEdit_delete_thumbs'] = 'Delete Thumbs and display Ascreen';
$language['siteEdit_delete_ascreen'] = 'Delete Ascreen and display Thumbs';
$language['siteEdit_checking_website'] = 'Checking website...';
$language['siteEdit_delete_image'] = 'Do you want delete this image?';
$language['siteEdit_website_comments'] = 'Website comments';
$language['siteEdit_th_comments'] = 'Comments';
$language['siteEdit_th_users'] = 'Users';
$language['siteEdit_th_date'] = 'Date';
$language['siteEdit_th_ip'] = 'IP';
$language['siteEdit_th_validated'] = 'Validated';
$language['siteEdit_ban_ip'] = 'Ban IP';
$language['siteEdit_ad_website_detail'] = 'Advertisement in website detail page';

// waiting.tpl
$language['siteWaiting_html_title'] = 'Pending websites';
$language['siteWaiting_meta_description'] = 'Pending websites';
$language['siteWaiting_arbo'] = 'Pending websites';
$language['siteWaiting_h1'] = 'Pending websites';
$language['siteWaiting_edit_website'] = 'Edit website';
$language['siteWaiting_description'] = 'Description';
$language['siteWaiting_rss_feed'] = 'RSS feed';
$language['siteWaiting_keywords'] = 'Keywords';
$language['siteWaiting_cat'] = 'Category';
$language['siteWaiting_suggest_cat'] = 'Categories suggested';
$language['siteWaiting_suggest_key'] = 'Keywords suggested';
$language['siteWaiting_backlink'] = 'Backlink';
$language['siteWaiting_payment_detail'] = 'Details';
$language['siteWaiting_payment_free'] = 'Free';
$language['siteWaiting_payment_premium'] = 'Premium';
$language['siteWaiting_payment_status'] = 'Payment status';
$language['siteWaiting_payment_pending'] = 'Pending';
$language['siteWaiting_payment_denied'] = 'Denied';
$language['siteWaiting_payment_paid'] = 'Paid';
$language['siteWaiting_email_confirmed'] = 'Email confirmed';
$language['siteWaiting_select_email'] = 'Select email type';
$language['siteWaiting_email_default'] = 'Default';
$language['siteWaiting_email_custo'] = 'Customized';
$language['siteWaiting_predefined_email'] = 'Predefined email';
$language['siteWaiting_select_customized_email'] = 'Select your email if necessary';
$language['siteWaiting_subject'] = 'Subject';
$language['siteWaiting_message'] = 'Message';
$language['siteWaiting_validate'] = 'Validate';
$language['siteWaiting_refuse'] = 'Refuse';
$language['siteWaiting_ban'] = 'Ban';
$language['siteWaiting_button_check'] = 'Check all';
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