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
{include file='includes/header.tpl' page="site" title="{'siteWaiting_html_title'|lang}"} 

<div id="left">
{include file='menu/menuleft/menuleftIndex.tpl'} 
</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div class="title_h_2">
<h2><span id="countOfWaitingSites">{$totalCount}</span> {'sites in wait'|lang}</h2>
</div>

<form action="{'/moderation/site/updateSiteState'|url}" method="post" id="waitingSitesForm"> 
<div id="holderOfWaitingSites">
{include file='site/item.tpl'}

{include file="includes/pageNavigation.tpl"} 
 
</div>
<div class="column_in_waiting_site_button">
<select name="status" >
<option value="validated" selected="selected"> {'siteWaiting_validate'|lang} </option>
<option value="refused" > {'siteWaiting_refuse'|lang} </option>
<option value="banned" > {'siteWaiting_ban'|lang} </option>
</select>
<input type="button" class="button" value="{'siteWaiting_button_check'|lang}" id="selectAllButton" />
<input type="submit" class="button" value="{'siteWaiting_button_ok'|lang}" />
</div>

</form> 

{include file='includes/footer.tpl'} 