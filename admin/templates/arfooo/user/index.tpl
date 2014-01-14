{include file='includes/header.tpl' page="user" title="{'userIndex_html_title'|lang}" metaDescription="{'userIndex_meta_description'|lang}"} 

<div id="left">

{include file='menu/menuleft/menuleftUsers.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/user'|url}">{'menuMenuHeader_users'|lang}</a> &gt; <a href="{'/admin/user'|url}">{'menuLeftUsers_change_pass'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'userIndex_h1'|lang}</h1>
</div>
<div class="column_in_table2">
<form action="{'/admin/user/saveNewAdminPassword'|url}" method="post">
<table class="table2" cellspacing="1">
<col class="col3" /><col class="col4" />
<tbody>
<tr>
	<td>{'userIndex_new_pass'|lang}: </td>
	<td><input type="password" class="input_text_medium" name="newPassword" value="" /></td>
</tr>
<tr>
	<td>{'userIndex_repeat_new_pass'|lang}: </td>
	<td><input type="password" class="input_text_medium" name="repeatedNewPassword" value="" /></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" class="button" value="{'button_save'|lang}"  /></td>
</tr>
</tbody>
</table>  
</form>
</div>

{include file='includes/footer.tpl'}   