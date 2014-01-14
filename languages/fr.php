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


/* Front Sites Texts */


// all
$language['show_arbo_directory'] = 'Annuaire';
$language['page'] = 'page';


//// --> template/templateName/captcha/
// show.tpl
$language['captchaShow_generate_new_image'] = 'Générer un nouveau code de sécurité';


//// --> template/templateName/category/
// list.tpl

// showAll.tpl
$language['categoryShowAll_html_title'] = 'Les catégories de l\'annuaire';
$language['categoryShowAll_meta_description'] = 'Retrouvez toutes les catégories de l\'annuaire';
$language['categoryShowAll_categories'] = 'Catégories';
$language['categoryShowAll_h1'] = 'Les catégories de l\'annuaire';


//// --> template/templateName/comment/
// popup.tpl
$language['commentPopup_post_comment'] = 'Poster un commentaire';
$language['commentPopup_name'] = 'Nom';
$language['commentPopup_rating'] = 'Note';
$language['commentPopup_message'] = 'Message';
$language['commentPopup_security_code'] = 'Code de sécurité';
$language['commentPopup_button_send'] = 'Envoyer';
$language['commentPopup_button_cancel'] = 'Annuler';
$language['commentPopup_already_commented'] = 'Vous avez déjà commenté ce site aujourd\'hui.';


//// --> template/templateName/contact/
// contactPopup.tpl
$language['contactPopup_send_message'] = 'Envoyer un message';
$language['contactPopup_mandatory_fields'] = '= champs obligatoires';
$language['contactPopup_your_email'] = 'Votre email';
$language['contactPopup_object'] = 'Sujet';
$language['contactPopup_message'] = 'Message';
$language['contactPopup_security_code'] = 'Code de sécurité';
$language['contactPopup_button_send'] = 'Envoyer';
$language['contactPopup_button_cancel'] = 'Annuler';

// index.tpl
$language['contactIndex_html_title'] = 'Contact';
$language['contactIndex_meta_description'] = 'Contact';
$language['contactIndex_contact'] = 'Contact';
$language['contactIndex_form'] = 'Formulaire de contact';
$language['contactIndex_email'] = 'Email';
$language['contactIndex_subject'] = 'Sujet';
$language['contactIndex_message'] = 'Message';
$language['contactIndex_security_code'] = 'Code de sécurité';
$language['contactIndex_button_send'] = 'Envoyer';

// problemPopup.tpl
$language['problemPopup_title'] = 'Nous alerter à propos de ce site';
$language['problemPopup_mandatory_fields'] = '= champs obligatoires';
$language['problemPopup_problem_type'] = 'Type de problème';
$language['problemPopup_select_choice'] = 'Sélectionner le problème';
$language['problemPopup_spam'] = 'Spam';
$language['problemPopup_bad_category'] = 'Mauvaise catégorie';
$language['problemPopup_expired'] = 'Expirée';
$language['problemPopup_others'] = 'Autre';
$language['problemPopup_message'] = 'Message';
$language['problemPopup_description_why'] = 'Pourquoi souhaitez-vous nous alerter (uniquement visible par nos modérateurs)?';
$language['problemPopup_security_code'] = 'Code de sécurité';
$language['problemPopup_button_send'] = 'Envoyer';
$language['problemPopup_button_cancel'] = 'Annuler';


//// --> template/templateName/extraField/
// itemForm.tpl
$language['extraFieldItemForm_select_option'] = 'Sélectionner une option';
$language['extraFieldItemForm_url'] = 'URL';
$language['extraFieldItemForm_anchor'] = 'Ancre texte';
$language['extraFieldItemForm_file'] = 'Fichier';
$language['extraFieldItemForm_file_title'] = 'Nom du fichier';
$language['extraFieldItemForm_see_file'] = 'Voir';
$language['extraFieldItemForm_delete_file'] = 'Supprimer';

// search.tpl
$language['extraFieldSearch_category'] = 'Catégories';
$language['extraFieldSearch_all_categories'] = 'Toutes les catégories';
$language['extraFieldSearch_select_option'] = 'Sélectionner une option';
$language['extraFieldSearch_from'] = 'A partir de';
$language['extraFieldSearch_to'] = 'à';


//// --> template/templateName/front/
// 404.tpl
$language['front404_html_title'] = 'Erreur, Page inaccessible ...';
$language['front404_meta_description'] = 'La page que vous avez désirez atteindre n\'existe pas (ou plus). Excusez-nous pour la gêne occasionnée ...';
$language['front404_h1'] = 'Erreur, Page inaccessible ...';
$language['front404_description'] = 'La page que vous avez désirez atteindre n\'existe pas (ou plus). Excusez-nous pour la gêne occasionnée ...';

// error.tpl


//// --> template/templateName/includes/
// header.tpl
$language['includesHeader_language'] = 'fr';

// footer.tpl
$language['includesFooter_powered'] = 'Propulsé par';
$language['includesFooter_arfooo_url'] = 'http://www.arfooo.com/';
$language['includesFooter_arfooo_name'] = 'Arfooo Annuaire';
$language['includesFooter_arfooo_title'] = 'Annuaire pour le référencement';
$language['includesFooter_date'] = '2007 - ' . date('Y');   
$language['includesFooter_newsletter'] = 'Newsletter';
$language['includesFooter_contact'] = 'Contact';

// pageNavigation.tpl
$language['includesPageNavigation_page'] = 'page';
$language['includesPageNavigation_from'] = 'sur';


//// --> template/templateName/info/
// useCondition.tpl
$language['infoUseCondition_html_title'] = 'Conditions d\'utilisation';
$language['infoUseCondition_meta_description'] = 'Conditions d\'utilisation';
$language['infoUseCondition_arbo'] = 'Conditions d\'utilisation';
$language['infoUseCondition_h1'] = 'Conditions d\'utilisation';


//// --> template/templateName/javascript/
// config.tpl
$language['javascriptConfig_you_have_already_chosen_this_keyword_Select_another_one'] = 'Vous avez déjà choisi ce mot clé. Sélectionnez-en un autre.';
$language['javascriptConfig_loading'] = 'Chargement...';
$language['javascriptConfig_please_fill_in_the_website_Url_Title_and_Description_fields'] = 'Merci de remplir les champs Url du site, Titre et Description';
$language['javascriptConfig_the_Url_must_start_with_http://'] = 'L\'Url doit commencer par http://';
$language['javascriptConfig_please_enter_valid_email_address'] = 'Veuillez indiquer une adresse email valide';
$language['javascriptConfig_when_changing_the_website_webmaster_the_email_will_also_change'] = 'En changeant le webmaster du site, le mail sera changé également';
$language['javascriptConfig_the_comment_was_saved'] = 'Commentaire sauvegardé';
$language['javascriptConfig_the_comment_was_deleted'] = 'Commentaire supprimé';
$language['javascriptConfig_the_IP_was_banned'] = 'IP bannie';
$language['javascriptConfig_please_select_package'] = 'Merci de sélectionner une offre';
$language['javascriptConfig_please_select_payment_processor'] = 'Merci de sélectionner un moyen de paiement';
$language['javascriptConfig_please_enter_your_username'] = 'Veuillez entrer votre nom';
$language['javascriptConfig_please_enter_comment'] = 'Veuillez entrer un commentaire';
$language['javascriptConfig_please_enter_the_security_code'] = 'Merci d\'entrer le code de sécurité';
$language['javascriptConfig_the_tag_was_saved'] = 'Tag sauvegardé';
$language['javascriptConfig_you_cant_select_this_payment_method_for_selected_package'] = 'VOus ne pouvez pas sélectionner ce moyen de paiement pour cette offre';
$language['javascriptConfig_delete'] = 'Supprimer';
$language['javascriptConfig_edit'] = 'Modifier';
$language['javascriptConfig_file'] = 'Fichier';
$language['javascriptConfig_was_uploaded_sucessfully'] = 'a été uploadé avec succès';
$language['javascriptConfig_of'] = 'de';
$language['javascriptConfig_available_photos_uploaded'] = 'photos disponibles';
$language['javascriptConfig_popup_loading_title'] = 'Chargement';
$language['javascriptConfig_popup_loading_content'] = 'Chargement...';
$language['javascript_config_email_format'] = 'Votre email doit avoir le format suivant : a@a.com';
$language['javascript_config_email_was_used_earlier'] = 'Email déjà utilisé';
$language['javascript_config_please_enter_password'] = 'Merci d\'entrer votre mot de passe';
$language['javascript_config_please_confirm_your_password'] = 'Merci de confirmer votre mot de passe';
$language['javascript_config_please_enter_captcha_code'] = 'Merci d\'entrer le code de sécurité';
$language['javascript_config_passwords_are_not_equal'] = 'Mot de passe non identique';
$language['javascript_config_please_enter_your_email'] = 'Merci d\'entrer votre email';
$language['javascript_config_validation_message'] = 'Validation message';
$language['javascript_config_your_message_was_saved'] = 'Votre message a été sauvegardé';
$language['javascript_config_your_message_was_sent'] = 'Votre message a été envoyé';
$language['javascript_config_new_file_has_been_uploaded_sucessfully'] = 'Image uploadée avec succès';
$language['javascript_config_uploading'] = 'En cours d\'upload...';
$language['You did not guess the security code. Try again with a new one.'] = 'Le code de sécurité que vous avez entré est incorrect. Merci d\'essayer avec un nouveau code.';
$language['You did not guess the security code.'] = 'Le code de sécurité que vous avez entré est incorrect. Merci d\'essayer avec un nouveau code.';
$language['Your comment was saved'] = 'Votre commentaire a été sauvegardé';
$language['Your comment was saved. He is awaiting moderation and will be published if it is useful for surfers'] = 'Votre commentaire a été sauvegardé. Il est en attente de modération et sera publié si celui-ci est utile pour les Internautes.';
$language['The problem has been reported to the administrator. Thank you for your help.'] = 'Le problème vient d\'être signalé à l\'administrateur. Merci pour votre aide.';
$language['Validation Message'] = 'Validation Message test test';
$language['This site\' HTTP response code is not 200. The site is not accepted.'] = 'Le site ne répond pas. Le site n\'est pas accepté';
$language['We have detected duplicate content, change your description.'] = 'Votre description est déjà présente sur un ou plusieurs autre(s) site(s)/annuaire(s). Merci de la modifier afin de la rendre unique';
$language['Please enter a valid code'] = 'Merci d\'enter un code valide';
$language['You have entered an invalid code'] = 'Merci d\'enter un code valide';
$language['Allopass was validated sucessfully.'] = 'Code Allopass valide. Vous pouvez maintenant soumettre votre site.';
$language['You haven\'t credit for this action'] = 'Vous n\'avez pas de crédit pour soumettre votre site avec la formule privilège. Merci de revenir à l\'étape précédente, pour soumettre votre site avec la formule privilège.';


//// --> template/templateName/keyword/
// show.tpl
$language['keywordShow_html_title'] = 'Annuaire de mots commençant par';
$language['keywordShow_meta_description'] = 'Annuaire de mots commençant par';
$language['keywordShow_arbo'] = 'Annuaire de mots commençant par';
$language['keywordShow_h1'] = 'Annuaire de mots commençant par';


//// --> template/templateName/main/
// index.tpl
$language['mainIndex_h2'] = 'Sites référencés dans l\'annuaire';


//// --> template/templateName/menu/
// menuheader/menuheader.tpl
$language['menuMenuheader_directory'] = 'Annuaire';
$language['menuMenuheader_news'] = 'Nouveautés';
$language['menuMenuheader_top_hits'] = 'Top hits';
$language['menuMenuheader_top_rated'] = 'Top notes';
$language['menuMenuheader_top_rank'] = 'Top rank';
$language['menuMenuheader_top_referrers'] = 'Top referrers';
$language['menuMenuheader_categories'] = 'Catégories';
$language['menuMenuheader_submit_website'] = 'Soumettre un site';

// menuheader/searchEngine.tpl
$language['menuSearchEngine_what'] = 'Quoi';
$language['menuSearchEngine_where'] = 'Où';
$language['menuSearchEngine_type_keyword'] = 'Entrer des mots clés';
$language['menuSearchEngine_adress'] = 'Adresse, ville, pays, ou code postal';
$language['menuSearchEngine_search_button'] = 'Rechercher';
$language['menuSearchEngine_advanced_search'] = 'Recherche avancée';

// menuleft/categories.tpl
$language['menuleftCategories_categories'] = 'Catégories';

// menuleft/keywords.tpl
$language['menuleftKeywords_keywords'] = 'Mots clés';

// menuleft/menuleft.tpl

// menuleft/statistics.tpl
$language['menuleftStatistics_stats'] = 'Statistiques';
$language['menuleftStatistics_approved_links'] = 'Sites référencés';
$language['menuleftStatistics_pending_links'] = 'Sites en attente';
$language['menuleftStatistics_rejected_links'] = 'Sites refusés';
$language['menuleftStatistics_banned_links'] = 'Sites bannis';
$language['menuleftStatistics_categories'] = 'Catégories';
$language['menuleftStatistics_keywords'] = 'Mots clés';
$language['menuleftStatistics_webmasters'] = 'Webmasters';

// menuright/menuright.tpl
$language['menuright_members_area'] = 'Zone membres';
$language['menuright_management'] = 'Gestion';
$language['menuright_change_password'] = 'Changer le mot de passe';
$language['menuright_logout'] = 'Déconnexion';

// menuright/tagCloud.tpl
$language['menurightTagCloud_tag_cloud'] = 'Tag Cloud';


//// --> template/templateName/newsletter/
// confirmNewsletterEmailAdd.tpl
$language['confirmNewsletterEmailAdd_html_title'] = 'Vérification de votre email';
$language['confirmNewsletterEmailAdd_meta_description'] = 'Merci d\'avoir confirmé votre inscription à la newsletter';
$language['confirmNewsletterEmailAdd_h1'] = 'Vérification de votre email';
$language['confirmNewsletterEmailAdd_description'] = 'Merci d\'avoir confirmé votre inscription à la newsletter';

// confirmNewsletterEmailDel.tpl.tpl
$language['confirmNewsletterEmailDel_html_title'] = 'Vérification de votre email';
$language['confirmNewsletterEmailDel_meta_description'] = 'Merci d\'avoir confirmé votre désinscription à la newsletter';
$language['confirmNewsletterEmailDel_h1'] = 'Vérification de votre email';
$language['confirmNewsletterEmailDel_description'] = 'Merci d\'avoir confirmé votre désinscription à la newsletter';

// index.tpl
$language['newsletterIndex_html_title'] = 'Newsletter';
$language['newsletterIndex_meta_description'] = 'Newsletter';
$language['newsletterIndex_arbo'] = 'Newsletter';
$language['newsletterIndex_h1'] = 'Newsletter';
$language['newsletterIndex_email'] = 'Votre email';
$language['newsletterIndex_button_subscribe'] = 'Inscription';
$language['newsletterIndex_button_unsubscribe'] = 'Désinscription';
$language['Your email was added. Check your inbox to confirm it'] = 'Votre email a été ajouté avec succès. Pour recevoir la newsletter, merci de confirmer votre inscription en cliquant sur le lien présent dans le mail qui vient de vous être envoyé.';
$language['This email was added earlier'] = 'Cet email a déjà été ajouté à la newsletter';
$language['Check your inbox and click on remove link'] = 'Pour définitivement supprimer votre email de la newsletter, merci de confirmer votre désinscription en cliquant sur le lien présent dans le mail qui vient de vous être envoyé.';
$language['This email do not exists in our db'] = 'Cet email n\'existe pas dans notre base de données';


//// --> template/templateName/payment/
// makePayment.tpl
$language['makePayment_html_title'] = 'Paiement';
$language['makePayment_meta_description'] = 'Paiement';
$language['makePayment_arbo'] = 'Paiement';
$language['makePayment_your_choice'] = 'Votre offre';
$language['makePayment_price'] = 'Prix';
$language['makePayment_choice_description'] = 'Description de votre offre';
$language['makePayment_next_step'] = 'Etape suivante';
$language['makePayment_allopass_code'] = 'Code Allopass';

// processPayment.tpl
$language['processPayment_html_title'] = 'Traitement du paiement...';
$language['processPayment_h1'] = 'Traitement du paiement...';

// selectPaymentOptions.tpl
$language['selectPaymentOptions_html_title'] = 'Choisissez une offre et votre moyen de paiement';
$language['selectPaymentOptions_meta_description'] = 'Choisissez une offre et votre moyen de paiement';
$language['selectPaymentOptions_arbo'] = 'Paiement';
$language['selectPaymentOptions_h1'] = 'Choisissez une offre et votre moyen de paiement';
$language['selectPaymentOptions_package'] = 'Offre';
$language['selectPaymentOptions_select_package'] = 'Merci de sélectionner une offre';
$language['selectPaymentOptions_package_description'] = 'Description de l\'offre';
$language['selectPaymentOptions_description'] = 'Une description détaillée de l\'offre apparaîtra en sélectionnant une offre';
$language['selectPaymentOptions_payment_method'] = 'Moyen de paiement';
$language['selectPaymentOptions_select_payment_method'] = 'Sélectionner un moyen de paiement';
$language['selectPaymentOptions_next_step'] = 'Etape suivante';


//// --> template/templateName/photo/
// edit.tpl
$language['photoEdit_title'] = 'Modifier le nom de la photo (attribut alternatif)';
$language['photoEdit_name_alt'] = 'Nom / Alt';
$language['photoEdit_save_button'] = 'Sauvegarder';
$language['photoEdit_cancel_button'] = 'Annuler';


//// --> template/templateName/site/
// category.tpl
$language['siteCategory_rss'] = 'RSS';

// details.tpl
$language['siteDetails_rss'] = 'RSS';
$language['siteDetails_see_sentence'] = 'Visiter et apprécier le site';
$language['siteDetails_categorie'] = ', appartenant à la catégorie';
$language['siteDetails_keyword_sentence'] = 'Les mots clés thématiques associés au site sont :';
$language['siteDetails_language'] = 'Langue';
$language['siteDetails_url'] = 'Url';
$language['siteDetails_backlink'] = 'Lien retour';
$language['siteDetails_hits'] = 'Hits';
$language['siteDetails_rate'] = 'Notes';
$language['siteDetails__rate'] = 'note';
$language['siteDetails_for'] = 'pour';
$language['siteDetails_comments'] = 'Commentaires';
$language['siteDetails_validation_date'] = 'Date de validation';
$language['siteDetails_interaction'] = 'Interaction';
$language['siteDetails_report_problem'] = 'Reporter un problème';
$language['siteDetails_write_comment'] = 'Ecrire un commentaire';
$language['siteDetails_rate_website'] = 'Noter le site';
$language['siteDetails_contact_webmaster'] = 'Contacter le webmaster';
$language['siteDetails_google_infos'] = 'Informations Google';
$language['siteDetails_pagerank'] = 'PageRank';
$language['siteDetails_loading'] = 'Chargement...';
$language['siteDetails_number_backlinks'] = 'Nombre de backlinks';
$language['siteDetails_number_indexed_pages'] = 'Nombre de pages indexées';
$language['siteDetails_rss_feed'] = 'Flux RSS';
$language['siteDetails_company_information'] = 'Informations sur la société';
$language['siteDetails_adress'] = 'Adresse';
$language['siteDetails_postal_code'] = 'Code postal';
$language['siteDetails_city'] = 'Ville';
$language['siteDetails_country'] = 'Pays';
$language['siteDetails_phone_number'] = 'Téléphone';
$language['siteDetails_fax_number'] = 'Fax';
$language['siteDetails_wrote_on'] = 'a écrit';
$language['siteDetails_comment_rate'] = 'Note:';
$language['siteDetails_5'] = '/5';
$language['siteDetails_na'] = 'n/a';
$language['siteDetails_related_sites'] = 'Thématique proche de';

// item.tpl
$language['siteItem_details'] = 'Détails';
$language['siteItem_new_website'] = 'Nouveau site';
$language['siteItem_keywords'] = 'Mots clés';
$language['siteItem_number_visitors_sent'] = 'Nombre de visiteurs envoyés';
$language['siteItem_pagerank'] = 'Pagerank';
$language['siteItem_hits'] = 'Hits';
$language['siteItem_rate'] = 'Notes';
$language['siteItem_5'] = '/5';
$language['siteItem__rate'] = 'notes';
$language['siteItem_for'] = 'pour';

// keyword.tpl

// news.tpl
$language['siteNews_html_title'] = 'Les nouveaux sites référencés';
$language['siteNews_meta_description'] = 'Les nouveaux sites référencés';
$language['siteNews_arbo'] = 'Nouveaux sites référencés';
$language['siteNews_h1'] = 'Les nouveaux sites référencés';
$language['siteNews_rss'] = 'RSS nouveaux sites référencés';

// randomList.tpl

// search.tpl
$language['siteSearch_html_title'] = 'Résultats de la recherche';
$language['siteSearch_arbo'] = 'Résultats de la recherche';
$language['siteSearch_h1'] = 'Résultats de la recherche';

// tag.tpl

// topHits.tpl
$language['siteTopHits_html_title'] = 'Sites les plus visités';
$language['siteTopHits_meta_description'] = 'Sites les plus visités';
$language['siteTopHits_arbo'] = 'Sites les plus visités';
$language['siteTopHits_h1'] = 'Sites les plus visités';

// topNotes.tpl
$language['siteTopNotes_html_title'] = 'Sites les mieux notés';
$language['siteTopNotes_meta_description'] = 'Sites les mieux notés';
$language['siteTopNotes_arbo'] = 'Sites les mieux notés';
$language['siteTopNotes_h1'] = 'Sites les mieux notés';

// topRank.tpl
$language['siteTopRank_html_title'] = 'Sites classés par PageRank';
$language['siteTopRank_meta_description'] = 'Sites classés par PageRank';
$language['siteTopRank_arbo'] = 'Sites classés par PageRank';
$language['siteTopRank_h1'] = 'Sites classés par PageRank';
$language['siteTopRank_whit_pagerank'] = 'Sites avec un PageRank de';

// topReferrers.tpl
$language['siteTopReferrers_html_title'] = 'Top referrers';
$language['siteTopReferrers_meta_description'] = 'Top referrers';
$language['siteTopReferrers_arbo'] = 'Top referrers';
$language['siteTopReferrers_h1'] = 'Top referrers';


//// --> template/templateName/webmaster/
// changePassword.tpl
$language['webmasterChangePassword_html_title'] = 'Changer votre mot de passe';
$language['webmasterChangePassword_meta_description'] = 'Changer votre mot de passe';
$language['webmasterChangePassword_arbo'] = 'Changer votre mot de passe';
$language['webmasterChangePassword_h1'] = 'Changer votre mot de passe';
$language['webmasterChangePassword_new_pass'] = 'Nouveau mot de passe';
$language['webmasterChangePassword_repeat_pass'] = 'Répéter le nouveau mot de passe';
$language['webmasterChangePassword_button'] = 'Sauvegarder';

// chooseSiteType.tpl
$language['webmasterChooseSiteType_html_title'] = 'Choisissez votre offre pour soumettre un site';
$language['webmasterChooseSiteType_meta_description'] = 'Choisissez votre offre pour soumettre un site';
$language['webmasterChooseSiteType_arbo'] = 'Choisissez votre offre pour soumettre un site';
$language['webmasterChooseSiteType_h1'] = 'Choisissez votre offre pour soumettre un site';
$language['webmasterChooseSiteType_free'] = 'Gratuit';
$language['webmasterChooseSiteType_free_submission'] = 'Soumission gratuite';
$language['webmasterChooseSiteType_standard_submission'] = 'Soumission standard sans privilège ';
$language['webmasterChooseSiteType_privileged'] = 'Privilège';
$language['webmasterChooseSiteType_privilege_submission'] = 'Soumission privilège';
$language['webmasterChooseSiteType_submission_allowing_you'] = 'Soumission vous permettant d\'obtenir certains privilèges';

// confirmSiteEmail.tpl
$language['webmasterConfirmSiteEmail_html_title'] = 'Vérification de votre email';
$language['webmasterConfirmSiteEmail_meta_description'] = 'Vérification de votre email';
$language['webmasterConfirmSiteEmail_h1'] = 'Vérification de votre email';
$language['webmasterConfirmSiteEmail_desc'] = 'Merci d\'avoir vérifié votre email';

// confirmUserEmail.tpl
$language['webmasterConfirmUserEmail_html_title'] = 'Vérification de votre email';
$language['webmasterConfirmUserEmail_meta_description'] = 'Vérification de votre email';
$language['webmasterConfirmUserEmail_h1'] = 'Vérification de votre email';
$language['webmasterConfirmUserEmail_desc'] = 'Merci d\'avoir vérifié votre email';
$language['webmasterConfirmUserEmail_desc2'] = 'Vous pouvez maintenant vous connecter à votre zone membre et soumetre vos sites';

// editSite.tpl

// loading.tpl
$language['webmasterLoading_html_title'] = 'Paiement en cours de vérification';
$language['webmasterLoading_meta_description'] = 'Paiement en cours de vérification';
$language['webmasterLoading_h1'] = 'Paiement en cours de vérification';
$language['webmasterLoading_desc'] = 'Le paiement est en cours de vérification';
$language['webmasterLoading_desc2'] = 'Nous vous remercions de bien vouloir patienter';
$language['webmasterLoading_desc3'] = 'Vous allez être redirigé vers le formulaire de soumission, après vérification';

// logIn.tpl
$language['webmasterLogIn_html_title'] = 'Connexion / Inscription';
$language['webmasterLogIn_meta_description'] = 'Connexion / Inscription';
$language['webmasterLogIn_arbo'] = 'Connexion / Inscription';
$language['webmasterLogIn_h1'] = 'Déjà membre ? Connectez-vous';
$language['webmasterLogIn_desc'] = 'Entrez vos identifiants ci-dessous';
$language['webmasterLogIn_wrong'] = 'Vous avez indiqué un mot de passe / nom d\'utilisateur incorrect';
$language['webmasterLogIn_email'] = 'Email';
$language['webmasterLogIn_pass'] = 'Mot de passe';
$language['webmasterLogIn_remember'] = 'Se souvenir de moi';
$language['webmasterLogIn_forgot_pass'] = 'Mot de passe oublié?';
$language['webmasterLogIn_button_login'] = 'Connexion';
$language['webmasterLogIn_terms'] = 'Conditions de référencement';
$language['webmasterLogIn_new_create'] = 'Nouveau ? Créez un compte';
$language['webmasterLogIn_desc2'] = 'En vous inscrivant, vous pouvez soumettre et gérer vos sites';
$language['webmasterLogIn_repeat_pass'] = 'Répéter votre mot de passe';
$language['webmasterLogIn_subscribe_news'] = 'S\'inscrire à la newsletter';
$language['webmasterLogIn_security_code'] = 'Code de sécurité';
$language['webmasterLogIn_button_registration'] = 'Inscription';

// lostPassword.tpl
$language['webmasterLostPass_lost_pass'] = 'Mot de passe oublié';
$language['webmasterLostPass_desc'] = 'Si vous avez oublié votre mot de passe, entrez votre adresse email ci-dessous.';
$language['webmasterLostPass_desc2'] = 'Vous recevrez un email contenant votre nouveau mot de passe.';
$language['webmasterLostPass_mandatory'] = '= champs obligatoires';
$language['webmasterLostPass_your_email'] = 'Votre email';
$language['webmasterLostPass_security_code'] = 'Code de sécurité';
$language['webmasterLostPass_button_send'] = 'Envoyer le nouveau mot de passe';
$language['webmasterLostPass_button_cancel'] = 'Annuler';
$language['We haven\'t this email in database'] = 'Cet email n\'existe pas dans notre base de données';

// manage.tpl
$language['webmasterManage_html_title'] = 'Zone de gestion';
$language['webmasterManage_meta_description'] = 'Zone de gestion';
$language['webmasterManage_arbo'] = 'Zone de gestion';
$language['webmasterManage_h1'] = 'Zone membres';
$language['webmasterManage_add_website'] = 'Ajouter votre site';
$language['webmasterManage_username'] = 'Nom de l\'utilisateur';
$language['webmasterManage_logout'] = 'Déconnexion';
$language['webmasterManage_website_url'] = 'Site / URL';
$language['webmasterManage_status'] = 'Statut';
$language['webmasterManage_view'] = 'Voir';
$language['webmasterManage_details'] = 'Détails';
$language['webmasterManage_management'] = 'Gestion';
$language['webmasterManage_validated'] = 'Validé';
$language['webmasterManage_pending'] = 'En attente';
$language['webmasterManage_go'] = 'Voir';
$language['webmasterManage_free'] = 'Gratuit';
$language['webmasterManage_privileged'] = 'Privilège';
$language['webmasterManage_edit'] = 'Modifier';
$language['webmasterManage_delete_website?'] = 'Voulez vous vraiment supprimer votre site ?';
$language['webmasterManage_delete'] = 'Supprimer';

// submitDisabled.tpl
$language['webmasterSubmitDisabled_html_title'] = 'Les inscriptions sont momentanément fermées. Merci de revenir plus tard.';
$language['webmasterSubmitDisabled_meta_description'] = 'Les inscriptions sont momentanément fermées. Merci de revenir plus tard.';
$language['webmasterSubmitDisabled_arbo'] = 'Les inscriptions sont momentanément fermées.';
$language['webmasterSubmitDisabled_h1'] = 'Les inscriptions sont momentanément fermées.';
$language['webmasterSubmitDisabled_desc'] = 'Les inscriptions sont momentanément fermées. Merci de revenir plus tard.';

// submitWebsite.tpl
$language['webmasterSubmitWebsite_html_title'] = 'Webmaster - ajouter/modifier votre site';
$language['webmasterSubmitWebsite_meta_description'] = 'Webmaster - ajouter/modifier votre site';
$language['webmasterSubmitWebsite_arbo'] = 'Gestion';
$language['webmasterSubmitWebsite_arbo2'] = 'Webmaster - ajouter/modifier votre site';
$language['webmasterSubmitWebsite_step'] = 'Étape';
$language['webmasterSubmitWebsite_select_categorie'] = 'Sélectionnez une catégorie';
$language['webmasterSubmitWebsite_suggest_cat'] = 'Proposer des catégories';
$language['webmasterSubmitWebsite_select_other_category'] = 'Merci de sélectionner une catégorie plus précise pour publier votre site.';
$language['webmasterSubmitWebsite_general_information'] = 'Informations générales';
$language['webmasterSubmitWebsite_mandatory_fields'] = '= champs obligatoires';
$language['webmasterSubmitWebsite_language_site'] = 'Langue du site';
$language['webmasterSubmitWebsite_select_language_site'] = 'Sélectionnez la langue du site';
$language['webmasterSubmitWebsite_webmaster_email'] = 'Email';
$language['webmasterSubmitWebsite_webmaster_email_tooltip'] = 'Indiquez un email valide';
$language['webmasterSubmitWebsite_website_title'] = 'Titre du site';
$language['webmasterSubmitWebsite_website_title_tooltip'] = 'Titre utilisé comme ancre texte du lien sortant';
$language['webmasterSubmitWebsite_website_url'] = 'Adresse du site (URL)';
$language['webmasterSubmitWebsite_button_metas'] = 'Metas';
$language['webmasterSubmitWebsite_website_url_tooltip'] = 'Exemple: http://www.example.com/';
$language['webmasterSubmitWebsite_rss_feed_title'] = 'Titre du flux RSS';
$language['webmasterSubmitWebsite_rss_feed_title_tooltip'] = 'Titre utilisé comme ancre texte du lien sortant';
$language['webmasterSubmitWebsite_rss_feed_url'] = 'Adresse du flux RSS (URL)';
$language['webmasterSubmitWebsite_rss_feed_url_tooltip'] = 'Exemple: http://www.example.com/rss.xml';
$language['webmasterSubmitWebsite_website_desc'] = 'Description';
$language['webmasterSubmitWebsite_website_desc_tooltip'] = 'Rédiger une description précisant votre site, votre activité...';
$language['webmasterSubmitWebsite_characters_left'] = 'caractères disponibles';
$language['webmasterSubmitWebsite_add_photo'] = 'Ajouter des photos';
$language['webmasterSubmitWebsite_add_photo_button'] = 'Ajouter une photo';
$language['webmasterSubmitWebsite_search_partnership'] = 'Recherche de partenaires';
$language['webmasterSubmitWebsite_search_partnership_tooltip'] = 'Si vous êtes à la recherche de partenaires, cochez la case';
$language['webmasterSubmitWebsite_company_info'] = 'Informations sur votre société / Permet d\'apparaître sur google map';
$language['webmasterSubmitWebsite_adress'] = 'Adresse';
$language['webmasterSubmitWebsite_postal_code'] = 'Code postal';
$language['webmasterSubmitWebsite_city'] = 'Ville';
$language['webmasterSubmitWebsite_country'] = 'Pays';
$language['webmasterSubmitWebsite_phone'] = 'Téléphone';
$language['webmasterSubmitWebsite_fax'] = 'Fax';
$language['webmasterSubmitWebsite_select_keywords'] = 'Sélectionnez vos mots clés / Suggérez des mots clés';
$language['webmasterSubmitWebsite_keyword'] = 'Mots clés';
$language['webmasterSubmitWebsite_select_your_keyword'] = 'Sélectionnez votre mot clé';
$language['webmasterSubmitWebsite_suggest_keywords'] = 'Proposer des mots clés';
$language['webmasterSubmitWebsite_backlink'] = 'Lien retour';
$language['webmasterSubmitWebsite_backlink_desc'] = 'Un lien retour (backlink) vers votre site n\'est pas obligatoire mais recommandé';
$language['webmasterSubmitWebsite_desc2'] = 'En faisant un lien retour, votre site aura de nombreux avantages';
$language['webmasterSubmitWebsite_desc3'] = 'Si vous mettez un lien retour sur votre site, il doit déjà être présent avant de soumettre votre site';
$language['webmasterSubmitWebsite_desc4'] = 'Merci d\'indiquer l\'adresse (URL) du lien retour dans le champs ci-dessous';
$language['webmasterSubmitWebsite_backlink_url'] = 'Adresse du lien retour (URL)';
$language['webmasterSubmitWebsite_backlink_html1'] = 'Lien retour code Html 1';
$language['webmasterSubmitWebsite_backlink_html2'] = 'Lien retour code Html 2';
$language['webmasterSubmitWebsite_backlink_html_tooltip'] = 'Merci d\'insérer ce code sur votre site';
$language['webmasterSubmitWebsite_submit_website'] = 'Soumettez votre site';
$language['webmasterSubmitWebsite_subscribe_newsletter'] = 'M\'inscrire à la newsletter';
$language['webmasterSubmitWebsite_security_code'] = 'Code de sécurité';
$language['webmasterSubmitWebsite_terms_use_desc'] = 'En cliquant sur "Soumettre mon site", j\'accepte les termes d\'utilisation';
$language['webmasterSubmitWebsite_read_terms'] = 'Lire nos conditions d\'utilisation';
$language['webmasterSubmitWebsite_checking'] = 'Vérification du site en cours...';
$language['webmasterSubmitWebsite_button_submit'] = 'Soumettre mon site';


$language['This site is not allowed to be offered more times.'] = 'Ce site ne peut pas être soumis plusieurs fois.';
$language['Description of site must have minimum'] = 'La description du site doit faire';
$language['characters length.'] = 'caractères minimum.';
$language['The registration was successful! You can login now.'] = 'Merci pour votre inscription. Vous pouvez maintenant vous indentifier.';
$language['The registration was successful! You must confirm your email. Check your inbox.'] = 'Merci pour votre inscription. Un email vient de vous être envoyé. Vous devez cliquer sur le lien présent dans l\'email pour confirmer votre inscription. Vous pourrez alors vous identifier et soumettre un site.';
$language['The site was successfully submitted.'] = 'Le site a été soumis avec succès.';
$language['This field is required'] = 'Ce champ est obligatoire';
$language['The site was successfully submitted. You must confirm your email. Check your inbox.'] = 'Le site a été soumis avec succès. Un email vient de vous être envoyé. Vous devez cliquer sur le lien présent dans l\'email pour confirmer la soumission du site.';

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