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
<a href="{$site.url}" title="{$site.siteTitle}" class="link_url_direct" target="_blank">{$site.url}</a> [ <a href="{"/moderation/site/edit/$site.siteId"|url}" class="link_edit_site" >{'siteWaiting_edit_website'|lang}</a> ]
<br /> 
{'siteWaiting_description'|lang} : {$site.description}
<br /> 
{'siteWaiting_rss_feed'|lang} : {$site.rssTitle} <a href="{$site.rssFeedOfSite}" >{$site.rssFeedOfSite}</a>
<br />
{'siteWaiting_keywords'|lang} : {foreach from=$site.keywords value=keyword name=loop}{if $templatelite.foreach.loop.iteration > 1}, {/if}{$keyword.keyword}{/foreach} 
<br />
{'siteWaiting_cat'|lang} : <b>{'Root'|lang}</b> &gt; {foreach from=$site.categoryParentsData value=category}
              <b>{$category.name}</b> &gt;
           {/foreach} </b> <b>{$site.siteTitle}</b>                     
<br />
{'siteWaiting_suggest_cat'|lang} : {$site.proposalForCategory} 
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
    <input type="button" class="button autocode" value="[url site]" />
    <input type="button" class="button autocode" value="[site name]" /> 
    <input type="button" class="button autocode" value="[url site details]" />
    <input type="button" class="button autocode" value="[description of the site]" /> <br/>
    <input type="button" class="button autocode" value="[name of the category]" /> 
    <input type="button" class="button autocode" value="[name of directory]" />
    <input type="button" class="button autocode" value="[url of your directory]" />
    <br/>
    <textarea class="textarea_extra_large" name="description[{$site.siteId}]" cols="50" rows="5"></textarea></td>
</tr>
</tbody>
</table>

</div>
</div>

{/foreach}