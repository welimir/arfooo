{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.autoFill.js'|resurl}"></script>
<script type="text/javascript" src="{'/admin/javascript/setting/indexOnLoad.js'|resurl}"></script>

<link href="{"/templates/$templateName/jquery/tooltip/jquery.tooltip.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/tooltip/jquery.tooltip.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.addTooltip.js'|resurl}"></script>

<script type="text/javascript">
var setting = new Array();
setting.settingJSON = {$settingJSON|htmlspecialchars_decode};
</script>

{/capture}

{include file='includes/header.tpl' page="setting" title="{'settingIndex_html_title'|lang}" metaDescription="{'settingIndex_meta_description'|lang}"}

<div id="left">

{include file='menu/menuleft/menuleftSettings.tpl'}

</div>

<div id="right">
</div>

<div id="middle">
<div class="column">

<div id="show_arbo">
<a href="{'/admin/setting'|url}">{'menuMenuHeader_settings'|lang}</a> &gt; <a href="{'/admin/setting'|url}">{'menuLeftSettings_main_settings'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'settingIndex_h1'|lang}</h1>
</div>
<div class="column_in_table2">
<form action="{'/admin/setting/save'|url}" method="post" enctype="multipart/form-data" id="settingEditForm">
<table class="table1" cellspacing="1">
<col class="col1-1" /><col class="col2-2" />
<thead>
</thead>
<tbody>
<tr class="line1">
    <td>{'settingIndex_select_language'|lang}: </td>
    <td><select name="language">
    {html_options options=$languageOptions}
</select></td>
</tr>
<tr class="line2">
    <td>{'settingIndex_dir_title'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingIndex_dir_title_desc'|lang}" /></td>
    <td><input type="text" class="input_text_large" name="siteTitle" value="" /></td>
</tr>
<tr class="line1">
    <td>{'settingIndex_dir_meta_desc'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingIndex_dir_meta_desc_desc'|lang}" /></td>
    <td><input type="text" class="input_text_large" name="siteDescription" value="" /></td>
</tr>
<tr class="line2">
    <td>{'settingIndex_admin_email'|lang}: </td>
    <td><input type="text" class="input_text_large" name="adminEmail" value="" /></td>
</tr>
<tr class="line1">
    <td>{'settingIndex_dir_url'|lang}: </td>
    <td><input type="text" class="input_text_large" name="siteRootUrl" value="" /></td>
</tr>
<tr class="line2">
    <td>{'settingIndex_date_format'|lang}: </td>
    <td><input type="text" class="input_text_small" name="dateFormat" value="" /></td>
</tr>
<tr class="line1">
    <td>{'settingIndex_url_rewrite'|lang}: </td>
    <td><input type="radio" name="urlRewriting" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="urlRewriting" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_url_rewrite_mode'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingIndex_url_rewrite_mode_desc'|lang}" /></td>
    <td><input type="radio" name="advancedUrlRewritingEnabled" value="0" /> {'1'|lang} &nbsp;&nbsp;<input type="radio" name="advancedUrlRewritingEnabled" value="1" /> {'2'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_url_rewrite_parents'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingIndex_url_rewrite_parents_desc'|lang}" /></td>
    <td><input type="radio" name="advancedUrlRewritingParentsEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="advancedUrlRewritingParentsEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_sites_in_parent_categories'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingIndex_sites_in_parent_categories_desc'|lang}" /></td>
    <td><input type="radio" name="sitesInParentCategoriesEnabled" value="0" /> {'1'|lang} &nbsp;&nbsp;<input type="radio" name="sitesInParentCategoriesEnabled" value="1" /> {'2'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_order_by'|lang}: <br/></td>
    <td><select name="sitesSortyBy">
    <option value="creationDate">{'settingIndex_order_by_date'|lang}</option>
    <option value="referrerTimes">{'settingIndex_order_by_ref'|lang}</option>
    <option value="siteTitle">{'settingIndex_order_by_alph'|lang}</option>
    </select>
</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_domain'|lang}: </td>
    <td><input type="text" class="input_text_small" name="maxCategoriesCountPerSite" value="" /></td>
</tr>
<tr class="line1">
    <td>{'settingIndex_domain_subpage'|lang}: </td>
    <td><input type="text" class="input_text_small" name="maxSubpagesCountPerSite" value="" /></td>
</tr>
<tr class="line2">
    <td>{'settingIndex_new_website'|lang}: </td>
    <td><input type="text" class="input_text_small" name="siteNoveltyPeriod" value="" /></td>
</tr>
<tr class="line1">
    <td>{'settingIndex_number_char_page'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingIndex_number_char_page_desc'|lang}" /></td>
    <td><input type="text" class="input_text_small" name="numberOfCharactersForItemDescription" value="" /> </td>
</tr>
<tr class="line2">
    <td>{'settingIndex_vertical_menu'|lang}: </td>
    <td><input type="radio" name="categoriesInLeftMenuEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="categoriesInLeftMenuEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_display_news'|lang}: </td>
    <td><input type="radio" name="newsEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="newsEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_display_top_hits'|lang}: </td>
    <td><input type="radio" name="hitsEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="hitsEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_display_top_rate'|lang}: </td>
    <td><input type="radio" name="notationsEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="notationsEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_display_top_rank'|lang}: </td>
    <td><input type="radio" name="topRankEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="topRankEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_display_top_ref'|lang}: </td>
    <td><input type="radio" name="topReferrersEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="topReferrersEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_display_allcat'|lang}: </td>
    <td><input type="radio" name="allCategoriesPageEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="allCategoriesPageEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_display_contact'|lang}: </td>
    <td><input type="radio" name="contactPageEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="contactPageEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_number_website_cat'|lang}: </td>
    <td><input type="text" class="input_text_small" name="sitesPerPageInCategory" value="" /></td>
</tr>
<tr class="line1">
    <td>{'settingIndex_number_website_key'|lang}: </td>
    <td><input type="text" class="input_text_small" name="sitesPerPageInKeywords" value="" /></td>
</tr>
<tr class="line2">
    <td>{'settingIndex_number_website_search'|lang}: </td>
    <td><input type="text" class="input_text_small" name="sitesPerPageInSearch" value="" /></td>
</tr>
<tr class="line1">
    <td>{'settingIndex_number_website_top_hits'|lang}: </td>
    <td><input type="text" class="input_text_small" name="maxTopHitsCount" value="" /></td>
</tr>
<tr class="line2">
    <td>{'settingIndex_number_website_top_rate'|lang}: </td>
    <td><input type="text" class="input_text_small" name="maxTopNotesCount" value="" /></td>
</tr>
<tr class="line1">
    <td>{'settingIndex_number_website_top_rank'|lang}: </td>
    <td><input type="text" class="input_text_small" name="maxTopRankCount" value="" /></td>
</tr>
<tr class="line2">
    <td>{'settingIndex_number_website_top_ref'|lang}: </td>
    <td><input type="text" class="input_text_small" name="maxTopReferrersCount" value="" /></td>
</tr>
<tr class="line1">
    <td>{'settingIndex_number_website_news'|lang}: </td>
    <td><input type="text" class="input_text_small" name="maxNewsCount" value="" /></td>
</tr>
<tr class="line2">
    <td>{'settingIndex_number_sub_cat'|lang}: </td>
    <td><input type="text" class="input_text_small" name="countOfSubcategoriesUnderCategory" value="" /></td>
</tr>
<tr class="line1">
    <td>{'settingIndex_display_keywords'|lang}: </td>
    <td><input type="radio" name="keywordsEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="keywordsEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_number_keywords'|lang}: </td>
    <td><input type="text" class="input_text_small" name="maxKeywordsCountPerSite" value="" /></td>
</tr>
<tr class="line1">
    <td>{'settingIndex_display_tags'|lang}: </td>
    <td><input type="radio" name="tagCloudEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="tagCloudEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_display_before_tags'|lang}: </td>
    <td><input type="text" class="input_text_small" name="minNumberOfTagInTagCloud" value="" /></td>
</tr>
<tr class="line1">
    <td>{'settingIndex_number_tags'|lang}: </td>
    <td><input type="text" class="input_text_small" name="numberOfTagInTagCloud" value="" /></td>
</tr>
<tr class="line2">
    <td>{'settingIndex_number_random_website'|lang}: </td>
    <td><input type="text" class="input_text_small" name="selectionSitesCount" value="" /></td>
</tr>
<tr class="line1">
    <td>{'settingIndex_number_random_website_renew'|lang}: </td>
    <td><input type="text" class="input_text_small" name="selectionPeriod" value="" /> <input type="submit" class="button3" value="{'settingIndex_button_renew_random'|lang}" name="newSelectionButton"  /></td>
</tr>
<tr class="line2">
    <td>{'settingIndex_top_ref_renew'|lang}: </td>
    <td><input type="text" class="input_text_small" name="deletionPeriodOfTopReferrers" value="" /> <input type="submit" class="button3" value="{'settingIndex_button_renew_ref'|lang}" name="resetTopReferrersButton"  /></td>
</tr>
</tbody>
</table>
</div>

<div class="title_h_2" id="detail">
<h2>{'settingIndex_h2_detail_page'|lang}</h2>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<col class="col1-1" /><col class="col2-2" />
<thead>
</thead>
<tbody>
<tr class="line1">
    <td>{'settingIndex_display_rss_feed'|lang}:</td>
    <td><input type="radio" name="remoteRssParsingEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="remoteRssParsingEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_number_item_rss'|lang}: </td>
    <td><input type="text" class="input_text_small" name="numberOfItemsForRssParsing" value="" /></td>
</tr>
<tr class="line1">
    <td>{'settingIndex_number_char_rss'|lang}: </td>
    <td><input type="text" class="input_text_small" name="numberOfCharactersForRssParsing" value="" /></td>
</tr>
<tr class="line2">
    <td>{'settingIndex_number_days_delete_rss_cache'|lang}: </td>
    <td><input type="text" class="input_text_small" name="magpieRssCacheMaxAgeDays" value="" /></td>
</tr>
<tr class="line1">
    <td>{'settingIndex_display_company_info'|lang}: </td>
    <td><input type="radio" name="companyInfoEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="companyInfoEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_display_google_map'|lang}: </td>
    <td><input type="radio" name="googleMapEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="googleMapEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_display_random_websites_detail_page'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingIndex_display_random_websites_detail_page_desc'|lang}" /></td>
    <td><input type="radio" name="showRandomSitesInDetails" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="showRandomSitesInDetails" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_condition_common_keyword'|lang}: </td>
    <td><input type="radio" name="similarSiteKeywordMatch" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="similarSiteKeywordMatch" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_number_random_websites_displayed_detail'|lang}: </td>
    <td><input type="text" class="input_text_small" name="randomSitesInDetailsCount" value="" /></td>
</tr>
<tr class="line2">
    <td>{'settingIndex_number_char_random_web'|lang}: </td>
    <td><input type="text" class="input_text_small" name="randomSitesInDetailsDescriptionLength" value="" /></td>
</tr>
<tr class="line1">
    <td>{'settingIndex_enable_comments'|lang}: </td>
    <td><input type="radio" name="commentsEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="commentsEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_validated_comments'|lang}: </td>
    <td><input type="radio" name="automaticCommentValidation" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="automaticCommentValidation" value="0" /> {'Off'|lang}</td>
</tr>
</tbody>
</table>
</div>

<div class="title_h_2" id="images">
<h2>{'settingIndex_h2_images_thumbs'|lang}</h2>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<col class="col1-1" /><col class="col2-2" />
<thead>
</thead>
<tbody>
<tr class="line1">
    <td>{'settingIndex_display_image_beside_cat'|lang}: </td>
    <td><input type="radio" name="categoriesImages" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="categoriesImages" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_image_beside_web'|lang}: </td>
    <td><input type="radio" name="sitesImages" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="sitesImages" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_enable_ascreen'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingIndex_enable_ascreen_desc'|lang}" /></td>
    <td><input type="radio" name="ascreenEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="ascreenEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_url_generation_thumbs'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingIndex_url_generation_thumbs_desc'|lang}" /></td>
    <td><input type="text" class="input_text_large" name="thumbsGeneratorUrl" value="" /></td>
</tr>
<tr class="line1">
    <td>{'settingIndex_save_thumbs'|lang}: </td>
    <td><input type="radio" name="cacheSiteImagesEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="cacheSiteImagesEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_country_flag'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingIndex_country_flag_desc'|lang}" /></td>
    <td><input type="radio" name="countryFlagsEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="countryFlagsEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_enable_gallery_image'|lang}:</td>
    <td><input type="radio" name="itemGalleryImagesEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="itemGalleryImagesEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_images_uploaded'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingIndex_images_uploaded_desc'|lang}" /></td>
    <td><input type="radio" name="firstGalleryImageForThumbEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="firstGalleryImageForThumbEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_number_images_web'|lang}: </td>
    <td><input type="text" class="input_text_small" name="itemGalleryImagesMaxCount" value="" /></td>
</tr>
<tr class="line2">
    <td>{'settingIndex_image_weight'|lang}: </td>
    <td><input type="text" class="input_text_small" name="itemGalleryImageMaxWeight" value="" /> KB</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_image_watermark'|lang}:<br />
        {'settingIndex_image_watermark_on'|lang}: </td>
    <td><input type="radio" name="imageWatermarkEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="imageWatermarkEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_dl_watermark'|lang}: </td>
    <td><input type="file" class="input_text_medium" style="width:247px;" name="imageWatermarkFile" /></td>
</tr>
<tr class="line1">
    <td>{'settingIndex_where_watermark'|lang}: </td>
    <td><select name="imageWatermarkPosition">
        <option label="Top right" value="t,r">{'settingIndex_where_top_right'|lang}</option>
        <option label="Top left" value="t,l">{'settingIndex_where_top_left'|lang}</option>
        <option label="Bottom right" value="b,r">{'settingIndex_where_bot_right'|lang}</option>
        <option label="Bottom left" value="b,l">{'settingIndex_where_bot_left'|lang}</option>
        </select></td>
</tr>
<tr class="line2">
    <td>{'settingIndex_medium_image'|lang}: </td>
    <td>{'settingIndex_width'|lang} <input type="text" class="input_text_small" name="mediumThumbWidth" value="" /> &nbsp;
        {'settingIndex_height'|lang} <input type="text" class="input_text_small" name="mediumThumbHeight" value="" /></td>
</tr>
<tr class="line1">
    <td>{'settingIndex_small_image'|lang}: </td>
    <td>{'settingIndex_width'|lang} <input type="text" class="input_text_small" name="smallThumbWidth" value="" /> &nbsp;
        {'settingIndex_height'|lang} <input type="text" class="input_text_small" name="smallThumbHeight" value="" /></td>
</tr>
<tr class="line2">
    <td>{'settingIndex_micro_image'|lang}: </td>
    <td>{'settingIndex_width'|lang} <input type="text" class="input_text_small" name="microThumbWidth" value="" /> &nbsp;
        {'settingIndex_height'|lang} <input type="text" class="input_text_small" name="microThumbHeight" value="" /></td>
</tr>
</tbody>

</table>
</div>

<div class="title_h_2" id="inscription">
<h2>{'settingIndex_h2_website_registration'|lang}</h2>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<col class="col1-1" /><col class="col2-2" />
<thead>
</thead>
<tbody>
<tr class="line1">
    <td>{'settingIndex_submission_available_type'|lang}: <br/></td>
    <td><select name="availableSiteTypes">
    <option value="basic">{'settingIndex_sub_free'|lang}</option>
    <option value="premium">{'settingIndex_sub_premium'|lang}</option>
    <option value="both">{'settingIndex_sub_both'|lang}</option>
    </select>
</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_registration_mandatory'|lang}: </td>
    <td><input type="radio" name="registrationOfWebmastersEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="registrationOfWebmastersEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_dir_website_only'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingIndex_dir_website_only_desc'|lang}" /></td>
    <td><input type="radio" name="urlMandatory" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="urlMandatory" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_registration_open_desc'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingIndex_registration_open_desc'|lang}" /></td>
    <td><input type="radio" name="inscriptionsOfSitesEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="inscriptionsOfSitesEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_validation_auto'|lang}: </td>
    <td><input type="radio" name="automaticSiteValidation" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="automaticSiteValidation" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_check_code_website'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingIndex_check_code_website_desc'|lang}" /></td>
    <td><input type="radio" name="inscriptionCheckHttpResponseCode" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="inscriptionCheckHttpResponseCode" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_meta_button'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingIndex_meta_button_desc'|lang}" /></td>
    <td><input type="radio" name="metaTagScannerEnabled" value="1" /> {'ON'|lang} &nbsp;&nbsp;<input type="radio" name="metaTagScannerEnabled" value="0" /> {'OFF'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_char_availalbe_each_web'|lang}:</td>
    <td><input type="text" class="input_text_small" name="siteDescriptionMaxLength" value="" /></td>
</tr>
<tr class="line1">
    <td>{'settingIndex_char_mandatory_each_web'|lang}: </td>
    <td><input type="text" class="input_text_small" name="minSiteDescriptionLength" value="" /></td>
</tr>
<tr class="line2">
    <td>{'settingIndex_backlink_mandatory'|lang}: </td>
    <td><input type="radio" name="backLinkMandatory" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="backLinkMandatory" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_backlink_html_code1'|lang}: </td>
    <td><input type="radio" name="backLinkHtmlCode1Enabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="backLinkHtmlCode1Enabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_backlink_html_code1_text'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingIndex_backlink_html_code1_text_desc'|lang}" /></td>
    <td><input type="text" class="input_text_large" name="backLinkHtmlCode1Text" value="" /></td>
</tr>
<tr class="line1">
    <td>{'settingIndex_backlink_html_code1_url'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingIndex_backlink_html_code1_url_desc'|lang}" /></td>
    <td><input type="text" class="input_text_large" name="backLinkHtmlCode1Url" value="" /></td>
</tr>
<tr class="line2">
    <td>{'settingIndex_backlink_html_code2'|lang}: </td>
    <td><input type="radio" name="backLinkHtmlCode2Enabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="backLinkHtmlCode2Enabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_backlink_html_code2_text'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingIndex_backlink_html_code1_text_desc'|lang}" /></td>
    <td><input type="text" class="input_text_large" name="backLinkHtmlCode2Text" value="" /></td>
</tr>
<tr class="line2">
    <td>{'settingIndex_website_protocols'|lang}: </td>
    <td>
    <input type="checkbox" name="supportedUrlSchemes[]" value="http" /> {'settingIndex_protocol_http'|lang} &nbsp;&nbsp;
    <input type="checkbox" name="supportedUrlSchemes[]" value="https" /> {'settingIndex_protocol_https'|lang} &nbsp;&nbsp;
    <input type="checkbox" name="supportedUrlSchemes[]" value="ftp" /> {'settingIndex_protocol_ftp'|lang}
    </td>
</tr>
<tr class="line1">
    <td>{'settingIndex_partnership'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingIndex_partnership_desc'|lang}" /></td>
    <td><input type="radio" name="partnershipSearchingEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="partnershipSearchingEnabled" value="0" /> {'Off'|lang}</td>
</tr>
</tbody>
</table>
</div>


<div class="title_h_2" id="htmlConfig">
<h2>{'settingIndex_h2_html_settings'|lang}</h2>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<col class="col1-1" /><col class="col2-2" />
<thead>
</thead>
<tbody>
<tr class="line1">
    <td>{'settingIndex_site_description_html_enabled_for_admin'|lang}: </td>
    <td><input type="radio" name="siteDescriptionHtmlEnabledAdmin" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="siteDescriptionHtmlEnabledAdmin" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_available_html_tags_for_admin'|lang}:</td>
    <td><textarea  name="siteDescriptionHtmlAllowedTagsAdmin"></textarea></td>
</tr>
<tr class="line1">
    <td>{'settingIndex_available_css_attributes_for_admin'|lang}:</td>
    <td><textarea  name="siteDescriptionHtmlAllowedCssPropertiesAdmin"></textarea></td>
</tr>
<tr class="line2">
    <td>{'settingIndex_site_description_html_enabled_for_users'|lang}: </td>
    <td><input type="radio" name="siteDescriptionHtmlEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="siteDescriptionHtmlEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_available_html_tags_for_users'|lang}:</td>
    <td><textarea  name="siteDescriptionHtmlAllowedTags"></textarea></td>
</tr>
<tr class="line2">
    <td>{'settingIndex_available_css_attributes_for_users'|lang}:</td>
    <td><textarea  name="siteDescriptionHtmlAllowedCssProperties"></textarea></td>
</tr>
</tbody>
</table>
</div>


<div class="title_h_2" id="duplicate">
<h2>{'settingIndex_h2_duplication_checker'|lang}</h2>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<col class="col1-1" /><col class="col2-2" />
<thead>
</thead>
<tbody>
<tr class="line1">
    <td>{'settingIndex_enable_checking_duplicate_content_submission_sites'|lang}: </td>
    <td><input type="radio" name="duplicateContentCheckerEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="duplicateContentCheckerEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_how_many_random_phrases_to_check'|lang}:</td>
    <td><input type="text" class="input_text_small" name="duplicateContentCheckerPhrasesToCheckCount" value=""/></td>
</tr>
<tr class="line1">
    <td>{'settingIndex_how_many_words_should_contain_a_phrase'|lang}:</td>
    <td><input type="text" class="input_text_small" name="duplicateContentCheckerWordsInPhraseCount" value=""/></td>
</tr>
<tr class="line2">
    <td>{'settingIndex_how_many_of_checked_phrases_can_be_duplicated'|lang}:</td>
    <td><input type="text" class="input_text_small" name="duplicateContentCheckerAllowableDuplicatedPhrasesCount" value=""/></td>
</tr>
</tbody>
</table>
</div>


<div class="title_h_2" id="google">
<h2>{'settingIndex_h2_google_info'|lang}</h2>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<col class="col1-1" /><col class="col2-2" />
<thead>
</thead>
<tbody>
<tr class="line1">
    <td>{'settingIndex_display_backlink_number'|lang}: </td>
    <td><input type="radio" name="showingBacklinksCountEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="showingBacklinksCountEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_display_page_number'|lang}: </td>
    <td><input type="radio" name="showingIndexedPagesCountEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="showingIndexedPagesCountEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_display_pagerank'|lang}: </td>
    <td><input type="radio" name="showingPagerankEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="showingPagerankEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_pagerank_mode1'|lang}: <br />
    {'settingIndex_to_test'|lang}: <a href="{'/admin/setting/testGoogle/www.google.com/1'|url}" class="link_url_direct">{'settingIndex_test'|lang}</a></td>
    <td><input type="radio" name="wayForPagerankExtraction" value="1" /> 1</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_pagerank_mode2'|lang}: <br />
    {'settingIndex_to_test'|lang}: <a href="{'/admin/setting/testGoogle/www.google.com/2'|url}" class="link_url_direct">{'settingIndex_test'|lang}</a></td>
    <td><input type="radio" name="wayForPagerankExtraction" value="2" /> 2</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_pagerank_mode2_url'|lang}: </td>
    <td><input type="text" class="input_text_large" name="additionalServerUrl" value="" /></td>
</tr>
<tr class="line1">
    <td>{'settingIndex_pagerank_cache'|lang}: </td>
    <td><input type="text" class="input_text_small" name="pageRankCacheExpiration" value="" /></td>
</tr>
</tbody>
</table>
</div>


<div class="title_h_2" id="emails">
<h2>{'settingIndex_h2_email'|lang}</h2>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<col class="col1-1" /><col class="col2-2" />
<thead>
</thead>
<tbody>
<tr class="line1">
    <td>{'settingIndex_email_confirm'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingIndex_email_confirm_desc'|lang}" /></td>
    <td><input type="radio" name="emailConfirmationEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="emailConfirmationEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_email_approved_website'|lang}:</td>
    <td><input type="radio" name="informWebmastersForAdminValidateDecision" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="informWebmastersForAdminValidateDecision" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_email_rejected_website'|lang}: </td>
    <td><input type="radio" name="informWebmastersForAdminRefuseDecision" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="informWebmastersForAdminRefuseDecision" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_email_banned_website'|lang}: </td>
    <td><input type="radio" name="informWebmastersForAdminBanDecision" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="informWebmastersForAdminBanDecision" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_email_submit_website'|lang}: </td>
    <td><input type="radio" name="informWebmastersForAdminDecisions" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="informWebmastersForAdminDecisions" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_email_submit_website_admin'|lang}: </td>
    <td><input type="radio" name="sendEmailsOnInscriptionAndApproval" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="sendEmailsOnInscriptionAndApproval" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_email_submit_comment_admin'|lang}: </td>
    <td><input type="radio" name="sendEmailsOnComment" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="sendEmailsOnComment" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_email_submit_error_admin'|lang}: </td>
    <td><input type="radio" name="sendEmailsOnSiteProblem" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="sendEmailsOnSiteProblem" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_email_newsletter'|lang}: </td>
    <td><input type="radio" name="newsletterEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="newsletterEnabled" value="0" /> {'Off'|lang}</td>
</tr>
</tbody>
</table>
</div>


<div class="title_h_2" id="stats">
<h2>{'settingIndex_h2_stats'|lang}</h2>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<col class="col1-1" /><col class="col2-2" />
<thead>
</thead>
<tbody>
<tr class="line1">
    <td>{'settingIndex_display_stats'|lang}: <br />
    {'settingIndex_stats_on'|lang}:</td>
    <td><input type="radio" name="statisticsEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="statisticsEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_display_approved_websites'|lang}: </td>
    <td><input type="radio" name="displayValidatedSitesCount" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="displayValidatedSitesCount" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_display_pending_websites'|lang}: </td>
    <td><input type="radio" name="displayWaitingSitesCount" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="displayWaitingSitesCount" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_display_rejected_websites'|lang}: </td>
    <td><input type="radio" name="displayRefusedSitesCount" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="displayRefusedSitesCount" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_display_ban_websites'|lang}: </td>
    <td><input type="radio" name="displayBannedSitesCount" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="displayBannedSitesCount" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_display_numb_cat'|lang}: </td>
    <td><input type="radio" name="displayAllCategoriesCount" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="displayAllCategoriesCount" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_display_numb_keyword'|lang}: </td>
    <td><input type="radio" name="displayKeywordsCount" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="displayKeywordsCount" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_display_numb_webmasters'|lang}: </td>
    <td><input type="radio" name="displayWebmastersCount" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="displayWebmastersCount" value="0" /> {'Off'|lang}</td>
</tr>
</tbody>
</table>
</div>


<div class="title_h_2" id="captcha">
<h2>{'settingIndex_h2_captcha'|lang}</h2>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<col class="col1-1" /><col class="col2-2" />
<thead>
</thead>
<tbody>
<tr class="line1">
    <td>{'settingIndex_captcha_registration'|lang}: </td>
    <td><input type="radio" name="captchaEnabledOnWebmasterRegistration" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="captchaEnabledOnWebmasterRegistration" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_captcha_sub'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingIndex_captcha_sub_desc'|lang}" /></td>
    <td><input type="radio" name="captchaEnabledOnSiteInscription" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="captchaEnabledOnSiteInscription" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_captcha_contact'|lang}: </td>
    <td><input type="radio" name="captchaEnabledOnContactForm" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="captchaEnabledOnContactForm" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_captcha_comment'|lang}: </td>
    <td><input type="radio" name="captchaEnabledOnComments" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="captchaEnabledOnComments" value="0" /> {'Off'|lang}</td>
</tr>
</tbody>
</table>
</div>


<div class="title_h_2" id="searcher">
<h2>{'settingIndex_h2_search_engine'|lang}</h2>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<col class="col1-1" /><col class="col2-2" />
<thead>
</thead>
<tbody>
<tr class="line1">
    <td>{'settingIndex_search_advanced'|lang}: </td>
    <td><input type="radio" name="advancedSearchEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="advancedSearchEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_search_like'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingIndex_search_like_desc'|lang}" /></td>
    <td><input type="radio" name="searchEngineLikeMethodEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="searchEngineLikeMethodEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_search_like_min'|lang}:</td>
    <td><input type="text" class="input_text_small" name="searchEngineLikeMethodWordMinLength" value=""/></td>
</tr>
<tr class="line2">
    <td>{'settingIndex_search_like_max'|lang}:</td>
    <td><input type="text" class="input_text_small" name="searchEngineLikeMethodWordMaxLength" value=""/></td>
</tr>
<tr class="line1">
    <td>{'settingIndex_search_operator'|lang}: </td>
    <td><input type="radio" name="searchEngineWordDefaultOperator" value="AND" /> {'settingIndex_search_operator_and'|lang} &nbsp;&nbsp;<input type="radio" name="searchEngineWordDefaultOperator" value="OR" /> {'settingIndex_search_operator_or'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_search_fields'|lang}: </td>
    <td>
    <input type="checkbox" name="searchEngineSearchIn[]" value="siteTitle" /> {'settingIndex_search_fields_title'|lang} 
    <input type="checkbox" name="searchEngineSearchIn[]" value="description" /> {'settingIndex_search_fields_desc'|lang} 
    <input type="checkbox" name="searchEngineSearchIn[]" value="url" /> {'settingIndex_search_fields_url'|lang}
    </td>
</tr>
</tbody>
</table>
</div>


<div class="title_h_2" id="cache">
<h2>{'settingIndex_cache_optimization'|lang}</h2>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<col class="col1-1" /><col class="col2-2" />
<thead>
</thead>
<tbody>
<tr class="line1">
    <td>{'settingIndex_enable_gzip'|lang}: </td>
    <td><input type="radio" name="httpGzipCompressionEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="httpGzipCompressionEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_compr_template'|lang}: </td>
    <td><input type="radio" name="templateWhiteSpaceFilterEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="templateWhiteSpaceFilterEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_enbable_check_template'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingIndex_enbable_check_template_desc'|lang}" /></td>
    <td><input type="radio" name="templateCompileCheckEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="templateCompileCheckEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_count_referrers'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingIndex_count_referrers_desc'|lang}" /></td>
    <td><input type="radio" name="referrersSavingEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="referrersSavingEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_cache_detail_page'|lang}: </td>
    <td><input type="radio" name="siteDetailsCacheEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="siteDetailsCacheEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_cache_detail_page_life'|lang}: </td>
    <td><input type="text" class="input_text_small" name="siteDetailsCacheLifeTime" value="" /></td>
</tr>
<tr class="line1">
    <td>{'settingIndex_error_handler_save_to_file'|lang}: </td>
    <td><input type="radio" name="errorHandlerSaveToFileEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="errorHandlerSaveToFileEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_error_handler_display_error'|lang}: </td>
    <td><input type="radio" name="errorHandlerDisplayErrorEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="errorHandlerDisplayErrorEnabled" value="0" /> {'Off'|lang}</td>
</tr>
</tbody>
</table>
</div>


<div class="title_h_2" id="rss">
<h2>{'settingIndex_h2_rss_feeds'|lang}</h2>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<col class="col1-1" /><col class="col2-2" />
<thead>
</thead>
<tbody>
<tr class="line1">
    <td>{'settingIndex_rss_news'|lang}: </td>
    <td><input type="radio" name="rssNewsEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="rssNewsEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line2">
    <td>{'settingIndex_rss_cat'|lang}: </td>
    <td><input type="radio" name="rssCategoriesEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="rssCategoriesEnabled" value="0" /> {'Off'|lang}</td>
</tr>
<tr class="line1">
    <td>{'settingIndex_rss_web'|lang}: </td>
    <td><input type="radio" name="rssSitesEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="rssSitesEnabled" value="0" /> {'Off'|lang}</td>
</tr>
</tbody>
</table>

<div class="column_in_center">
<input type="submit" class="button" value="{'button_save'|lang}" />
</div>

</form>

</div>

{include file='includes/footer.tpl'}