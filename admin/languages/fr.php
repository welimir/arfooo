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


/* Admin Texts */

// all
$language['Management'] = 'Gestion';
$language['Do you really want to delete it?'] = 'Voulez-vous vraiment supprimer?';
$language['button_save'] = 'Sauvegarder';
$language['button_delete'] = 'Supprimer';
$language['button_create'] = 'Créer';
$language['button_edit'] = 'Editer';
$language['button_start'] = 'Commencer';
$language['button_pause'] = 'Pause';
$language['button_resume'] = 'Résumer';
$language['button_stop'] = 'Arrêter';
$language['link_edit'] = 'Editer';
$language['link_delete'] = 'Supprimer';
$language['link_save'] = 'Sauvegarder';
$language['link_ban'] = 'Bannir';
$language['link_unban'] = 'Débannir';
$language['Website'] = 'Site';
$language['Websites'] = 'Sites';
$language['On'] = 'Oui';
$language['Off'] = 'Non';
$language['Yes'] = 'Oui';
$language['No'] = 'Non';
$language['HEADER - BANNER'] = 'HEADER - BANNER';
$language['HORIZONTAL MENU'] = 'MENU HORIZONTAL';
$language['Left menu'] = 'Menu Gauche';
$language['Right menu'] = 'Menu Droit';
$language['Root'] = 'Index';
$language['FOOTER'] = 'FOOTER';


//// --> template/templateName/ad/
// editCriteria.tpl
$language['adEditCriteria_html_title'] = 'Publicité - Editer les critères';
$language['adEditCriteria_meta_description'] = 'Publicité - Editer les critères';
$language['adEditCriteria_arbo'] = 'Publicité - Editer les critères';
$language['adEditCriteria_h1'] = 'Publicité - Editer les critères';
$language['adEditCriteria_criteria_name'] = 'Nom du critère';
$language['adEditCriteria_form_title1'] = '(x)HTML code et Javascript';
$language['adEditCriteria_form_desc1'] = 'Du code (x)HTML pour faciliter l\'intégration et le JavaScript pour votre code de pub adsense, oxado ...';

// in.tpl
$language['adIn_html_title'] = 'Publicité dans';
$language['adIn_meta_description'] = 'Publicité dans';
$language['adIn_arbo'] = 'Publicité dans';
$language['adIn_h1'] = 'Publicité dans';
$language['adIn_activate'] = 'Activer la publicité';

// index.tpl
$language['adIndex_html_title'] = 'Publicité';
$language['adIndex_meta_description'] = 'Publicité';
$language['adIndex_arbo'] = 'Publicité';
$language['adIndex_h1'] = 'Publicité';
$language['adIndex_desc1'] = 'Vous pouvez gérer la publicité sur les pages:';
$language['adIndex_desc2'] = 'Index, nouveautés, mots clés (liste des mots et liste des sites), top (hits, notes, rank, referrers), moteur de recherche';
$language['adIndex_desc3'] = 'Pour gérer la publicité dans les catégories, les sites et les mots clés, vous devez vous rendre à l\'intérieur des sites, catégories et mots clés';
$language['adIndex_h2'] = 'Liste des critères';
$language['adIndex_criteria_name'] = 'Nom du critère';
$language['adIndex_form_title1'] = '(x)HTML code et Javascript';
$language['adIndex_form_desc1'] = 'Du code (x)HTML pour faciliter l\'intégration et le JavaScript pour votre code de pub adsense, oxado ...';
$language['adIndex_h2_create'] = 'Créer un critère';


//// --> template/templateName/ad/pages/
// all
$language['adPagesAll_activate_ad'] = 'Activer la publicité';

// index.tpl
$language['adPagesIndex_html_title'] = 'Publicité sur la page index';
$language['adPagesIndex_meta_description'] = 'Publicité sur la page index';
$language['adPagesIndex_arbo'] = 'Publicité sur la page index';
$language['adPagesIndex_h1'] = 'Publicité sur la page index';
$language['adPagesIndex_h2'] = 'Gérer la publicité sur la page index';
$language['adPagesIndex_directory_title'] = 'Directory Title';
$language['adPagesIndex_category'] = 'Catégorie';
$language['adPagesIndex_random_websites'] = 'Sites aléatoires';
$language['adPagesIndex_directory_description'] = 'Description de l\'annuaire';

// predefineCategory.tpl
$language['predefineCategory_html_title'] = 'Prédéfinir la position de la publicité dans les catégories';
$language['predefineCategory_meta_description'] = 'Prédéfinir la position de la publicité dans les catégories';
$language['predefineCategory_arbo'] = 'Prédéfinir la position de la publicité dans les catégories';
$language['predefineCategory_h1'] = 'Prédéfinir la position de la publicité dans les catégories';
$language['predefineCategory_desc1'] = 'Vous allez pouvoir prédéfinir la position de la publicité dans toutes les catégories.';
$language['predefineCategory_desc2'] = 'Il est recommandé d\'activer la prédéfinition de la publicité, ainsi la publicité sera activée dans toutes les catégories automatiquement et même celles que vous créerez ultérieurement.';
$language['predefineCategory_desc3'] = 'Vous pouvez modifier la positon de la publicité et/ou désactiver la publicité très simplement en vous rendant dans la catégorie où vous voulez procéder à des modifications.';
$language['predefineCategory_desc4'] = 'Si la prédéfinition de la publicité est activée pour les catégories et les sites (ce qui est recommandé), alors en désactivant la prédéfinition de la publicité pour UNE catégorie en vous rendant dans la catégorie, la publicité sera désactivée pour tous les sites se trouvant dans la catégorie.';
$language['predefineCategory_desc5'] = 'Cette option est très utile pour gérer facilement la publicité très rapidement et pour désactiver la publicité dans des catégories et sites tels que les jeux d\'argent, le sexe qui sont interdits par certains annonceurs. ';
$language['predefineCategory_category'] = 'Catégorie';
$language['predefineCategory_category_description'] = 'Texte descriptif de la catégorie, si vous en avez entré une...';

// predefineKeyword.tpl
$language['predefineKeyword_html_title'] = 'Prédéfinir la position de la publicité dans les mots clés';
$language['predefineKeyword_meta_description'] = 'Prédéfinir la position de la publicité dans les mots clés';
$language['predefineKeyword_arbo'] = 'Prédéfinir la position de la publicité dans les mots clés';
$language['predefineKeyword_h1'] = 'Prédéfinir la position de la publicité dans les mots clés';
$language['predefineKeyword_websites_list'] = 'Liste des sites';
$language['predefineKeyword_desc1'] = 'Vous allez pouvoir prédéfinir la position de la publicité dans tous les mots clés (liste des mots et liste des sites).';
$language['predefineKeyword_desc2'] = 'Il est recommandé d\'activer la prédéfinition de la publicité, ainsi, la publicité sera activée dans tous les mots clés automatiquement et même ceux que vous créerez ultérieurement.';
$language['predefineKeyword_desc3'] = 'Vous pouvez modifier la position de la publicité et/ou désactiver la publicité très simplement en vous rendant dans le mot clé où vous voulez procéder à des modifications.';
$language['predefineKeyword_desc4'] = 'Cette option est très utile pour gérer facilement la publicité très rapidement et pour désactiver la publicité dans des mots clés tels que les jeux d\'argent, le sexe qui sont interdits par certaines régies. ';
$language['predefineKeyword_keywords'] = 'Mots clés';
$language['predefineKeyword_words_list'] = 'Liste des mots';

// predefineSite.tpl
$language['predefineSite_html_title'] = 'Prédéfinir la position de la publicité dans la page détails des sites';
$language['predefineSite_meta_description'] = 'Prédéfinir la position de la publicité dans la page détails des sites';
$language['predefineSite_arbo'] = 'Prédéfinir la position de la publicité dans la page détails des sites';
$language['predefineSite_h1'] = 'Prédéfinir la position de la publicité dans la page détails des sites';
$language['predefineSite_desc1'] = 'Vous allez pouvoir prédéfinir la position de la publicité dans toutes les pages détails des sites.';
$language['predefineSite_desc2'] = 'Il est recommandé d\'activer la prédéfinition de la publicité, ainsi, la publicité sera activée dans tous les sites automatiquement et même ceux ajoutés utlérieurement.';
$language['predefineSite_desc3'] = 'Vous pouvez modifier la position de la publicité et/ou désactiver la publicité très simplement en vous rendant dans le site où vous voulez procéder à des modifications.';
$language['predefineSite_desc4'] = 'Si la prédéfinition de la publicité est activée pour les catégories et les sites (ce qui est recommandé), alors en désactivant la prédéfinition de la publicité pour UNE catégorie en vous rendant dans la catégorie, la publicité sera désactivée pour tous les sites se trouvant dans la catégorie.';
$language['predefineSite_desc5'] = 'Cette option est très utile pour gérer facilement la publicité très rapidement et pour désactiver la publicité dans des catégories et sites tels que les jeux d\'argent, le sexe qui sont interdits par certains annonceurs. ';
$language['predefineSite_website_title'] = 'Titre du site';
$language['predefineSite_website_info'] = 'Informations sur le site';
$language['predefineSite_website_rss'] = 'Flux RSS du site';
$language['predefineSite_google'] = 'Informations Google du site';
$language['predefineSite_company'] = 'Informations sur la société';
$language['predefineSite_category'] = 'Site dans la même catégorie';

// predefineTag.tpl
$language['predefineTag_html_title'] = 'Prédéfinir la position de la publicité dans les pages tags';
$language['predefineTag_meta_description'] = 'Prédéfinir la position de la publicité dans les pages tags';
$language['predefineTag_arbo'] = 'Prédéfinir la position de la publicité dans les pages tags';
$language['predefineTag_h1'] = 'Prédéfinir la position de la publicité dans les pages tags';
$language['predefineTag_desc1'] = 'Vous allez pouvoir prédéfinir la position de la publicité dans tous les tags.';
$language['predefineTag_desc2'] = 'Il est recommandé d\'activer la prédéfinition de la publicité, ainsi, la publicité sera activée dans tous les tags automatiquement et même ceux que vous créerez ultérieurement.';
$language['predefineTag_desc3'] = 'Vous pouvez modifier la positon de la publicité et/ou désactiver la publicité très simplement en vous rendant dans le tag où vous voulez procéder à des modifications.';
$language['predefineTag_desc4'] = 'Cette option est très utile pour gérer facilement la publicité très rapidement et pour désactiver la publicité dans des tags tels que les jeux d\'argent, le sexe qui sont interdits par certaines régies.';
$language['predefineTag_tags'] = 'Tags';
$language['predefineTag_tag_name'] = 'Nom du tag';


//// --> template/templateName/campaign/
// filter.tpl
$language['campaignFilter_html_title'] = 'Tracker ses campagnes mails/autres';
$language['campaignFilter_meta_description'] = 'Tracker ses campagnes mails/autres';
$language['campaignFilter_arbo'] = 'Tracker ses campagnes mails/autres';
$language['campaignFilter_h1'] = 'Tracker ses campagnes mails/autres';
$language['campaignFilter_desc1'] = 'Si vous souhaitez tracker vos campagnes mails, ou autres, vous devez ajouter des filtres afin que le script autorise le lien entrant.';
$language['campaignFilter_desc2'] = 'Autrement, vos liens de tracking retourneront une erreur http 404.';
$language['campaignFilter_desc3'] = 'Attention : Par défaut le script ajoute toujours le caractère ?';
$language['campaignFilter_desc4'] = 'Si vous souhaitez ajouter un filtre, ne mettez jamais le premier caractère ?';
$language['campaignFilter_desc5'] = 'Exemple :';
$language['campaignFilter_desc6'] = 'Filtre qui fonctionne : utm_source=newsletter&utm_medium=email&utm_campaign=newsletter777';
$language['campaignFilter_desc7'] = 'Filtre qui ne fonctionne pas : ?utm_source=newsletter&utm_medium=email&utm_campaign=newsletter777';
$language['campaignFilter_add_filters'] = 'Ajouter des filtres';
$language['campaignFilter_remove_filters'] = 'Supprimer des filtres';
$language['campaignFilter_filters'] = 'Filtres';
$language['campaignFilter_add'] = 'Ajouter';
$language['campaignFilter_remove'] = 'Supprimer';


//// --> template/templateName/category/
// edit.tpl
$language['categoryEdit_html_title'] = 'Modifier la catégorie';
$language['categoryEdit_meta_description'] = 'Modifier la catégorie';
$language['categoryEdit_arbo'] = 'Modifier la catégorie';
$language['categoryEdit_h1'] = 'Modifier la catégorie';
$language['categoryEdit_parent_category'] = 'Catégorie parent';
$language['categoryEdit_category_name'] = 'Nom de la catégorie';
$language['categoryEdit_category_title'] = 'Titre HTML de la catégorie (facultatif)';
$language['categoryEdit_nav'] = 'Nom du lien de navigation / chemin de fer (facultatif)';
$language['categoryEdit_tag_h1'] = 'Balise &lt;h1&gt;&lt;/h1&gt; (facultatif)';
$language['categoryEdit_meta'] = 'Meta description (facultatif)';
$language['categoryEdit_possible_sub'] = 'Soumission autorisée';
$language['categoryEdit_forbidden'] = 'Catégorie filtrée';
$language['categoryEdit_forbidden_desc'] = 'Les sites présents dans cette catégorie ne seront pas affichés dans les différents top, la page nouveautés, le moteur de recherche, les sites au hasard sur la page index.';
$language['categoryEdit_category_image'] = 'Image de la catégorie';
$language['categoryEdit_category_image_desc'] = 'Permet de définir une image pour la catégorie.';
$language['categoryEdit_text_description'] = 'Texte qui sera affiché dans la catégorie (facultatif)';
$language['categoryEdit_text_description_desc'] = 'Créer une description pour obtenir un contenu plus ciblé pour le SEO';
$language['categoryEdit_add_new_fields'] = 'Ajouter un nouveau champ';
$language['categoryEdit_field_name'] = 'Nom du champ';
$language['categoryEdit_select_type_field'] = 'Sélectionner le type du champ';
$language['categoryEdit_type_text'] = 'Text';
$language['categoryEdit_type_textarea'] = 'Textarea';
$language['categoryEdit_type_radio'] = 'Radio button';
$language['categoryEdit_type_check'] = 'Checkbox';
$language['categoryEdit_type_select'] = 'Select list';
$language['categoryEdit_type_range'] = 'Range';
$language['categoryEdit_type_url'] = 'URL';
$language['categoryEdit_type_file'] = 'Fichier';
$language['categoryEdit_mandatory_field'] = 'Champ obligatoire';
$language['categoryEdit_suffix'] = 'Suffixe (facultatif)';
$language['categoryEdit_anchor'] = 'Ancre texte';
$language['categoryEdit_nofollow'] = 'Nofollow';
$language['categoryEdit_extensions'] = 'Extensions autorisées';
$language['categoryEdit_extensions_desc'] = 'Liste des extensions que vous autorisez séparées par une virgule. Exemple : odt, zip, txt, doc, xls, pdf';
$language['categoryEdit_maxSize'] = 'Poids max';
$language['categoryEdit_maxSize_desc'] = 'Poids maximum du fichier en KB';
$language['categoryEdit_field_description'] = 'Description du champ (facultatif)';
$language['categoryEdit_field_description_desc'] = 'Une image apparaît à côté du champ. En passant la souris sur l\'image, la description apparaîtra';
$language['categoryEdit_add_new_option'] = 'Ajouter une option';
$language['categoryEdit_quick_add'] = 'Ajout rapide';
$language['categoryEdit_quick_add_desc'] = 'En cliquant sur le lien Ajout rapide, vous pouvez ajouter de nombreuses options rapidement. Pour cela, ajoutez une option par ligne. Cliquez sur le bouton Ajouter, avant de créer le champ';
$language['categoryEdit_button_add'] = 'Ajouter';
$language['categoryEdit_option'] = 'Option';
$language['categoryEdit_button_create_field'] = 'Créer le champ';
$language['categoryEdit_organization'] = 'Organisation des champs (ordre, moteur de recherche...)';
$language['categoryEdit_th_name'] = 'Nom';
$language['categoryEdit_th_type'] = 'Type';
$language['categoryEdit_th_desc'] = 'Description';
$language['categoryEdit_th_search'] = 'Dans le moteur de recherche';
$language['categoryEdit_th_mandatory'] = 'Obligatoire';
$language['categoryEdit_th_management'] = 'Gestion';

// index.tpl
$language['categoryIndex_html_title'] = 'Gestion des catégories et des sites';
$language['categoryIndex_meta_description'] = 'Gestion des catégories et des sites';
$language['categoryIndex_arbo'] = 'Gestion des catégories et des sites';
$language['categoryIndex_h1'] = 'Gestion des catégories et des sites';
$language['categoryIndex_th_categories'] = 'Nom de la catégorie';
$language['categoryIndex_th_sub'] = 'Soumission autorisée';
$language['categoryIndex_th_management'] = 'Gestion';
$language['categoryIndex_create_category'] = 'Créer une catégorie';
$language['categoryIndex_create_subcategory_in'] = 'Créer une sous-catégorie dans';
$language['categoryIndex_websites_in_category'] = 'Sites dans la categorie';
$language['categoryIndex_th_websites'] = 'Nom des sites';
$language['categoryIndex_th_banned'] = 'Le site est banni';
$language['categoryIndex_th_backlink'] = 'Lien retour';
$language['categoryIndex_add_website_in'] = 'Ajouter un site dans';
$language['categoryIndex_general_information'] = 'Informations générales ';
$language['categoryIndex_website_language'] = 'Langue du site';
$language['categoryIndex_select_website_language'] = 'Sélectionner la langue du site';
$language['categoryIndex_webmaster'] = 'Webmaster';
$language['categoryIndex_admin'] = 'Admin';
$language['categoryIndex_name'] = 'Nom';
$language['categoryIndex_email'] = 'Email';
$language['categoryIndex_website_title'] = 'Titre du site';
$language['categoryIndex_website_adress'] = 'Adresse du site (URL)';
$language['categoryIndex_button_metas'] = 'Metas';
$language['categoryIndex_rss_feed_title'] = 'Titre du Flux Rss';
$language['categoryIndex_rss_feed_url'] = 'Adresse du Flux Rss (URL';
$language['categoryIndex_backlink_adress'] = 'Adresse du lien retour (URL)';
$language['categoryIndex_website_description'] = 'Description du site';
$language['categoryIndex_website_description_html_text'] = 'Texte';
$language['categoryIndex_website_description_html_admin'] = 'Html administrateur';
$language['categoryIndex_website_description_characters'] = 'caractères';
$language['categoryIndex_photos'] = 'Images';
$language['categoryIndex_add_photos'] = 'Ajouter des images';
$language['categoryIndex_add_an_photos'] = 'Ajouter une image';
$language['categoryIndex_new_fields'] = 'Champs supplémentaires';
$language['categoryIndex_keywords'] = 'Mots clés';
$language['categoryIndex_keyword'] = 'Mot clé';
$language['categoryIndex_select_keyword'] = 'Sélectionner un mot clé';
$language['categoryIndex_company_information'] = 'Informations sur la société ';
$language['categoryIndex_adress'] = 'Adresse';
$language['categoryIndex_postal_code'] = 'Code postal';
$language['categoryIndex_city'] = 'Ville';
$language['categoryIndex_country'] = 'Pays';
$language['categoryIndex_phone'] = 'Téléphone';
$language['categoryIndex_fax'] = 'Fax';
$language['categoryIndex_others_info'] = 'Autres informations, configurations ';
$language['categoryIndex_priority'] = 'Ordre de Priorité';
$language['categoryIndex_checking'] = 'Vérification du site en cours...';
$language['categoryIndex_advertisement_in'] = 'Publicité dans';
$language['categoryIndex_predefine_ad'] = 'Prédéfinir la position de la publicité';
$language['categoryIndex_predefine_ad_desc1'] = 'Si cette option est activée, les publicités seront activées automatiquement.';
$language['categoryIndex_predefine_ad_desc2'] = 'Les publicités seront affichées dans la catégorie et sur le site en fonction de vos paramètres.';
$language['categoryIndex_category_name'] = 'Nom de la catégorie';
$language['categoryIndex_category'] = 'Catégorie';
$language['categoryIndex_category_description'] = 'Texte descriptif de la catégorie, si vous en avez entré une...';
$language['categoryIndex_h2_predefine_in'] = 'Prédéfinir la position de la publicité dans la page détails des sites de la catégorie';
$language['categoryIndex_predefine_position_ad'] = 'Prédéfinir la position de la publicité';
$language['categoryIndex_predefine_position_desc1'] = 'Si cette option est activée, les publicités seront activées automatiquement.';
$language['categoryIndex_predefine_position_desc2'] = 'Vous pouvez gérer la publicité très facilement dans tous les sites de cette catégorie. Son but principal est de modifier ou adapter une régie spécialisée pour des catégories spéciales (sites x, casino...).';
$language['categoryIndex_h2_predefine'] = 'Prédéfinir la position de la publicité dans les sites';


//// --> template/templateName/comment/
// index.tpl
$language['commentIndex_html_title'] = 'Gestion des commentaires';
$language['commentIndex_meta_description'] = 'Gestion des commentaires';
$language['commentIndex_arbo'] = 'Gestion des commentaires';
$language['commentIndex_h1'] = 'Gestion des commentaires';
$language['commentIndex_validated'] = 'Commentaires validés';
$language['commentIndex_not_validated'] = 'Commentaires non validés';
$language['commentIndex_th_comment'] = 'Commentaire';
$language['commentIndex_th_website'] = 'Site';
$language['commentIndex_th_user'] = 'Utilisateur';
$language['commentIndex_th_date'] = 'Date';
$language['commentIndex_th_ip'] = 'IP';
$language['commentIndex_th_validated'] = 'Validé';
$language['commentIndex_th_management'] = 'Gestion';


//// --> template/templateName/extraField/
// edit.tpl
$language['extraFieldEdit_html_title'] = 'Modifier le champ supplémentaire';
$language['extraFieldEdit_meta_description'] = 'Modifier le champ supplémentaire';
$language['extraFieldEdit_arbo'] = 'Modifier le champ supplémentaire';
$language['extraFieldEdit_h1'] = 'Modifier le champ supplémentaire';

// itemForm.tpl
$language['extraFieldItemForm_select_option'] = 'Sélectionner une option';
$language['extraFieldItemForm_url'] = 'URL';
$language['extraFieldItemForm_anchor_text'] = 'Ancre texte';
$language['extraFieldItemForm_file'] = 'Fichier';
$language['extraFieldItemForm_file_title'] = 'Nom du fichier';


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


//// --> template/templateName/keyword/
// edit.tpl
$language['keywordEdit_html_title'] = 'Modifier le mot clé';
$language['keywordEdit_meta_description'] = 'Modifier le mot clé';
$language['keywordEdit_arbo'] = 'Modifier le mot clé';
$language['keywordEdit_h1'] = 'Modifier le mot clé';
$language['keywordEdit_name'] = 'Nom';
$language['keywordEdit_text_description'] = 'Texte qui sera affiché dans le mot clé (facultatif)';
$language['keywordEdit_text_description_desc'] = 'Créer une description pour obtenir un contenu plus ciblé pour le SEO';

// index.tpl
$language['keywordIndex_html_title'] = 'Mots clés';
$language['keywordIndex_meta_description'] = 'Mots clés';
$language['keywordIndex_arbo'] = 'Mots clés';
$language['keywordIndex_h1'] = 'Cliquer sur la lettre ou le nombre pour gérer les mots clés';
$language['keywordIndex_h2'] = 'Créer un mot clé';

// letter.tpl
$language['keywordLetter_html_title'] = 'Liste des mots clés commençant par';
$language['keywordLetter_meta_description'] = 'Liste des mots clés commençant par';
$language['keywordLetter_arbo'] = 'Liste des mots clés commençant par';
$language['keywordLetter_h2'] = 'Liste des mots clés commençant par';
$language['keywordLetter_th_name'] = 'Nom';
$language['keywordLetter_h2_ad'] = 'Publicité dans la liste des mots clés commençant par';
$language['keywordLetter_keyword'] = 'Mot clé';

// show.tpl
$language['keywordShow_html_title'] = 'Gestion des sites ayant pour mot clé';
$language['keywordShow_meta_description'] = 'Gestion des sites ayant pour mot clé';
$language['keywordShow_arbo'] = 'Gestion des sites ayant pour mot clé';
$language['keywordShow_h1'] = 'Gestion des sites ayant pour mot clé';
$language['keywordShow_th_banned'] = 'Le site est banni';
$language['keywordShow_h2_ad'] = 'Publicité dans le mot clé';
$language['keywordShow_predefine_ad'] = 'Prédéfinir la position de la publicité';
$language['keywordShow_predefine_ad_desc1'] = 'Si cette option est activée, les publicités seront activées automatiquement.';
$language['keywordShow_predefine_ad_desc2'] = 'Les publicités seront affichées dans le mot clé en fonction de vos paramètres.';


//// --> template/templateName/main/
// index.tpl
$language['mainIndex_html_title'] = 'Index de l\'administration';
$language['mainIndex_meta_description'] = 'Index de l\'administration';
$language['mainIndex_arbo'] = 'Index de l\'administration';
$language['mainIndex_h1'] = 'Bienvenue sur Arfooo Annuaire';
$language['mainIndex_desc1'] = 'Bienvenue sur Arfooo Annuaire..';
$language['mainIndex_desc2'] = 'Le support est disponible sur le';
$language['mainIndex_desc3'] = 'forum.';
$language['mainIndex_desc4'] = 'Nous vous souhaitons une bonne gestion de votre Annuaire Arfooo.';
$language['mainIndex_th_stats'] = 'Statistiques';
$language['mainIndex_th_value'] = 'Valeur';
$language['mainIndex_referenced'] = 'Sites acceptés';
$language['mainIndex_pending'] = 'Sites en attente';
$language['mainIndex_rejected'] = 'Sites refusés';
$language['mainIndex_banned'] = 'Sites bannis';
$language['mainIndex_keywords'] = 'Mots clés';
$language['mainIndex_categories'] = 'Catégories';
$language['mainIndex_open'] = 'Date d\'ouverture de l\'annuaire';
$language['mainIndex_webmasters'] = 'Webmasters';
$language['mainIndex_version'] = 'Version de l\'annuaire';
$language['mainIndex_db'] = 'Taille de la base de données';
$language['mainIndex_reset_part'] = 'Remettre à 0 certaines parties de l\'annuaire';
$language['mainIndex_run'] = 'Exécuter';
$language['mainIndex_reset_hits'] = 'Remettre le top hits à 0';
$language['mainIndex_reset_hits_desc'] = 'Permet de remettre le top hits à 0';
$language['mainIndex_reset_rating'] = 'Remettre le top notes à 0';
$language['mainIndex_reset_rating_desc'] = 'Permet de remettre le top notes à 0';
$language['mainIndex_reset_referrers'] = 'Remettre le top referrers à 0';
$language['mainIndex_reset_referrers_desc'] = 'Permet de remettre le top referrers à 0';
$language['mainIndex_clear_cache'] = 'Vider le cache';
$language['mainIndex_clear_cache_desc'] = 'Permet de vider le cache ainsi que toutes les requêtes mises en cache';
$language['mainIndex_clear_cache_pr'] = 'Vider le cache du PageRank et des informations Google';
$language['mainIndex_clear_cache_pr_desc'] = 'Permet de vider le cache du PageRank et des informations Google. A utiliser uniquement après chaque export du PR';
$language['mainIndex_url'] = 'Générer le nom des URLs, le format';
$language['mainIndex_url_desc'] = 'Permet de générer le format des URLs. Vous devez utiliser cette fonction, après la création de chaque nouvelle sous-catégorie, uniquement si vous utilisez la méthode 2, pour obtenir le format des URL suivant : http://www.exemple.com/categorie/subcategorie/ autrement le format sera le suivant : http://www.exemple.com/subcategorie/ sans l\'injection des catégories précédentes';
$language['mainIndex_reset_category_order'] = 'Reclasser les catégories par ordre alphabétique';
$language['mainIndex_reset_category_order_desc'] = 'Permet de reclasser les catégories et sous-catégories par ordre alphabétique';

// logIn.tpl
$language['mainLogIn_html_title'] = 'Se connecter à l\'administration d\'Arfooo Annuaire';
$language['mainLogIn_meta_description'] = 'Se connecter à l\'administration d\'Arfooo Annuaire';
$language['mainLogIn_login'] = 'Identifiant';
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
$language['menuMenuHeader_settings'] = 'Configurations';
$language['menuMenuHeader_ad'] = 'Publicité';
$language['menuMenuHeader_users'] = 'Utilisateurs';
$language['menuMenuHeader_templates'] = 'Templates';
$language['menuMenuHeader_plugins'] = 'Plugins';
$language['menuMenuHeader_system'] = 'Système';

// /menuleft/login.tpl
$language['menuLeftLogIn_login'] = 'Vous êtes connecté en tant que';
$language['menuLeftLogIn_logout'] = 'Déconnexion';

// /menuleft/menuleftAdsense.tpl
$language['menuLeftAd_criteria'] = 'Critères';
$language['menuLeftAd_manage_criteria'] = 'Gestions des critères';
$language['menuLeftAd_ad'] = 'Publicité';
$language['menuLeftAd_ad_index'] = 'Publicité dans l\'index';
$language['menuLeftAd_ad_news'] = 'Publicité dans les nouvautés';
$language['menuLeftAd_ad_top_hits'] = 'Publicité dans le top hits';
$language['menuLeftAd_ad_top_rating'] = 'Publicité dans le top notes';
$language['menuLeftAd_ad_top_rank'] = 'Publicité dans le top rank';
$language['menuLeftAd_ad_top_ref'] = 'Publicité dans le top referrers';
$language['menuLeftAd_ad_search'] = 'Publicité dans le moteur de recherche';
$language['menuLeftAd_ad_contact'] = 'Publicité dans la page contact';
$language['menuLeftAd_ad_404'] = 'Publicité dans le page 404 erreur';
$language['menuLeftAd_ad_allcat'] = 'Publicité dans la page allcatégorie';
$language['menuLeftAd_ad_predefine'] = 'Prédéfinir la publicité';
$language['menuLeftAd_ad_predefine_cat'] = 'Catégories';
$language['menuLeftAd_ad_predefine_websites'] = 'Sites';
$language['menuLeftAd_ad_predefine_keywords'] = 'Mots clés';
$language['menuLeftAd_ad_predefine_tags'] = 'Tags';

// /menuleft/menuleftIndex.tpl
$language['menuLeftIndex_site_cat'] = 'Sites et catégories';
$language['menuLeftIndex_pending'] = 'Sites en attente';
$language['menuLeftIndex_problem'] = 'Sites avec problème';
$language['menuLeftIndex_error'] = 'Sites avec erreur';
$language['menuLeftIndex_banned'] = 'Sites bannis';
$language['menuLeftIndex_search'] = 'Rechercher des sites';
$language['menuLeftIndex_keywords'] = 'Mots clés';
$language['menuLeftIndex_manage_keywords'] = 'Gestion des mots clés';
$language['menuLeftIndex_tags'] = 'Tags Cloud';
$language['menuLeftIndex_manage_tags'] = 'Gérer les tags';
$language['menuLeftIndex_referrers'] = 'Referrers';
$language['menuLeftIndex_manage_referrers'] = 'Gérer les referrers';
$language['menuLeftIndex_comments'] = 'Commentaires';
$language['menuLeftIndex_manage_comments'] = 'Gérer les commentaires';
$language['menuLeftIndex_sitemap'] = 'Google sitemap';
$language['menuLeftIndex_generate_sitemap'] = 'Générer le sitemap / voir';

// /menuleft/menuleftPlugins.tpl
$language['menuLeftPlugins_plugins'] = 'Plugins';
$language['menuLeftPlugins_manage_plugins'] = 'Gérer les plugins';

// /menuleft/menuleftSettings.tpl
$language['menuLeftSettings_settings'] = 'Configurations';
$language['menuLeftSettings_main_settings'] = 'Configurations principales';
$language['menuLeftSettings_detail_page'] = 'Pages détails des sites';
$language['menuLeftSettings_images_thumbs'] = 'Images, photos, thumbs';
$language['menuLeftSettings_submission'] = 'Inscription des sites';
$language['menuLeftSettings_html'] = 'Html';
$language['menuLeftSettings_duplicate'] = 'Duplication de contenu';
$language['menuLeftSettings_google_info'] = 'Informations Google';
$language['menuLeftSettings_emails'] = 'Emails & newsletter';
$language['menuLeftSettings_stats'] = 'Statistiques';
$language['menuLeftSettings_captcha'] = 'Captcha - Code de securité';
$language['menuLeftSettings_searcher'] = 'Moteur de recherche';
$language['menuLeftSettings_cache'] = 'Cache & optimisation';
$language['menuLeftSettings_rss'] = 'Flux RSS';
$language['menuLeftSettings_text'] = 'Texte';
$language['menuLeftSettings_dir_desc'] = 'Description de l\'annuaire';
$language['menuLeftSettings_terms'] = 'Conditions d\'utilisation';
$language['menuLeftSettings_email'] = 'Emails';
$language['menuLeftSettings_pay_sys'] = 'Système de paiement';
$language['menuLeftSettings_pay_proc'] = 'Moyen de paiement';
$language['menuLeftSettings_manage_criteria'] = 'Gérer les critères';
$language['menuLeftSettings_campaign_tracking'] = 'Tracker ses campagnes mails/autres';
$language['menuLeftSettings_manage_filters'] = 'Gérer les fitres';

// /menuleft/menuleftSystem.tpl
$language['menuLeftSystem_version'] = 'Version';
$language['menuLeftSystem_check_updates'] = 'Vérifier les mises à jour';
$language['menuLeftSystem_data_php'] = 'Base de données & PHP';
$language['menuLeftSystem_optimize'] = 'Optimiser les tables';
$language['menuLeftSystem_save'] = 'Sauvegarder';
$language['menuLeftSystem_restore'] = 'Restaurer';
$language['menuLeftSystem_system'] = 'Système';
$language['menuLeftSystem_infos'] = 'Informations';
$language['menuLeftSystem_check'] = 'Vérifier & mettre à jour';
$language['menuLeftSystem_update_thumbs'] = 'Mettre à jour les thumbs';
$language['menuLeftSystem_backlink'] = 'Vérifier les liens retour';
$language['menuLeftSystem_duplicate_content'] = 'Vérifier la duplication de contenu';

// /menuleft/menuleftTemplates.tpl
$language['menuLeftTemplates_templates'] = 'Templates';
$language['menuLeftTemplates_manage_templates'] = 'Gérer les templates';

// /menuleft/menuleftUsers.tpl
$language['menuLeftUsers_users'] = 'Utilisateurs';
$language['menuLeftUsers_change_pass'] = 'Changer votre mot de passe';
$language['menuLeftUsers_admin'] = 'Administrateurs';
$language['menuLeftUsers_moderators'] = 'Modérateurs';
$language['menuLeftUsers_webmasters'] = 'Webmasters';
$language['menuLeftUsers_security'] = 'Sécurité';
$language['menuLeftUsers_ban_ip'] = 'Bannir IPs';
$language['menuLeftUsers_ban_email'] = 'Bannir emails';
$language['menuLeftUsers_ban_website'] = 'Bannir sites';
$language['menuLeftUsers_ban_tags'] = 'Bannir tags';
$language['menuLeftUsers_newsletter'] = 'Newsletter';
$language['menuLeftUsers_send_newsletter'] = 'Envoyer la newsletter';
$language['menuLeftUsers_export_email'] = 'Exporter/importer emails';


//// --> template/templateName/plugin/
// edit.tpl
$language['pluginEdit_html_title'] = 'Plugins';
$language['pluginEdit_meta_description'] = 'Plugins';
$language['pluginEdit_arbo'] = 'Plugins';
$language['pluginEdit_h1'] = 'Informations sur les plugins';
$language['pluginEdit_h2'] = 'Liste & fonctions';

// index.tpl
$language['pluginIndex_html_title'] = 'Plugins';
$language['pluginIndex_meta_description'] = 'Plugins';
$language['pluginIndex_arbo'] = 'Plugins';
$language['pluginIndex_h1'] = 'Liste des plugins';
$language['pluginIndex_th_name'] = 'Nom des plugins';


//// --> template/templateName/referrer/
// index.tpl
$language['referrerIndex_html_title'] = 'Gérer les referrers';
$language['referrerIndex_meta_description'] = 'Gérer les referrers';
$language['referrerIndex_arbo'] = 'Gérer les referrers';
$language['referrerIndex_h1'] = 'Gérer les referrers';
$language['referrerIndex_desc1'] = 'Sur cette page vous pouvez gérer les referrers.';
$language['referrerIndex_th_name'] = 'Nom des sites';
$language['referrerIndex_th_visitors'] = 'Nombre de visiteurs';
$language['referrerIndex_reset'] = 'Remettre 0';


//// --> template/templateName/setting/
// condition.tpl
$language['settingCondition_html_title'] = 'Conditions d\'utilisation';
$language['settingCondition_meta_description'] = 'Conditions d\'utilisation';
$language['settingCondition_arbo'] = 'Conditions d\'utilisation';
$language['settingCondition_h1'] = 'Conditions d\'utilisation';
$language['settingCondition_desc'] = 'Entrer les conditions d\'utilisation de votre annuaire.';
$language['settingCondition_terms'] = 'Conditions d\'utilisation';

// description.tpl
$language['settingDescription_html_title'] = 'Description de l\'annuaire';
$language['settingDescription_meta_description'] = 'Description de l\'annuaire';
$language['settingDescription_arbo'] = 'Description de l\'annuaire';
$language['settingDescription_h1'] = 'Description de l\'annuaire';
$language['settingDescription_desc1'] = 'Décrivez votre annuaire.';
$language['settingDescription_desc2'] = 'La description apparaît sur l\'index de l\'annuaire.';
$language['settingDescription_desc3'] = 'Cela vous permettra d\'avoir un contenu plus important afin d\'améliorer votre référencement.';
$language['settingDescription_title'] = 'Titre';
$language['settingDescription_desc'] = 'Description';

// editEmail.tpl
$language['settingEditEmail_html_title'] = 'Editer l\'email';
$language['settingEditEmail_meta_description'] = 'Editer l\'email';
$language['settingEditEmail_arbo'] = 'Editer l\'email';
$language['settingEditEmail_h1'] = 'Editer l\'email';
$language['settingEditEmail_description'] = 'Description';
$language['settingEditEmail_subject'] = 'Sujet';

// editPackage.tpl
$language['settingEditPackage_html_title'] = 'Système de paiement - Modifier les critères';
$language['settingEditPackage_meta_description'] = 'Système de paiement - Modifier les critères';
$language['settingEditPackage_arbo'] = 'Système de paiement - Modifier les critères';
$language['settingEditPackage_h1'] = 'Système de paiement - Modifier les critères';
$language['settingEditPackage_criteria_name'] = 'Nom du critère';
$language['settingEditPackage_criteria_image'] = 'Image du critère (facultatif)';
$language['settingEditPackage_criteria_image_desc'] = 'Affiche une image spéciale pour le site qui a ce critère';
$language['settingEditPackage_price'] = 'Prix';
$language['settingEditPackage_price_desc'] = 'Indiquer le prix uniquement si vous utilisez Paypal';
$language['settingEditPackage_id_allopass'] = 'ID Allopass';
$language['settingEditPackage_id_allopass_desc'] = 'A remplir uniquement si vous utilisez Allopass';
$language['settingEditPackage_allopass_number'] = 'Nombre d\'Allopass';
$language['settingEditPackage_priority'] = 'Priorité';
$language['settingEditPackage_priority_desc'] = 'Fixe un ordre de priorité pour l\'affichage du site';
$language['settingEditPackage_characters_numb'] = 'Nombre de caractères maximum';
$language['settingEditPackage_characters_numb_desc'] = 'Nombre de caractères disponibles pour la description de chaque site';
$language['settingEditPackage_characters_min_numb'] = 'Nombre de caractères minimum';
$language['settingEditPackage_characters_min_numb_desc'] = 'Nombre de caractères minimum obligatoire pour la description de chaque site';
$language['settingEditPackage_keywords'] = 'Nombre de mots clés';
$language['settingEditPackage_keywords_desc'] = 'Nombre de mots clés associés pour chaque site';
$language['settingEditPackage_backlink'] = 'Lien retour obligatoire';
$language['settingEditPackage_html_enabled'] = 'Activer le html';
$language['settingEditPackage_html_allowed_tags'] = 'Tags html autorisés';
$language['settingEditPackage_html_allowed_css_properties'] = 'Attributs css autorisés';
$language['settingEditPackage_criteria_description'] = 'Description du critère';
$language['settingEditPackage_criteria_description_desc'] = 'Affiche une description du critère pour que les utilisateurs connaissent ses caractéristiques';

// editPaymentProcessor.tpl
$language['settingEditPaymentProcessor_html_title'] = 'Système de paiement - Gérer les moyens de paiement';
$language['settingEditPaymentProcessor_meta_description'] = 'Système de paiement - Gérer les moyens de paiement';
$language['settingEditPaymentProcessor_arbo'] = 'Système de paiement - Gérer les moyens de paiement';
$language['settingEditPaymentProcessor_h1'] = 'Système de paiement - Gérer les moyens de paiement';
$language['settingEditPaymentProcessor_payment_method_name'] = 'Nom du moyen de paiement';
$language['settingEditPaymentProcessor_display_name'] = 'Nom affiché';
$language['settingEditPaymentProcessor_enabled'] = 'Activé';
$language['settingEditPaymentProcessor_currency'] = 'Devise';
$language['settingEditPaymentProcessor_email'] = 'Email';
$language['settingEditPaymentProcessor_test'] = 'Mode test';

// email.tpl
$language['settingEmail_html_title'] = 'Emails - Gérer les emails';
$language['settingEmail_meta_description'] = 'Emails - Gérer les emails';
$language['settingEmail_arbo'] = 'Emails - Gérer les emails';
$language['settingEmail_h1'] = 'Gérer les emails - Liste des emails';
$language['settingEmail_desc1'] = 'Vous pouvez personnaliser les différents emails envoyés aux webmasters et à l\'administrateur sur cette page.';
$language['settingEmail_desc2'] = 'Vous pouvez créer des emails personnalisés, puis les sélectionner lors de la gestion des sites en attente, puis les envoyer.';
$language['settingEmail_desc3'] = 'L\'email de test est envoyé à l\'administrateur de l\'annuaire.';
$language['settingEmail_th_email'] = 'Email';
$language['settingEmail_test'] = 'Envoyer l\'email de test';
$language['Do you really want send test email?'] = 'Voulez-vous envoyer l\'email de test?';
$language['settingEmail_add_email'] = 'Ajouter un email';
$language['settingEmail_desc'] = 'Description';
$language['settingEmail_subject'] = 'Sujet';

// index.tpl
$language['settingIndex_html_title'] = 'Configuration de l\'annuaire';
$language['settingIndex_meta_description'] = 'Configuration de l\'annuaire';
$language['settingIndex_arbo'] = 'Configuration de l\'annuaire';
$language['settingIndex_h1'] = 'Configuration générale';
$language['settingIndex_explain'] = 'Explication';
$language['settingIndex_value'] = 'Valeur';
$language['settingIndex_select_language'] = 'Sélectionner la langue de l\'annuaire';
$language['settingIndex_dir_title'] = 'Titre de l\'annuaire';
$language['settingIndex_dir_title_desc'] = 'Balise title présente sur la page index';
$language['settingIndex_dir_meta_desc'] = 'Meta description de l\'annuaire';
$language['settingIndex_dir_meta_desc_desc'] = 'Balise meta description présente sur la page index';
$language['settingIndex_admin_email'] = 'Email de l\'administrateur';
$language['settingIndex_dir_url'] = 'Adresse de l\'annuaire (URL)';
$language['settingIndex_date_format'] = 'Format de la date';
$language['settingIndex_url_rewrite'] = 'Activer l\'URL rewrite';
$language['settingIndex_url_rewrite_mode'] = 'URL rewrite mode';
$language['settingIndex_url_rewrite_mode_desc'] = 'Le mode 1 est un mode classique, sans l\'injection des catégories et sous catégories dans les URLs: http://www.arfooo.com/website-title-s1.html. Le mode 2 est un mode avancé, avec l\'injection des catégories et sous catégories dans les URLs: http://www.arfooo.com/category/subcategory/website-title-s1.html';
$language['settingIndex_url_rewrite_parents'] = 'URL rewrite : Injection des catégories dans l\'URL';
$language['settingIndex_url_rewrite_parents_desc'] = 'Si vous mettez à oui, les URLs contiendront l\'ensemble des catégories et sous-catégories parents du site. ATTENTION : Après chaque nouvelle sous-catégorie créée, vous devez aller sur la page d\'accueil de votre admin et appuyer sur le bouton exécuter pour Générer le nom des URLs, le format. Si vous mettez à non, les URLs contiendront uniquement la catégorie à laquelle appartient le site.';
$language['settingIndex_sites_in_parent_categories'] = 'Classement des sites dans les catégories mode';
$language['settingIndex_sites_in_parent_categories_desc'] = 'Le mode 1 est une mode classique. Les sites sont affichés uniquement dans la catégorie sélectionnée lors de la soumission. Le mode 2 est un mode avancé. Les sites sont affichés dans la catégorie sélectionnée lors de la soumission mais également dans les catégories parents. Exemple : Le site est soumis dans la catégorie http://www.arfooo.com/categorie-1/sous-categorie-1/sous-categorie-2/. Le site sera alors affiché dans les 3 catégories et pas uniquement la dernière.';
$language['settingIndex_order_by'] = 'Sites classés par';
$language['settingIndex_order_by_date'] = 'Date de validation';
$language['settingIndex_order_by_ref'] = 'Referrers';
$language['settingIndex_order_by_alph'] = 'Ordre alphabétique';
$language['settingIndex_domain'] = 'Un domaine peut être présent dans "x" catégories';
$language['settingIndex_domain_subpage'] = 'Nombre de pages secondaires d\'un domaine pouvant être présent';
$language['settingIndex_new_website'] = 'Un site sera considéré comme nouveau durant "x" jours';
$language['settingIndex_number_char_page'] = 'Nombre de caractères affichés pour la description des sites sur les pages de l\'annuaire';
$language['settingIndex_number_char_page_desc'] = 'Seule la page détails des sites affichera la description complète';
$language['settingIndex_vertical_menu'] = 'Afficher le menu vertical contenant les catégories';
$language['settingIndex_display_news'] = 'Afficher la page nouveautés';
$language['settingIndex_display_top_hits'] = 'Afficher le top hits';
$language['settingIndex_display_top_rate'] = 'Afficher top notes';
$language['settingIndex_display_top_rank'] = 'Afficher top rank';
$language['settingIndex_display_top_ref'] = 'Afficher top referrers';
$language['settingIndex_display_allcat'] = 'Afficher la page allcategories';
$language['settingIndex_display_contact'] = 'Afficher la page de contact';
$language['settingIndex_number_website_cat'] = 'Nombre de sites à afficher dans les catégories et sous-catégories';
$language['settingIndex_number_website_key'] = 'Nombre de sites à afficher dans les mots clés';
$language['settingIndex_number_website_search'] = 'Nombre de sites à afficher dans le moteur de recherche';
$language['settingIndex_number_website_top_hits'] = 'Nombre de sites à afficher dans le top hits';
$language['settingIndex_number_website_top_rate'] = 'Nombre de sites à afficher dans le top notes';
$language['settingIndex_number_website_top_rank'] = 'Nombre de sites à afficher dans le top rank';
$language['settingIndex_number_website_top_ref'] = 'Nombre de sites à afficher dans le top referrers';
$language['settingIndex_number_website_news'] = 'Nombre de sites à afficher dans les nouveautés';
$language['settingIndex_number_sub_cat'] = 'Nombre de sous-catégories à afficher en dessous des catégories';
$language['settingIndex_display_keywords'] = 'Afficher les mots clés';
$language['settingIndex_number_keywords'] = 'Si Oui, alors le nombre de mots clés associés pour chaque site';
$language['settingIndex_display_tags'] = 'Afficher le tag cloud';
$language['settingIndex_display_before_tags'] = 'Nombre de tags recherchés avant d\'afficher le tag cloud';
$language['settingIndex_number_tags'] = 'Nombre de tags affichés dans le tag cloud';
$language['settingIndex_number_random_website'] = 'Le nombre de sites aléatoires à afficher sur l\'index';
$language['settingIndex_number_random_website_renew'] = 'Le nombre de site aléatoire sur l\'index sera renouvelé tous les "X" jours';
$language['settingIndex_button_renew_random'] = 'Générer une nouvelle sélection';
$language['settingIndex_top_ref_renew'] = 'Le top referrers sera remis à 0 tous les "X" jours';
$language['settingIndex_button_renew_ref'] = 'Remettre à 0 le top referrers';
$language['settingIndex_enable_gzip'] = 'Activer la compression Gzip';
$language['settingIndex_compr_template'] = 'Activer la compression du template';
$language['settingIndex_enbable_check_template'] = 'Activer la vérification du template pour chaque affichage de page';
$language['settingIndex_enbable_check_template_desc'] = 'Désactiver cette option uniquement si vous ne procédez plus à aucune modification de votre template';
$language['settingIndex_count_referrers'] = 'Activer le compte des referrers';
$language['settingIndex_count_referrers_desc'] = 'Activer cette option seulement si vous affichez le top referrers ou si vous affichez les sites via le nombre de referrers';
$language['settingIndex_cache_detail_page'] = 'Activer le cache pour la page détails des sites';
$language['settingIndex_cache_detail_page_life'] = 'Durée du cache pour la page détails des sites (en secondes)';
$language['settingIndex_error_handler_save_to_file'] = 'Sauvegarder les erreurs, bugs dans un fichier';
$language['settingIndex_error_handler_display_error'] = 'Afficher les erreurs, bugs';
$language['settingIndex_h2_detail_page'] = 'Pages détails des sites';
$language['settingIndex_display_rss_feed'] = 'Afficher, parser le flux RSS des sites';
$language['settingIndex_number_item_rss'] = 'Nombre d\'item affichés pour le parsage du flux RSS';
$language['settingIndex_number_char_rss'] = 'Nombre de caractères affichés pour le parsage du flux RSS';
$language['settingIndex_number_days_delete_rss_cache'] = 'Nombre de jours avant de supprimer le cache du flux RSS';
$language['settingIndex_display_company_info'] = 'Afficher les informations sur la société (adresse, ville, tel...)';
$language['settingIndex_display_google_map'] = 'Afficher Google Maps';
$language['settingIndex_google_map_key'] = 'Google Maps API Key';
$language['settingIndex_display_random_websites_detail_page'] = 'Afficher les sites aléatoires sur la page détails des sites';
$language['settingIndex_display_random_websites_detail_page_desc'] = 'Afficher les sites aléatoires sur la page détails des sites vous permet d\'améliorer votre linkage interne';
$language['settingIndex_condition_common_keyword'] = 'Les sites aléatoires seront affichés uniquement s\'ils ont un mot clé commun';
$language['settingIndex_number_random_websites_displayed_detail'] = 'Nombre de site aléatoire affiché sur la page détails des sites';
$language['settingIndex_number_char_random_web'] = 'Nombre de caractères affichés pour la description des sites aléatoires';
$language['settingIndex_enable_comments'] = 'Activer les commentaires';
$language['settingIndex_validated_comments'] = 'Activer la validation automatique des commentaires';
$language['settingIndex_h2_images_thumbs'] = 'Images - photos - thumbs';
$language['settingIndex_display_image_beside_cat'] = 'Afficher les images à côté des catégories';
$language['settingIndex_image_beside_web'] = 'Afficher les images à côté des sites';
$language['settingIndex_enable_ascreen'] = 'Activer Ascreen';
$language['settingIndex_enable_ascreen_desc'] = 'Si Ascreen est activé, l\'Ascreen sera toujours cherché et affiché en premier. Le service de génération d\'image sera alors utilisé si aucun Ascreen n\'est trouvé';
$language['settingIndex_url_generation_thumbs'] = 'Adresse du service de génération de thumbs (URL)';
$language['settingIndex_url_generation_thumbs_desc'] = 'Vous pouvez utiliser le joker [url] comme paramètre pour pouvoir utiliser différents paramètres de votre service de génération d\'image. Exemple: http://www.yourservice.com/src/[url]@320x240';
$language['settingIndex_save_thumbs'] = 'Rapatrier, sauvegarder les images des sites dans le répertoire uploads/thumbs_images';
$language['settingIndex_country_flag'] = 'Afficher le drapeau des pays';
$language['settingIndex_country_flag_desc'] = 'Permet d\'indiquer la langue des sites';
$language['settingIndex_enable_gallery_image'] = 'Activer l\'upload d\'images par les utilisateurs';
$language['settingIndex_images_uploaded'] = 'Les images uploadées par les utilisateurs seront affichées en priorité';
$language['settingIndex_images_uploaded_desc'] = 'Les thumbs ne seront pas affichés si des images sont uploadées';
$language['settingIndex_number_images_web'] = 'Nombre d\'image pour chaque site';
$language['settingIndex_image_weight'] = 'Poids maximum d\'une image';
$language['settingIndex_image_watermark'] = 'Image watermark (copyright)';
$language['settingIndex_image_watermark_on'] = 'Si le watermark est activé';
$language['settingIndex_dl_watermark'] = 'Télécharger le watermark';
$language['settingIndex_where_watermark'] = 'Où est affiché le watermark sur l\'image';
$language['settingIndex_where_top_right'] = 'En haut à droite';
$language['settingIndex_where_top_left'] = 'En haut à gauche';
$language['settingIndex_where_bot_right'] = 'En bas à droite';
$language['settingIndex_where_bot_left'] = 'En bas à gauche';
$language['settingIndex_medium_image'] = 'Dimensions des images de style "medium"';
$language['settingIndex_small_image'] = 'Dimensions des images de style "small"';
$language['settingIndex_micro_image'] = 'Dimensions des images de style "micro"';
$language['settingIndex_width'] = 'Largeur';
$language['settingIndex_height'] = 'Hauteur';
$language['settingIndex_h2_website_registration'] = 'Inscription / soumission des sites';
$language['settingIndex_submission_available_type'] = 'Sélectionner le type de soumission disponible';
$language['settingIndex_sub_free'] = 'Gratuit';
$language['settingIndex_sub_premium'] = 'Payant';
$language['settingIndex_sub_both'] = 'Gratuit & Payant';
$language['settingIndex_registration_mandatory'] = 'Les webmasters doivent s\'enregistrer pour inscrire leurs sites';
$language['settingIndex_dir_website_only'] = 'Annuaire de site uniquement';
$language['settingIndex_dir_website_only_desc'] = 'Si vous décidez de mettre cette option à non, Arfooo Annuaire peut être un annuaire de camping, de personnes (pages jaunes)... L\'inscription d\'un site avec une URL sera donc facultatif.';
$language['settingIndex_registration_open'] = 'Les inscriptions des sites sont ouvertes';
$language['settingIndex_registration_open_desc'] = 'Permet d\'ouvrir ou fermer l\'inscription des sites';
$language['settingIndex_validation_auto'] = 'Les sites sont automatiquement validés';
$language['settingIndex_check_code_website'] = 'Si Oui, vérifier si les sites sont accessibles';
$language['settingIndex_check_code_website_desc'] = 'Seul le code retour http 200 est considéré comme accessible';
$language['settingIndex_meta_button'] = 'Metas tags';
$language['settingIndex_meta_button_desc'] = 'Permet de pré-remplir les champs du formulaire grâce aux metas tags du site';
$language['settingIndex_char_availalbe_each_web'] = 'Nombre de caractères disponibles pour la description de chaque site';
$language['settingIndex_char_mandatory_each_web'] = 'Nombre de caractères obligatoires pour la description de chaque site';
$language['settingIndex_backlink_mandatory'] = 'Le lien retour est obligatoire';
$language['settingIndex_backlink_html_code1'] = 'Afficher le backlink html code 1';
$language['settingIndex_backlink_html_code1_text'] = 'Texte du backlink html code 1';
$language['settingIndex_backlink_html_code1_text_desc'] = 'Permet de personnaliser le texte du backlink, si vide alors le titre de votre annuaire sera affiché';
$language['settingIndex_backlink_html_code1_url'] = 'URL du Backlink html code 1';
$language['settingIndex_backlink_html_code1_url_desc'] = 'Permet de personnaliser l\'URL du backlink, si vide alors l\'URL de votre annuaire sera affichée';
$language['settingIndex_backlink_html_code2'] = 'Afficher le backlink html code 2';
$language['settingIndex_backlink_html_code2_text'] = 'Texte du backlink html code 2';
$language['settingIndex_website_protocols'] = 'URL protocoles autorisé';
$language['settingIndex_protocol_http'] = 'http';
$language['settingIndex_protocol_https'] = 'https';
$language['settingIndex_protocol_ftp'] = 'ftp';
$language['settingIndex_partnership'] = 'Activer la recherche de partenariat';
$language['settingIndex_partnership_desc'] = 'Les webmasters peuvent recevoir des contacts de partenariats par email. Formulaire présent sur la page détails des sites via un popup JS';
$language['settingIndex_h2_html_settings'] = 'Html configuration';
$language['settingIndex_site_description_html_enabled_for_admin'] = 'Activer le html pour l\'admin';
$language['settingIndex_available_html_tags_for_admin'] = 'Tags html autorisés pour l\'admin';
$language['settingIndex_available_css_attributes_for_admin'] = 'Attributs css autorisés pour l\'admin';
$language['settingIndex_site_description_html_enabled_for_users'] = 'Activer le html pour les utilisateurs';
$language['settingIndex_available_html_tags_for_users'] = 'Tags html autorisés pour les utilisateurs';
$language['settingIndex_available_css_attributes_for_users'] = 'Attributs css autorisés pour les utilisateurs';
$language['settingIndex_h2_duplication_checker'] = 'Duplication checker configuration';
$language['settingIndex_enable_checking_duplicate_content_submission_sites'] = 'Activer la vérification de la duplication de contenu à la soumission des sites';
$language['settingIndex_how_many_random_phrases_to_check'] = 'Combien de phrases aléatoires doivent être vérifiées';
$language['settingIndex_how_many_words_should_contain_a_phrase'] = 'Combien de mots doit contenir une phrase';
$language['settingIndex_how_many_of_checked_phrases_can_be_duplicated'] = 'Combien de phrases vérifiés peuvent être dupliquées';
$language['settingIndex_h2_google_info'] = 'Google informations';
$language['settingIndex_display_backlink_number'] = 'Afficher le nombre de backlinks';
$language['settingIndex_display_page_number'] = 'Afficher le nombre de pages indexées';
$language['settingIndex_display_pagerank'] = 'Afficher le PageRank';
$language['settingIndex_pagerank_mode1'] = 'Utiliser la méthode 1 pour générer le PageRank';
$language['settingIndex_to_test'] = 'Faire un test';
$language['settingIndex_test'] = 'Tester';
$language['settingIndex_pagerank_mode2'] = 'Utiliser la méthode 2 pour générer le PageRank';
$language['settingIndex_pagerank_mode2_url'] = 'Adresse du serveur distant pour générer le PageRank avec la méthode 2 (URL)';
$language['settingIndex_pagerank_cache'] = 'Durée de vie du cache pour le PageRank (en jours)';
$language['settingIndex_h2_stats'] = 'Statistiques';
$language['settingIndex_display_stats'] = 'Afficher les statistiques';
$language['settingIndex_stats_on'] = 'Si Oui, alors';
$language['settingIndex_display_approved_websites'] = 'Afficher le nombre de sites validés';
$language['settingIndex_display_pending_websites'] = 'Afficher le nombre de sites en attente';
$language['settingIndex_display_rejected_websites'] = 'Afficher le nombre de sites refusés';
$language['settingIndex_display_ban_websites'] = 'Afficher le nombre de sites bannis';
$language['settingIndex_display_numb_cat'] = 'Afficher le nombre de catégories';
$language['settingIndex_display_numb_keyword'] = 'Afficher le nombre de mots clés';
$language['settingIndex_display_numb_webmasters'] = 'Afficher le nombre de webmasters';
$language['settingIndex_h2_captcha'] = 'Captcha - Code de securité';
$language['settingIndex_captcha_registration'] = 'Afficher le captcha à l\'inscription des webmasters';
$language['settingIndex_captcha_sub'] = 'Afficher le captcha sur le formulaire d\'inscription des sites';
$language['settingIndex_captcha_sub_desc'] = 'Ce captcha est affiché uniquement quand les webmasters ne doivent pas créer de compte utilisateur';
$language['settingIndex_captcha_contact'] = 'Afficher le captcha sur la page du formulaire de contact';
$language['settingIndex_captcha_comment'] = 'Afficher le captcha pour poster un commentaire';
$language['settingIndex_h2_email'] = 'Email & Newsletter';
$language['settingIndex_email_confirm'] = 'Activer la confirmation par email';
$language['settingIndex_email_confirm_desc'] = 'Le webmaster doit confirmer son compte utilisateur ou la soumission des sites en cliquant sur un lien présent dans l\'email de confirmation';
$language['settingIndex_email_approved_website'] = 'Le webmaster reçoit un email quand son site est validé';
$language['settingIndex_email_rejected_website'] = 'Le webmaster reçoit un email quand son site est refusé';
$language['settingIndex_email_banned_website'] = 'Le webmaster reçoit un email quand son site est banni';
$language['settingIndex_email_submit_website'] = 'Le webmaster reçoit un email pour lui confirmer la soumission de son site';
$language['settingIndex_email_submit_website_admin'] = 'L\'administrateur reçoit un email quand un site est soumis';
$language['settingIndex_email_submit_comment_admin'] = 'L\'administrateur reçoit un email quand un nouveau commentaire est posté';
$language['settingIndex_email_submit_error_admin'] = 'L\'administrateur reçoit un email quand un utilisateur alerte qu\'un site a un problème';
$language['settingIndex_email_newsletter'] = 'Activer l\'inscription à la newsletter';
$language['settingIndex_h2_search_engine'] = 'Moteur de recherche';
$language['settingIndex_search_advanced'] = 'Activer le lien "Recherche avancée"';
$language['settingIndex_search_like'] = 'Activer la méthode LIKE';
$language['settingIndex_search_like_desc'] = 'En activant la methode LIKE, vous pouvez faire des recherche avec des mots d\'1 seule lettre. Autrement la méthode de base, est la méthode FULL TEXT, ne permettant de faire des recherches qu\'avec des mots de minimum 4 lettres. Nous vous recommandons de ne pas toucher au nombre de lettres minimum et maximum pour la méthode LIKE';
$language['settingIndex_search_like_min'] = 'Nombre de lettres minimum pour la méthode LIKE';
$language['settingIndex_search_like_max'] = 'Nombre de lettres maximum pour la méthode LIKE';
$language['settingIndex_search_operator'] = 'Opérateur logique par défaut';
$language['settingIndex_search_operator_and'] = 'AND';
$language['settingIndex_search_operator_or'] = 'OR';
$language['settingIndex_search_fields'] = 'Activer la recherche dans les champs';
$language['settingIndex_search_fields_title'] = 'Titre';
$language['settingIndex_search_fields_desc'] = 'Description';
$language['settingIndex_search_fields_url'] = 'URL';
$language['settingIndex_cache_optimization'] = 'Cache & optimisation';
$language['settingIndex_h2_rss_feeds'] = 'Flux RSS';
$language['settingIndex_rss_news'] = 'Afficher le flux RSS des nouveaux sites';
$language['settingIndex_rss_cat'] = 'Afficher le flux RSS pour chaque catégorie et sous-catégorie';
$language['settingIndex_rss_web'] = 'Afficher le flux RSS pour chaque site';

// package.tpl
$language['settingPackage_html_title'] = 'Système de paiement - Gérer les critères';
$language['settingPackage_meta_description'] = 'Système de paiement - Gérer les critères';
$language['settingPackage_arbo'] = 'Système de paiement - Gérer les critères';
$language['settingPackage_h1'] = 'Système de paiement - Gérer les critères';
$language['settingPackage_desc1'] = 'Activez uniquement le ou les moyens de paiement que si vous utilisez le ou les moyens de paiement sur tous vos critères.';
$language['settingPackage_desc2'] = 'Exemple: Si vous activez Allopass et Paypal, il faudra bien renseigner les champs du prix pour Paypal, l\'ID Allopass et le nombre d\'Allopass sur tous vos critères.';
$language['settingPackage_desc3'] = 'Pour utiliser Allopass et/ou Paypal, vous devez possédez un compte ou en créer un.';
$language['settingPackage_desc4'] = 'Créer un compte Allopass';
$language['settingPackage_desc5'] = 'Créer un compte Paypal';
$language['settingPackage_desc6'] = 'Pour utilisez Allopass, une fois votre compte créé, il faut vous rendre dans "Gestion des documents" puis "Ajouter un site".';
$language['settingPackage_desc7'] = 'Remplissez le "nom du site", choisissez la catégorie "Annuaire", puis indiquer l\'adresse (URL) où est installé votre annuaire.';
$language['settingPackage_desc8'] = 'Une fois le site ajouté, cliquez sur le nom du site, choisissez "micro-paiement à l\'acte" puis "Ajouter un document".';
$language['settingPackage_desc9'] = 'Remplissez le "nom du document", par exemple, bronze, argent, or...';
$language['settingPackage_desc10'] = 'Pour "URL de la page d\'accès" et "URL du document", indiquez simplement l\'URL où est installé votre annuaire.';
$language['settingPackage_desc11'] = 'Pour "URL d\'erreur", laissez vide.';
$language['settingPackage_desc12'] = 'Indiquez le nombre de code: 1, 2, 3, 4 ou 5.';
$language['settingPackage_desc13'] = 'Puis aller tout en bas de la page et décocher "Activation de My allopass".';
$language['settingPackage_desc14'] = 'Enfin validez, en appuyant sur le bouton "Envoi".';
$language['settingPackage_desc15'] = 'L\'ID Allopass est l\'identifiant Allopass du document que vous venez de créer.';
$language['settingPackage_desc16'] = 'Il ressemble à ça: "178941/458792/25479".';
$language['settingPackage_desc17'] = 'Pour le champ, "Le nombre d\'Allopass si vous utilisez Allopass" indiquer simplement le nombre de codes que vous avez choisi lors de la création du document.';
$language['settingPackage_desc18'] = 'Pour utiliser Paypal, il vous suffit de renseigner l\'adresse email de votre compte Paypal, dans le moyen de paiement paypal et de mettre à "Non" le "Mode test".';
$language['settingPackage_desc19'] = 'Puis indiquer le prix dans le champ: "Prix".';
$language['settingPackage_desc20'] = '!!! Attention !!!';
$language['settingPackage_desc21'] = 'Si vous indiquez un prix avec des centimes, exemple : 15.50, il faut utiliser le point "." et non la virgule ",". ';
$language['settingPackage_h2'] = 'Liste des critères';
$language['settingPackage_th_name'] = 'Nom du critère';
$language['settingPackage_h2_create'] = 'Créer un critère';

// paymentProcessor.tpl
$language['settingPaymentProcessor_html_title'] = 'Système de paiement - Gérer les moyens de paiement';
$language['settingPaymentProcessor_meta_description'] = 'Système de paiement - Gérer les moyens de paiement';
$language['settingPaymentProcessor_arbo'] = 'Système de paiement - Gérer les moyens de paiement';
$language['settingPaymentProcessor_h1'] = 'Système de paiement - Gérer les moyens de paiement';
$language['settingPaymentProcessor_th_payment_method_name'] = 'Nom du moyen de paiement';
$language['settingPaymentProcessor_th_enabled'] = 'Activé';


//// --> template/templateName/site/
// banned.tpl
$language['siteBanned_html_title'] = 'Sites bannis';
$language['siteBanned_meta_description'] = 'Sites bannis';
$language['siteBanned_show_arbo'] = 'Sites bannis';
$language['siteBanned_h1'] = 'Sites bannis';
$language['siteBanned_desc1'] = 'Retrouvez ci-dessous la liste des sites bannis.';
$language['siteBanned_desc2'] = 'Vous pouvez ainsi les gérer facilement.';
$language['siteBanned_th_website_name'] = 'Nom des sites';

// banSite.tpl
$language['siteBanSite_html_title'] = 'Bannir des sites';
$language['siteBanSite_meta_description'] = 'Bannir des sites';
$language['siteBanSite_arbo'] = 'Bannir des sites';
$language['siteBanSite_h1'] = 'Bannir des sites';
$language['siteBanSite_desc1'] = 'Pour bannir, un ou plusieurs sites, entrer 1 site par ligne';
$language['siteBanSite_desc2'] = 'Vous pouvez utiliser le caractère "*" comme joker pour bannir des sous-domaines entiers (blog, forum...)';
$language['siteBanSite_h2_unban'] = 'Débannir des sites';

// edit.tpl
$language['siteEdit_html_title'] = 'Modifier le site';
$language['siteEdit_meta_description'] = 'Modifier le site';
$language['siteEdit_arbo'] = 'Modifier le site';
$language['siteEdit_h1'] = 'Modifier le site';
$language['siteEdit_cat'] = 'Catégories';
$language['siteEdit_additional_categories'] = 'Catégories supplémentaires';
$language['siteEdit_additional_categories_none'] = '- Aucune -';
$language['siteEdit_category_proposal'] = 'Catégories suggérées';
$language['siteEdit_images'] = 'Images';
$language['siteEdit_add_images'] = 'Ajouter des images';
$language['siteEdit_add_an_image'] = 'Ajouter une image';
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
$language['siteEdit_website_html_text'] = 'Texte';
$language['siteEdit_website_html_user'] = 'Html utilisateur';
$language['siteEdit_website_html_admin'] = 'Html administrateur';
$language['siteEdit_additional_fields'] = 'Champs supplémenaires';
$language['siteEdit_select_keywords'] = 'Sélectionnez vos mots clés';
$language['siteEdit_select_keyword'] = 'Sélectionnez votre mot clé';
$language['siteEdit_keyword'] = 'Mot clé';
$language['siteEdit_keyword_proposal'] = 'Mots clés suggérés';
$language['siteEdit_company_info'] = 'Informations sur votre société / Permet d\'apparaître sur google map';
$language['siteEdit_adress'] = 'Adresse';
$language['siteEdit_display_google_maps'] = 'Voir Google Maps';
$language['siteEdit_postal_code'] = 'Code postal';
$language['siteEdit_city'] = 'Ville';
$language['siteEdit_country'] = 'Pays';
$language['siteEdit_phone'] = 'Téléphone';
$language['siteEdit_fax'] = 'Fax';
$language['siteEdit_other_settings'] = 'Autres informations, configuration';
$language['siteEdit_search_partner'] = 'Recherche de partenaires';
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
$language['siteEdit_delete_thumbs_customized'] = 'Supprimer le thumbs uploadé';
$language['siteEdit_upload_another_thumbs'] = 'Uploader un autre thumbs';
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
$language['siteEdit_ad_website_detail'] = 'Publicité sur la page détails du site';

// errorCode.tpl
$language['siteErrorCode_html_title'] = 'Vérifier les sites avec un code d\'erreur HTTP';
$language['siteErrorCode_meta_description'] = 'Vérifier les sites avec un code d\'erreur HTTP';
$language['siteErrorCode_arbo'] = 'Vérifier les sites avec un code d\'erreur HTTP';
$language['siteErrorCode_h1'] = 'Vérifier les sites avec un code d\'erreur HTTP';
$language['siteErrorCode_status'] = 'Statut';
$language['siteErrorCode_progress'] = 'Progression';
$language['siteErrorCode_checked_sites'] = 'Sites vérifiés';
$language['siteErrorCode_desc1'] = 'Cette fonction, vous permet de trouver tous les sites avec un code de retour http différent de 200 (301, 302, 404, 500...).';
$language['siteErrorCode_th_website_name'] = 'Nom des sites';
$language['siteErrorCode_th_http'] = 'Code d\'erreur HTTP';

// search.tpl
$language['siteSearch_html_title'] = 'Rechercher des sites';
$language['siteSearch_meta_description'] = 'Rechercher des sites';
$language['siteSearch_arbo'] = 'Rechercher des sites';
$language['siteSearch_h1'] = 'Rechercher des sites';
$language['siteSearch_desc1'] = 'Pour trouver rapidement des sites, il suffit d\'entrer le nom ou une partie de l\'adresse du site (URL) sans http://';
$language['siteSearch_button_search'] = 'Rechercher';
$language['siteSearch_h2'] = 'Sites trouvés';
$language['siteSearch_th_website_name'] = 'Nom des sites';
$language['siteSearch_th_url'] = 'URL';
$language['siteSearch_th_ban'] = 'Sites bannis';
$language['siteSearch_th_backlink'] = 'Lien retour"';

// showGoogleMap.tpl

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


//// --> template/templateName/sitemap/
// index.tpl


//// --> template/templateName/siteProblem/
// index.tpl
$language['siteProblem_html_title'] = 'Vérifier les sites reportés par les utilisateurs comme ayant \"un problème\"';
$language['siteProblem_meta_description'] = 'Vérifier les sites reportés par les utilisateurs comme ayant \"un problème\"';
$language['siteProblem_arbo'] = 'Vérifier les sites reportés par les utilisateurs comme ayant "un problème"';
$language['siteProblem_h1'] = 'Vérifier les sites reportés par les utilisateurs comme ayant "un problème"';
$language['siteProblem_desc1'] = 'Vérifier les sites reportés par les utilisateurs comme ayant "un problème".';
$language['siteProblem_th_website_name'] = 'Nom des sites';
$language['siteProblem_th_problem_type'] = 'Type de problème';
$language['siteProblem_th_problem_detail'] = 'Détails du problem';
$language['siteProblem_bad_category'] = 'Mauvaise catégorie';
$language['siteProblem_spam'] = 'Spam';


//// --> template/templateName/system/
// backlink.tpl
$language['systemBacklink_html_title'] = 'Vérifier les liens retours';
$language['systemBacklink_meta_description'] = 'Vérifier les liens retours';
$language['systemBacklink_arbo'] = 'Vérifier les liens retours';
$language['systemBacklink_h1'] = 'Vérifier les liens retours';
$language['systemBacklink_backlinks_checked'] = 'Vérifier les liens retours';
$language['systemBacklink_desc1'] = 'Vous pouvez vérifier si les liens retours qui ont été ajoutés lors de l\'inscription sont toujours présents.';
$language['systemBacklink_desc2'] = 'Un email vous sera envoyé lorsque la vérification sera terminée.';

// checkSecurity.tpl
$language['systemCheckSecurity_desc1'] = 'Votre version n\'est pas à jour, une mise à jour est disponible à l\'adresse suivante: http://www.arfooo.com/';
$language['systemCheckSecurity_desc2'] = 'Vous devez mettre à jour votre installation pour des raisons de sécurité.';
$language['systemCheckSecurity_install_dir'] = 'Attention, le dossier install/ est encore présent sur le serveur. Pour des raisons de sécurité, supprimez le.';

// duplicateContent.tpl
$language['systemDuplicate_html_title'] = 'Vérifier la duplication de contenu';
$language['systemDuplicate_meta_description'] = 'Vérifier la duplication de contenu';
$language['systemDuplicate_arbo'] = 'Vérifier la duplication de contenu';
$language['systemDuplicate_h1'] = 'Vérifier la duplication de contenu';
$language['systemDuplicate_backlinks_checked'] = 'Vérifier la duplication de contenu';
$language['systemDuplicate_desc1'] = 'Vous pouvez vérifier si la description qui a été ajouté lors de l\'inscription est toujours unique.';
$language['systemDuplicate_desc2'] = 'Un email vous sera envoyé lorsque la vérification sera terminée.';

// index.tpl
$language['systemIndex_html_title'] = 'Vérifier les mises à jour';
$language['systemIndex_meta_description'] = 'Vérifier les mises à jour';
$language['systemIndex_arbo'] = 'Vérifier les mises à jour';
$language['systemIndex_h1'] = 'Vérifier les mises à jour';
$language['systemIndex_desc'] = 'Vérifiez que votre version de Arfooo Annuaire est actuellement à jour';
$language['systemIndex_desc1'] = 'Votre installation est à jour, aucune mise à jour est disponible pour votre version de Arfooo Annuaire. Vous n\'avez pas besoin de mettre à jour votre installation. ';
$language['systemIndex_current'] = 'Version actuelle';
$language['systemIndex_last'] = 'Dernière version';

// information.tpl
$language['systemInfo_html_title'] = 'Informations sur votre système';
$language['systemInfo_meta_description'] = 'Informations sur votre système';
$language['systemInfo_arbo'] = 'Informations sur votre système';
$language['systemInfo_h1'] = 'Informations sur les fichiers et les dossiers';
$language['systemInfo_install_dir'] = 'Le dossier install/ est encore présent sur le serveur';
$language['systemInfo_cache_dir'] = 'Le dossier cache/ est accessible en écriture';
$language['systemInfo_save_dir'] = 'Le dossier save/ est accessible en écriture';
$language['systemInfo_uploads_img_cat_dir'] = 'Le dossier uploads/images_categories/ est accessible en écriture';
$language['systemInfo_uploads_img_thumbs_dir'] = 'Le dossier uploads/images_thumbs/ est accessible en écriture';
$language['systemInfo_h2'] = 'Informations sur votre serveur';
$language['systemInfo_php_version'] = 'Votre version de PHP';
$language['systemInfo_mysql_version'] = 'Votre version de MySQL';
$language['systemInfo_template_version'] = 'Votre version de Template Lite';

// optimize.tpl
$language['systemOptimize_html_title'] = 'Optimiser les tables MySQL';
$language['systemOptimize_meta_description'] = 'Optimiser les tables MySQL';
$language['systemOptimize_arbo'] = 'Optimiser les tables MySQL';
$language['systemOptimize_h1'] = 'Optimiser les tables MySQL';
$language['systemOptimize_desc1'] = 'Ce processus permettra d\'optimiser les tables de votre base de données MySQL et préservera l\'intégrité des données.';
$language['systemOptimize_desc2'] = 'Aucune donnée ne peut être perdue au cours de ce processus.';

// restore.tpl
$language['systemRestore_html_title'] = 'Restaurer la base de données Arfooo Annuaire';
$language['systemRestore_meta_description'] = 'Restaurer la base de données Arfooo Annuaire';
$language['systemRestore_arbo'] = 'Restaurer la base de données Arfooo Annuaire';
$language['systemRestore_h1'] = 'Restaurer la base de données Arfooo Annuaire';
$language['systemRestore_desc1'] = 'Ce processus va restaurer votre base de données MySQL Arfooo Annuaire. Il utilise un fichier de sauvegarde gzippé ou textes produits par le processus de sauvegarde.';
$language['systemRestore_desc2'] = 'Utilisez le formulaire ci-dessous pour sélectionner et télécharger votre fichier de sauvegarde.';
$language['systemRestore_desc3'] = 'Important: Cette opération peut prendre un certain temps. Soyez patient.';
$language['systemRestore_desc4'] = 'Notez que cette opération ne fusionnera pas des données existantes avec des données de la sauvegarde, mais remplacera toutes les données.';
$language['systemRestore_desc5'] = 'En outre, ce processus risque d\'échouer à cause des restrictions sur le temps d\'exécution dans votre configuration de PHP. Dans un tel cas, il est nécessaire d\'utiliser une méthode différente. Essayer via SSH par exemple...';
$language['systemRestore_desc6'] = 'Vous êtes prévenu!';
$language['systemRestore_file_type'] = 'Type de fichier';
$language['systemRestore_file_gzip'] = 'Gzip';
$language['systemRestore_file_text'] = 'Texte';
$language['systemRestore_backup_file'] = 'Fichier de sauvegarde';
$language['systemRestore_button_restore'] = 'Restaurer';

// save.tpl
$language['systemSave_html_title'] = 'Sauvegarder la base de données Arfooo Annuaire';
$language['systemSave_meta_description'] = 'Sauvegarder la base de données Arfooo Annuaire';
$language['systemSave_arbo'] = 'Sauvegarder la base de données Arfooo Annuaire';
$language['systemSave_h1'] = 'Sauvegarder la base de données Arfooo Annuaire';
$language['systemSave_desc1'] = 'Ce processus permettra de sauvegarder la base de données MySQL de Arfooo Annuaire.';
$language['systemSave_desc2'] = 'Il permettra de générer un fichier gzip ou texte stocké dans le dossier save/, qui peut être utilisé pour restaurer vos tables et leurs contenus.';
$language['systemSave_action'] = 'Action';
$language['systemSave_action_both'] = 'Stocker et télécharger';
$language['systemSave_action_dl'] = 'Télécharger';
$language['systemSave_action_store'] = 'Stocker';

// thumb.tpl
$language['systemThumb_html_title'] = 'Mettre à jour les thumbs';
$language['systemThumb_meta_description'] = 'Mettre à jour les thumbs';
$language['systemThumb_arbo'] = 'Mettre à jour les thumbs';
$language['systemThumb_h1'] = 'Mettre à jour les thumbs';
$language['systemThumb_desc1'] = 'Cette opération va vous permettre de mettre à jour tous les thumbs des sites présents dans votre annuaire';


//// --> template/templateName/tag/
// banTag.tpl
$language['tagBan_html_title'] = 'Bannir des tags';
$language['tagBan_meta_description'] = 'Bannir des tags';
$language['tagBan_arbo'] = 'Bannir des tags';
$language['tagBan_h1'] = 'Bannir des tags';
$language['tagBan_desc1'] = 'Pour bannir, un ou plusieurs tags, entrer 1 tag par ligne.';
$language['tagBan_desc2'] = 'Vous pouvez utiliser le caractère "*" comme joker.';
$language['tagBan_tags'] = 'Tags';
$language['tagBan_button_ban_tags'] = 'Bannir';
$language['tagBan_button_unban_tags'] = 'Débannir';

// index.tpl
$language['tagIndex_html_title'] = 'Gérer les tags';
$language['tagIndex_meta_description'] = 'Gérer les tags';
$language['tagIndex_arbo'] = 'Gérer les tags';
$language['tagIndex_h1'] = 'Gérer les tags';
$language['tagIndex_th_tags'] = 'Tags';
$language['tagIndex_th_search_times'] = 'Nombre de fois recherché';
$language['tagIndex_th_banned'] = 'Banni';

// show.tpl
$language['tagShow_html_title'] = 'Publicité dans le tag';
$language['tagShow_meta_description'] = 'Publicité dans le tag';
$language['tagShow_arbo'] = 'Publicité dans le tag';
$language['tagShow_h1'] = 'Publicité dans le tag';
$language['tagShow_predefine_ad'] = 'Prédefinir la publicité';


//// --> template/templateName/template/
// index.tpl
$language['templateIndex_html_title'] = 'Gérer les templates';
$language['templateIndex_meta_description'] = 'Gérer les templates';
$language['templateIndex_arbo'] = 'Gérer les templates';
$language['templateIndex_h1'] = 'Gérer les templates';
$language['templateIndex_desc1'] = 'Vous pouvez sélectionner le template de votre choix.';
$language['templateIndex_desc2'] = 'Pour ajouter un template, ajouter un dossier contenant les différents fichiers dans le dossier templates/';
$language['templateIndex_th_template_name'] = 'Nom du template';
$language['templateIndex_preview'] = 'Prévisualiser';
$language['templateIndex_enabled'] = 'Activé';
$language['templateIndex_disabled'] = 'Désactivé';

// preview.tpl


//// --> template/templateName/user/
// administrator.tpl
$language['userAdministrator_html_title'] = 'Gérer les administrateurs';
$language['userAdministrator_meta_description'] = 'Gérer les administrateurs';
$language['userAdministrator_arbo'] = 'Gérer les administrateurs';
$language['userAdministrator_h1'] = 'Gérer les administrateurs';
$language['userAdministrator_login'] = 'Identifiant';
$language['userAdministrator_h2'] = 'Ajouter un administrateur';
$language['userAdministrator_pass'] = 'Mot de passe';

// banEmail.tpl
$language['userBanEmail_html_title'] = 'Bannir des emails';
$language['userBanEmail_meta_description'] = 'Bannir des emails';
$language['userBanEmail_arbo'] = 'Bannir des emails';
$language['userBanEmail_h1'] = 'Bannir des emails';
$language['userBanEmail_desc1'] = 'Pour bannir, un ou plusieurs emails, entrer 1 email par ligne.';
$language['userBanEmail_desc2'] = 'Vous pouvez utiliser le caractère "*" comme joker.';
$language['userBanEmail_emails'] = 'Emails';
$language['userBanEmail_unban_emails'] = 'Débannir des emails';

// banIp.tpl
$language['userBanIp_html_title'] = 'Bannir des IPs';
$language['userBanIp_meta_description'] = 'Bannir des IPs';
$language['userBanIp_arbo'] = 'Bannir des IPs';
$language['userBanIp_h1'] = 'Bannir des IPs';
$language['userBanIp_desc1'] = 'Pour bannir, un ou plusieurs IPs, entrer 1 IP par ligne.';
$language['userBanIp_desc2'] = 'Vous pouvez utiliser le caractère "*" comme joker.';
$language['userBanIp_ip'] = 'IPs';
$language['userBanIp_unban_ip'] = 'Débannir des IPs';

// editAdministrator.tpl
$language['userEditAdmin_html_title'] = 'Modifier l\'administrateur';
$language['userEditAdmin_meta_description'] = 'Modifier l\'administrateur';
$language['userEditAdmin_arbo'] = 'Modifier l\'administrateur';
$language['userEditAdmin_h1'] = 'Modifier l\'administrateur';

// editModerator.tpl
$language['userEditModerator_html_title'] = 'Modifier le modérateur';
$language['userEditModerator_meta_description'] = 'Modifier le modérateur';
$language['userEditModerator_arbo'] = 'Modifier le modérateur';
$language['userEditModerator_h1'] = 'Modifier le modérateur';
$language['userEditModerator_email'] = 'Email';

// editWebmaster.tpl
$language['userEditWebmaster_html_title'] = 'Modifier le webmaster';
$language['userEditWebmaster_meta_description'] = 'Modifier le webmaster';
$language['userEditWebmaster_arbo'] = 'Modifier le webmaster';
$language['userEditWebmaster_h1'] = 'Modifier le webmaster';
$language['userEditWebmaster_th_url'] = 'URL';
$language['userEditWebmaster_th_status'] = 'Statut';
$language['userEditWebmaster_th_backlink'] = 'Lien retour';
$language['userEditWebmaster_approved'] = 'Validé';
$language['userEditWebmaster_pending'] = 'En attente';
$language['userEditWebmaster_banned'] = 'Banni';
$language['userEditWebmaster_email'] = 'Email';

// index.tpl
$language['userIndex_html_title'] = 'Administrateur - Changer votre mot de passe';
$language['userIndex_meta_description'] = 'Administrateur - Changer votre mot de passe';
$language['userIndex_arbo'] = 'Administrateur - Changer votre mot de passe';
$language['userIndex_h1'] = 'Administrateur - Changer votre mot de passe';
$language['userIndex_new_pass'] = 'Nouveau mot de passe';
$language['userIndex_repeat_new_pass'] = 'Répéter le mot de passe';

// moderator.tpl
$language['userModerator_html_title'] = 'Gérer les modérateurs';
$language['userModerator_meta_description'] = 'Gérer les modérateurs';
$language['userModerator_arbo'] = 'Gérer les modérateurs';
$language['userModerator_h1'] = 'Gérer les modérateurs';
$language['userModerator_th_login'] = 'Email';
$language['userModerator_th_websites'] = 'Sites : Validés | Refusés | Bannis';
$language['userModerator_h2'] = 'Ajouter un modérateur';
$language['userModerator_email'] = 'Email';
$language['userModerator_password'] = 'Mot de passe';

// newsletter.tpl
$language['userNewsletter_html_title'] = 'Newsletter';
$language['userNewsletter_meta_description'] = 'Newsletter';
$language['userNewsletter_arbo'] = 'Newsletter';
$language['userNewsletter_h1'] = 'Newsletter';
$language['userNewsletter_desc1'] = 'Vous pouvez envoyer un email à tous les webmasters.';
$language['userNewsletter_desc2'] = 'Les e-mails sont envoyés en tâche de fond, afin que vous puissiez faire autre chose.';
$language['userNewsletter_desc3'] = 'Vous pouvez également arrêter et reprendre à n\'importe quel moment, l\'envoi de la newsletter.';
$language['userNewsletter_desc4'] = 'Une notification vous sera envoyée par email dès que l\'envoi sera terminé. .';
$language['userNewsletter_subject'] = 'Sujet';
$language['userNewsletter_message'] = 'Message';
$language['userNewsletter_email_number'] = 'Nombre d\'email envoyés par minute';
$language['userNewsletter_newsletter_to'] = 'Envoyer la newsletter à';
$language['userNewsletter_subscribers'] = 'Inscrits ';
$language['userNewsletter_all'] = 'Tous les emails ';
$language['userNewsletter_test'] = 'Test (envoyé uniquement à l\'administrateur) ';
$language['userNewsletter_csv_file_only'] = 'Fichier CSV uniquement';
$language['userNewsletter_newsletter_from'] = 'Email en en-tête';
$language['userNewsletter_email_sent'] = 'Emails envoyés';

// newsletterEmail.tpl
$language['userNewsletterEmail_html_title'] = 'Emails : Import / Export';
$language['userNewsletterEmail_meta_description'] = 'Emails : Import / Export';
$language['userNewsletterEmail_arbo'] = 'Emails : Import / Export';
$language['userNewsletterEmail_h1'] = 'Emails : Import / Export';
$language['userNewsletterEmail_desc1'] = 'Vous pouvez importer/exporter des emails avec des fichiers csv.';
$language['userNewsletterEmail_h2_export'] = 'Exporter';
$language['userNewsletterEmail_dl_export'] = 'Télécharger';
$language['userNewsletterEmail_h2_import'] = 'Importer';
$language['userNewsletterEmail_csv_file'] = 'Fichier';
$language['userNewsletterEmail_import_email'] = 'Importer';

// webmaster.tpl
$language['userWebmaster_html_title'] = 'Gérer les webmasters';
$language['userWebmaster_meta_description'] = 'Gérer les webmasters';
$language['userWebmaster_arbo'] = 'Gérer les webmasters';
$language['userWebmaster_h1'] = 'Webmasters';
$language['userWebmaster_desc1'] = 'En cliquant sur "Modifier", vous pouvez connaître le statut de chacun des sites du webmaster, si le site vous fait un lien retour...';
$language['userWebmaster_desc2'] = 'Vous pouvez aussi modifier et supprimer des sites.';
$language['userWebmaster_desc3'] = 'Vous pouvez chercher des webmasters en indiquant leur email, ou une partie de leur email.';
$language['userWebmaster_th_email'] = 'Emails';
$language['userWebmaster_th_web'] = 'Nombre de sites';


/* Admin Texts END */

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