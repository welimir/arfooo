{capture assign="headData"}
<link href="{"/templates/$templateName/css/upload.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/config'|url}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.livequery.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery-validate/jquery.validate.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/tooltip/jquery.tooltip.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/tooltip/jquery.tooltip.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.form.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.formTool.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.autoFill.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.fileUploader.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.charCounter.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.captchaCode.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.chainSelect.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.keywordSelector.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.itemEditor.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.ajaxUpload.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/tiny_mce/tiny_mce.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/tiny_mce/basic_config.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.popup.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/webmaster/submitWebsiteOnLoad.js'|resurl}"></script>
<script type="text/javascript">  
{if !empty($edit)}
setting.edit = true;
setting.item = {$itemJson|htmlspecialchars_decode};
setting.itemId = setting.item.itemId;
{else}
setting.tempId = "{$tempId}";
{/if}
setting.newUser = {if empty($session.login)}true{else}false{/if};
</script>
{if $setting.registrationOfWebmastersEnabled && $sessionLifeTime}
<script type="text/javascript">
var sessionLifeTime = {$sessionLifeTime};
{literal}
function sessionKeepAlive() {
    $.post(AppRouter.getRewrittedUrl('/javascript/config'));
}
window.setInterval(sessionKeepAlive, 1000 * sessionLifeTime / 2);
{/literal}
</script>
{/if}

<script type="text/javascript">
{if !empty($package)}
setting.siteDescriptionMaxLength = {$package.siteDescriptionMaxLength};
setting.maxKeywordsCountPerSite = {$package.maxKeywordsCountPerSite};
setting.siteDescriptionMinLength = {$package.siteDescriptionMinLength};
{/if}
{if isset($siteId)}
setting.siteId = {$siteId};
{/if}
setting.backLinkCodeDataUrl = "{'/webmaster/getBackLinkData'|url}";

{if ($setting.siteDescriptionHtmlEnabled && empty($package))
    || (!empty($package) && $package.siteDescriptionHtmlEnabled)}
tinyMCE.execCommand('mceAddControl', false, 'itemDescription');
{/if}
</script>
{/capture}

{include file="includes/header.tpl" title="{'webmasterSubmitWebsite_html_title'|lang}" metaDescription="{'webmasterSubmitWebsite_meta_description'|lang}"}

{assign var="totalSteps" value=4}

{if $setting.companyInfoEnabled || $setting.googleMapEnabled}
{math equation="x + 1" x=$totalSteps assign="totalSteps"}
{/if}

{if $setting.keywordsEnabled}
{math equation="x + 1" x=$totalSteps assign="totalSteps"}
{/if}


<div class="show_arbo">
<a href="{$setting.siteRootUrl}" class="link_showarbo">{'show_arbo_directory'|lang} </a> &gt; 
{if $setting.registrationOfWebmastersEnabled}<a href="{'/webmaster/manage'|url}" class="link_showarbo">{'webmasterSubmitWebsite_arbo'|lang}</a> &gt; {/if}
<a href="{'/webmaster/submitWebsite'|url}" class="link_showarbo">{'webmasterSubmitWebsite_arbo2'|lang}</a>
</div>

<div class="title_h">
<h1>{'webmasterSubmitWebsite_step'|lang} {counter}/{$totalSteps} &nbsp;&nbsp;{'webmasterSubmitWebsite_select_categorie'|lang}</h1>
</div>

<form action="{'/webmaster/saveNewWebsite'|url}" method="post" id="itemForm">
<input type="hidden" name="siteType" value="{$siteType}"/> 

<fieldset class="column_in">
<input type="hidden" name="preview" value="0"/>
{if !empty($edit)}
<input type="hidden" name="siteId" value=""/>
{else}
<input type="hidden" name="tempId" value="{$tempId}"/>  
{/if}

    <br />
    <p class="form">
    <label class="infos_select_category">
    <select name="categoryId1" size="15" style="color:#000;border:1px solid #666;width:200px;">
    <option value=""></option>
    </select>
    <input type="text" name="categoryId" value="" style="display:none"/> 
    </label>
    </p>
	
	<div class="form">
    <label class="title">{'webmasterSubmitWebsite_suggest_cat'|lang}</label>
    <label class="infos"><input type="text" class="input_text_large" name="proposalForCategory" value="" /></label>
    </div>
</fieldset>

<span id="selectOtherCategoryDiv" style="display:none;">
<b>{'webmasterSubmitWebsite_select_other_category'|lang}</b>
</span>

<div id="newItemStepsDiv" style="display:none;"> 

<div class="title_h">
<h2>{'webmasterSubmitWebsite_step'|lang} {counter}/{$totalSteps}  &nbsp;&nbsp;{'webmasterSubmitWebsite_general_information'|lang}</h2>
</div>
<fieldset class="column_in">  
    <div class="form">
    <label class="title"><span class="text_color_mandatory">*</span></label>
    <div class="infos">{'webmasterSubmitWebsite_mandatory_fields'|lang}</div>
    </div>
	
	{if $setting.countryFlagsEnabled}
    <div class="form">
    <label class="title">{'webmasterSubmitWebsite_language_site'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos"><select name="countryCode" class="" id="countryCode">
        				 <option value=''>{'webmasterSubmitWebsite_select_language_site'|lang}</option>
        				 {html_options options=$countryFlags}
      					 </select>
						 <img src="" alt="" id="countryFlagImage" style="display:none;" /></div>
    </div>
	{/if}

    {if !$setting.registrationOfWebmastersEnabled}
    <div class="form">
    <label class="title">{'webmasterSubmitWebsite_webmaster_email'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos"><input type="text" class="input_text_large" name="webmasterEmail" value="" /> <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'webmasterSubmitWebsite_webmaster_email_tooltip'|lang}" /></div>
    </div>
    {/if}
    
    <div class="form">
    <label class="title">{'webmasterSubmitWebsite_website_title'|lang} <span class="text_color_mandatory">*</span></label>
	<div class="infos"><input type="text" class="input_text_large" name="siteTitle" value="" /> <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'webmasterSubmitWebsite_website_title_tooltip'|lang}" /></div>
    </div>
    
    <div class="form">
    <label class="title">{'webmasterSubmitWebsite_website_url'|lang} {if $setting.urlMandatory}<span class="text_color_mandatory">*</span>{/if}</label>
    <div class="infos"><input type="text" class="input_text_metas" name="url" value="http://" /> <input type="button" class="button" value="{'webmasterSubmitWebsite_button_metas'|lang}" id="metaTagButton" /> <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'webmasterSubmitWebsite_website_url_tooltip'|lang}" /></div>
    </div>
	
	<div class="form">
    <label class="title">{'webmasterSubmitWebsite_rss_feed_title'|lang}</label>
    <div class="infos"><input type="text" class="input_text_large" name="rssTitle" value="" /> <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'webmasterSubmitWebsite_rss_feed_title_tooltip'|lang}" /></div>
    </div>
	
	<div class="form">
    <label class="title">{'webmasterSubmitWebsite_rss_feed_url'|lang}</label>
    <div class="infos"><input type="text" class="input_text_large" name="rssFeedOfSite" value="" /> <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'webmasterSubmitWebsite_rss_feed_url_tooltip'|lang}" /></div>
    </div>
	
	<div id="itemFormExtraFields">
    </div>
	
	<div class="form">
    <label class="title">{'webmasterSubmitWebsite_website_desc'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos"><div class="infos_textarea"><textarea class="textarea_extra_large" name="description" cols="50" rows="5" id="itemDescription"></textarea></div><img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide_description" title="{'webmasterSubmitWebsite_website_desc_tooltip'|lang}"/><br style="clear:both;"/>
    <span id="descriptionCharsLeftCounter"></span> {'webmasterSubmitWebsite_characters_left'|lang}</div>
    </div>
    
    {if $setting.itemGalleryImagesEnabled}
    <div class="form">
    <label class="title">{'webmasterSubmitWebsite_add_photo'|lang}</label>
    <div class="infos">
        <div id="fileUploadPanel" class="fileUploader">
        <input type="button" id="uploadGalleryImageButton" class="button" value="{'webmasterSubmitWebsite_add_photo_button'|lang}"><br/>
        </div>
    </div>
    </div>
    {/if}
	
	{if $setting.partnershipSearchingEnabled} 
    <div class="form">
    <label class="title">{'webmasterSubmitWebsite_search_partnership'|lang}</label>
    <div class="infos"><input type="checkbox" name="searchPartnership" value="1"> <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'webmasterSubmitWebsite_search_partnership_tooltip'|lang}" /></div>
    </div>
    {/if}
</fieldset>

{if $setting.companyInfoEnabled || $setting.googleMapEnabled}
<div class="title_h">
<h2>{'webmasterSubmitWebsite_step'|lang} {counter}/{$totalSteps} &nbsp;&nbsp;{'webmasterSubmitWebsite_company_info'|lang}</h2>
</div>
<fieldset class="column_in">
    
    <div class="form">
    <label class="title">{'webmasterSubmitWebsite_adress'|lang}</label>
    <div class="infos"><input type="text" class="input_text_large" name="address" value="" /></div>
    </div>
    
    <div class="form">
    <label class="title">{'webmasterSubmitWebsite_postal_code'|lang}</label>
	<div class="infos"><input type="text" class="input_text_small" name="zipCode" value="" /></div>
    </div>
    
    <div class="form">
    <label class="title">{'webmasterSubmitWebsite_city'|lang}</label>
    <div class="infos"><input type="text" class="input_text_medium" name="city" value="" /></div>
    </div>
	
	<div class="form">
    <label class="title">{'webmasterSubmitWebsite_country'|lang}</label>
    <div class="infos"><input type="text" class="input_text_medium" name="country" value="" /></div>
    </div>
	
	<div class="form">
    <label class="title">{'webmasterSubmitWebsite_phone'|lang}</label>
    <div class="infos"><input type="text" class="input_text_medium" name="phoneNumber" value="" /></div>
    </div>
	
	<div class="form">
    <label class="title">{'webmasterSubmitWebsite_fax'|lang}</label>
    <div class="infos"><input type="text" class="input_text_medium" name="faxNumber" value="" /></div>
    </div>
  
</fieldset>
{/if}

{if $setting.keywordsEnabled}
<div class="title_h">
<h2>{'webmasterSubmitWebsite_step'|lang} {counter}/{$totalSteps} &nbsp;&nbsp;{'webmasterSubmitWebsite_select_keywords'|lang}</h2>
</div>
<fieldset class="column_in">

<textarea style="display:none;" id="keywordRowTemplate">
    &lt;div class="form"&gt;
    &lt;label class="title"&gt;{'webmasterSubmitWebsite_keyword'|lang} {literal}{0}{/literal}&lt;/label&gt;
    &lt;div class="infos"&gt;&lt;select name="keywords[]"&gt;
                        &lt;option value=""&gt; {'webmasterSubmitWebsite_select_your_keyword'|lang} &lt;/option&gt;
                        {foreach from=$allKeywordsList value=keyword key=keywordId}
                        &lt;option value="{$keywordId}" &gt;{$keyword} &lt;/option&gt;
                        {/foreach}
                        &lt;/select&gt;&lt;/div&gt;
    &lt;/div&gt;
</textarea>

<div id="keywordsSelectTable">

</div>
    
    <div class="form">
    <label class="title">{'webmasterSubmitWebsite_suggest_keywords'|lang}</label>
	<div class="infos"><input type="text" class="input_text_large" name="proposalForKeywords" value="" /></div>
    </div>

</fieldset>
{/if}

<div class="title_h">
<h2>{'webmasterSubmitWebsite_step'|lang} {counter}/{$totalSteps} &nbsp;&nbsp;{'webmasterSubmitWebsite_backlink'|lang}</h2>
</div>
<fieldset class="column_in">
    
    <div class="form">
    <label class="title">&nbsp;</label>
	<div class="infos">{'webmasterSubmitWebsite_backlink_desc'|lang}.<br />
	{'webmasterSubmitWebsite_desc2'|lang}.<br />
	{'webmasterSubmitWebsite_desc3'|lang}.<br /> 
	{'webmasterSubmitWebsite_desc4'|lang}</div>
    </div>
	
	<div class="form">
    <label class="title">{'webmasterSubmitWebsite_backlink_url'|lang}</label>
	<div class="infos"><input type="text" class="input_text_large" name="returnBond" value="" /></div>
    </div>
	
	{if $setting.backLinkHtmlCode1Enabled}
	<div class="form">
    <label class="title">{'webmasterSubmitWebsite_backlink_html1'|lang}</label>
	<div class="infos"><textarea class="textarea_return" name="backLinkCode1" cols="50" rows="5">&lt;a href="{if $setting.backLinkHtmlCode1Url}{$setting.backLinkHtmlCode1Url|htmlspecialchars}{else}{$setting.siteRootUrl|htmlspecialchars}{/if}"&gt;{if $setting.backLinkHtmlCode1Text}{$setting.backLinkHtmlCode1Text|htmlspecialchars}{else}{$setting.siteTitle|htmlspecialchars}{/if}&lt;/a&gt;</textarea><img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide_description" title="{'webmasterSubmitWebsite_backlink_html_tooltip'|lang}"></div>
    </div>
	{/if}
	
	{if $setting.backLinkHtmlCode2Enabled}
	<div class="form">
    <label class="title">{'webmasterSubmitWebsite_backlink_html2'|lang}</label>
	<div class="infos"><textarea class="textarea_return" name="backLinkCode2" cols="50" rows="5"></textarea><img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide_description" title="{'webmasterSubmitWebsite_backlink_html_tooltip'|lang}"></div>
    </div>
	{/if}
</fieldset>

<div class="title_h">
<h2>{'webmasterSubmitWebsite_step'|lang} {counter}/{$totalSteps} &nbsp;&nbsp;{'webmasterSubmitWebsite_submit_website'|lang}</h2>
</div>
<fieldset class="column_in">
	{if $setting.newsletterEnabled}
	<div class="form">
    <label class="title">{'webmasterSubmitWebsite_subscribe_newsletter'|lang}</label>
	<div class="infos"><input type="checkbox" name="newsletterActive" value="1"></div>
    </div>
	{/if}
	
    {if $setting.captchaEnabledOnSiteInscription && (empty($session.role) || $session.role != "webmaster")}
    <div class="form">
    <label class="title">{'webmasterSubmitWebsite_security_code'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos captchaCode"></div>
    </div>
    {/if}
    
    <div class="form">
    <label class="title">&nbsp;</label>
    <div class="infos_terms">{'webmasterSubmitWebsite_terms_use_desc'|lang} <a href="{'/info/useCondition'|url}" class="link_small_underline" target="_blank">{'webmasterSubmitWebsite_read_terms'|lang}</a></div>
    </div>
	
	<div class="form">
    <label class="title">&nbsp;</label>
	<div class="infos"><div id="siteLoader" style="display:none;"> {'webmasterSubmitWebsite_checking'|lang} <img src="{"/templates/$templateName/images/loader.gif"|resurl}"></div> <input type="submit" class="button" value="{'webmasterSubmitWebsite_button_submit'|lang}" /></div>
    </div>
</fieldset>


</div>
</form>

{include file="includes/footer.tpl"}