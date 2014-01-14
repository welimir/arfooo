{capture assign="headData"}
    <script type="text/javascript" src="{'/javascript/config'|url}"></script>
    <script type="text/javascript" src="{'/javascript/jquery/jquery.js'|url}"></script>
    <script type="text/javascript" src="{'/moderation/javascript/site/jquery.waitingSitesUpdater.js'|resurl}"></script>  
    <script type="text/javascript" src="{'/moderation/javascript/site/waitingOnLoad.js'|resurl}"></script>
    <script type="text/javascript">
    var emailMessages = {$emailMessagesJSON|htmlspecialchars_decode};
    {if !empty($skipAutoRefresh)}
    setting.skipAutoRefresh = true;  
    {/if}
    </script>
    
{/capture}
{include file='includes/header.tpl' page="index" title=" $totalCount {'siteWaiting_html_title'|lang}" metaDescription=" $totalCount {'siteWaiting_meta_description'|lang}"}

<div id="left">

{include file='menu/menuleft/menuleftIndex.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/'|url}">{'menuMenuHeader_directory'|lang}</a> &gt; <a href="{'/admin/site/waiting'|url}">{'menuLeftIndex_pending'|lang}</a>
</div>

<div class="title_h_1">             
<h1><span id="countOfWaitingSites">{$totalCount}</span> {'siteWaiting_h1'|lang}</h1>
</div>

<form action="{'/admin/site/updateSiteState'|url}" method="post" id="waitingSitesForm">
<div id="holderOfWaitingSites">
{foreach from=$sites value=site}
<div class="column_in_waiting_site_{cycle values='grey,blue'}" id="siteItem{$site.siteId}">
<div class="column_in_waiting_site_checkbox">
<input type="checkbox" class="checkbox" name="siteIds[]" value="{$site.siteId}" />
</div>
<div class="column_in_waiting_site_image">
<img alt="{$site.siteTitle}" src="{$site.imageSrc}" class="website_image" />

{if $setting.countryFlagsEnabled && $site.countryCode}
<img src="{"/templates/arfooo/images/flags/$site.countryCode"|resurl}.png" alt="{$site.countryCode}" class="flag_image" />
{/if} 

</div>
<div class="column_in_waiting_site_text">
{$site.creationDate} - <strong>{$site.siteTitle}</strong>
<br />
<a href="{$site.url}" class="link_url_direct" target="_blank">{$site.url}</a> [ <a href="{"/admin/site/edit/$site.siteId"|url}" class="link_edit_site" >{'siteWaiting_edit_website'|lang}</a> ]
<br /> 
{'siteWaiting_cat'|lang} : {'Root'|lang} &gt; {foreach from=$site.categoryParentsData value=category} {$category.name} &gt; {/foreach} {$site.siteTitle}
<br /> 
{'siteWaiting_suggest_cat'|lang} : {$site.proposalForCategory}
<br /><br />
{'siteWaiting_description'|lang} : {$site.description|htmlspecialchars_decode|strip_tags}
<br /> 
{'siteWaiting_rss_feed'|lang} : {$site.rssTitle} <a href="{$site.rssFeedOfSite}" >{$site.rssFeedOfSite}</a>
<br />
{'siteWaiting_keywords'|lang} : {foreach from=$site.keywords value=keyword name=loop}{if $templatelite.foreach.loop.iteration > 1}, {/if}{$keyword.keyword}{/foreach} 
<br />
{'siteWaiting_suggest_key'|lang} : {$site.proposalForKeywords}
<br />
{if $site.returnBond} 
{'siteWaiting_backlink'|lang} : <a href="{$site.returnBond}" class="link_url_return" >{$site.returnBond}</a>
<br />
{/if}
{'siteWaiting_payment_detail'|lang} : 
{if $site.siteType == "basic"}
{'siteWaiting_payment_free'|lang}
{else}
{'siteWaiting_payment_premium'|lang} -  {$site.packageName} - {$site.paymentProcessorName}<br/>
{'siteWaiting_payment_status'|lang} : {switch from=$site.paymentStatus}
{case value="pending" }{'siteWaiting_payment_pending'|lang}
{case value="denied" }{'siteWaiting_payment_denied'|lang}
{case}{'siteWaiting_payment_paid'|lang}
{/switch}
{/if}
<br />
{if $setting.emailConfirmationEnabled && !$setting.registrationOfWebmastersEnabled}
{'siteWaiting_email_confirmed'|lang} : 
{if $site.emailConfirmed} {'Yes'|lang} {else} {'No'|lang} {/if}
<br />
{/if} 
<br />
<b>{'siteWaiting_select_email'|lang}:</b>
<br />
<input type="radio" name="emailType[{$site.siteId}]" value="default" checked="checked" siteid="{$site.siteId}" onclick="$('messageTable[{$site.siteId}]').hide();" /> {'siteWaiting_email_default'|lang} &nbsp;&nbsp;<input type="radio" name="emailType[{$site.siteId}]" value="custom" siteid="{$site.siteId}" onclick="$('messageTable[{$site.siteId}]').show();"/> {'siteWaiting_email_custo'|lang}  
<br />
<table class="table3" cellspacing="1" style="display:none" id="messageTable[{$site.siteId}]">
<tbody>
{if !empty($emailMessages)}
<tr>
    <td>{'siteWaiting_predefined_email'|lang}: </td>
    <td><select name="messageId[{$site.siteId}]" onchange="fillCustomMessage({$site.siteId})">
    {foreach from=$emailMessages value=email key=messageId}
    <option value="">{'siteWaiting_select_customized_email'|lang}</option>
    <option value="{$messageId}">{$email.userText}</option>
    {/foreach}
    
    </select></td>
</tr>
{/if}
<tr>
    <td>{'siteWaiting_subject'|lang}: </td>
    <td><input type="text" class="input_text_large" name="subject[{$site.siteId}]" value="" /></td>
</tr>
<tr>
    <td>{'siteWaiting_message'|lang}: </td>
    <td>
    <input type="button" class="button" value="[url site]" onclick="addCodeToMessage({$site.siteId}, this.value)" />
    <input type="button" class="button" value="[site name]" onclick="addCodeToMessage({$site.siteId}, this.value)" /> 
    <input type="button" class="button" value="[url site details]" onclick="addCodeToMessage({$site.siteId}, this.value)" />
    <input type="button" class="button" value="[description of the site]" onclick="addCodeToMessage({$site.siteId}, this.value)" /> <br/>
    <input type="button" class="button" value="[name of the category]" onclick="addCodeToMessage({$site.siteId}, this.value)" /> 
    <input type="button" class="button" value="[name of directory]" onclick="addCodeToMessage({$site.siteId}, this.value)" />
    <input type="button" class="button" value="[url of your directory]" onclick="addCodeToMessage({$site.siteId}, this.value)" />
    <br/>
    <textarea class="textarea_extra_large" name="description[{$site.siteId}]" cols="50" rows="5"></textarea></td>
</tr>
</tbody>
</table>

</div>
</div>

{/foreach}

{include file="includes/pageNavigation.tpl"}

</div>

<div class="column_in_waiting_site_button">
<select name="status" >
<option value="validated" selected="selected"> {'siteWaiting_validate'|lang} </option>
<option value="refused" > {'siteWaiting_refuse'|lang} </option>
<option value="banned" > {'siteWaiting_ban'|lang} </option>
</select>
<input type="button" class="button" value="{'siteWaiting_button_check'|lang}" id="selectAllButton"/>
<input type="submit" class="button" value="{'siteWaiting_button_ok'|lang}" />
</div> 

</form>

 

{include file='includes/footer.tpl'}  