{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/config'|url}"></script> 
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.adminFormTool.js'|resurl}"></script>
{/capture}

{include file='includes/header.tpl' page="user" title="{'userModerator_html_title'|lang}" metaDescription="{'userModerator_meta_description'|lang}"}  

<div id="left">

{include file='menu/menuleft/menuleftUsers.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/user'|url}">{'menuMenuHeader_users'|lang}</a> &gt; <a href="{'/admin/user/moderator'|url}">{'menuLeftUsers_moderators'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'userModerator_h1'|lang}</h1>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<thead>
<tr>
	<th>{'userModerator_th_login'|lang}</th>
	<th>{'userModerator_th_websites'|lang}</th>
	<th>{'Management'|lang}</th>
</tr>
</thead>
<tbody>

{foreach from=$moderators value=moderator}
<tr class="line{cycle values='1,2'}">
	<td>{$moderator.email}</td>     
	<td>{$moderator.validatedCount} | {$moderator.refusedCount} | {$moderator.bannedCount}</td>
	<td><a href="{"/admin/user/editModerator/$moderator.userId"|url}" class="link_green">{'link_edit'|lang}</a> | 
		<a onclick="return $.confirmLinkClick('{'Do you really want to delete it?'|lang}', this.href)" href="{"/admin/user/delete/$moderator.userId"|url}" class="link_red">{'link_delete'|lang}</a></td>
</tr>
{/foreach}

</tbody>
</table>
</div>

<div class="title_h_2">
<h2>{'userModerator_h2'|lang}</h2>
</div>
<div class="column_in_table2">
<form action="{'/admin/user/saveNewUser'|url}" method="post">
<input type="hidden" name="role" value="moderator"/>
<table class="table2" cellspacing="1">
<col class="col3" /><col class="col4" />
<tbody>
<tr>
	<td>{'userModerator_email'|lang}: </td>
	<td><input type="text" class="input_text_medium" name="login" value="" /></td>
</tr>
<tr>
	<td>{'userModerator_password'|lang}: </td>
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