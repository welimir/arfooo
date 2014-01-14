{capture assign="headData"}
<link href="{"/templates/$templateName/css/upload.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/config'|url}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.chainSelect.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.autoFill.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.fileUploader.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.charCounter.js'|resurl}"></script>
<script type="text/javascript" src="{'/admin/javascript/ad/jquery.adEditor.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.livequery.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery-validate/jquery.validate.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.keywordSelector.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.form.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.adminFormTool.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.itemEditor.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.popup.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.ajaxUpload.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/tiny_mce/tiny_mce.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/tiny_mce/basic_config.js'|resurl}"></script>
<script type="text/javascript" src="{'/admin/javascript/comment/CommentEditor.js'|resurl}"></script>
<script type="text/javascript" src="{'/admin/javascript/site/editOnLoad.js'|resurl}"></script>
<script type="text/javascript">
// <![CDATA[
setting.siteDescriptionMaxLength = 0;
setting.siteDescriptionMinLength = 0;
setting.maxKeywordsCountPerSite = 1000; // admin has no limit
setting.siteId = {$siteId};
setting.item = {$siteJson|htmlspecialchars_decode};
setting.adPage = "site{$siteId}";
setting.websiteDataUrl = "/admin/site/getWebsiteData";
setting.webmasterDataUrl = "/admin/site/getWebmasterData";
// ]]>
</script>
{/capture}

{include file='includes/header.tpl' page="index" title="{'siteEdit_html_title'|lang}" metaDescription="{'siteEdit_meta_description'|lang}"}

<div id="left">

{include file='menu/menuleft/menuleftIndex.tpl'}

</div>

<div id="right">
</div>

<div id="middle">
<div class="column">

<div id="show_arbo">
<a href="{'/admin/'|url}">{'menuMenuHeader_directory'|lang}</a> &gt; <a href="{'/admin/category'|url}">{'menuLeftIndex_site_cat'|lang}</a> &gt; <a href="{'/admin/category'|url}" class="link_bold">{'Root'|lang}</a>
{foreach from=$site.categoryParentsData value=category}
    &gt; <a href="{"/admin/category/index/$category.categoryId/"|url}" class="link_bold"> {$category.name} </a>
{/foreach}
&gt; <a href="{"/admin/site/edit/$site.siteId"|url}" class="link_bold">{$site.siteTitle}</a> 
</div>

<div class="title_h_1">
<h1>{'siteEdit_h1'|lang}</h1>
</div>
<form action="{"/admin/site/saveSite"|url}" method="post" id="itemForm">
<div class="column_in_table2">
<input type="hidden" name="siteId" value="{$siteId}"/>
<div class="column_in_subbmit_first">
{'siteEdit_cat'|lang}
</div>
<div class="column_in_subbmit_out1">
<table class="table2" cellspacing="1">
<col class="col5-1"/><col class="col5-2"/>
<tbody>
<tr>
    <td>{'siteEdit_cat'|lang}: </td>
    <td><select name="categoryId">
                    <option value=''></option>
                    {html_options options=$selectCategories}
        </select></td>
</tr>
<tr>
<td>{'siteEdit_additional_categories'|lang}:</td>
<td>
<select name="additionalCategoryIds[]" size="5" multiple="multiple">
<option value="">{'siteEdit_additional_categories_none'|lang}</option>
{html_options options=$selectCategories}
</select>
</td>
</tr>
<tr>
    <td>{'siteEdit_category_proposal'|lang}:</td>
    <td><input type="text" class="input_text_large" name="proposalForCategory" value="" /></td>
</tr>
</tbody>
</table>
</div>


<div class="column_in_subbmit">
{'siteEdit_images'|lang}
</div>
<div class="column_in_subbmit_out1">
<table class="table2" cellspacing="1" style="width:100%">
<col class="col3"/><col class="col4"/>
<tbody>
{if $setting.itemGalleryImagesEnabled}
<tr>
    <td>{'siteEdit_add_images'|lang}:</td>
    <td><div id="fileUploadPanel" class="fileUploader">
        <input type="button" id="uploadGalleryImageButton" class="button" value="{'siteEdit_add_an_image'|lang}"/><br/><br/>
        </div>
    </td>
</tr>
{/if}
<tr>
    <td>{'siteEdit_thumbs'|lang}:</td>
    <td>
	<div class="column_in_edit_image">
    {if $displayRemoveImage}<span id="removeImageLink"><a href="{"/admin/site/deleteSiteImage/$site.siteId"|url}" onclick="return $.confirmLinkClick('{'siteEdit_delete_image'|lang}', this.href);">{'siteEdit_delete_thumbs_customized'|lang}</a><br /></span>{/if}
    <img src="{$site.imageSrc}" alt="" class="website_image" id="siteThumb"/><br style='clear:both;'/>
    <input type="button" id="uploadThumbButton" class="button" value="{'siteEdit_upload_another_thumbs'|lang}"/>
	</div>
	</td>
</tr>
<tr>
<td></td>
<td> <a href="{"/admin/site/setThumb/$site.siteId/refresh"|url}">{'siteEdit_update_thumbs'|lang}</a><br/>
     <a href="{"/admin/site/setThumb/$site.siteId/delnormal"|url}">{'siteEdit_delete_thumbs'|lang}</a><br/>
     <a href="{"/admin/site/setThumb/$site.siteId/delascreen"|url}">{'siteEdit_delete_ascreen'|lang}</a>
</td>
</tr>
</tbody>
</table>
</div>

<div class="column_in_subbmit">
{'siteEdit_general_information'|lang}
</div>
<div class="column_in_subbmit_out">
<div class="column_in_table3">
<table class="table2" cellspacing="1">
<col class="col3"/><col class="col4"/>
<tbody>
{if $setting.countryFlagsEnabled}
<tr>
    <td>{'siteEdit_language_site'|lang}: </td>
    <td><select name="countryCode" class="" id="countryCode">

        <option value=''>{'siteEdit_select_language_site'|lang}</option>
        {html_options options=$countryFlags}
        </select>
        <img src="" alt="" id="countryFlagImage" style="display:none;" />
    </td>
</tr>
{/if}

<tr>
    <td>{'siteEdit_webmaster_email'|lang}: </td>
    <td><select name="webmasterId">
        {html_options options=$webmasters selected=$site.webmasterId}
        </select></td>
</tr>
<tr>
    <td>{'siteEdit_webmaster_name'|lang}: </td>
    <td><input type="text" class="input_text_large" name="webmasterName" value="" /></td>
</tr>
<tr>
    <td>{'siteEdit_webmaster_email'|lang}: </td>
    <td><input type="text" class="input_text_large" name="webmasterEmail" value="" />(<a href="{"/contact/contactPopup/$site.siteId"|url}" class="dialog link_green" id="contactAdvertiserLink">{'siteEdit_webmaster_contact'|lang}</a>)</td>
</tr>
<tr>
    <td>{'siteEdit_website_title'|lang}: </td>
    <td><input type="text" class="input_text_large" name="siteTitle" value="" /></td>
</tr>
<tr>
    <td>{'siteEdit_website_url'|lang}: </td>
    <td><input type="text" class="input_text_metas" name="url" value="http://" /> <input type="button" class="button" value="{'siteEdit_button_metas'|lang}" id="metaTagButton"/> (<a href="{$site.url}" class="link_green" target="_blank">{'siteEdit_display_website'|lang}</a>)</td>
</tr>
<tr>
    <td>{'siteEdit_rss_feed_title'|lang}:</td>
    <td><input type="text" class="input_text_large" name="rssTitle" value="" /></td>
</tr>
<tr>
    <td>{'siteEdit_rss_feed_url'|lang}:</td>
    <td><input type="text" class="input_text_large" name="rssFeedOfSite" value="" /> {if $site.rssFeedOfSite}(<a href="{$site.rssFeedOfSite}" class="link_green" target="_blank">{'siteEdit_display_rss_feed'|lang}</a>){/if}</td>
</tr>
<tr>
    <td>{'siteEdit_backlink_url'|lang}:</td>
    <td><input type="text" class="input_text_large" name="returnBond" value="" /></td>
</tr>
<tr>
    <td>{'siteEdit_website_desc'|lang}:</td>
    <td>
        {if $setting.siteDescriptionHtmlEnabledAdmin}
        <input type="radio" name="descriptionDisplayMethod" value="text"> {'siteEdit_website_html_text'|lang}
        <input type="radio" name="descriptionDisplayMethod" value="html"> {'siteEdit_website_html_user'|lang}
        <input type="radio" name="descriptionDisplayMethod" value="htmlAdmin"> {'siteEdit_website_html_admin'|lang}<br />
        {/if}
        <textarea class="textarea_extra_large" name="description" cols="50" rows="5" id="itemDescription"></textarea><br/>
        <span id="descriptionCharsLeftCounter"></span> characters
    </td>
</tr>
</tbody>
</table>
</div>

<div class="column_in_subbmit">
{'siteEdit_additional_fields'|lang}
</div>
<div class="column_in_subbmit_out">
<table class="table2" cellspacing="1">
<col class="col3"/><col class="col4"/>
<tbody id="itemFormExtraFields">

</tbody>
</table>
</div>

<div class="column_in_subbmit">
{'siteEdit_select_keywords'|lang}
</div>
<div class="column_in_subbmit_out">
<table class="table2" cellspacing="1" id="keywordsSelectTable">
<col class="col3"/><col class="col4"/>
<textarea style="display:none;" id="keywordRowTemplate">
<tr>
    <td>{'siteEdit_keyword'|lang} {literal}{0}{/literal}:</td>
    <td><select name="keywords[]">
            <option value=""> {'siteEdit_select_keyword'|lang} </option>
                {foreach from=$allKeywordsList value=keyword key=keywordId}
                <option value="{$keywordId}" >{$keyword} </option>
                {/foreach}
        </select></td>
</tr>
</textarea>
</table>
</div>

<div class="column_in_subbmit_out">
<table class="table2" cellspacing="1">
<col class="col3"/><col class="col4"/>
<tr>
    <td>{'siteEdit_keyword_proposal'|lang}:</td>
    <td><input type="text" class="input_text_large" name="proposalForKeywords" value="" /></td>
</tr>
</table>
</div>

{if $setting.companyInfoEnabled}
<div class="column_in_subbmit">
{'siteEdit_company_info'|lang}
</div>
<div class="column_in_subbmit_out">
<table class="table2" cellspacing="1">
<col class="col3"/><col class="col4"/>
<tbody>
<tr>
    <td>{'siteEdit_adress'|lang}:</td>
    <td><input type="text" class="input_text_large" name="address" value="" /> {if $setting.googleMapEnabled && !empty($site.address) && !empty($site.city) && !empty($site.country)}(<a href="{"/admin/site/showGoogleMap/$site.siteId"|url}" class="link_green" target="_blank">{'siteEdit_display_google_maps'|lang}</a>){/if} </td>
</tr>
<tr>
    <td>{'siteEdit_postal_code'|lang}:</td>
    <td><input type="text" class="input_text_large" name="zipCode" value="" /></td>
</tr>
<tr>
    <td>{'siteEdit_city'|lang}:</td>
    <td><input type="text" class="input_text_large" name="city" value="" /></td>
</tr>
<tr>
    <td>{'siteEdit_country'|lang}:</td>
    <td><input type="text" class="input_text_large" name="country" value="" /></td>
</tr>
<tr>
    <td>{'siteEdit_phone'|lang}:</td>
    <td><input type="text" class="input_text_large" name="phoneNumber" value="" /></td>
</tr>
<tr>
    <td>{'siteEdit_fax'|lang}:</td>
    <td><input type="text" class="input_text_large" name="faxNumber" value="" /></td>
</tr>
</tbody>
</table>
</div>
{/if}

<div class="column_in_subbmit">
{'siteEdit_other_settings'|lang}
</div>
<div class="column_in_subbmit_out">
<table class="table2" cellspacing="1">
<col class="col3"/><col class="col4"/>
<tbody>
<tr>
    <td>{'siteEdit_hits_numbers'|lang}:</td>
    <td><input type="text" class="input_text_small" name="visitsCount" value="" /></td>
</tr>
<tr>
    <td>{'siteEdit_rating_number'|lang}:</td>
    <td><input type="text" class="input_text_small" name="votesCount" value="" readonly="readonly"/></td>
</tr>
<tr>
    <td>{'siteEdit_rating_average'|lang}:</td>
    <td><input type="text" class="input_text_small" name="votesAverage" value="" readonly="readonly"/></td>
</tr>
<tr>
    <td>{'siteEdit_visitors_sent'|lang}:</td>
    <td><input type="text" class="input_text_small" name="referrerTimes" value="" /></td>
</tr>
<tr>
    <td>{'siteEdit_website_problem'|lang}:</td>
    <td><select name="problemExists">
        {html_options options=$yesNoOptions}
        </select></td>
</tr>
<tr>
    <td>{'siteEdit_websiste_status'|lang}:</td>
    <td><select name="status">
        <option value="validated"> {'siteEdit_websiste_approved'|lang} </option>
        <option value="waiting" selected="selected"> {'siteEdit_websiste_pending'|lang} </option>
        <option value="banned"> {'siteEdit_websiste_banned'|lang} </option>
        </select></td>
</tr>
<tr>
    <td>{'siteEdit_website_priority'|lang}:</td>
    <td><select name="priority" class="select-categoriesandgames">
       {html_options options=$priorites}
        </select></td>
</tr>

{if $setting.partnershipSearchingEnabled} 
<tr>
<td> {'siteEdit_search_partner'|lang}:</td>
<td><input type="checkbox" name="searchPartnership" value="1"/></td>
</tr>
{/if}
<tr>
    <td>{'siteEdit_website_payment_detail'|lang}:</td>
    <td>
{if $site.siteType == "basic"}
{'siteEdit_payment_free'|lang}
{else}
{'siteEdit_payment_premium'|lang} - {$package.name} - {$site.paymentProcessorName} <br/>
{'siteEdit_payment_status'|lang} : {switch from=$site.paymentStatus}
{case value="pending" }{'siteEdit_payment_status_pending'|lang}
{case value="denied" }{'siteEdit_payment_status_denied'|lang}
{case}{'siteEdit_payment_status_paid'|lang}
{/switch}
{/if}</td>
</tr>
<tr>
    <td>{'siteEdit_webmaster_IP'|lang}:</td>
    <td>{$site.ip}</td>
</tr>
<tr>
    <td></td>
    <td>
    <div id="siteLoader" style="display:none;"> {'siteEdit_checking_website'|lang} <img src="{"/templates/$templateName/images/loader.gif"|resurl}" /></div>
    <input type="submit" class="button" value="{'button_save'|lang}" /> <input type="button" class="button" value="{'button_delete'|lang}" onclick="return $.confirmLinkClick('{'Do you really want to delete it?'|lang}', '{"/admin/site/delete/$siteId/1"|url}');"  /></td>
</tr>
</tbody>
</table>
</div>
</div>

</div>
</form>

<div class="title_h_2">
<h2>{'siteEdit_website_comments'|lang}</h2>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<thead>
<tr>
    <th>{'siteEdit_th_comments'|lang}</th>
    <th>{'siteEdit_th_users'|lang}</th>
    <th>{'siteEdit_th_date'|lang}</th>
    <th>{'siteEdit_th_ip'|lang}</th>
    <th>{'siteEdit_th_validated'|lang}</th>
    <th>{'Management'|lang}</th>
</tr>
</thead>
<tbody>
{foreach from=$comments value=comment}
<form id="commentForm{$comment.commentId}">
<tr class="line{cycle values='1,2'}" id="commentForm{$comment.commentId}">
    <td><textarea class="textarea_large" name="text" cols="50" rows="5">{$comment.text}</textarea></td>
    <td><input type="text" class="input_text_small" name="pseudo" value="{$comment.pseudo}" /></td>
    <td><input type="text" class="input_text_small" name="date" value="{$comment.date}" /></td>
    <td>{$comment.remoteIp}</td>
    <td>{if $comment.validated}<span class="text_green">{'Yes'|lang}</span>{else}<span class="text_red">{'No'|lang}</span>{/if}</td>
    <td>
    <input type="hidden" name="commentId" value="{$comment.commentId}"/>
    <input type="hidden" name="remoteIp" value="{$comment.remoteIp}"/>
    <a href="" title="Save comment" class="link_green" rel="save">{'link_save'|lang}</a> |
        <a href="" title="Delete comment" class="link_red" rel="delete">{'link_delete'|lang}</a> |
        <a href="" title="Ban IP" class="link_red" rel="banIp" >{'link_ban'|lang}</a></td>
</tr>
</form>
{/foreach}
</tbody>
</table>
</div>


<form id="editAdsForm">
<div class="title_h_2">
<h2>{'siteEdit_ad_website_detail'|lang}</h2>
</div>
<div class="column_in_table2">
<table class="table2" cellspacing="1">
<tbody>
<tr>
    <td>{'adPagesAll_activate_ad'|lang}: </td>
    <td><input type="radio" name="general" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="general" value="0" checked="checked"  /> {'Off'|lang}</td>
</tr>
</tbody>
</table>
</div>

<div class="title_h_2">
<h2>{'siteEdit_ad_website_detail'|lang}</h2>
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
<select name="rightMenu">
{html_options options=$adCriterias}
</select>
</div>
</div>

<div id="ads_middle">
<div class="ads_column">

<div class="ads_show_arbo">
{'Root'|lang} {foreach from=$site.categoryParentsData value=category} &gt; {$category.name} {/foreach} &gt; {$site.siteTitle}
</div>

<div class="ads_column_in_select">
<select name="overInformationOfWebsite" class="select-categoriesandgames">
{html_options options=$adCriterias}
</select>
</div>

<div class="ads_title_out">
<div class="ads_title">
{$site.siteTitle}
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

{include file='includes/footer.tpl'}