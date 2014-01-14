{capture assign="headData"}
    <script type="text/javascript" src="{'/javascript/config'|url}"></script>
    <script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
    <script type="text/javascript" src="{'/javascript/jquery/jquery.form.js'|resurl}"></script>
    <script type="text/javascript" src="{'/javascript/jquery/jquery.backgroundTask.js'|resurl}"></script>
    <script type="text/javascript" src="{'/admin/javascript/site/errorCodeOnLoad.js'|resurl}"></script>
{/capture}

{include file='includes/header.tpl' page="index" title="{'siteErrorCode_html_title'|lang}" metaDescription="{'siteErrorCode_meta_description'|lang}"} 

<div id="left">

{include file='menu/menuleft/menuleftIndex.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/'|url}">{'menuMenuHeader_directory'|lang}</a> &gt; <a href="{'/admin/site/errorCode'|url}">{'menuLeftIndex_error'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'siteErrorCode_h1'|lang}</h1>
</div>
<div class="column_in">
    
    <div style="display:none" id="progressInformation">
    {'siteErrorCode_status'|lang}: <b><span id="taskStatus"></span></b> &nbsp;
    {'siteErrorCode_progress'|lang}: <b><span id="taskPercentage">0%</span></b> &nbsp;
    {'siteErrorCode_checked_sites'|lang}: <b><span id="taskParsedItems">0</span></b> 
    <br/>
    <div style="width:100%;border: 1px solid #000; background: #fff; height: 10px;display:none" id="progressBarOutline">
       <div style="width:0%; background: #7AB; height: 100%" id="progressBar"></div>
    </div>
    <br/>
    </div>  
    
<form id="backgroundTaskControlForm"> 
{'siteErrorCode_desc1'|lang}<br /><br />
    <input type="button" class="button" name="start" value="{'button_start'|lang}" />
    <input type="button" class="button" name="pause" value="{'button_pause'|lang}" style="display:none" />
    <input type="button" class="button" name="resume" value="{'button_resume'|lang}" style="display:none" />
    <input type="button" class="button" name="stop" value="{'button_stop'|lang}" style="display:none" />
</form>
</div>

<div class="column_in_table">
<table class="table1" cellspacing="1">
<thead>
<tr>
	<th>{'siteErrorCode_th_website_name'|lang}</th>
	<th>{'siteErrorCode_th_http'|lang}</th>
	<th>{'Management'|lang}</th>
</tr>
</thead>
<tbody>
{foreach from=$sites value=site}
<tr class="line{cycle values='1,2'}">
	<td><a href="{"/admin/site/edit/$site.siteId"|url}" title="{$site.siteTitle}">{$site.siteTitle}</a></td>
	<td><span class="text_red">{$site.httpCode}</span></td>
	<td><a href="{"/admin/site/edit/$site.siteId"|url}" class="link_green">{'link_edit'|lang}</a></td>
</tr>
{/foreach}
</tbody>
</table>
</div>

{include file='includes/footer.tpl'}  