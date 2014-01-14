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


/* Admin Texts */

// all
$language['Management'] = 'Management';
$language['Do you really want to delete it?'] = 'Do you really want to delete it?';
$language['button_save'] = 'Save';
$language['button_delete'] = 'Delete';
$language['button_create'] = 'Create';
$language['button_edit'] = 'Edit';
$language['button_start'] = 'Start';
$language['button_pause'] = 'Pause';
$language['button_resume'] = 'Resume';
$language['button_stop'] = 'Stop';
$language['link_edit'] = 'Edit';
$language['link_delete'] = 'Delete';
$language['link_save'] = 'Save';
$language['link_ban'] = 'Ban';
$language['link_unban'] = 'Débannir';
$language['Website'] = 'Website';
$language['Websites'] = 'Websites';
$language['On'] = 'On';
$language['Off'] = 'Off';
$language['Yes'] = 'Yes';
$language['No'] = 'No';
$language['HEADER - BANNER'] = 'HEADER - BANNER';
$language['HORIZONTAL MENU'] = 'HORIZONTAL MENU';
$language['Left menu'] = 'Left Menu';
$language['Right menu'] = 'Right Menu';
$language['Root'] = 'Root';
$language['FOOTER'] = 'FOOTER';


//// --> template/templateName/ad/
// editCriteria.tpl
$language['adEditCriteria_html_title'] = 'Advertisement - Edit Criteria';
$language['adEditCriteria_meta_description'] = 'Advertisement - Edit Criteria';
$language['adEditCriteria_arbo'] = 'Advertisement - Edit Criteria';
$language['adEditCriteria_h1'] = 'Advertisement - Edit Criteria';
$language['adEditCriteria_criteria_name'] = 'Criteria Name';
$language['adEditCriteria_form_title1'] = '(x)HTML code and Javascript';
$language['adEditCriteria_form_desc1'] = '(x)HTML code to ease the integration and Javascript for your code of advertisement : Adsense, Oxado...';

// in.tpl
$language['adIn_html_title'] = 'Advertisement in';
$language['adIn_meta_description'] = 'Advertisement in';
$language['adIn_arbo'] = 'Advertisement in';
$language['adIn_h1'] = 'Advertisement in';
$language['adIn_activate'] = 'Activate advertisement';

// index.tpl
$language['adIndex_html_title'] = 'Advertisement';
$language['adIndex_meta_description'] = 'Advertisement';
$language['adIndex_arbo'] = 'Advertisement';
$language['adIndex_h1'] = 'Advertisement';
$language['adIndex_desc1'] = 'You can manage Advertisement on pages:';
$language['adIndex_desc2'] = 'Index, news, keywords (words list and websites list), top (hits, notes, rank, referrers), search engine';
$language['adIndex_desc3'] = 'To manage Advertisement in the categories, websites and keywords, you should go in categories, websites and keywords';
$language['adIndex_h2'] = 'Criteria List';
$language['adIndex_criteria_name'] = 'Criteria Name';
$language['adIndex_form_title1'] = '(x)HTML code and Javascript';
$language['adIndex_form_desc1'] = '(x)HTML code to ease the integration and Javascript for your code of advertisement : Adsense, Oxado...';
$language['adIndex_h2_create'] = 'Create Criteria';


//// --> template/templateName/ad/pages/
// all
$language['adPagesAll_activate_ad'] = 'Activate Advertisement';

// index.tpl
$language['adPagesIndex_html_title'] = 'Advertisement on index page';
$language['adPagesIndex_meta_description'] = 'Advertisement on index page';
$language['adPagesIndex_arbo'] = 'Advertisement on index page';
$language['adPagesIndex_h1'] = 'Advertisement on index page';
$language['adPagesIndex_h2'] = 'Manage Advertisement on index page';
$language['adPagesIndex_directory_title'] = 'Directory Title';
$language['adPagesIndex_category'] = 'Category';
$language['adPagesIndex_random_websites'] = 'Random websites';
$language['adPagesIndex_directory_description'] = 'Directory description';

// predefineCategory.tpl
$language['predefineCategory_html_title'] = 'Predefine the position of the advertisement in the categories pages';
$language['predefineCategory_meta_description'] = 'Predefine the position of the advertisement in the categories pages';
$language['predefineCategory_arbo'] = 'Predefine the position of the advertisement in the categories pages';
$language['predefineCategory_h1'] = 'Predefine the position of the advertisement in the categories pages';
$language['predefineCategory_desc1'] = 'You\'ll be able to predefine the position of advertising in all categories.';
$language['predefineCategory_desc2'] = 'It is recommended to activate the preset of advertising and publicity will be activated in all categories automatically and even those that you create later.';
$language['predefineCategory_desc3'] = 'You can change the position of advertising and/or disable advertising very simply by going in the category where you want to change.';
$language['predefineCategory_desc4'] = 'If the preset of advertising is activated for the category and sites (recommended), then disabling the preset of advertising for a category by going in the category, advertising will be disabled for all sites in category.';
$language['predefineCategory_desc5'] = 'This option is very useful to easily manage advertising very quickly and disable advertising categories and sites such as gambling, sex, which are prohibited by some advertisers.';
$language['predefineCategory_category'] = 'Category';
$language['predefineCategory_category_description'] = 'Category description, if you have entered one...';

// predefineKeyword.tpl
$language['predefineKeyword_html_title'] = 'Predefine the position of the advertisement in the keywords pages';
$language['predefineKeyword_meta_description'] = 'Predefine the position of the advertisement in the keywords pages';
$language['predefineKeyword_arbo'] = 'Predefine the position of the advertisement in the keywords pages';
$language['predefineKeyword_h1'] = 'Predefine the position of the advertisement in the keywords pages';
$language['predefineKeyword_websites_list'] = 'Websites list';
$language['predefineKeyword_desc1'] = 'Youll be able to predefine the position of advertising in any keywords (word list and websites list).';
$language['predefineKeyword_desc2'] = 'It is recommended to activate the preset of advertising and publicity will be activated in all keywords automatically and even those that you create later.';
$language['predefineKeyword_desc3'] = 'You can change the position of advertising and/or disable advertising very simply by going in the keyword where you want to change.';
$language['predefineKeyword_desc4'] = 'This option is very useful to easily manage advertising very quickly and disable advertising keywords and sites such as gambling, sex, which are prohibited by some advertisers.';
$language['predefineKeyword_keywords'] = 'Keywords';
$language['predefineKeyword_words_list'] = 'Words list';

// predefineSite.tpl
$language['predefineSite_html_title'] = 'Predefine the position of the advertisement in the websites details pages';
$language['predefineSite_meta_description'] = 'Predefine the position of the advertisement in the websites details pages';
$language['predefineSite_arbo'] = 'Predefine the position of the advertisement in the websites details pages';
$language['predefineSite_h1'] = 'Predefine the position of the advertisement in the websites details pages';
$language['predefineSite_desc1'] = 'You\'ll be able to predefine the position of advertising in all websites details pages';
$language['predefineSite_desc2'] = 'It is recommended to activate the preset of advertising and publicity will be activated in all websites details pages automatically and even those that you create later.';
$language['predefineSite_desc3'] = 'You can change the position of advertising and/or disable advertising very simply by going in the website where you want to change.';
$language['predefineSite_desc4'] = 'If the preset of advertising is activated for the category and sites (recommended), then disabling the preset of advertising for a category by going in the category, advertising will be disabled for all websites in category.';
$language['predefineSite_desc5'] = 'This option is very useful to easily manage advertising very quickly and disable advertising categories and sites such as gambling, sex, which are prohibited by some advertisers.';
$language['predefineSite_website_title'] = 'Website title';
$language['predefineSite_website_info'] = 'Website information';
$language['predefineSite_website_rss'] = 'Website RSS feeds';
$language['predefineSite_google'] = 'Google information';
$language['predefineSite_company'] = 'Company information';
$language['predefineSite_category'] = 'Website in same category';

// predefineTag.tpl
$language['predefineTag_html_title'] = 'Predefine the position of the advertisement in the tags pages';
$language['predefineTag_meta_description'] = 'Predefine the position of the advertisement in the tags pages';
$language['predefineTag_arbo'] = 'Predefine the position of the advertisement in the tags pages';
$language['predefineTag_h1'] = 'Predefine the position of the advertisement in the tags pages';
$language['predefineTag_desc1'] = 'Youll be able to predefine the position of advertising in any tags.';
$language['predefineTag_desc2'] = 'It is recommended to activate the preset of advertising and publicity will be activated in all tags automatically and even those that you create later.';
$language['predefineTag_desc3'] = 'You can change the position of advertising and/or disable advertising very simply by going in the tag where you want to change.';
$language['predefineTag_desc4'] = 'This option is very useful to easily manage advertising very quickly and disable advertising tags and sites such as gambling, sex, which are prohibited by some advertisers.';
$language['predefineTag_tags'] = 'Tags';
$language['predefineTag_tag_name'] = 'Tag name';


//// --> template/templateName/campaign/
// filter.tpl
$language['campaignFilter_html_title'] = 'Emails/others Campaign tracking';
$language['campaignFilter_meta_description'] = 'Emails/others Campaign tracking';
$language['campaignFilter_arbo'] = 'Emails/others Campaign tracking';
$language['campaignFilter_h1'] = 'Emails/others Campaign tracking';
$language['campaignFilter_desc1'] = 'If you want track your mails campaign, or others campaign, you need to add filters to the script allows the incoming link.';
$language['campaignFilter_desc2'] = 'Otherwise, your tracking links would return an http 404 error.';
$language['campaignFilter_desc3'] = 'Warning : By default, the script always adds character ?';
$language['campaignFilter_desc4'] = 'If you want to add a filter, never put the first character ?';
$language['campaignFilter_desc5'] = 'Example :';
$language['campaignFilter_desc6'] = 'Filter OK : utm_source=newsletter&utm_medium=email&utm_campaign=newsletter777';
$language['campaignFilter_desc7'] = 'Filter Not OK : ?utm_source=newsletter&utm_medium=email&utm_campaign=newsletter777';
$language['campaignFilter_add_filters'] = 'Add filters';
$language['campaignFilter_remove_filters'] = 'Remove filters';
$language['campaignFilter_filters'] = 'Filters';
$language['campaignFilter_add'] = 'Add';
$language['campaignFilter_remove'] = 'Remove';


//// --> template/templateName/category/
// edit.tpl
$language['categoryEdit_html_title'] = 'Edit category';
$language['categoryEdit_meta_description'] = 'Edit category';
$language['categoryEdit_arbo'] = 'Edit category';
$language['categoryEdit_h1'] = 'Edit category';
$language['categoryEdit_parent_category'] = 'Parent category';
$language['categoryEdit_category_name'] = 'Category name';
$language['categoryEdit_category_title'] = 'Category HTML title (optional)';
$language['categoryEdit_nav'] = 'Navigation name (optional)';
$language['categoryEdit_tag_h1'] = '&lt;h1&gt;&lt;/h1&gt; tag (optional)';
$language['categoryEdit_meta'] = 'Meta description (optional)';
$language['categoryEdit_possible_sub'] = 'Submission in the category allowed';
$language['categoryEdit_forbidden'] = 'Forbidden category';
$language['categoryEdit_forbidden_desc'] = 'The websites presents in this category will not be displayed in the pages top, the new page, the searcher, the random websites on the index page.';
$language['categoryEdit_category_image'] = 'Category Image';
$language['categoryEdit_category_image_desc'] = 'Sets an image for the category.';
$language['categoryEdit_text_description'] = 'Text to be displayed in the category (optional)';
$language['categoryEdit_text_description_desc'] = 'Category description for more targeted content for SEO';
$language['categoryEdit_add_new_fields'] = 'Add new fields';
$language['categoryEdit_field_name'] = 'Field name';
$language['categoryEdit_select_type_field'] = 'Select the type of field';
$language['categoryEdit_type_text'] = 'Text';
$language['categoryEdit_type_textarea'] = 'Textarea';
$language['categoryEdit_type_radio'] = 'Radio button';
$language['categoryEdit_type_check'] = 'Checkbox';
$language['categoryEdit_type_select'] = 'Select list';
$language['categoryEdit_type_range'] = 'Range';
$language['categoryEdit_type_url'] = 'URL';
$language['categoryEdit_type_file'] = 'File';
$language['categoryEdit_mandatory_field'] = 'Mandatory field';
$language['categoryEdit_suffix'] = 'Suffix (optional)';
$language['categoryEdit_anchor'] = 'Anchor text';
$language['categoryEdit_nofollow'] = 'Nofollow';
$language['categoryEdit_extensions'] = 'File extensions allowed';
$language['categoryEdit_extensions_desc'] = 'Add list of extensions that you allow separated by a comma. Example: odt, pdf, txt, doc, xls, zip';
$language['categoryEdit_maxSize'] = 'File size max';
$language['categoryEdit_maxSize_desc'] = 'Maximum file size in KB';
$language['categoryEdit_field_description'] = 'Field description (optional)';
$language['categoryEdit_field_description_desc'] = 'An image will appear next to the field. By passing the mouse over the image, the description will appear';
$language['categoryEdit_add_new_option'] = 'Add new option';
$language['categoryEdit_quick_add'] = 'Quick Add';
$language['categoryEdit_quick_add_desc'] = 'By clicking on link "Quick Add", you can Adds many options quickly. To this, add ONE option by line. Click on button Add, before create field';
$language['categoryEdit_button_add'] = 'Add';
$language['categoryEdit_option'] = 'Option';
$language['categoryEdit_button_create_field'] = 'Create field';
$language['categoryEdit_organization'] = 'Organization fields (order, search engine...)';
$language['categoryEdit_th_name'] = 'Name';
$language['categoryEdit_th_type'] = 'Type';
$language['categoryEdit_th_desc'] = 'Description';
$language['categoryEdit_th_search'] = 'In search engine';
$language['categoryEdit_th_mandatory'] = 'Mandatory';
$language['categoryEdit_th_management'] = 'management';

// index.tpl
$language['categoryIndex_html_title'] = 'Websites and categories management';
$language['categoryIndex_meta_description'] = 'Websites and categories management';
$language['categoryIndex_arbo'] = 'Websites and categories management';
$language['categoryIndex_h1'] = 'Websites and categories management';
$language['categoryIndex_th_categories'] = 'Categories name';
$language['categoryIndex_th_sub'] = 'Submission allowed';
$language['categoryIndex_th_management'] = 'Management';
$language['categoryIndex_create_category'] = 'Create Categorie';
$language['categoryIndex_create_subcategory_in'] = 'Create Subcategorie in';
$language['categoryIndex_websites_in_category'] = 'Websites in categorie';
$language['categoryIndex_th_websites'] = 'Websites name';
$language['categoryIndex_th_banned'] = 'Websites is banned';
$language['categoryIndex_th_backlink'] = 'Backlink';
$language['categoryIndex_add_website_in'] = 'Add website in';
$language['categoryIndex_general_information'] = 'General information';
$language['categoryIndex_website_language'] = 'Website language';
$language['categoryIndex_select_website_language'] = 'Select website language';
$language['categoryIndex_webmaster'] = 'Webmaster';
$language['categoryIndex_admin'] = 'Admin';
$language['categoryIndex_name'] = 'Name';
$language['categoryIndex_email'] = 'Email';
$language['categoryIndex_website_title'] = 'Website title';
$language['categoryIndex_website_adress'] = 'Website adress (URL)';
$language['categoryIndex_button_metas'] = 'Metas';
$language['categoryIndex_rss_feed_title'] = 'RSS feed title';
$language['categoryIndex_rss_feed_url'] = 'RSS feed adress (URL)';
$language['categoryIndex_backlink_adress'] = 'Backlink adress (URL)';
$language['categoryIndex_website_description'] = 'Website description';
$language['categoryIndex_website_description_html_text'] = 'Texte';
$language['categoryIndex_website_description_html_admin'] = 'Html admin';
$language['categoryIndex_website_description_characters'] = 'characters';
$language['categoryIndex_photos'] = 'Images';
$language['categoryIndex_add_photos'] = 'Add images';
$language['categoryIndex_add_an_photos'] = 'Add an image';
$language['categoryIndex_new_fields'] = 'Additional fields';
$language['categoryIndex_keywords'] = 'Keywords';
$language['categoryIndex_keyword'] = 'Keyword';
$language['categoryIndex_select_keyword'] = 'Select keyword';
$language['categoryIndex_company_information'] = 'Company information';
$language['categoryIndex_adress'] = 'Adress';
$language['categoryIndex_postal_code'] = 'postal code';
$language['categoryIndex_city'] = 'City';
$language['categoryIndex_country'] = 'Country';
$language['categoryIndex_phone'] = 'Phone number';
$language['categoryIndex_fax'] = 'Fax number';
$language['categoryIndex_others_info'] = 'Others informations, settings';
$language['categoryIndex_priority'] = 'Priority order';
$language['categoryIndex_checking'] = 'Checking website...';
$language['categoryIndex_advertisement_in'] = 'Advertisement in';
$language['categoryIndex_predefine_ad'] = 'Predefine advertisement';
$language['categoryIndex_predefine_ad_desc1'] = 'If this option is enabled, ads will be activated automatically.';
$language['categoryIndex_predefine_ad_desc2'] = 'Ads will be displayed in category and on the website according to your settings.';
$language['categoryIndex_category_name'] = 'Category name';
$language['categoryIndex_category'] = 'Category';
$language['categoryIndex_category_description'] = 'Category description';
$language['categoryIndex_h2_predefine_in'] = 'Predefine the position of the advertisement in the websites details pages in categorie';
$language['categoryIndex_predefine_position_ad'] = 'Predefine the position of the advertisement';
$language['categoryIndex_predefine_position_desc1'] = 'If this option is enabled, ads will be activated automatically.';
$language['categoryIndex_predefine_position_desc2'] = 'You can manage advertising very easily to all sites in this category. Its main purpose is to modify or adapt an advertising agency specializing in special categories (sites x, casino ...).';
$language['categoryIndex_h2_predefine'] = 'Predefine the position of the advertisement in the websites details pages';


//// --> template/templateName/comment/
// index.tpl
$language['commentIndex_html_title'] = 'Comments management';
$language['commentIndex_meta_description'] = 'Comments management';
$language['commentIndex_arbo'] = 'Comments management';
$language['commentIndex_h1'] = 'Comments management';
$language['commentIndex_validated'] = 'Comments validated';
$language['commentIndex_not_validated'] = 'Comments not validated';
$language['commentIndex_th_comment'] = 'Comment';
$language['commentIndex_th_website'] = 'Website';
$language['commentIndex_th_user'] = 'User';
$language['commentIndex_th_date'] = 'Date';
$language['commentIndex_th_ip'] = 'IP';
$language['commentIndex_th_validated'] = 'Validated';
$language['commentIndex_th_management'] = 'Management';


//// --> template/templateName/extraField/
// edit.tpl
$language['extraFieldEdit_html_title'] = 'Edit additional field';
$language['extraFieldEdit_meta_description'] = 'Edit additional field';
$language['extraFieldEdit_arbo'] = 'Edit additional field';
$language['extraFieldEdit_h1'] = 'Edit additional field';

// itemForm.tpl
$language['extraFieldItemForm_select_option'] = 'Select an option';
$language['extraFieldItemForm_url'] = 'URL';
$language['extraFieldItemForm_anchor_text'] = 'Anchor text';
$language['extraFieldItemForm_file'] = 'File';
$language['extraFieldItemForm_file_title'] = 'File Title';


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


//// --> template/templateName/keyword/
// edit.tpl
$language['keywordEdit_html_title'] = 'Edit keyword';
$language['keywordEdit_meta_description'] = 'Edit keyword';
$language['keywordEdit_arbo'] = 'Edit keyword';
$language['keywordEdit_h1'] = 'Edit keyword';
$language['keywordEdit_name'] = 'Name';
$language['keywordEdit_text_description'] = 'Text to be displayed in the keyword (optional)';
$language['keywordEdit_text_description_desc'] = 'Keyword description for more targeted content for SEO';

// index.tpl
$language['keywordIndex_html_title'] = 'Keywords';
$language['keywordIndex_meta_description'] = 'Keywords';
$language['keywordIndex_arbo'] = 'Keywords';
$language['keywordIndex_h1'] = 'Click on the letter or number to manage keywords';
$language['keywordIndex_h2'] = 'Create a keyword';

// letter.tpl
$language['keywordLetter_html_title'] = 'Keywords beginning with the letter';
$language['keywordLetter_meta_description'] = 'Keywords beginning with the letter';
$language['keywordLetter_arbo'] = 'Keywords beginning with the letter';
$language['keywordLetter_h2'] = 'Keywords beginning with the letter';
$language['keywordLetter_th_name'] = 'Name';
$language['keywordLetter_h2_ad'] = 'Advertising in the list of keywords beginning with';
$language['keywordLetter_keyword'] = 'Keyword';

// show.tpl
$language['keywordShow_html_title'] = 'Managing websites with the keyword';
$language['keywordShow_meta_description'] = 'Managing websites with the keyword';
$language['keywordShow_arbo'] = 'Managing websites with the keyword';
$language['keywordShow_h1'] = 'Managing websites with the keyword';
$language['keywordShow_th_banned'] = 'Website is banned';
$language['keywordShow_h2_ad'] = 'Advertisement in keyword';
$language['keywordShow_predefine_ad'] = 'Predefine advertisement';
$language['keywordShow_predefine_ad_desc1'] = 'If this option is enabled, ads will be activated automatically.';
$language['keywordShow_predefine_ad_desc2'] = 'Ads will be displayed in kyeword according to your settings.';


//// --> template/templateName/main/
// index.tpl
$language['mainIndex_html_title'] = 'Administration index';
$language['mainIndex_meta_description'] = 'Administration index';
$language['mainIndex_arbo'] = 'Administration index';
$language['mainIndex_h1'] = 'Welcome to Arfooo directory';
$language['mainIndex_desc1'] = 'Welcome to Arfooo directory.';
$language['mainIndex_desc2'] = 'Support is available on the';
$language['mainIndex_desc3'] = 'forum.';
$language['mainIndex_desc4'] = 'We hope you enjoy managing your Arfooo Directory.';
$language['mainIndex_th_stats'] = 'Statistics';
$language['mainIndex_th_value'] = 'Value';
$language['mainIndex_referenced'] = 'Approved websites';
$language['mainIndex_pending'] = 'Pending websites';
$language['mainIndex_rejected'] = 'Rejected websites';
$language['mainIndex_banned'] = 'Banned website';
$language['mainIndex_keywords'] = 'Keywords';
$language['mainIndex_categories'] = 'Categories';
$language['mainIndex_open'] = 'Directory open since';
$language['mainIndex_webmasters'] = 'Webmasters';
$language['mainIndex_version'] = 'Directory version';
$language['mainIndex_db'] = 'Database size';
$language['mainIndex_reset_part'] = 'Reset certain part of the directory';
$language['mainIndex_run'] = 'Run';
$language['mainIndex_reset_hits'] = 'Reset top hits';
$language['mainIndex_reset_hits_desc'] = 'Reset to 0 the top hits';
$language['mainIndex_reset_rating'] = 'Reset top rating';
$language['mainIndex_reset_rating_desc'] = 'Reset to 0 the top rating';
$language['mainIndex_reset_referrers'] = 'Reset top referrers';
$language['mainIndex_reset_referrers_desc'] = 'Reset to 0 the top referrers';
$language['mainIndex_clear_cache'] = 'Clear Cache';
$language['mainIndex_clear_cache_desc'] = 'Empty all the template files and queries cache';
$language['mainIndex_clear_cache_pr'] = 'Clear Cache Google PageRank';
$language['mainIndex_clear_cache_pr_desc'] = 'Empty the cache of Google PageRank. Use after each export PR only';
$language['mainIndex_url'] = 'Generate URL names';
$language['mainIndex_url_desc'] = 'Used to generate the format of URLs. You must use this function after the creation of each new sub-category, only if you use method 2, for the following URL format: http://www.example.com/category/subcategory/ otherwise the format will be: http://www.example.com/subcategory/ without the injection of the above categories';
$language['mainIndex_reset_category_order'] = 'Reclassify categories in alphabetical order';
$language['mainIndex_reset_category_order_desc'] = 'Used to reclassify the categories and subcategories in alphabetical order';

// logIn.tpl
$language['mainLogIn_html_title'] = 'Login to Arfooo Directory Admin panel';
$language['mainLogIn_meta_description'] = 'Login to Arfooo Directory Admin panel';
$language['mainLogIn_login'] = 'Username';
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
$language['menuMenuHeader_settings'] = 'Settings';
$language['menuMenuHeader_ad'] = 'Advertisement';
$language['menuMenuHeader_users'] = 'Users';
$language['menuMenuHeader_templates'] = 'Templates';
$language['menuMenuHeader_plugins'] = 'Plugins';
$language['menuMenuHeader_system'] = 'System';

// /menuleft/login.tpl
$language['menuLeftLogIn_login'] = 'You are logged in as';
$language['menuLeftLogIn_logout'] = 'Logout';

// /menuleft/menuleftAdsense.tpl
$language['menuLeftAd_criteria'] = 'Criteria';
$language['menuLeftAd_manage_criteria'] = 'Manage criteria';
$language['menuLeftAd_ad'] = 'Advertisement';
$language['menuLeftAd_ad_index'] = 'Advertisement in index';
$language['menuLeftAd_ad_news'] = 'Advertisement in news';
$language['menuLeftAd_ad_top_hits'] = 'Advertisement in top hits';
$language['menuLeftAd_ad_top_rating'] = 'Advertisement in top rating';
$language['menuLeftAd_ad_top_rank'] = 'Advertisement in top rank';
$language['menuLeftAd_ad_top_ref'] = 'Advertisement in top referrers';
$language['menuLeftAd_ad_search'] = 'Advertisement in search engine';
$language['menuLeftAd_ad_contact'] = 'Advertisement in contact page';
$language['menuLeftAd_ad_404'] = 'Advertisement in 404 error page';
$language['menuLeftAd_ad_allcat'] = 'Advertisement in allcategories';
$language['menuLeftAd_ad_predefine'] = 'Predefine the position of the advertisement';
$language['menuLeftAd_ad_predefine_cat'] = 'Categories';
$language['menuLeftAd_ad_predefine_websites'] = 'Websites';
$language['menuLeftAd_ad_predefine_keywords'] = 'Keywords';
$language['menuLeftAd_ad_predefine_tags'] = 'Tags';

// /menuleft/menuleftIndex.tpl
$language['menuLeftIndex_site_cat'] = 'Websites and categories';
$language['menuLeftIndex_pending'] = 'Pending websites';
$language['menuLeftIndex_problem'] = 'Websites with problems';
$language['menuLeftIndex_error'] = 'Websites with errors';
$language['menuLeftIndex_banned'] = 'Banned websites';
$language['menuLeftIndex_search'] = 'Search websites';
$language['menuLeftIndex_keywords'] = 'Keywords';
$language['menuLeftIndex_manage_keywords'] = 'Manage keywords';
$language['menuLeftIndex_tags'] = 'Tags Cloud';
$language['menuLeftIndex_manage_tags'] = 'Manage tags';
$language['menuLeftIndex_referrers'] = 'Referrers';
$language['menuLeftIndex_manage_referrers'] = 'Manage referrers';
$language['menuLeftIndex_comments'] = 'Comments';
$language['menuLeftIndex_manage_comments'] = 'Manage comments';
$language['menuLeftIndex_sitemap'] = 'Google sitemap';
$language['menuLeftIndex_generate_sitemap'] = 'Generate sitemap / see';

// /menuleft/menuleftPlugins.tpl
$language['menuLeftPlugins_plugins'] = 'Plugins';
$language['menuLeftPlugins_manage_plugins'] = 'Manage plugins';

// /menuleft/menuleftSettings.tpl
$language['menuLeftSettings_settings'] = 'Settings';
$language['menuLeftSettings_main_settings'] = 'Main settings';
$language['menuLeftSettings_detail_page'] = 'Websites detail page';
$language['menuLeftSettings_images_thumbs'] = 'Images, photos, thumbs';
$language['menuLeftSettings_submission'] = 'Websites submission';
$language['menuLeftSettings_html'] = 'Html';
$language['menuLeftSettings_duplicate'] = 'Duplicate checker';
$language['menuLeftSettings_google_info'] = 'Google information';
$language['menuLeftSettings_emails'] = 'Emails & newsletter';
$language['menuLeftSettings_stats'] = 'Statistics';
$language['menuLeftSettings_captcha'] = 'Captcha - Security code';
$language['menuLeftSettings_searcher'] = 'Search engine';
$language['menuLeftSettings_cache'] = 'Cache & optimization';
$language['menuLeftSettings_rss'] = 'Rss feeds';
$language['menuLeftSettings_text'] = 'Text';
$language['menuLeftSettings_dir_desc'] = 'Directory description';
$language['menuLeftSettings_terms'] = 'Terms of Use';
$language['menuLeftSettings_email'] = 'E-mails';
$language['menuLeftSettings_pay_sys'] = 'Payment system';
$language['menuLeftSettings_pay_proc'] = 'Payment Processors';
$language['menuLeftSettings_manage_criteria'] = 'Manage criteria';
$language['menuLeftSettings_campaign_tracking'] = 'Emails/others Campaign tracking';
$language['menuLeftSettings_manage_filters'] = 'Manage filters';

// /menuleft/menuleftSystem.tpl
$language['menuLeftSystem_version'] = 'Version';
$language['menuLeftSystem_check_updates'] = 'Check for updates';
$language['menuLeftSystem_data_php'] = 'Database & PHP';
$language['menuLeftSystem_optimize'] = 'Optimize tables';
$language['menuLeftSystem_save'] = 'Save';
$language['menuLeftSystem_restore'] = 'Restore';
$language['menuLeftSystem_system'] = 'System';
$language['menuLeftSystem_infos'] = 'Informations';
$language['menuLeftSystem_check'] = 'Check & updates';
$language['menuLeftSystem_version'] = 'Update thumbs';
$language['menuLeftSystem_backlink'] = 'Check backlink';
$language['menuLeftSystem_duplicate_content'] = 'Check duplicate content';

// /menuleft/menuleftTemplates.tpl
$language['menuLeftTemplates_templates'] = 'Templates';
$language['menuLeftTemplates_manage_templates'] = 'Manage templates';

// /menuleft/menuleftUsers.tpl
$language['menuLeftUsers_users'] = 'Users';
$language['menuLeftUsers_change_pass'] = 'Change password';
$language['menuLeftUsers_admin'] = 'Administrators';
$language['menuLeftUsers_moderators'] = 'Moderators';
$language['menuLeftUsers_webmasters'] = 'Webmasters';
$language['menuLeftUsers_security'] = 'Security';
$language['menuLeftUsers_ban_ip'] = 'Ban IPs';
$language['menuLeftUsers_ban_email'] = 'Ban e-mails';
$language['menuLeftUsers_ban_website'] = 'Ban websites';
$language['menuLeftUsers_ban_tags'] = 'Ban tags';
$language['menuLeftUsers_newsletter'] = 'Mass mailer - Newsletter';
$language['menuLeftUsers_send_newsletter'] = 'Send mass mailer - newsletter';
$language['menuLeftUsers_export_email'] = 'Export/import emails';


//// --> template/templateName/plugin/
// edit.tpl
$language['pluginEdit_html_title'] = 'Plugins';
$language['pluginEdit_meta_description'] = 'Plugins';
$language['pluginEdit_arbo'] = 'Plugins';
$language['pluginEdit_h1'] = 'Plugins informations';
$language['pluginEdit_h2'] = 'List & functions';

// index.tpl
$language['pluginIndex_html_title'] = 'Plugins';
$language['pluginIndex_meta_description'] = 'Plugins';
$language['pluginIndex_arbo'] = 'Plugins';
$language['pluginIndex_h1'] = 'Plugins list';
$language['pluginIndex_th_name'] = 'Plugins name';


//// --> template/templateName/referrer/
// index.tpl
$language['referrerIndex_html_title'] = 'Manage referrers';
$language['referrerIndex_meta_description'] = 'Manage referrers';
$language['referrerIndex_arbo'] = 'Manage referrers';
$language['referrerIndex_h1'] = 'Manage referrers';
$language['referrerIndex_desc1'] = 'On this page you can manage referrers.';
$language['referrerIndex_th_name'] = 'Websites name';
$language['referrerIndex_th_visitors'] = 'Visitors number';
$language['referrerIndex_reset'] = 'Reset to 0';


//// --> template/templateName/setting/
// condition.tpl
$language['settingCondition_html_title'] = 'Terms of Use';
$language['settingCondition_meta_description'] = 'Terms of Use';
$language['settingCondition_arbo'] = 'Terms of Use';
$language['settingCondition_h1'] = 'Terms of Use';
$language['settingCondition_desc'] = 'Enter the terms of use of your directory.';
$language['settingCondition_terms'] = 'Terms of Use';

// description.tpl
$language['settingDescription_html_title'] = 'Directory description';
$language['settingDescription_meta_description'] = 'Directory description';
$language['settingDescription_arbo'] = 'Directory description';
$language['settingDescription_h1'] = 'Directory description';
$language['settingDescription_desc1'] = 'Describe your directory.';
$language['settingDescription_desc2'] = 'The description appears on the index directory.';
$language['settingDescription_desc3'] = 'This will allow you to have a higher content to improve your SEO.';
$language['settingDescription_title'] = 'Title';
$language['settingDescription_desc'] = 'Description';

// editEmail.tpl
$language['settingEditEmail_html_title'] = 'Edit email';
$language['settingEditEmail_meta_description'] = 'Edit email';
$language['settingEditEmail_arbo'] = 'Edit email';
$language['settingEditEmail_h1'] = 'Edit email';
$language['settingEditEmail_description'] = 'Description';
$language['settingEditEmail_subject'] = 'Subject';

// editPackage.tpl
$language['settingEditPackage_html_title'] = 'Payment System - Edit criteria';
$language['settingEditPackage_meta_description'] = 'Payment System - Edit criteria';
$language['settingEditPackage_arbo'] = 'Payment System - Edit criteria';
$language['settingEditPackage_h1'] = 'Payment System - Edit criteria';
$language['settingEditPackage_criteria_name'] = 'Criteria name';
$language['settingEditPackage_criteria_image'] = 'Criteria image (optional)';
$language['settingEditPackage_criteria_image_desc'] = 'Displays a special image for the website that this criterion';
$language['settingEditPackage_price'] = 'Price';
$language['settingEditPackage_price_desc'] = 'Enter the price only if you use Paypal';
$language['settingEditPackage_id_allopass'] = 'Allopass ID';
$language['settingEditPackage_id_allopass_desc'] = 'To be completed only if you use Allopass';
$language['settingEditPackage_allopass_number'] = 'Allopass Number';
$language['settingEditPackage_priority'] = 'Priority';
$language['settingEditPackage_priority_desc'] = 'Sets a priority order for the display of the website';
$language['settingEditPackage_characters_numb'] = 'Characters number';
$language['settingEditPackage_characters_numb_desc'] = 'Number of available characters to describe each website';
$language['settingEditPackage_characters_min_numb'] = 'Minimum number of characters';
$language['settingEditPackage_characters_min_numb_desc'] = 'Minimum number of characters required for the description of each site';
$language['settingEditPackage_keywords'] = 'Keywords number';
$language['settingEditPackage_keywords_desc'] = 'Number of available keywords associated to each website';
$language['settingEditPackage_backlink'] = 'Backlink mandatory';
$language['settingEditPackage_html_enabled'] = 'Site description html enabled';
$language['settingEditPackage_html_allowed_tags'] = 'Available html tags';
$language['settingEditPackage_html_allowed_css_properties'] = 'Available css attributes';
$language['settingEditPackage_criteria_description'] = 'Criteria description';
$language['settingEditPackage_criteria_description_desc'] = 'Displays a description of the criteria so users know its characteristics';

// editPaymentProcessor.tpl
$language['settingEditPaymentProcessor_html_title'] = 'Payment System - Payment method';
$language['settingEditPaymentProcessor_meta_description'] = 'Payment System - Payment method';
$language['settingEditPaymentProcessor_arbo'] = 'Payment System - Payment method';
$language['settingEditPaymentProcessor_h1'] = 'Payment System - Payment method';
$language['settingEditPaymentProcessor_payment_method_name'] = 'Payment method name';
$language['settingEditPaymentProcessor_display_name'] = 'Display name';
$language['settingEditPaymentProcessor_enabled'] = 'Enabled';
$language['settingEditPaymentProcessor_currency'] = 'Currency';
$language['settingEditPaymentProcessor_email'] = 'E-mail';
$language['settingEditPaymentProcessor_test'] = 'Test mode';

// email.tpl
$language['settingEmail_html_title'] = 'E-mails - Manage E-mails';
$language['settingEmail_meta_description'] = 'E-mails - Manage E-mails';
$language['settingEmail_arbo'] = 'E-mails - Manage E-mails';
$language['settingEmail_h1'] = 'Manage E-mails - E-mails list';
$language['settingEmail_desc1'] = 'You can customize the various emails sent to webmaster and administrator on this page.';
$language['settingEmail_desc2'] = 'You can create personalized email, then select them in the management of pending website, then send.';
$language['settingEmail_desc3'] = 'The test email is sent to the administrator of the directory.';
$language['settingEmail_th_email'] = 'Email';
$language['settingEmail_test'] = 'Send test email';
$language['Do you really want send test email?'] = 'Do you really want send test email?';
$language['settingEmail_add_email'] = 'Add email';
$language['settingEmail_desc'] = 'Description';
$language['settingEmail_subject'] = 'Subject';

// index.tpl
$language['settingIndex_html_title'] = 'Directory settings';
$language['settingIndex_meta_description'] = 'Directory settings';
$language['settingIndex_arbo'] = 'Directory settings';
$language['settingIndex_h1'] = 'Main settings';
$language['settingIndex_explain'] = 'Explain';
$language['settingIndex_value'] = 'Value';
$language['settingIndex_select_language'] = 'Select your language';
$language['settingIndex_dir_title'] = 'Directory title';
$language['settingIndex_dir_title_desc'] = 'Title tag on index page';
$language['settingIndex_dir_meta_desc'] = 'Directory meta description';
$language['settingIndex_dir_meta_desc_desc'] = 'Directory meta description tag on index page';
$language['settingIndex_admin_email'] = 'Admin email';
$language['settingIndex_dir_url'] = 'Directory adress (URL)';
$language['settingIndex_date_format'] = 'Date format';
$language['settingIndex_url_rewrite'] = 'Enabled search engine friendly URLs';
$language['settingIndex_url_rewrite_mode'] = 'Search engine friendly URLs mode';
$language['settingIndex_url_rewrite_mode_desc'] = 'Mode 1 is a classical mode, without the injection of categories and subcategories in URLs: http://www.arfooo.com/website-title-s1.html. Mode 2 is an advanced mode, with the injection of categories and subcategories in URLs: http://www.arfooo.com/category/subcategory/website-title-s1.html';
$language['settingIndex_url_rewrite_parents'] = 'URL rewriting : Injection of categories in URL';
$language['settingIndex_url_rewrite_parents_desc'] = 'If you select ON, URLs contain all the categories and subcategories parent of the site. WARNING : After each new subcategory is created, you must go to the homepage of your admin and press the run button for Generate URLs name, format. If you select OFF, URLs contain only category where is present the site';
$language['settingIndex_sites_in_parent_categories'] = 'Website order in categories mode';
$language['settingIndex_sites_in_parent_categories_desc'] = 'Mode 1 is a classical mode. The sites are displayed only in the select category during submission. Mode 2 is a advanced mode. The sites are displayed in the select category during submission but also in the parent categories. Example: The site is subbmit in category http://www.arfooo.com/category-1/subcategory-1/subcategory-2/. The site will then be displayed in 3 categories and not just the last.';
$language['settingIndex_order_by'] = 'Website order by';
$language['settingIndex_order_by_date'] = 'Validation date';
$language['settingIndex_order_by_ref'] = 'Referrers';
$language['settingIndex_order_by_alph'] = 'Alphabetical';
$language['settingIndex_domain'] = 'One domain can be present in "x" categories';
$language['settingIndex_domain_subpage'] = 'Maximum number of subpages from one domain which can be submitted';
$language['settingIndex_new_website'] = 'A website will be considered new during "x" days';
$language['settingIndex_number_char_page'] = 'Number of character displayed for the description of sites on the pages of the directory';
$language['settingIndex_number_char_page_desc'] = 'Only the detail page of websites display the full description';
$language['settingIndex_vertical_menu'] = 'Display vertical categories menu';
$language['settingIndex_display_news'] = 'Display news page';
$language['settingIndex_display_top_hits'] = 'Display top hits';
$language['settingIndex_display_top_rate'] = 'Display top rating';
$language['settingIndex_display_top_rank'] = 'Display top rank';
$language['settingIndex_display_top_ref'] = 'Display top referrers';
$language['settingIndex_display_allcat'] = 'Display allcategories page';
$language['settingIndex_display_contact'] = 'Display contact page';
$language['settingIndex_number_website_cat'] = 'Number of websites to display in categories and subcategories';
$language['settingIndex_number_website_key'] = 'Number of websites to display in keywords';
$language['settingIndex_number_website_search'] = 'Number of websites to display in search engine';
$language['settingIndex_number_website_top_hits'] = 'Number of websites to display in top hits';
$language['settingIndex_number_website_top_rate'] = 'Number of websites to display in top rating';
$language['settingIndex_number_website_top_rank'] = 'Number of websites to display in top rank';
$language['settingIndex_number_website_top_ref'] = 'Number of websites to display in top referrers';
$language['settingIndex_number_website_news'] = 'Number of websites to display in news';
$language['settingIndex_number_sub_cat'] = 'Number of subcategories to display below categories';
$language['settingIndex_display_keywords'] = 'Display keywords';
$language['settingIndex_number_keywords'] = 'If ON, then number of keywords, associated with each website';
$language['settingIndex_display_tags'] = 'Display Tags cloud';
$language['settingIndex_display_before_tags'] = 'Number Search tags before displaying the tags cloud';
$language['settingIndex_number_tags'] = 'Number of tags displayed in the tag cloud';
$language['settingIndex_number_random_website'] = 'Number of random websites displayed on index page';
$language['settingIndex_number_random_website_renew'] = 'Number of random website on the index page will be renewed every "x" days';
$language['settingIndex_button_renew_random'] = 'Generate new selection';
$language['settingIndex_top_ref_renew'] = 'Top referrers will be reset to 0 every "x" days';
$language['settingIndex_button_renew_ref'] = 'Reset top referrers to 0';
$language['settingIndex_enable_gzip'] = 'Enable Gzip compression';
$language['settingIndex_compr_template'] = 'Enable template compression';
$language['settingIndex_enbable_check_template'] = 'Enable checking of template for each page display';
$language['settingIndex_enbable_check_template_desc'] = 'Disable this option only if you make any more changes to your template';
$language['settingIndex_count_referrers'] = 'Enable account referrers';
$language['settingIndex_count_referrers_desc'] = 'Enable this option only if you display the top referrers, or if you display the websites by the number of referrers';
$language['settingIndex_cache_detail_page'] = 'Enable cache for websites detail page';
$language['settingIndex_cache_detail_page_life'] = 'Website detail page cache life time (in seconds)';
$language['settingIndex_error_handler_save_to_file'] = 'Save the errors, bugs to file';
$language['settingIndex_error_handler_display_error'] = 'Display the errors, bugs';
$language['settingIndex_h2_detail_page'] = 'Websites detail page';
$language['settingIndex_display_rss_feed'] = 'Display, parse the RSS feed websites';
$language['settingIndex_number_item_rss'] = 'Number of items displayed for the parsing of RSS feed';
$language['settingIndex_number_char_rss'] = 'Number of characters to display for the parsing of RSS feed';
$language['settingIndex_number_days_delete_rss_cache'] = 'Number of days before deleting the cached RSS feed';
$language['settingIndex_display_company_info'] = 'Display company information (adress, city,phone...)';
$language['settingIndex_display_google_map'] = 'Display Google Maps';
$language['settingIndex_google_map_key'] = 'Google Maps API Key';
$language['settingIndex_display_random_websites_detail_page'] = 'Display random websites on the detail page of websites';
$language['settingIndex_display_random_websites_detail_page_desc'] = 'Display random websites on the detail page of websites, improve your internal linkage';
$language['settingIndex_condition_common_keyword'] = 'The random websites are displayed only if they have a common keyword';
$language['settingIndex_number_random_websites_displayed_detail'] = 'Number of random websites displayed on the details page of websites';
$language['settingIndex_number_char_random_web'] = 'Characters number displayed for the description of random websites';
$language['settingIndex_enable_comments'] = 'Enable comments';
$language['settingIndex_validated_comments'] = 'Comments will be automatically validated';
$language['settingIndex_h2_images_thumbs'] = 'Images - photos - thumbs';
$language['settingIndex_display_image_beside_cat'] = 'Display images beside categories';
$language['settingIndex_image_beside_web'] = 'Display images beside websites';
$language['settingIndex_enable_ascreen'] = 'Enable Ascreen';
$language['settingIndex_enable_ascreen_desc'] = 'If ascreen is activated, the ascreen will always be searched and displayed first. The thumbshot service generation will be used if ascreen isn\'t found';
$language['settingIndex_url_generation_thumbs'] = 'Address thumbs Service generation (URL)';
$language['settingIndex_url_generation_thumbs_desc'] = 'You can use the joker [url] as a parameter to use different settings for your thumbs service generation. Example: http://www.yourservice.com/src/[url]@320x240';
$language['settingIndex_save_thumbs'] = 'Repatriate save thumbs websites in the directory uploads/thumbs_images';
$language['settingIndex_country_flag'] = 'Display country flag';
$language['settingIndex_country_flag_desc'] = 'Specifies the language of the website';
$language['settingIndex_enable_gallery_image'] = 'Enable image uploads by users';
$language['settingIndex_images_uploaded'] = 'Images uploaded by users will be displayed first';
$language['settingIndex_images_uploaded_desc'] = 'Thumbs are not displayed when images are uploaded';
$language['settingIndex_number_images_web'] = 'Number of images for each website';
$language['settingIndex_image_weight'] = 'Maximum weight for each image';
$language['settingIndex_image_watermark'] = 'Image watermark (copyright)';
$language['settingIndex_image_watermark_on'] = 'If watermark is ON';
$language['settingIndex_dl_watermark'] = 'Download watermark image';
$language['settingIndex_where_watermark'] = 'Where watermark is displayed on image';
$language['settingIndex_where_top_right'] = 'Top right';
$language['settingIndex_where_top_left'] = 'Top left';
$language['settingIndex_where_bot_right'] = 'Bottom right';
$language['settingIndex_where_bot_left'] = 'Bottom left';
$language['settingIndex_medium_image'] = 'Medium image dimensions';
$language['settingIndex_small_image'] = 'Small image dimensions';
$language['settingIndex_micro_image'] = 'Micro image dimensions';
$language['settingIndex_width'] = 'width';
$language['settingIndex_height'] = 'height';
$language['settingIndex_h2_website_registration'] = 'Websites registration / submission';
$language['settingIndex_submission_available_type'] = 'Select the type of submission available';
$language['settingIndex_sub_free'] = 'Free';
$language['settingIndex_sub_premium'] = 'Premium';
$language['settingIndex_sub_both'] = 'Free & Premium';
$language['settingIndex_registration_mandatory'] = 'Webmasters must register to submit their websites';
$language['settingIndex_dir_website_only'] = 'Directory website only';
$language['settingIndex_dir_website_only_desc'] = 'If you decide to put this option off, Arfooo Directory can be a directory of camping, person (yellow page)... Webiste submission with a URL will be optional';
$language['settingIndex_registration_open'] = 'Registration / Submission website are open';
$language['settingIndex_registration_open_desc'] = 'Allows to open or close websites registration';
$language['settingIndex_validation_auto'] = 'Websites are automatically validated';
$language['settingIndex_check_code_website'] = 'If yes, check whether the websites are accessible';
$language['settingIndex_check_code_website_desc'] = 'Only the http code 200 is considered like accessible';
$language['settingIndex_meta_button'] = 'Enable metas tags button checker';
$language['settingIndex_meta_button_desc'] = 'The button is here to complete the form fields through the website metas tags';
$language['settingIndex_char_availalbe_each_web'] = 'Number of characters available to describe each website';
$language['settingIndex_char_mandatory_each_web'] = 'Number of characters required for the description of each website';
$language['settingIndex_backlink_mandatory'] = 'Backlink mandatory';
$language['settingIndex_backlink_html_code1'] = 'Display backlink html code 1';
$language['settingIndex_backlink_html_code1_text'] = 'Backlink html code 1 text';
$language['settingIndex_backlink_html_code1_text_desc'] = 'Allows you to customize the text of the backlink, if empty then the title of your directory will be displayed';
$language['settingIndex_backlink_html_code1_url'] = 'Backlink html code 1 (URL)';
$language['settingIndex_backlink_html_code1_url_desc'] = 'Allows you to customize the URL of the backlink, if empty then the URL of your directory will be displayed';
$language['settingIndex_backlink_html_code2'] = 'Display backlink html code 2';
$language['settingIndex_backlink_html_code2_text'] = 'Backlink html code 2 text';
$language['settingIndex_website_protocols'] = 'Allow websites protocols';
$language['settingIndex_protocol_http'] = 'http';
$language['settingIndex_protocol_https'] = 'https';
$language['settingIndex_protocol_ftp'] = 'ftp';
$language['settingIndex_partnership'] = 'Enable partnership searching';
$language['settingIndex_partnership_desc'] = 'Webmasters can receive contacts partnerships by email. Form are present on websites detail page via a JS popup';
$language['settingIndex_h2_html_settings'] = 'Html settings';
$language['settingIndex_site_description_html_enabled_for_admin'] = 'Site description html enabled for admin';
$language['settingIndex_available_html_tags_for_admin'] = 'Available html tags for admin';
$language['settingIndex_available_css_attributes_for_admin'] = 'Available css attributes for admin';
$language['settingIndex_site_description_html_enabled_for_users'] = 'Site description html enabled for users';
$language['settingIndex_available_html_tags_for_users'] = 'Available html tags for users';
$language['settingIndex_available_css_attributes_for_users'] = 'Available css attributes for users';
$language['settingIndex_h2_duplication_checker'] = 'Duplication checker';
$language['settingIndex_enable_checking_duplicate_content_submission_sites'] = 'Enable checking duplicate content submission sites';
$language['settingIndex_how_many_random_phrases_to_check'] = 'How many random phrases to check';
$language['settingIndex_how_many_words_should_contain_a_phrase'] = 'How many words should contain a phrase';
$language['settingIndex_how_many_of_checked_phrases_can_be_duplicated'] = 'How many of checked phrases can be duplicated';
$language['settingIndex_h2_google_info'] = 'Google informations';
$language['settingIndex_display_backlink_number'] = 'Display the number of backlinks';
$language['settingIndex_display_page_number'] = 'Show the number of indexed pages';
$language['settingIndex_display_pagerank'] = 'Display PageRank';
$language['settingIndex_pagerank_mode1'] = 'Use Method 1 to generate the PageRank';
$language['settingIndex_to_test'] = 'To test';
$language['settingIndex_test'] = 'Test';
$language['settingIndex_pagerank_mode2'] = 'Use Method 2 to generate the PageRank';
$language['settingIndex_pagerank_mode2_url'] = 'Address of the remote server to generate the PageRank with method 2 (URL)';
$language['settingIndex_pagerank_cache'] = 'PageRank cache life time (in days)';
$language['settingIndex_h2_stats'] = 'Statistics';
$language['settingIndex_display_stats'] = 'Display statistics';
$language['settingIndex_stats_on'] = 'If statistics is ON, then';
$language['settingIndex_display_approved_websites'] = 'Display the number of approved websites';
$language['settingIndex_display_pending_websites'] = 'Display the number of pending websites';
$language['settingIndex_display_rejected_websites'] = 'Display the number of rejected websites';
$language['settingIndex_display_ban_websites'] = 'Display the number of banned websites';
$language['settingIndex_display_numb_cat'] = 'Display the number of categories';
$language['settingIndex_display_numb_keyword'] = 'Display the number of keywords';
$language['settingIndex_display_numb_webmasters'] = 'Display the number of webmasters';
$language['settingIndex_h2_captcha'] = 'Captcha - Security code';
$language['settingIndex_captcha_registration'] = 'Display captcha on the webmasters registration page';
$language['settingIndex_captcha_sub'] = 'Display captcha on the websites submission form';
$language['settingIndex_captcha_sub_desc'] = 'This captcha is displayed only when the webmasters should not register';
$language['settingIndex_captcha_contact'] = 'Display captcha on the page contact form';
$language['settingIndex_captcha_comment'] = 'Display captcha to post a comment';
$language['settingIndex_h2_email'] = 'Email & Newsletter';
$language['settingIndex_email_confirm'] = 'Enable email confirmation';
$language['settingIndex_email_confirm_desc'] = 'The webmaster must confirm his account or the submission of the website by clicking a link in an email';
$language['settingIndex_email_approved_website'] = 'Webmaster receive an email when his website is approved';
$language['settingIndex_email_rejected_website'] = 'Webmaster receive an email when his website is rejected';
$language['settingIndex_email_banned_website'] = 'Webmaster receive an email when his website is banned';
$language['settingIndex_email_submit_website'] = 'Webmaster receive an email when he submit a website';
$language['settingIndex_email_submit_website_admin'] = 'Admin receive an email when webmaster submit website';
$language['settingIndex_email_submit_comment_admin'] = 'Admin receive an email when new comment / rating is submitted';
$language['settingIndex_email_submit_error_admin'] = 'Admin receive an email when website with a problem is submitted by an user';
$language['settingIndex_email_newsletter'] = 'Enable registration to the newsletter';
$language['settingIndex_h2_search_engine'] = 'Search engine';
$language['settingIndex_search_advanced'] = 'Activate the link to make advanced search';
$language['settingIndex_search_like'] = 'Enable search engine LIKE method';
$language['settingIndex_search_like_desc'] = 'By activating the LIKE method, you can make search with the words of 1 letter. Otherwise the basic method is the method FULL TEXT, not to do research with words of 4 letters minimum. We recommend that you do not touch the number of letters minimum and maximum for the LIKE method.';
$language['settingIndex_search_like_min'] = 'Search engine LIKE method min length of searched word';
$language['settingIndex_search_like_max'] = 'Search engine LIKE method max length of searched word';
$language['settingIndex_search_operator'] = 'Search engine default operator';
$language['settingIndex_search_operator_and'] = 'AND';
$language['settingIndex_search_operator_or'] = 'OR';
$language['settingIndex_search_fields'] = 'Enable search in fields';
$language['settingIndex_search_fields_title'] = 'Title';
$language['settingIndex_search_fields_desc'] = 'Description';
$language['settingIndex_search_fields_url'] = 'URL';
$language['settingIndex_cache_optimization'] = 'Cache & optimization';
$language['settingIndex_h2_rss_feeds'] = 'RSS feeds';
$language['settingIndex_rss_news'] = 'Display RSS feed of new websites';
$language['settingIndex_rss_cat'] = 'Display RSS feeds in each category and subcategories';
$language['settingIndex_rss_web'] = 'Display RSS feed in each website';

// package.tpl
$language['settingPackage_html_title'] = 'Payment System - Manage criteria';
$language['settingPackage_meta_description'] = 'Payment System - Manage criteria';
$language['settingPackage_arbo'] = 'Payment System - Manage criteria';
$language['settingPackage_h1'] = 'Payment System - Manage criteria';
$language['settingPackage_desc1'] = 'Enable only one or all payment method, if you use one or all of payment method on all your criteria.';
$language['settingPackage_desc2'] = 'Example: If you activate Allopass and Paypal payment method, you must fill the price for Paypal, Allopass ID and the number of Allopass on all your criteria.';
$language['settingPackage_desc3'] = 'To use Allopass and/or Paypal, you must have an account or create one.';
$language['settingPackage_desc4'] = 'Create Allopass account';
$language['settingPackage_desc5'] = 'Create Paypal account';
$language['settingPackage_desc6'] = 'To use Allopass once your account is created, you must go to "Document management" then "Add Site".';
$language['settingPackage_desc7'] = 'Fill the field "site name", select the category "Directory", then enter the address (URL) where is installed your directory.';
$language['settingPackage_desc8'] = 'Once the site is added, click the name of the site, select "micro-payment by act" then "Add Document".';
$language['settingPackage_desc9'] = 'Fill the field "document name", for example, bronze, silver, gold.';
$language['settingPackage_desc10'] = 'For field "URL access" and "URL document", simply enter the URL where your directory is installed.';
$language['settingPackage_desc11'] = 'For "URL error", leave it blank.';
$language['settingPackage_desc12'] = 'Enter the number of code: 1, 2, 3, 4 or 5.';
$language['settingPackage_desc13'] = 'Then go down the page and uncheck "Enable My allopass".';
$language['settingPackage_desc14'] = 'Finally confirm by pressing the button "Send".';
$language['settingPackage_desc15'] = 'The ID Allopass is the identifier Allopass of the document you just created.';
$language['settingPackage_desc16'] = 'It looks like this: "178941/458792/25479';
$language['settingPackage_desc17'] = 'For the field, "Allopass number" if you use Allopass simply enter the number of codes that you select when creating the document.';
$language['settingPackage_desc18'] = 'To use PayPal, simply enter the email address of your Paypal account, and put "OFF" the "test mode".';
$language['settingPackage_desc19'] = 'Then specify the price in the field: "Price".';
$language['settingPackage_desc20'] = '!!! Warning !!!';
$language['settingPackage_desc21'] = 'If you specify a price with cents, example: 15.50, use the point "." and not a comma ",".';
$language['settingPackage_h2'] = 'Criteria list';
$language['settingPackage_th_name'] = 'Criteria name';
$language['settingPackage_h2_create'] = 'Create criteria';

// paymentProcessor.tpl
$language['settingPaymentProcessor_html_title'] = 'Payment System - Payment method';
$language['settingPaymentProcessor_meta_description'] = 'Payment System - Payment method';
$language['settingPaymentProcessor_arbo'] = 'Payment System - Payment method';
$language['settingPaymentProcessor_h1'] = 'Payment System - Payment method';
$language['settingPaymentProcessor_th_payment_method_name'] = 'Payment method name';
$language['settingPaymentProcessor_th_enabled'] = 'Enabled';


//// --> template/templateName/site/
// banned.tpl
$language['siteBanned_html_title'] = 'Websites banned';
$language['siteBanned_meta_description'] = 'Websites banned';
$language['siteBanned_show_arbo'] = 'Websites banned';
$language['siteBanned_h1'] = 'Websites banned';
$language['siteBanned_desc1'] = 'Find below the list of banned sites.';
$language['siteBanned_desc2'] = 'You can manage them easily.';
$language['siteBanned_th_website_name'] = 'Websites name';

// banSite.tpl
$language['siteBanSite_html_title'] = 'Ban websites';
$language['siteBanSite_meta_description'] = 'Ban websites';
$language['siteBanSite_arbo'] = 'Ban websites';
$language['siteBanSite_h1'] = 'Ban websites';
$language['siteBanSite_desc1'] = 'To banish one or multiple websites, enter 1 website by line';
$language['siteBanSite_desc2'] = 'You can use the character "*" as a wildcard for banning entire subdomain (blog, forum ...)';
$language['siteBanSite_h2_unban'] = 'Unban websites';

// edit.tpl
$language['siteEdit_html_title'] = 'Edit website';
$language['siteEdit_meta_description'] = 'Edit website';
$language['siteEdit_arbo'] = 'Edit website';
$language['siteEdit_h1'] = 'Edit website';
$language['siteEdit_cat'] = 'Categories';
$language['siteEdit_additional_categories'] = 'Additional categories';
$language['siteEdit_additional_categories_none'] = '- None -';
$language['siteEdit_category_proposal'] = 'Suggested Categories';
$language['siteEdit_images'] = 'Images';
$language['siteEdit_add_images'] = 'Add images';
$language['siteEdit_add_an_image'] = 'Add an image';
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
$language['siteEdit_website_html_text'] = 'Text';
$language['siteEdit_website_html_user'] = 'Html user';
$language['siteEdit_website_html_admin'] = 'Html admin';
$language['siteEdit_additional_fields'] = 'Additional fields';
$language['siteEdit_select_keywords'] = 'Select your keywords';
$language['siteEdit_select_keyword'] = 'Select your keyword';
$language['siteEdit_keyword'] = 'Keyword';
$language['siteEdit_keyword_proposal'] = 'Suggested Keywords';
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
$language['siteEdit_delete_thumbs_customized'] = 'Delete thumbs uploaded';
$language['siteEdit_upload_another_thumbs'] = 'Upload another thumbs';
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

// errorCode.tpl
$language['siteErrorCode_html_title'] = 'Check websites with an HTTP error code';
$language['siteErrorCode_meta_description'] = 'Check websites with an HTTP error code';
$language['siteErrorCode_arbo'] = 'Check websites with an HTTP error code';
$language['siteErrorCode_h1'] = 'Check websites with an HTTP error code';
$language['siteErrorCode_status'] = 'Status';
$language['siteErrorCode_progress'] = 'Progress';
$language['siteErrorCode_checked_sites'] = 'Checked websites';
$language['siteErrorCode_desc1'] = 'This feature allows you to find all websites with a code different http 200 (301, 302, 404, 500...).';
$language['siteErrorCode_th_website_name'] = 'Websites name';
$language['siteErrorCode_th_http'] = 'HTTP error code';

// search.tpl
$language['siteSearch_html_title'] = 'Search websites';
$language['siteSearch_meta_description'] = 'Search websites';
$language['siteSearch_arbo'] = 'Search websites';
$language['siteSearch_h1'] = 'Search websites';
$language['siteSearch_desc1'] = 'To find website, enter website title or website URL without http://';
$language['siteSearch_button_search'] = 'Search';
$language['siteSearch_h2'] = 'Websites found';
$language['siteSearch_th_website_name'] = 'Websites name';
$language['siteSearch_th_url'] = 'URL';
$language['siteSearch_th_ban'] = 'Websites banned';
$language['siteSearch_th_backlink'] = 'Backlink"';

// showGoogleMap.tpl

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


//// --> template/templateName/sitemap/
// index.tpl


//// --> template/templateName/siteProblem/
// index.tpl
$language['siteProblem_html_title'] = 'Check websites have been reported by users as \"with a problem\"';
$language['siteProblem_meta_description'] = 'Check websites have been reported by users as \"with a problem\"';
$language['siteProblem_arbo'] = 'Check websites have been reported by users as "with a problem"';
$language['siteProblem_h1'] = 'Check websites have been reported by users as "with a problem"';
$language['siteProblem_desc1'] = 'Check websites have been reported by users as "with a problem".';
$language['siteProblem_th_website_name'] = 'Websites name';
$language['siteProblem_th_problem_type'] = 'Problem type';
$language['siteProblem_th_problem_detail'] = 'Problem detail';
$language['siteProblem_bad_category'] = 'Bad category';
$language['siteProblem_spam'] = 'Spam';


//// --> template/templateName/system/
// backlink.tpl
$language['systemBacklink_html_title'] = 'Check backlinks';
$language['systemBacklink_meta_description'] = 'Check backlinks';
$language['systemBacklink_arbo'] = 'Check backlinks';
$language['systemBacklink_h1'] = 'Check backlinks';
$language['systemBacklink_backlinks_checked'] = 'Backlinks checked';
$language['systemBacklink_desc1'] = 'You can check if backlinks that were added during registration are always present.';
$language['systemBacklink_desc2'] = 'An email will be sent when the check is completed.';

// checkSecurity.tpl
$language['systemCheckSecurity_desc1'] = 'Your version is not up to date, an update is available at this address: http://www.arfooo.net/';
$language['systemCheckSecurity_desc2'] = 'You need to update your installation for security reasons.';
$language['systemCheckSecurity_install_dir'] = 'Beware, install/ dir is still present on the server. For security reasons, remove this dir.';

// duplicateContent.tpl
$language['systemDuplicate_html_title'] = 'Check duplicate content';
$language['systemDuplicate_meta_description'] = 'Check duplicate content';
$language['systemDuplicate_arbo'] = 'Check duplicate content';
$language['systemDuplicate_h1'] = 'Check duplicate content';
$language['systemDuplicate_backlinks_checked'] = 'Duplicate content checked';
$language['systemDuplicate_desc1'] = 'You can check if description that were added during registration are always unique.';
$language['systemDuplicate_desc2'] = 'An email will be sent when the check is completed.';

// index.tpl
$language['systemIndex_html_title'] = 'Check update';
$language['systemIndex_meta_description'] = 'Check update';
$language['systemIndex_arbo'] = 'Check update';
$language['systemIndex_h1'] = 'Check update';
$language['systemIndex_desc'] = 'Check thath Arfooo Directory is updated';
$language['systemIndex_desc1'] = 'Your installation is up to date, no update is available for your version of Arfooo directory. You do not need to update your installation.';
$language['systemIndex_current'] = 'Current version';
$language['systemIndex_last'] = 'Last version';

// information.tpl
$language['systemInfo_html_title'] = 'System informations';
$language['systemInfo_meta_description'] = 'System informations';
$language['systemInfo_arbo'] = 'System informations';
$language['systemInfo_h1'] = 'Files and directories informations';
$language['systemInfo_install_dir'] = 'install/ dir is still present on the server';
$language['systemInfo_cache_dir'] = 'cache/ dir is writable';
$language['systemInfo_save_dir'] = 'save/ dir is writable';
$language['systemInfo_uploads_img_cat_dir'] = 'uploads/images_categories/ dir is writable';
$language['systemInfo_uploads_img_thumbs_dir'] = 'uploads/images_thumbs/ dir is writable';
$language['systemInfo_h2'] = 'Server informations';
$language['systemInfo_php_version'] = 'Your PHP version';
$language['systemInfo_mysql_version'] = 'Your MySQL version';
$language['systemInfo_template_version'] = 'Your Template Lite version';

// optimize.tpl
$language['systemOptimize_html_title'] = 'Optimize MySQL tables';
$language['systemOptimize_meta_description'] = 'Optimize MySQL tables';
$language['systemOptimize_arbo'] = 'Optimize MySQL tables';
$language['systemOptimize_h1'] = 'Optimize MySQL tables';
$language['systemOptimize_desc1'] = 'This process will optimize the tables in the MySQL database and preserve data integrity.';
$language['systemOptimize_desc2'] = 'No data can be lost during this process.';

// restore.tpl
$language['systemRestore_html_title'] = 'Restore Arfooo directory database';
$language['systemRestore_meta_description'] = 'Restore Arfooo directory database';
$language['systemRestore_arbo'] = 'Restore Arfooo directory database';
$language['systemRestore_h1'] = 'Restore Arfooo directory database';
$language['systemRestore_desc1'] = 'This operation restore your Arfooo Directory MySQL tables. It uses a file Gzipped or text dump file produced by the backup operation.';
$language['systemRestore_desc2'] = 'Use the form below to select and upload your backup file.';
$language['systemRestore_desc3'] = 'Important: This operation take some time. Be patient.';
$language['systemRestore_desc4'] = 'This operation does not merge existing data with data from the backup, but replace all the data.';
$language['systemRestore_desc5'] = 'In addition, this process may fail because of restrictions on the execution time in your PHP configuration. In such cases, it is necessary to use a different method. Try using SSH for example...';
$language['systemRestore_desc6'] = 'You are warned!';
$language['systemRestore_file_type'] = 'File type';
$language['systemRestore_file_gzip'] = 'Gzip';
$language['systemRestore_file_text'] = 'Text';
$language['systemRestore_backup_file'] = 'Backup file';
$language['systemRestore_button_restore'] = 'Restore';

// save.tpl
$language['systemSave_html_title'] = 'Save Arfooo directory database';
$language['systemSave_meta_description'] = 'Save Arfooo directory database';
$language['systemSave_arbo'] = 'Save Arfooo directory database';
$language['systemSave_h1'] = 'Save Arfooo directory database';
$language['systemSave_desc1'] = 'This operation will save Arfooo Directory MySQL database.';
$language['systemSave_desc2'] = 'It will generate a text, or gzip file stored in the save/ dir, which can be used to restore your tables and their contents.';
$language['systemSave_action'] = 'Action';
$language['systemSave_action_both'] = 'Store and download';
$language['systemSave_action_dl'] = 'Download';
$language['systemSave_action_store'] = 'Store';

// thumb.tpl
$language['systemThumb_html_title'] = 'Update thumbs';
$language['systemThumb_meta_description'] = 'Update thumbs';
$language['systemThumb_arbo'] = 'Update thumbs';
$language['systemThumb_h1'] = 'Update thumbs';
$language['systemThumb_desc1'] = 'This operation will allow you to update all thumbs websites present in your directory';


//// --> template/templateName/tag/
// banTag.tpl
$language['tagBan_html_title'] = 'Ban Tags';
$language['tagBan_meta_description'] = 'Ban Tags';
$language['tagBan_arbo'] = 'Ban Tags';
$language['tagBan_h1'] = 'Ban Tags';
$language['tagBan_desc1'] = 'To banish one or multiple tags, enter 1 tag by line.';
$language['tagBan_desc2'] = 'You can use the character "*" as a wildcard.';
$language['tagBan_tags'] = 'Tags';
$language['tagBan_button_ban_tags'] = 'Ban';
$language['tagBan_button_unban_tags'] = 'Unban';

// index.tpl
$language['tagIndex_html_title'] = 'Manage Tags';
$language['tagIndex_meta_description'] = 'Manage Tags';
$language['tagIndex_arbo'] = 'Manage Tags';
$language['tagIndex_h1'] = 'Manage Tags';
$language['tagIndex_th_tags'] = 'Tags';
$language['tagIndex_th_search_times'] = 'Search times';
$language['tagIndex_th_banned'] = 'Banned';

// show.tpl
$language['tagShow_html_title'] = 'Advertisement in tag';
$language['tagShow_meta_description'] = 'Advertisement in tag';
$language['tagShow_arbo'] = 'Advertisement in tag';
$language['tagShow_h1'] = 'Advertisement in tag';
$language['tagShow_predefine_ad'] = 'Predefine advertisement';


//// --> template/templateName/template/
// index.tpl
$language['templateIndex_html_title'] = 'Manage templates';
$language['templateIndex_meta_description'] = 'Manage templates';
$language['templateIndex_arbo'] = 'Manage templates';
$language['templateIndex_h1'] = 'Manage templates';
$language['templateIndex_desc1'] = 'Select the template of your choice.';
$language['templateIndex_desc2'] = 'To add a template, add a dir containing template files in the dir templates/';
$language['templateIndex_th_template_name'] = 'Templates name';
$language['templateIndex_preview'] = 'Preview';
$language['templateIndex_enabled'] = 'Enabled';
$language['templateIndex_disabled'] = 'Disabled';

// preview.tpl


//// --> template/templateName/user/
// administrator.tpl
$language['userAdministrator_html_title'] = 'Manager administrators';
$language['userAdministrator_meta_description'] = 'Manager administrators';
$language['userAdministrator_arbo'] = 'Manager administrators';
$language['userAdministrator_h1'] = 'Manager administrators';
$language['userAdministrator_login'] = 'Login';
$language['userAdministrator_h2'] = 'Add administrator';
$language['userAdministrator_pass'] = 'Password';

// banEmail.tpl
$language['userBanEmail_html_title'] = 'Ban Emails';
$language['userBanEmail_meta_description'] = 'Ban Emails';
$language['userBanEmail_arbo'] = 'Ban Emails';
$language['userBanEmail_h1'] = 'Ban Emails';
$language['userBanEmail_desc1'] = 'To banish one or multiple emails, enter 1 email by line.';
$language['userBanEmail_desc2'] = 'You can use the character "*" as a wildcard.';
$language['userBanEmail_emails'] = 'Emails';
$language['userBanEmail_unban_emails'] = 'Unban Emails';

// banIp.tpl
$language['userBanIp_html_title'] = 'Ban IPs';
$language['userBanIp_meta_description'] = 'Ban IPs';
$language['userBanIp_arbo'] = 'Ban IPs';
$language['userBanIp_h1'] = 'Ban IPs';
$language['userBanIp_desc1'] = 'To banish one or multiple IPs, enter 1 IP by line.';
$language['userBanIp_desc2'] = 'You can use the character "*" as a wildcard.';
$language['userBanIp_ip'] = 'IPs';
$language['userBanIp_unban_ip'] = 'Unban IPs';

// editAdministrator.tpl
$language['userEditAdmin_html_title'] = 'Edit administrator';
$language['userEditAdmin_meta_description'] = 'Edit administrator';
$language['userEditAdmin_arbo'] = 'Edit administrator';
$language['userEditAdmin_h1'] = 'Edit administrator';

// editModerator.tpl
$language['userEditModerator_html_title'] = 'Edit moderator';
$language['userEditModerator_meta_description'] = 'Edit moderator';
$language['userEditModerator_arbo'] = 'Edit moderator';
$language['userEditModerator_h1'] = 'Edit moderator';
$language['userEditModerator_email'] = 'Email';

// editWebmaster.tpl
$language['userEditWebmaster_html_title'] = 'Edit webmaster';
$language['userEditWebmaster_meta_description'] = 'Edit webmaster';
$language['userEditWebmaster_arbo'] = 'Edit webmaster';
$language['userEditWebmaster_h1'] = 'Edit webmaster';
$language['userEditWebmaster_th_url'] = 'URL';
$language['userEditWebmaster_th_status'] = 'Status';
$language['userEditWebmaster_th_backlink'] = 'Backlink';
$language['userEditWebmaster_approved'] = 'Approved';
$language['userEditWebmaster_pending'] = 'Pending';
$language['userEditWebmaster_banned'] = 'Banned';
$language['userEditWebmaster_email'] = 'Email';

// index.tpl
$language['userIndex_html_title'] = 'Administrator - Change your password';
$language['userIndex_meta_description'] = 'Administrator - Change your password';
$language['userIndex_arbo'] = 'Administrator - Change your password';
$language['userIndex_h1'] = 'Administrator - Change your password';
$language['userIndex_new_pass'] = 'New password';
$language['userIndex_repeat_new_pass'] = 'Repeat new password';

// moderator.tpl
$language['userModerator_html_title'] = 'Manage moderators';
$language['userModerator_meta_description'] = 'Manage moderators';
$language['userModerator_arbo'] = 'Manage moderators';
$language['userModerator_h1'] = 'Manage moderators';
$language['userModerator_th_login'] = 'Email';
$language['userModerator_th_websites'] = 'Websites : Approved | Rejected | Banned';
$language['userModerator_h2'] = 'Add moderator';
$language['userModerator_email'] = 'Email';
$language['userModerator_password'] = 'Password';

// newsletter.tpl
$language['userNewsletter_html_title'] = 'Mass mailer - Newsletter';
$language['userNewsletter_meta_description'] = 'Mass mailer - Newsletter';
$language['userNewsletter_arbo'] = 'Mass mailer - Newsletter';
$language['userNewsletter_h1'] = 'Mass mailer - Newsletter';
$language['userNewsletter_desc1'] = 'You can send an email to all webmasters.';
$language['userNewsletter_desc2'] = 'Emails are sent in background task, so you can do something else.';
$language['userNewsletter_desc3'] = 'You can also stop and resume at any moment, sending the newsletter.';
$language['userNewsletter_desc4'] = 'A notification will be sent by email once the sending is completed.';
$language['userNewsletter_subject'] = 'Subject';
$language['userNewsletter_message'] = 'Message';
$language['userNewsletter_email_number'] = 'Number of emails sent per minute';
$language['userNewsletter_newsletter_to'] = 'Send newsletter to';
$language['userNewsletter_subscribers'] = 'Subscribers';
$language['userNewsletter_all'] = 'All people - All Emails';
$language['userNewsletter_test'] = 'Test - Only admin';
$language['userNewsletter_csv_file_only'] = 'CSV file only';
$language['userNewsletter_newsletter_from'] = 'Sent from';
$language['userNewsletter_email_sent'] = 'Emails sent';

// newsletterEmail.tpl
$language['userNewsletterEmail_html_title'] = 'Emails : Import / Export';
$language['userNewsletterEmail_meta_description'] = 'Emails : Import / Export';
$language['userNewsletterEmail_arbo'] = 'Emails : Import / Export';
$language['userNewsletterEmail_h1'] = 'Emails : Import / Export';
$language['userNewsletterEmail_desc1'] = 'You can import / export emails with csv files.';
$language['userNewsletterEmail_h2_export'] = 'Export';
$language['userNewsletterEmail_dl_export'] = 'Donwload CSV file';
$language['userNewsletterEmail_h2_import'] = 'Import';
$language['userNewsletterEmail_csv_file'] = 'CSV file';
$language['userNewsletterEmail_import_email'] = 'Import emails';

// webmaster.tpl
$language['userWebmaster_html_title'] = 'Manage webmasters';
$language['userWebmaster_meta_description'] = 'Manage webmasters';
$language['userWebmaster_arbo'] = 'Manage webmasters';
$language['userWebmaster_h1'] = 'Webmasters';
$language['userWebmaster_desc1'] = 'Clicking "Edit", you can check the status of each website\'s webmaster, if the site you make a backlink...';
$language['userWebmaster_desc2'] = 'You can also edit and delete websites.';
$language['userWebmaster_desc3'] = 'You can search webmasters. just write their email or a part of their email';
$language['userWebmaster_th_email'] = 'Emails';
$language['userWebmaster_th_web'] = 'Websites number';


/* Admin Texts END */

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