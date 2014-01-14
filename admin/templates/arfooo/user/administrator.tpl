{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/config'|url}"></script> 
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.adminFormTool.js'|resurl}"></script>
{/capture}

{include file='includes/header.tpl' page="user" title="{'userAdministrator_html_title'|lang}" metaDescription="{'userAdministrator_meta_description'|lang}"}  

<div id="left">

{include file='menu/menuleft/menuleftUsers.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/user'|url}">{'menuMenuHeader_users'|lang}</a> &gt; <a href="{'/admin/user/administrator'|url}">{'menuLeftUsers_admin'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'userAdministrator_h1'|lang}</h1>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<thead>
<tr>
	<th>{'userAdministrator_login'|lang}</th>
	<th>{'Management'|lang}</th>
</tr>
</thead>
<tbody>

{foreach from=$admins value=admin}
<tr class="line{cycle values='1,2'}">
	<td>{$admin.login}</td>
	<td><a href="{"/admin/user/editAdministrator/$admin.userId"|url}" class="link_green">{'link_edit'|lang}</a> | 
		{if $admin.userId != 1}<a onclick="return $.confirmLinkClick('{'Do you really want to delete it?'|lang}', this.href)" href="{"/admin/user/delete/$admin.userId"|url}" class="link_red">{'link_delete'|lang}</a>{/if}</td>
</tr>
{/foreach}

</tbody>
</table>
</div>

<div class="title_h_2">
<h2>{'userAdministrator_h2'|lang}</h2>
</div>
<div class="column_in_table2">
<form action="{'/admin/user/saveNewUser'|url}" method="post">
<input type="hidden" name="role" value="administrator"/>
<table class="table2" cellspacing="1">
<col class="col3" /><col class="col4" />
<tbody>
<tr>
	<td>{'userAdministrator_login'|lang}: </td>
	<td><input type="text" class="input_text_medium" name="login" value="" /></td>
</tr>
<tr>
	<td>{'userAdministrator_pass'|lang}: </td>
	<td><input type="password" class="input_text_medium" name="password" value="" /></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" class="button" value="{'button_save'|lang}" /></td>
</tr>
</tbody>
</table>
</form>
</div>

{include file='includes/footer.tpl'}    