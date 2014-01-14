{capture assign="headData"}
<link href="{"/templates/$templateName/css/upload.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/config'|url}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.chainSelect.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.fileUploader.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.charCounter.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.autoFill.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.livequery.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/json.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.tablednd.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery-validate/jquery.validate.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.keywordSelector.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.form.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.adminFormTool.js'|resurl}"></script>
<script type="text/javascript" src="{'/admin/javascript/ad/jquery.adEditor.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.popup.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.itemEditor.js'|resurl}"></script>
<script type="text/javascript" src="{'/admin/javascript/category/indexOnLoad.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/tiny_mce/tiny_mce.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/tiny_mce/basic_config.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/tooltip/jquery.tooltip.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/tooltip/jquery.tooltip.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.ajaxUpload.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.addTooltip.js'|resurl}"></script>
<script type="text/javascript">
setting.siteDescriptionMaxLength = 0;
setting.maxKeywordsCountPerSite = 1000; // admin has no limit 
setting.categoryId = {$parentCategoryId};
setting.adPage = "category{$parentCategoryId}";
setting.adPage2 = "siteCustomCategory{$parentCategoryId}";
tinyMCE.execCommand('mceAddControl', false, 'categoryDescription');
{if $setting.siteDescriptionHtmlEnabled}
tinyMCE.execCommand('mceAddControl', false, 'itemDescription');
{/if}
{if !empty($tempId)}
setting.tempId = "{$tempId}";
{/if} 
</script>

{/capture}

{include file='includes/header.tpl' page="index" title="{'categoryIndex_html_title'|lang}" metaDescription="{'categoryIndex_meta_description'|lang}"}

<div id="left">

{include file='menu/menuleft/menuleftIndex.tpl'}

</div>

<div id="right">
</div>

<div id="middle">
<div class="column">

<div id="show_arbo">
<a href="{'/admin/'|url}">{'menuMenuHeader_directory'|lang}</a> &gt; <a href="{'/admin/category'|url}">{'menuLeftIndex_site_cat'|lang}</a> &gt; <a href="{'/admin/category'|url}" class="link_bold">{'Root'|lang}</a> {foreach from=$categoryParentsData value=category} &gt; <a href="{"/admin/category/index/$category.categoryId/"|url}" class="link_bold">{$category.name}</a>
{/foreach}
</div>

<div class="title_h_1">
<h1>{'categoryIndex_h1'|lang}</h1>
</div>
<div class="column_in">
<a href="{'/admin/category'|url}" class="link_bold">{'Root'|lang}</a>
{foreach from=$categoryParentsData value=category} &gt; <a href="{"/admin/category/index/$category.categoryId/"|url}" class="link_bold">{$category.name}</a>
{/foreach}
<br /><br />
<select name="parentCategoryId" id="categoriesSelect">
<option value="0">{'Root'|lang}</option>
{html_options options=$categoriesSelect selected=$parentCategoryId}
</select>
</div>

<div class="column_in_table">
<table class="table1" cellspacing="1" id="categoriesTable">
<thead>
<tr>
    <th>{'categoryIndex_th_categories'|lang}</th>
    <th>{'categoryIndex_th_sub'|lang}</th>
    <th>{'categoryIndex_th_management'|lang}</th>
</tr>
</thead>
<tbody>
{foreach from=$categories value=category}
<tr class="line{cycle values='1,2'}" id="categoriesTable-row-{$category.categoryId}">
    <td><a href="{"/admin/category/index/$category.categoryId"|url}">
        <img src="{"/uploads/images_categories/$category.imageSrc"|resurl}" alt="" class="categories" /> {$category.name}</a>&nbsp;&nbsp; ({$category.validatedSitesCount})</td>
    <td>{if $category.possibleTender}<span class="text_green">{'Yes'|lang}</span>{else}<span class="text_red">{'No'|lang}</span>{/if}</td>
    <td><a href="{"/admin/category/edit/$category.categoryId"|url}" class="link_green">{'link_edit'|lang}</a> |
        <a onclick="return $.confirmLinkClick('{'Do you really want to delete it?'|lang}', this.href)" href="{"/admin/category/delete/$category.categoryId"|url}" class="link_red">{'link_delete'|lang}</a></td>
</tr>
{/foreach}
</tbody>
</table>
</div>

<div class="title_h_2">
<h2>{if empty($currentCategory)}{'categoryIndex_create_category'|lang}{else}{'categoryIndex_create_subcategory_in'|lang} {$currentCategory.name}{/if}</h2>
</div>
<div class="column_in_table2">
<form action="{'/admin/category/saveCategory'|url}" method="post" enctype="multipart/form-data">
<input type="hidden" name="parentCategoryId" value="{$parentCategoryId}" />
<table class="table2" cellspacing="1">
<tbody>
<tr>
    <td>{'categoryEdit_category_name'|lang}: </td>
    <td><input type="text" class="input_text_large" name="name" value="" /></td>
</tr>
<tr>
    <td>{'categoryEdit_category_title'|lang}: </td>
    <td><input type="text" class="input_text_large" name="title" value="" /></td>
</tr>
<tr>
    <td>{'categoryEdit_nav'|lang}: </td>
    <td><input type="text" class="input_text_large" name="navigationName"/></td>
</tr>
<tr>
    <td>{'categoryEdit_tag_h1'|lang}: </td>
    <td><input type="text" class="input_text_large" name="headerDescription"/></td>
</tr>
<tr>
    <td>{'categoryEdit_meta'|lang}: </td>
    <td><textarea name="metaDescription" class="textarea_metas" ></textarea></td>
</tr>
<tr>
    <td>{'categoryEdit_possible_sub'|lang}: </td>
    <td><input type="radio" name="possibleTender" value="1" checked="checked" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="possibleTender" value="0" /> {'Off'|lang}</td>
</tr>
<tr>
    <td>{'categoryEdit_forbidden'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'categoryEdit_forbidden_desc'|lang}" /></td>
    <td><input type="radio" name="forbidden" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="forbidden" value="0" checked="checked" /> {'Off'|lang}</td>
</tr>
<tr>
    <td>{'categoryEdit_category_image'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'categoryEdit_category_image_desc'|lang}" /></td>
    <td><input type="file" class="input_text_medium" style="width:247px;" name="categoryImage" /></td>
</tr>
<tr>
    <td>{'categoryEdit_text_description'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'categoryEdit_text_description_desc'|lang}" /></td>
    <td><textarea class="textarea_extra_large" name="description" cols="50" rows="5" id="categoryDescription"></textarea></td>
</tr>
<tr>
    <td></td>
    <td><input type="submit" class="button" value="{'button_create'|lang}"  /></td>
</tr>
</tbody>
</table>
</form>
</div>

{if $parentCategoryId}

<div class="title_h_2">
<h2>{'categoryIndex_websites_in_category'|lang} {$currentCategory.name}</h2>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<thead>
<tr>
    <th>{'categoryIndex_th_websites'|lang}</th>
    <th>{'categoryIndex_th_banned'|lang}</th>
    <th>{'categoryIndex_th_backlink'|lang}</th>
    <th>{'categoryIndex_th_management'|lang}</th>
</tr>
</thead>
<tbody>
{foreach from=$sites value=site}
<tr class="line{cycle values='1,2'}">
    <td><a href="{"/admin/site/edit/$site.siteId"|url}" title="{$site.siteTitle}">{$site.siteTitle}</a></td>
    <td>{if $site.status == 'banned'}<span class="text_red">{'Yes'|lang}</span>{else}<span class="text_green">{'No'|lang}</span>{/if}</td>
    <td>{if $site.returnBond == ''}<span class="text_red">{'No'|lang}</span>{else}<span class="text_green">{'Yes'|lang}</span>{/if}</td>
    <td><a href="{"/admin/site/edit/$site.siteId"|url}" class="link_green">{'link_edit'|lang}</a> |
        <a onclick="return $.confirmLinkClick('{'Do you really want to delete it?'|lang}', this.href)" href="{"/admin/site/delete/$site.siteId"|url}" class="link_red">{'link_delete'|lang}</a></td>
</tr>
{/foreach}
</tbody>
</table>

{include file="includes/pageNavigation.tpl"}

</div>

<div class="title_h_2">
<h2>{'categoryIndex_add_website_in'|lang} {$currentCategory.name}</h2>
</div>
<div class="column_in_table2">
<form action="{'/admin/site/saveSite'|url}" method="post" enctype="multipart/form-data" id="itemForm">
<input type="hidden" name="categoryId" value="{$parentCategoryId}" />
<input type="hidden" name="forceCategoryDuplicate" value="0" />
<input type="hidden" name="forcePossibleTender" value="0" />
<input type="hidden" name="status" value="validated" />
<input type="hidden" name="tempId" value="{$tempId}"/>
<div class="column_in_subbmit_first">
{'categoryIndex_general_information'|lang}
</div>
<div class="column_in_subbmit_out">
<table class="table2" cellspacing="1">
<col class="col3" /><col class="col4" />
<tbody>
{if $setting.countryFlagsEnabled}
<tr>
    <td>{'categoryIndex_website_language'|lang}: </td>
    <td><select name="countryCode" class="" id="countryCode">

        <option value=''>{'categoryIndex_select_website_language'|lang}</option>
        {html_options options=$countryFlags}
        </select>
        <img src="" alt="" id="countryFlagImage" style="display:none;" />
    </td>
</tr>
{/if}
<tr>
    <td>{'categoryIndex_webmaster'|lang}: </td>
    <td><select name="webmasterId">
        <option value="0">{'categoryIndex_admin'|lang}</option> 
        {html_options options=$webmasters}
        </select></td>
</tr>
<tr>
    <td>{'categoryIndex_name'|lang}: </td>
    <td><input type="text" class="input_text_large" name="webmasterName" value="" /></td>
</tr>
<tr>
    <td>{'categoryIndex_email'|lang}: </td>
    <td><input type="text" class="input_text_large" name="webmasterEmail" value="" /></td>
</tr>
<tr>
    <td>{'categoryIndex_website_title'|lang}: </td>
    <td><input type="text" class="input_text_large" name="siteTitle" value="" /></td>
</tr>
<tr>
    <td>{'categoryIndex_website_adress'|lang}: </td>
    <td><input type="text" class="input_text_metas" name="url" value="http://" /> <input type="button" class="button" value="{'categoryIndex_button_metas'|lang}" name="metaTagButton"/></td>
</tr>
<tr>
    <td>{'categoryIndex_rss_feed_title'|lang}:</td>
    <td><input type="text" class="input_text_large" name="rssTitle" value="" /></td>
</tr>
<tr>
    <td>{'categoryIndex_rss_feed_url'|lang}:</td>
    <td><input type="text" class="input_text_large" name="rssFeedOfSite" value="" /></td>
</tr>
<tr>
    <td>{'categoryIndex_backlink_adress'|lang}:</td>
    <td><input type="text" class="input_text_large" name="returnBond" value="" /></td>
</tr>
<tr>
    <td>{'categoryIndex_website_description'|lang}:</td>
    <td>
    {if $setting.siteDescriptionHtmlEnabledAdmin}
        <input type="radio" name="descriptionDisplayMethod" value="text"> {'categoryIndex_website_description_html_text'|lang}
        <input type="radio" name="descriptionDisplayMethod" value="htmlAdmin" checked="checked"> {'categoryIndex_website_description_html_admin'|lang}<br />
    {/if}
    <textarea class="textarea_extra_large" name="description" cols="50" rows="5" id="itemDescription"></textarea><br/>
    <span id="descriptionCharsLeftCounter"></span> {'categoryIndex_website_description_characters'|lang}
    </td>
</tr>
</tbody>
</table>
</div>
{if $setting.itemGalleryImagesEnabled}
<div class="column_in_subbmit">
{'categoryIndex_photos'|lang}
</div>
<div class="column_in_subbmit_out1">
<table class="table2" cellspacing="1">
<col class="col3" /><col class="col4" />
<tbody>
<tr>
    <td>{'categoryIndex_add_photos'|lang}:</td>
    <td><div id="fileUploadPanel" class="fileUploader">
        <input type="button" id="uploadGalleryImageButton" class="button" value="Add gallery image"/><br/><br/>
        </div>
    </td>
</tr>
</tbody>
</table>
</div>
{/if}
<div class="column_in_subbmit">
{'categoryIndex_new_fields'|lang}
</div>
<div class="column_in_subbmit_out">
<table class="table2" cellspacing="1">
<col class="col3" /><col class="col4" />
<tbody id="itemFormExtraFields">

</tbody>
</table>
</div>

<div class="column_in_subbmit">
{'categoryIndex_keywords'|lang}
</div>
<div class="column_in_subbmit_out">

<table class="table2" cellspacing="1" id="keywordsSelectTable">
<col class="col3" /><col class="col4" />
<textarea style="display:none;" id="keywordRowTemplate">
<tr>
    <td>{'categoryIndex_keyword'|lang} {literal}{0}{/literal}:</td>
    <td><select name="keywords[]">
            <option value=""> {'categoryIndex_select_keyword'|lang} </option>
                {foreach from=$allKeywordsList value=keyword key=keywordId}
                <option value="{$keywordId}" >{$keyword} </option>
                {/foreach}
        </select></td>
</tr>
</textarea>
</table>
</div>



{if $setting.companyInfoEnabled}
<div class="column_in_subbmit">
{'categoryIndex_company_information'|lang}
</div>
<div class="column_in_subbmit_out">
<table class="table2" cellspacing="1">
<col class="col3" /><col class="col4" />
<tbody>
<tr>
    <td>{'categoryIndex_adress'|lang}:</td>
    <td><input type="text" class="input_text_large" name="address" value="" /></td>
</tr>
<tr>
    <td>{'categoryIndex_postal_code'|lang}:</td>
    <td><input type="text" class="input_text_large" name="zipCode" value="" /></td>
</tr>
<tr>
    <td>{'categoryIndex_city'|lang}:</td>
    <td><input type="text" class="input_text_large" name="city" value="" /></td>
</tr>
<tr>
    <td>{'categoryIndex_country'|lang}:</td>
    <td><input type="text" class="input_text_large" name="country" value="" /></td>
</tr>
<tr>
    <td>{'categoryIndex_phone'|lang}:</td>
    <td><input type="text" class="input_text_large" name="phoneNumber" value="" /></td>
</tr>
<tr>
    <td>{'categoryIndex_fax'|lang}:</td>
    <td><input type="text" class="input_text_large" name="faxNumber" value="" /></td>
</tr>
</tbody>
</table>
</div>
{/if}

<div class="column_in_subbmit">
{'categoryIndex_others_info'|lang}
</div>
<div class="column_in_subbmit_out">
<table class="table2" cellspacing="1">
<col class="col3" /><col class="col4" />
<tbody>
<tr>
    <td>{'categoryIndex_priority'|lang}:</td>
    <td><select name="priority">
       {html_options options=$priorites}
        </select></td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td><div id="siteLoader" style="display:none;"> {'categoryIndex_checking'|lang} <img src="{"/templates/$templateName/images/loader.gif"|resurl}"></div></td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td><input type="submit" class="button" value="{'button_create'|lang}" /></td>
</tr>
</tbody>
</table>
</form>
</div>
</div>

<form id="editAdsForm">
<div class="title_h_2">
<h2>{'categoryIndex_advertisement_in'|lang} {$currentCategory.name}</h2>
</div>
<div class="column_in_table2">
<table class="table2" cellspacing="1">
<col class="col3" /><col class="col4" />
<tbody>
<tr>
    <td>{'categoryIndex_predefine_ad'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'categoryIndex_predefine_ad_desc1'|lang} {'categoryIndex_predefine_ad_desc2'|lang}" /></td>
    <td><input type="radio" name="predefine" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="predefine" value="0" /> {'Off'|lang}</td>
</tr>
<tr>
    <td>{'adPagesAll_activate_ad'|lang}: </td>
    <td><input type="radio" name="general" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="general" value="0" /> {'Off'|lang}</td>
</tr>
</tbody>
</table>
</div>

<div class="title_h_2">
<h2>{'categoryIndex_advertisement_in'|lang} {$currentCategory.name}</h2>
</div>
<div id="ads_principal">

<div id="ads_top1">
<div id="ads_top_left">
{'HEADER - BANNER'|lang}
</div>
<div id="ads_top_right">
<select name="header">
{html_options options=$adCriterias}
</select>
</div>
</div>

<div id="ads_top2">
{'HORIZONTAL MENU'|lang}
</div>

<div id="ads_main1">
<div id="ads_main2">

<div id="ads_left">
<div class="ads_menuleft">
<ul>
<li class="text">{'Left menu'|lang}</li>
</ul>
</div>
<div class="ads_menu_ads">
<select name="leftMenu">
{html_options options=$adCriterias}
</select>
</div>
</div>

<div id="ads_right">
<div class="ads_menuright">
<ul>
<li class="text">{'Right menu'|lang}</li>
</ul>
</div>
<div class="ads_menu_ads">
<select name="rightMenu">
{html_options options=$adCriterias}
</select>
</div>
</div>

<div id="ads_middle">
<div class="ads_column">

<div class="ads_show_arbo">
{'Root'|lang} &gt; {$currentCategory.name}
</div>

<div class="ads_column_in_select">
<select name="overSubcategories">
{html_options options=$adCriterias}
</select>
</div>

<div class="ads_title_out">
<div class="ads_title">
{'categoryIndex_category_name'|lang}
</div>
</div>
<div class="ads_column_in">
{'categoryIndex_category'|lang} 1 {'categoryIndex_category'|lang} 2<br />
{'categoryIndex_category'|lang} 3 {'categoryIndex_category'|lang} 4
</div>

<div class="ads_column_in_select">
<select name="overDescription">
{html_options options=$adCriterias}
</select>
</div>

<div class="ads_column_in">
<i>{'categoryIndex_category_description'|lang}</i>
</div>

<div class="ads_column_in_select">
<select name="overSitesList">
{html_options options=$adCriterias}
</select>
</div>

{for start=1 stop=10 step=1 value=i}
<div class="ads_column_in{cycle values='_grey,'}">
{'Website'|lang} {$i}
</div>

<div class="ads_column_in_select">
<select name="sitePosition{$i}">
{html_options options=$adCriterias}
</select>
</div>
{/for}

</div>
</div>

<div class="fixe">&nbsp;
</div>

</div>
</div>

<div id="ads_bottom">
<div class="ads_column_bottom">
{'FOOTER'|lang}
</div>
</div>

</div>

</form>


<form id="editAdsForm2">
<div class="title_h_2">
<h2>{'categoryIndex_h2_predefine_in'|lang} {$currentCategory.name}</h2>
</div>
<div class="column_in_table2">
<table class="table2" cellspacing="1">
<col class="col3" /><col class="col4" />
<tbody>
<tr>
    <td>{'categoryIndex_predefine_position_ad'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'categoryIndex_predefine_position_desc1'|lang} {'categoryIndex_predefine_position_desc2'|lang}" /></td>
    <td><input type="radio" name="general" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="general" value="0" /> {'Off'|lang}</td>
</tr>
</tbody>
</table>
</div> 
<div class="title_h_2">
<h2>{'categoryIndex_h2_predefine'|lang}</h2>
</div>
<div id="ads_principal">
    
<div id="ads_top1">
<div id="ads_top_left">
{'HEADER - BANNER'|lang}
</div>
<div id="ads_top_right">
<select name="header" class="select-categoriesandgames">
{html_options options=$adCriterias}
</select>
</div>
</div>

<div id="ads_top2">
{'HORIZONTAL MENU'|lang}
</div>
    
<div id="ads_main1">
<div id="ads_main2">
    
<div id="ads_left">
<div class="ads_menuleft">
<ul>
<li class="text">{'Left menu'|lang}</li>
</ul>
</div>
<div class="ads_menu_ads">
<select name="leftMenu">
{html_options options=$adCriterias}
</select>
</div>
</div>
    
<div id="ads_right">
<div class="ads_menuright">
<ul>
<li class="text">{'Right menu'|lang}</li>
</ul>
</div>
<div class="ads_menu_ads">
<select name="rightMenu" >
{html_options options=$adCriterias}
</select>
</div>
</div>
    
<div id="ads_middle">
<div class="ads_column">
    
<div class="ads_show_arbo">
{'Root'|lang} &gt; {'Website'|lang}</a>
</div>
    
<div class="ads_column_in_select"> 
<select name="overInformationOfWebsite" class="select-categoriesandgames">
{html_options options=$adCriterias}
</select>
</div>

<div class="ads_title_out"> 
<div class="ads_title">
{'predefineSite_website_title'|lang}
</div> 
</div> 
<div class="ads_column_in"> 
{'predefineSite_website_info'|lang}     
</div>
    
<div class="ads_column_in_select"> 
<select name="underInformationOfWebsite" class="select-categoriesandgames">
{html_options options=$adCriterias}
</select>
</div>
    
<div class="ads_column_in"> 
{'predefineSite_website_rss'|lang}
</div>
    
<div class="ads_column_in_select"> 
<select name="underInformationFluxRss" class="select-categoriesandgames">
{html_options options=$adCriterias}
</select>
</div>

<div class="ads_column_in">  
{'predefineSite_google'|lang}
</div>
        
<div class="ads_column_in_select"> 
<select name="underInformationGoogle" class="select-categoriesandgames">
{html_options options=$adCriterias}
</select>
</div>

<div class="ads_column_in">  
{'predefineSite_company'|lang}
</div>
        
<div class="ads_column_in_select"> 
<select name="underInformationCompany" class="select-categoriesandgames">
{html_options options=$adCriterias}
</select>
</div>

<div class="ads_column_in">  
{'predefineSite_category'|lang}
</div>
        
<div class="ads_column_in_select"> 
<select name="underThematicCloseWebsite" class="select-categoriesandgames">
{html_options options=$adCriterias}
</select>
</div>
    
</div> 
</div>
    
<div class="fixe">&nbsp;
</div>
    
</div>
</div>
       
<div id="ads_bottom">
<div class="ads_column_bottom">
{'FOOTER'|lang}
</div>
</div>
      
</div>
</form>

{/if}

{include file='includes/footer.tpl'}