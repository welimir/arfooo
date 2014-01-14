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
<script type="text/javascript" src="{'/moderation/javascript/site/editOnLoad.js'|resurl}"></script>
<script type="text/javascript">
// <![CDATA[
setting.siteDescriptionMaxLength = 0;
setting.siteDescriptionMinLength = 0;
setting.maxKeywordsCountPerSite = 1000; // admin has no limit
setting.siteId = {$siteId};
setting.item = {$siteJson|htmlspecialchars_decode};
setting.adPage = "site{$siteId}";
setting.websiteDataUrl = "/moderation/site/getWebsiteData";
setting.webmasterDataUrl = "/moderation/site/getWebmasterData";
// ]]>
</script>
{/capture}

{include file='includes/header.tpl' page="site" title="{'siteEdit_html_title'|lang}" metaDescription="{'siteEdit_meta_description'|lang}"}

<div id="left">

{include file='menu/menuleft/menuleftIndex.tpl'}

</div>

<div id="right">
</div>

<div id="middle">
<div class="column">

<div id="show_arbo">
<a href="{'/moderation/'|url}">{'menuMenuHeader_directory'|lang}</a> &gt; <a href="{'/moderation/'|url}" title="{'Waiting sites'|lang}">{'menuLeftIndex_pending'|lang}</a> &gt; <a href="{'/admin/category'|url}" class="link_bold">{'Root'|lang}</a>
{foreach from=$site.categoryParentsData value=category}
    &gt; <a href="{"/admin/category/index/$category.categoryId/"|url}" class="link_bold"> {$category.name} </a>
{/foreach}
&gt; <a href="{"/admin/site/edit/$site.siteId"|url}" class="link_bold">{$site.siteTitle}</a> 
</div>

<div class="title_h_1">
<h1>{'siteEdit_h1'|lang}</h1>
</div>
<div class="column_in_table2">
<form action="{"/moderation/site/saveSite"|url}" method="post" id="itemForm">
<input type="hidden" name="siteId" value="{$siteId}"/>
<div class="column_in_subbmit_first">
{'siteEdit_cat'|lang}
</div>
<div class="column_in_subbmit_out1">
<table class="table2" cellspacing="1">
<col class="col5-1"><col class="col5-2">
<tbody>
<tr>
    <td>{'siteEdit_cat'|lang}: </td>
    <td><select name="categoryId">
                    <option value=''></option>
                    {html_options options=$selectCategories}
        </select></td>
</tr>
</tbody>
</table>
</div>


<div class="column_in_subbmit">
{'siteEdit_images'|lang}
</div>
<div class="column_in_subbmit_out1">
<table class="table2" cellspacing="1" style="width:100%">
<col class="col3"><col class="col4">
<tbody>
{if $setting.itemGalleryImagesEnabled}
<tr>
    <td>{'siteEdit_add_images'|lang}:</td>
    <td><div id="fileUploadPanel" class="fileUploader">
        <input type="button" id="uploadGalleryImageButton" class="button" value="Add gallery image"/><br/><br/>
        </div>
    </td>
</tr>
{/if}
<tr>
    <td>{'siteEdit_thumbs'|lang}:</td>
    <td>
    <div class="column_in_edit_image">
    {if $displayRemoveImage}<span id="removeImageLink"><a href="{"/admin/site/deleteSiteImage/$site.siteId"|url}" onclick="return $.confirmLinkClick('{'siteEdit_delete_image'|lang}', this.href);">{'link_delete'|lang}</a><br /></span>{/if}
    <img src="{$site.imageSrc}" alt="" class="website_image" id="siteThumb"/><br style='clear:both;'/>
    <input type="button" id="uploadThumbButton" class="button" value="Change thumb image"/>
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
<col class="col3"><col class="col4">
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
        <input type="radio" name="descriptionDisplayMethod" value="text"> Text
        <input type="radio" name="descriptionDisplayMethod" value="html"> Html
        <input type="radio" name="descriptionDisplayMethod" value="htmlAdmin"> Html admin<br/>
        {/if}
    <textarea class="textarea_extra_large" name="description" cols="50" rows="5" id="itemDescription"></textarea>
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
<col class="col3"><col class="col4">
<tbody id="itemFormExtraFields">

</tbody>
</table>
</div>

<div class="column_in_subbmit">
{'siteEdit_select_keywords'|lang}
</div>
<div class="column_in_subbmit_out">
<table class="table2" cellspacing="1" id="keywordsSelectTable">
<col class="col3"><col class="col4">
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

{if $setting.companyInfoEnabled}
<div class="column_in_subbmit">
{'siteEdit_company_info'|lang}
</div>
<div class="column_in_subbmit_out">
<table class="table2" cellspacing="1">
<col class="col3"><col class="col4">
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
<col class="col3"><col class="col4">
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
{'siteEdit_payment_premium'|lang} -  {$package.name} - {$site.paymentProcessorName} <br/>
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
    <div id="siteLoader" style="display:none;"> {'siteEdit_checking_website'|lang} <img src="{"/templates/$templateName/images/loader.gif"|resurl}"></div>
    <input type="submit" class="button" value="{'button_save'|lang}" /> <input type="button" class="button" value="{'button_delete'|lang}" onclick="return $.confirmLinkClick('{'Do you really want to delete it?'|lang}', '{"/admin/site/delete/$siteId/1"|url}');"  /></td>
</tr>
</tbody>
</table>
</form>
</div>
</div>


</div>

{include file='includes/footer.tpl'} 
