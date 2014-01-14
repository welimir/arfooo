{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/config'|url}"></script> 
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.adminFormTool.js'|resurl}"></script>
{/capture}

{include file='includes/header.tpl' page="user" title="{'userWebmaster_html_title'|lang}" metaDescription="{'userWebmaster_meta_description'|lang}"}   

<div id="left">

{include file='menu/menuleft/menuleftUsers.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/user'|url}">{'menuMenuHeader_users'|lang}</a> &gt; <a href="{'/admin/user/webmaster'|url}">{'menuLeftUsers_webmasters'|lang}</a>
</div>

<div class="title_h_1">
<h1>{$webmastersCount} {'userWebmaster_h1'|lang}</h1>
</div>
<div class="column_in">
{'userWebmaster_desc1'|lang}<br />
{'userWebmaster_desc2'|lang}<br />
<form action="{'/admin/user/webmaster'|url}" method="post">
{'userWebmaster_desc3'|lang}<br /><br />
<input type="text" class="input_text_medium" name="searchedEmail" value="{if !empty($searchedEmail)}{$searchedEmail}{/if}" /> <input type="submit" class="button" value="{'siteSearch_button_search'|lang}" />
</form>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<thead>
<tr>
	<th>{'userWebmaster_th_email'|lang}</th>
	<th>{'userWebmaster_th_web'|lang}</th>
	<th>{'Management'|lang}</th>
</tr>
</thead>
<tbody>
{foreach from=$webmasters value=webmaster}
<tr class="line{cycle values='1,2'}">
	<td>{$webmaster.email}</td>
	<td>{$webmaster.sitesCount}</td>
	<td><a href="{"/admin/user/editWebmaster/$webmaster.userId"|url}" class="link_green">{'link_edit'|lang}</a> | 
		<a onclick="return $.confirmLinkClick('{'Do you really want to delete it?'|lang}', this.href)" href="{"/admin/user/deleteWebmaster/$webmaster.userId"|url}" class="link_red">{'link_delete'|lang}</a></td>
</tr>
{/foreach}
</tbody>
</table>
{include file="includes/pageNavigation.tpl"}
</div>

{include file='includes/footer.tpl'}    