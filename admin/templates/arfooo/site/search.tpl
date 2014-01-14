{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/config'|url}"></script> 
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.adminFormTool.js'|resurl}"></script>
{/capture}

{include file='includes/header.tpl' page="index" title="{'siteSearch_html_title'|lang}" metaDescription="{'siteSearch_meta_description'|lang}"} 

<div id="left">

{include file='menu/menuleft/menuleftIndex.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/'|url}">{'menuMenuHeader_directory'|lang}</a> &gt; <a href="{'/admin/site/search'|url}">{'menuLeftIndex_search'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'siteSearch_h1'|lang}</h1>
</div>
<div class="column_in">
<form action="{'/admin/site/search'|url}" method="post">
{'siteSearch_desc1'|lang}<br /><br />
<input type="text" class="input_text_medium" name="searchedUrl" value="" /> <input type="submit" class="button" value="{'siteSearch_button_search'|lang}" />
</form>
</div>

<div class="title_h_2">
<h2>{'siteSearch_h2'|lang}</h2>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<thead>
<tr>
    <th>{'siteSearch_th_website_name'|lang}</th>
	<th>{'siteSearch_th_url'|lang}</th>
	<th>{'siteSearch_th_ban'|lang}</th>
	<th>{'siteSearch_th_backlink'|lang}</th>
	<th>{'Management'|lang}</th>
</tr>
</thead>
<tbody>
{foreach from=$sites value=site}
<tr class="line{cycle values='1,2'}">
    <td><a href="{"/admin/site/edit/$site.siteId"|url}" title="{$site.siteTitle}">{$site.siteTitle}</a></td>
	<td><a href="{"/admin/site/edit/$site.siteId"|url}" title="{$site.siteTitle}">{$site.url}</a></td>
	<td>{if $site.status == 'banned'}<span class="text_red">{'Yes'|lang}</span>{else}<span class="text_green">{'No'|lang}</span>{/if}</td>
	<td>{if $site.returnBond == ''}<span class="text_red">{'No'|lang}</span>{else}<span class="text_green">{'Yes'|lang}</span>{/if}</td>
	<td><a href="{"/admin/site/edit/$site.siteId"|url}" class="link_green">{'link_edit'|lang}</a> | 
		<a onclick="return $.confirmLinkClick('{'Do you really want to delete it?'|lang}', this.href)" href="{"/admin/site/delete/$site.siteId"|url}" class="link_red">{'link_delete'|lang}</a></td>
</tr>
{/foreach}
</tbody>
</table>
</div>

{include file='includes/footer.tpl'} 