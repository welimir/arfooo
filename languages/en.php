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


/* Front Sites Texts */


// all
$language['show_arbo_directory'] = 'Directory';
$language['page'] = 'page';


//// --> template/templateName/captcha/
// show.tpl
$language['captchaShow_generate_new_image'] = 'Generate new security code';


//// --> template/templateName/category/
// list.tpl

// showAll.tpl
$language['categoryShowAll_html_title'] = 'Categories';
$language['categoryShowAll_meta_description'] = 'All Categories of directory';
$language['categoryShowAll_categories'] = 'Categories';
$language['categoryShowAll_h1'] = 'Directory categories';


//// --> template/templateName/comment/
// popup.tpl
$language['commentPopup_post_comment'] = 'Post a comment';
$language['commentPopup_name'] = 'Name';
$language['commentPopup_rating'] = 'Rating';
$language['commentPopup_message'] = 'Message';
$language['commentPopup_security_code'] = 'Security code';
$language['commentPopup_button_send'] = 'Send';
$language['commentPopup_button_cancel'] = 'Cancel';
$language['commentPopup_already_commented'] = 'You have already commented this site today.';


//// --> template/templateName/contact/
// contactPopup.tpl
$language['contactPopup_send_message'] = 'Send a message';
$language['contactPopup_mandatory_fields'] = '= this fields is mandatory';
$language['contactPopup_your_email'] = 'Your Email';
$language['contactPopup_object'] = 'Object';
$language['contactPopup_message'] = 'Message';
$language['contactPopup_security_code'] = 'Security code';
$language['contactPopup_button_send'] = 'Send';
$language['contactPopup_button_cancel'] = 'Cancel';

// index.tpl
$language['contactIndex_html_title'] = 'Contact';
$language['contactIndex_meta_description'] = 'Contact';
$language['contactIndex_contact'] = 'Contact';
$language['contactIndex_form'] = 'Contact form';
$language['contactIndex_email'] = 'Email';
$language['contactIndex_subject'] = 'Subject';
$language['contactIndex_message'] = 'Message';
$language['contactIndex_security_code'] = 'Security code';
$language['contactIndex_button_send'] = 'Send';

// problemPopup.tpl
$language['problemPopup_title'] = 'We warn about this site';
$language['problemPopup_mandatory_fields'] = '= this fields is mandatory';
$language['problemPopup_problem_type'] = 'Problem type';
$language['problemPopup_select_choice'] = 'Select choice';
$language['problemPopup_spam'] = 'Spam';
$language['problemPopup_bad_category'] = 'Bad category';
$language['problemPopup_expired'] = 'Expired';
$language['problemPopup_others'] = 'Others';
$language['problemPopup_message'] = 'Message';
$language['problemPopup_description_why'] = 'Why do you want to alert us (this will not be published)?';
$language['problemPopup_security_code'] = 'Security code';
$language['problemPopup_button_send'] = 'Send';
$language['problemPopup_button_cancel'] = 'Cancel';


//// --> template/templateName/extraField/
// itemForm.tpl
$language['extraFieldItemForm_select_option'] = 'Select an option';
$language['extraFieldItemForm_url'] = 'URL';
$language['extraFieldItemForm_anchor'] = 'Anchor text';
$language['extraFieldItemForm_file'] = 'File';
$language['extraFieldItemForm_file_title'] = 'File title';
$language['extraFieldItemForm_see_file'] = 'See';
$language['extraFieldItemForm_delete_file'] = 'Delete';

// search.tpl
$language['extraFieldSearch_category'] = 'Categories';
$language['extraFieldSearch_all_categories'] = 'All categories';
$language['extraFieldSearch_select_option'] = 'Select an option';
$language['extraFieldSearch_from'] = 'From';
$language['extraFieldSearch_to'] = 'To';


//// --> template/templateName/front/
// 404.tpl
$language['front404_html_title'] = 'Error, Page not found...';
$language['front404_meta_description'] = 'The page you want to achieve is not (or more). Excuse us for the inconvenience...';
$language['front404_h1'] = 'Error, Page not found...';
$language['front404_description'] = 'The page you want to achieve is not (or more). Excuse us for the inconvenience...';

// error.tpl


//// --> template/templateName/includes/
// header.tpl
$language['includesHeader_language'] = 'en';

// footer.tpl
$language['includesFooter_powered'] = 'Powered by';
$language['includesFooter_arfooo_url'] = 'http://www.arfooo.net/';
$language['includesFooter_arfooo_name'] = 'Arfooo directory';
$language['includesFooter_arfooo_title'] = 'Directory for seo';
$language['includesFooter_date'] = '2007 - ' . date('Y');   
$language['includesFooter_newsletter'] = 'Newsletter';
$language['includesFooter_contact'] = 'Contact';

// pageNavigation.tpl
$language['includesPageNavigation_page'] = 'page';
$language['includesPageNavigation_from'] = 'from';


//// --> template/templateName/info/
// useCondition.tpl
$language['infoUseCondition_html_title'] = 'Terms of use';
$language['infoUseCondition_meta_description'] = 'Terms of use';
$language['infoUseCondition_arbo'] = 'Terms of use';
$language['infoUseCondition_h1'] = 'Terms of use';


//// --> template/templateName/javascript/
// config.tpl
$language['javascriptConfig_you_have_already_chosen_this_keyword_Select_another_one'] = 'You have already chosen this keyword. Select another one';
$language['javascriptConfig_loading'] = 'loading...';
$language['javascriptConfig_please_fill_in_the_website_Url_Title_and_Description_fields'] = 'Please fill in the website Url, Title and Description fields';
$language['javascriptConfig_the_Url_must_start_with_http://'] = 'The Url must start with http://';
$language['javascriptConfig_please_enter_valid_email_address'] = 'Please enter a valid e-mail address';
$language['javascriptConfig_when_changing_the_website_webmaster_the_email_will_also_change'] = 'When changing the website webmaster, the e-mail will also change';
$language['javascriptConfig_the_comment_was_saved'] = 'The comment was saved';
$language['javascriptConfig_the_comment_was_deleted'] = 'The comment was deleted';
$language['javascriptConfig_the_IP_was_banned'] = 'The IP was banned';
$language['javascriptConfig_please_select_package'] = 'Please, select a package';
$language['javascriptConfig_please_select_payment_processor'] = 'Please, select a payment processor';
$language['javascriptConfig_please_enter_your_username'] = 'Please enter your username';
$language['javascriptConfig_please_enter_comment'] = 'Please enter a comment';
$language['javascriptConfig_please_enter_the_security_code'] = 'Please, enter the security code';
$language['javascriptConfig_the_tag_was_saved'] = 'The tag was saved';
$language['javascriptConfig_you_cant_select_this_payment_method_for_selected_package'] = 'You can`t select this payment method for selected package';
$language['javascriptConfig_delete'] = 'Delete';
$language['javascriptConfig_edit'] = 'Edit';
$language['javascriptConfig_file'] = 'File';
$language['javascriptConfig_was_uploaded_sucessfully'] = 'was uploaded sucessfully';
$language['javascriptConfig_of'] = 'of';
$language['javascriptConfig_available_photos_uploaded'] = 'available photos uploaded';
$language['javascriptConfig_popup_loading_title'] = 'Loading';
$language['javascriptConfig_popup_loading_content'] = 'Loading...';
$language['javascript_config_email_format'] = 'Your email must be in format - name@domain.com';
$language['javascript_config_email_was_used_earlier'] = 'Email was used earlier';
$language['javascript_config_please_enter_password'] = 'Please enter password';
$language['javascript_config_please_confirm_your_password'] = 'Please confirm your password';
$language['javascript_config_please_enter_captcha_code'] = 'Please enter captcha code';
$language['javascript_config_passwords_are_not_equal'] = 'Passwords are not equal';
$language['javascript_config_please_enter_your_email'] = 'Please enter your email';
$language['javascript_config_validation_message'] = 'Validation message';
$language['javascript_config_your_message_was_saved'] = 'Your message was saved';
$language['javascript_config_your_message_was_sent'] = 'Your message was sent';
$language['javascript_config_new_file_has_been_uploaded_sucessfully'] = 'Image uploaded successfully';
$language['javascript_config_uploading'] = 'Uploading...';
$language['You did not guess the security code. Try again with a new one.'] = 'You did not guess the security code. Try again with a new one.';
$language['You did not guess the security code.'] = 'You did not guess the security code. Try again with a new one.';
$language['Your comment was saved'] = 'Your comment was saved';
$language['Your comment was saved. He is awaiting moderation and will be published if it is useful for surfers'] = 'Your comment was saved. He is awaiting moderation and will be published if it is useful for surfers';
$language['The problem has been reported to the administrator. Thank you for your help.'] = 'The problem has been reported to the administrator. Thank you for your help.';
$language['Validation Message'] = 'Validation Message test test';
$language['This site\' HTTP response code is not 200. The site is not accepted.'] = 'This site\' HTTP response code is not 200. The site is not accepted.';
$language['We have detected duplicate content, change your description.'] = 'We have detected duplicate content, change your description.';
$language['Please enter a valid code'] = 'Please enter a valid code';
$language['You have entered an invalid code'] = 'You have entered an invalid code';
$language['Allopass was validated sucessfully.'] = 'Allopass code was validated successfully. You can submit your site now.';
$language['You haven\'t credit for this action'] = 'You haven\'t credit for this action. Thank you back to the previous step, to submit your site with the premium formula.';


//// --> template/templateName/keyword/
// show.tpl
$language['keywordShow_html_title'] = 'Directory of words starting with';
$language['keywordShow_meta_description'] = 'Directory of words starting with';
$language['keywordShow_arbo'] = 'Directory of words starting with';
$language['keywordShow_h1'] = 'Directory of words starting with';


//// --> template/templateName/main/
// index.tpl
$language['mainIndex_h2'] = 'Websites listed in the directory';


//// --> template/templateName/menu/
// menuheader/menuheader.tpl
$language['menuMenuheader_directory'] = 'Directory';
$language['menuMenuheader_news'] = 'News';
$language['menuMenuheader_top_hits'] = 'Top hits';
$language['menuMenuheader_top_rated'] = 'Top rated';
$language['menuMenuheader_top_rank'] = 'Top rank';
$language['menuMenuheader_top_referrers'] = 'Top referrers';
$language['menuMenuheader_categories'] = 'Categories';
$language['menuMenuheader_submit_website'] = 'Submit website';

// menuheader/searchEngine.tpl
$language['menuSearchEngine_what'] = 'What';
$language['menuSearchEngine_where'] = 'Where';
$language['menuSearchEngine_type_keyword'] = 'Type a keyword';
$language['menuSearchEngine_adress'] = 'Address, City, State or Zip Code';
$language['menuSearchEngine_search_button'] = 'Search';
$language['menuSearchEngine_advanced_search'] = 'Advanced search';

// menuleft/categories.tpl
$language['menuleftCategories_categories'] = 'Categories';

// menuleft/keywords.tpl
$language['menuleftKeywords_keywords'] = 'Keywords';

// menuleft/menuleft.tpl

// menuleft/statistics.tpl
$language['menuleftStatistics_stats'] = 'Statistics';
$language['menuleftStatistics_approved_links'] = 'Approved links';
$language['menuleftStatistics_pending_links'] = 'Pending links';
$language['menuleftStatistics_rejected_links'] = 'Rejected links';
$language['menuleftStatistics_banned_links'] = 'Banned links';
$language['menuleftStatistics_categories'] = 'Categories';
$language['menuleftStatistics_keywords'] = 'Keywords';
$language['menuleftStatistics_webmasters'] = 'Webmasters';

// menuright/menuright.tpl
$language['menuright_members_area'] = 'Members area';
$language['menuright_management'] = 'Management';
$language['menuright_change_password'] = 'Change password';
$language['menuright_logout'] = 'Logout';

// menuright/tagCloud.tpl
$language['menurightTagCloud_tag_cloud'] = 'Tag Cloud';


//// --> template/templateName/newsletter/
// confirmNewsletterEmailAdd.tpl
$language['confirmNewsletterEmailAdd_html_title'] = 'Email verification';
$language['confirmNewsletterEmailAdd_meta_description'] = 'Thank you for confirming your registration to the newsletter';
$language['confirmNewsletterEmailAdd_h1'] = 'Email verification';
$language['confirmNewsletterEmailAdd_description'] = 'Thank you for confirming your registration to the newsletter';

// confirmNewsletterEmailDel.tpl
$language['confirmNewsletterEmailDel_html_title'] = 'Email verification';
$language['confirmNewsletterEmailDel_meta_description'] = 'Thank you for confirming your registration to the newsletter';
$language['confirmNewsletterEmailDel_h1'] = 'Email verification';
$language['confirmNewsletterEmailDel_description'] = 'Thank you for confirming your registration to the newsletter';

// index.tpl
$language['newsletterIndex_html_title'] = 'Newsletter';
$language['newsletterIndex_meta_description'] = 'Newsletter';
$language['newsletterIndex_arbo'] = 'Newsletter';
$language['newsletterIndex_h1'] = 'Newsletter';
$language['newsletterIndex_email'] = 'Your email';
$language['newsletterIndex_button_subscribe'] = 'Subscribe';
$language['newsletterIndex_button_unsubscribe'] = 'Unsubscribe';
$language['Your email was added. Check your inbox to confirm it'] = 'Your email was added. Check your inbox to confirm it';
$language['This email was added earlier'] = 'This email was added earlier';
$language['Check your inbox and click on remove link'] = 'To permanently delete your email newsletter, thank you to confirm your unsubscribe by clicking on the link in the email send.';
$language['This email do not exists in our db'] = 'This email do not exists in our db';


//// --> template/templateName/payment/
// makePayment.tpl
$language['makePayment_html_title'] = 'Payment';
$language['makePayment_meta_description'] = 'Payment';
$language['makePayment_arbo'] = 'Payment';
$language['makePayment_your_choice'] = 'Your choice';
$language['makePayment_price'] = 'Price';
$language['makePayment_choice_description'] = 'Choice description';
$language['makePayment_next_step'] = 'Next step';
$language['makePayment_allopass_code'] = 'Allopass code';

// processPayment.tpl
$language['processPayment_html_title'] = 'Processing Payment...';
$language['processPayment_h1'] = 'Processing Payment...';

// selectPaymentOptions.tpl
$language['selectPaymentOptions_html_title'] = 'Choose a package and your payment method';
$language['selectPaymentOptions_meta_description'] = 'Choose a package and your payment method';
$language['selectPaymentOptions_arbo'] = 'payment';
$language['selectPaymentOptions_h1'] = 'Choose a package and your payment method';
$language['selectPaymentOptions_package'] = 'Package';
$language['selectPaymentOptions_select_package'] = 'Select a package';
$language['selectPaymentOptions_package_description'] = 'Package description';
$language['selectPaymentOptions_description'] = 'A detailed description of the package appears when you select a package';
$language['selectPaymentOptions_payment_method'] = 'Payment method';
$language['selectPaymentOptions_select_payment_method'] = 'Select a payment method';
$language['selectPaymentOptions_next_step'] = 'Next step';


//// --> template/templateName/photo/
// edit.tpl
$language['photoEdit_title'] = 'Edit photo details';
$language['photoEdit_name_alt'] = 'Name / Alt';
$language['photoEdit_save_button'] = 'Save';
$language['photoEdit_cancel_button'] = 'Cancel';


//// --> template/templateName/site/
// category.tpl
$language['siteCategory_rss'] = 'RSS';

// details.tpl
$language['siteDetails_rss'] = 'RSS';
$language['siteDetails_see_sentence'] = 'Visit and enjoy the site';
$language['siteDetails_categorie'] = ', belonging to category';
$language['siteDetails_keyword_sentence'] = 'The keywords associated with the site are :';
$language['siteDetails_language'] = 'Language';
$language['siteDetails_url'] = 'Url';
$language['siteDetails_backlink'] = 'Backlink';
$language['siteDetails_hits'] = 'Hits';
$language['siteDetails_rate'] = 'Rate';
$language['siteDetails__rate'] = 'rate';
$language['siteDetails_for'] = 'for';
$language['siteDetails_comments'] = 'Comments';
$language['siteDetails_validation_date'] = 'Validation date';
$language['siteDetails_interaction'] = 'Interaction';
$language['siteDetails_report_problem'] = 'Report a problem';
$language['siteDetails_write_comment'] = 'Write a comment';
$language['siteDetails_rate_website'] = 'Rate this website';
$language['siteDetails_contact_webmaster'] = 'Contact the webmaster';
$language['siteDetails_google_infos'] = 'Google information';
$language['siteDetails_pagerank'] = 'PageRank';
$language['siteDetails_loading'] = 'Loading...';
$language['siteDetails_number_backlinks'] = 'Number of backlinks';
$language['siteDetails_number_indexed_pages'] = 'Number of indexed pages';
$language['siteDetails_rss_feed'] = 'RSS feed';
$language['siteDetails_company_information'] = 'Company information';
$language['siteDetails_adress'] = 'Adress';
$language['siteDetails_postal_code'] = 'Postal code';
$language['siteDetails_city'] = 'City';
$language['siteDetails_country'] = 'Country';
$language['siteDetails_phone_number'] = 'Phone number';
$language['siteDetails_fax_number'] = 'Fax number';
$language['siteDetails_wrote_on'] = 'wrote on';
$language['siteDetails_comment_rate'] = 'Rate:';
$language['siteDetails_5'] = '/5';
$language['siteDetails_na'] = 'n/a';
$language['siteDetails_related_sites'] = 'Related sites';

// item.tpl
$language['siteItem_details'] = 'Details';
$language['siteItem_new_website'] = 'New website';
$language['siteItem_keywords'] = 'Keywords';
$language['siteItem_number_visitors_sent'] = 'Number of visitors sent to the website';
$language['siteItem_pagerank'] = 'Pagerank';
$language['siteItem_hits'] = 'Hits';
$language['siteItem_rate'] = 'Rate';
$language['siteItem_5'] = '/5';
$language['siteItem__rate'] = 'rate';
$language['siteItem_for'] = 'for';

// keyword.tpl

// news.tpl
$language['siteNews_html_title'] = 'New websites listed';
$language['siteNews_meta_description'] = 'New websites listed';
$language['siteNews_arbo'] = 'New websites listed';
$language['siteNews_h1'] = 'New websites listed';
$language['siteNews_rss'] = 'RSS New websites listed';

// randomList.tpl

// search.tpl
$language['siteSearch_html_title'] = 'Search results';
$language['siteSearch_arbo'] = 'Search results';
$language['siteSearch_h1'] = 'Search results';

// tag.tpl

// topHits.tpl
$language['siteTopHits_html_title'] = 'Most visited website';
$language['siteTopHits_meta_description'] = 'Most visited website';
$language['siteTopHits_arbo'] = 'Most visited website';
$language['siteTopHits_h1'] = 'Most visited website';

// topNotes.tpl
$language['siteTopNotes_html_title'] = 'Most rated website';
$language['siteTopNotes_meta_description'] = 'Most rated website';
$language['siteTopNotes_arbo'] = 'Most rated website';
$language['siteTopNotes_h1'] = 'Most rated website';

// topRank.tpl
$language['siteTopRank_html_title'] = 'Website sorted by PageRank';
$language['siteTopRank_meta_description'] = 'Website sorted by PageRank';
$language['siteTopRank_arbo'] = 'Website sorted by PageRank';
$language['siteTopRank_h1'] = 'Website sorted by PageRank';
$language['siteTopRank_whit_pagerank'] = 'Sites with PageRank';

// topReferrers.tpl
$language['siteTopReferrers_html_title'] = 'Top referrers';
$language['siteTopReferrers_meta_description'] = 'Top referrers';
$language['siteTopReferrers_arbo'] = 'Top referrers';
$language['siteTopReferrers_h1'] = 'Top referrers';


//// --> template/templateName/webmaster/
// changePassword.tpl
$language['webmasterChangePassword_html_title'] = 'Change your password';
$language['webmasterChangePassword_meta_description'] = 'Change your password';
$language['webmasterChangePassword_arbo'] = 'Change your password';
$language['webmasterChangePassword_h1'] = 'Change your password';
$language['webmasterChangePassword_new_pass'] = 'New password';
$language['webmasterChangePassword_repeat_pass'] = 'Repeat new password';
$language['webmasterChangePassword_button'] = 'Save';

// chooseSiteType.tpl
$language['webmasterChooseSiteType_html_title'] = 'Choose your method for submitting a website';
$language['webmasterChooseSiteType_meta_description'] = 'Choose your method for submitting a website';
$language['webmasterChooseSiteType_arbo'] = 'Choose your method for submitting a website';
$language['webmasterChooseSiteType_h1'] = 'Choose your method for submitting a website';
$language['webmasterChooseSiteType_free'] = 'Free';
$language['webmasterChooseSiteType_free_submission'] = 'Free submission';
$language['webmasterChooseSiteType_standard_submission'] = 'Standard submission without privileges';
$language['webmasterChooseSiteType_privileged'] = 'Privileged';
$language['webmasterChooseSiteType_privilege_submission'] = 'Privilege submission';
$language['webmasterChooseSiteType_submission_allowing_you'] = 'Submission allowing you to get some privileges';

// confirmSiteEmail.tpl
$language['webmasterConfirmSiteEmail_html_title'] = 'Checking your email';
$language['webmasterConfirmSiteEmail_meta_description'] = 'Checking your email';
$language['webmasterConfirmSiteEmail_h1'] = 'Checking your email';
$language['webmasterConfirmSiteEmail_desc'] = 'Thank you for checking your email';

// confirmUserEmail.tpl
$language['webmasterConfirmUserEmail_html_title'] = 'Checking your email';
$language['webmasterConfirmUserEmail_meta_description'] = 'Checking your email';
$language['webmasterConfirmUserEmail_h1'] = 'Checking your email';
$language['webmasterConfirmUserEmail_desc'] = 'Thank you for checking your email';
$language['webmasterConfirmUserEmail_desc2'] = 'You can now log into your account';

// editSite.tpl

// loading.tpl
$language['webmasterLoading_html_title'] = 'Payment under audit';
$language['webmasterLoading_meta_description'] = 'Payment under audit';
$language['webmasterLoading_h1'] = 'Payment under audit';
$language['webmasterLoading_desc'] = 'The payment is being verified';
$language['webmasterLoading_desc2'] = 'Thank you kindly wait';
$language['webmasterLoading_desc3'] = 'You will be redirected to the submission form after verification';

// logIn.tpl
$language['webmasterLogIn_html_title'] = 'Login / Registration';
$language['webmasterLogIn_meta_description'] = 'Login / Registration';
$language['webmasterLogIn_arbo'] = 'Login / Registration';
$language['webmasterLogIn_h1'] = 'Already a member ?';
$language['webmasterLogIn_desc'] = 'Enter your IDs below';
$language['webmasterLogIn_wrong'] = 'You have entered wrong login / password';
$language['webmasterLogIn_email'] = 'Email';
$language['webmasterLogIn_pass'] = 'Password';
$language['webmasterLogIn_remember'] = 'Remember me';
$language['webmasterLogIn_forgot_pass'] = 'Forgot password?';
$language['webmasterLogIn_button_login'] = 'Login';
$language['webmasterLogIn_terms'] = 'Terms of referencing';
$language['webmasterLogIn_new_create'] = 'New ? Create an account';
$language['webmasterLogIn_desc2'] = 'By registering, you can post and manage your website';
$language['webmasterLogIn_repeat_pass'] = 'Repeat password';
$language['webmasterLogIn_subscribe_news'] = 'Subscribe newsletter';
$language['webmasterLogIn_security_code'] = 'Security code';
$language['webmasterLogIn_button_registration'] = 'Registration';

// lostPassword.tpl
$language['webmasterLostPass_lost_pass'] = 'Lost password';
$language['webmasterLostPass_desc'] = 'Enter your email address below if you have forgotten your password.';
$language['webmasterLostPass_desc2'] = 'You will receive an email containing a link to change your password.';
$language['webmasterLostPass_mandatory'] = '= this fields is mandatory';
$language['webmasterLostPass_your_email'] = 'Your email';
$language['webmasterLostPass_security_code'] = 'Security code';
$language['webmasterLostPass_button_send'] = 'Send new password';
$language['webmasterLostPass_button_cancel'] = 'Cancel';
$language['We haven\'t this email in database'] = 'We haven\'t this email in database';

// manage.tpl
$language['webmasterManage_html_title'] = 'Webmaster management';
$language['webmasterManage_meta_description'] = 'Webmaster management';
$language['webmasterManage_arbo'] = 'Webmaster management';
$language['webmasterManage_h1'] = 'Members area';
$language['webmasterManage_add_website'] = 'Add website';
$language['webmasterManage_username'] = 'Username';
$language['webmasterManage_logout'] = 'Logout';
$language['webmasterManage_website_url'] = 'Website / URL';
$language['webmasterManage_status'] = 'Status';
$language['webmasterManage_view'] = 'View';
$language['webmasterManage_details'] = 'Details';
$language['webmasterManage_management'] = 'Management';
$language['webmasterManage_validated'] = 'Validated';
$language['webmasterManage_pending'] = 'Pending';
$language['webmasterManage_go'] = 'Go';
$language['webmasterManage_free'] = 'Free';
$language['webmasterManage_privileged'] = 'Privileged';
$language['webmasterManage_edit'] = 'Edit';
$language['webmasterManage_delete_website?'] = 'Do you really want to delete your website?';
$language['webmasterManage_delete'] = 'Delete';

// submitDisabled.tpl
$language['webmasterSubmitDisabled_html_title'] = 'Submissions are temporarily closed. Try again later.';
$language['webmasterSubmitDisabled_meta_description'] = 'Submissions are temporarily closed. Try again later.';
$language['webmasterSubmitDisabled_arbo'] = 'Submissions are temporarily closed';
$language['webmasterSubmitDisabled_h1'] = 'Submissions are temporarily closed.';
$language['webmasterSubmitDisabled_desc'] = 'Submissions are temporarily closed. Try again later.';

// submitWebsite.tpl
$language['webmasterSubmitWebsite_html_title'] = 'Webmaster - add/edit your website';
$language['webmasterSubmitWebsite_meta_description'] = 'Webmaster - add/edit your website';
$language['webmasterSubmitWebsite_arbo'] = 'Management';
$language['webmasterSubmitWebsite_arbo2'] = 'Webmaster - add/edit your website';
$language['webmasterSubmitWebsite_step'] = 'Step';
$language['webmasterSubmitWebsite_select_categorie'] = 'Select an categorie';
$language['webmasterSubmitWebsite_suggest_cat'] = 'Suggest Category';
$language['webmasterSubmitWebsite_select_other_category'] = 'Please select other category, you can\'t submit website in this one';
$language['webmasterSubmitWebsite_general_information'] = 'General information';
$language['webmasterSubmitWebsite_mandatory_fields'] = '= This field is mandatory';
$language['webmasterSubmitWebsite_language_site'] = 'Website language';
$language['webmasterSubmitWebsite_select_language_site'] = 'Select website language';
$language['webmasterSubmitWebsite_webmaster_email'] = 'Webmaster email';
$language['webmasterSubmitWebsite_webmaster_email_tooltip'] = 'Enter a valid email';
$language['webmasterSubmitWebsite_website_title'] = 'Website title';
$language['webmasterSubmitWebsite_website_title_tooltip'] = 'Title used as anchor text of outbound link';
$language['webmasterSubmitWebsite_website_url'] = 'Website address (Url)';
$language['webmasterSubmitWebsite_button_metas'] = 'Metas';
$language['webmasterSubmitWebsite_website_url_tooltip'] = 'Example: http://www.example.com/';
$language['webmasterSubmitWebsite_rss_feed_title'] = 'RSS feed title';
$language['webmasterSubmitWebsite_rss_feed_title_tooltip'] = 'Title used as anchor text of outbound link';
$language['webmasterSubmitWebsite_rss_feed_url'] = 'RSS feed address (Url)';
$language['webmasterSubmitWebsite_rss_feed_url_tooltip'] = 'Example: http://www.example.com/rss.xml';
$language['webmasterSubmitWebsite_website_desc'] = 'Website description';
$language['webmasterSubmitWebsite_website_desc_tooltip'] = 'Write a description that describes your site, your activity...';
$language['webmasterSubmitWebsite_characters_left'] = 'Characters left';
$language['webmasterSubmitWebsite_add_photo'] = 'Add photo';
$language['webmasterSubmitWebsite_add_photo_button'] = 'Add photo';
$language['webmasterSubmitWebsite_search_partnership'] = 'Search partnership';
$language['webmasterSubmitWebsite_search_partnership_tooltip'] = 'If you are looking for partners, check';
$language['webmasterSubmitWebsite_company_info'] = 'Information about your company / Shows details on Google Maps';
$language['webmasterSubmitWebsite_adress'] = 'Adress';
$language['webmasterSubmitWebsite_postal_code'] = 'Postal code';
$language['webmasterSubmitWebsite_city'] = 'City';
$language['webmasterSubmitWebsite_country'] = 'Country';
$language['webmasterSubmitWebsite_phone'] = 'Phone number';
$language['webmasterSubmitWebsite_fax'] = 'Fax number';
$language['webmasterSubmitWebsite_select_keywords'] = 'Select your keywords / Suggest keywords';
$language['webmasterSubmitWebsite_keyword'] = 'Keyword';
$language['webmasterSubmitWebsite_select_your_keyword'] = 'Select your keyword';
$language['webmasterSubmitWebsite_suggest_keywords'] = 'Suggest keywords';
$language['webmasterSubmitWebsite_backlink'] = 'Backlink';
$language['webmasterSubmitWebsite_backlink_desc'] = 'A backlink to our directory is not mandatory but recommended';
$language['webmasterSubmitWebsite_desc2'] = 'By placing a backlink, your website will have many advantages like improved position in its category and might get listed in our top referrers page';
$language['webmasterSubmitWebsite_desc3'] = 'If you place a backlink in your website, it must already be present before you submit your link';
$language['webmasterSubmitWebsite_desc4'] = 'Please enter the backlink URL in the field below';
$language['webmasterSubmitWebsite_backlink_url'] = 'Backlink address (URL)';
$language['webmasterSubmitWebsite_backlink_html1'] = 'Backlink HTML code 1';
$language['webmasterSubmitWebsite_backlink_html2'] = 'Backlink HTML code 1';
$language['webmasterSubmitWebsite_backlink_html_tooltip'] = 'Thank you to insert the code on your website';
$language['webmasterSubmitWebsite_submit_website'] = 'Submit your website';
$language['webmasterSubmitWebsite_subscribe_newsletter'] = 'Subscribe Newsletter';
$language['webmasterSubmitWebsite_security_code'] = 'Security code';
$language['webmasterSubmitWebsite_terms_use_desc'] = 'By clicking on "Submit my website", I accept the terms of use';
$language['webmasterSubmitWebsite_read_terms'] = 'Read our Terms';
$language['webmasterSubmitWebsite_checking'] = 'Checking website...';
$language['webmasterSubmitWebsite_button_submit'] = 'Submit my website';


$language['This site is not allowed to be offered more times.'] = 'This site is not allowed to be offered more times.';
$language['Description of site must have minimum'] = 'Description of site must have minimum';
$language['characters length.'] = 'characters length.';
$language['The registration was successful! You can login now.'] = 'Thank you for your registration. You can now login.';
$language['The registration was successful! You must confirm your email. Check your inbox.'] = 'Thank you for your registration. An email has been sent to you. You must click the link in the email to confirm your registration. You can then login and submit a site';
$language['The site was successfully submitted.'] = 'The site was successfully submitted.';
$language['This field is required'] = 'This field is required';
$language['The site was successfully submitted. You must confirm your email. Check your inbox.'] = 'The site has been submitted successfully. An email has been sent to you. You must click the link in the email to confirm the site submission.';
 
/* END Front Sites Texts */
	
/*foreach ($language as $key => $val)
{
	$language[$key] = str_replace("'", "`",$val);
} */

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