{include file='includes/header.tpl' page="main" title="{'mainChangePassword_html_title'|lang}" metaDescription="{'mainChangePassword_meta_description'|lang}"} 

<div id="left">

{include file='menu/menuleft/menuleftUsers.tpl'} 
</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div class="title_h_1">
<h1>{'mainChangePassword_h1'|lang}</h1>
</div>
<div class="column_in_table2">
<form id="changePasswordForm" method="post" action="{'/moderation/main/saveNewPassword'|url}">
<table class="table2" cellspacing="1">
<col class="col3" /><col class="col4" />
<tbody>
<tr>
	<td>{'mainChangePassword_new_pass'|lang}: </td>
	<td><input type="password" class="input_text_medium" name="newPassword" value="" /></td>
</tr>
<tr>
	<td>{'mainChangePassword_repeat_new_pass'|lang}: </td>
	<td><input type="password" class="input_text_medium" name="repeatedNewPassword" value="" /></td>
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