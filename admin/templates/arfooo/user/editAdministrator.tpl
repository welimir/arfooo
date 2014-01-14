{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/config'|url}"></script> 
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.adminFormTool.js'|resurl}"></script>
{/capture}

{include file='includes/header.tpl' page="user" title="{'userEditAdmin_html_title'|lang}" metaDescription="{'userEditAdmin_meta_description'|lang}"}  

<div id="left">

{include file='menu/menuleft/menuleftUsers.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/user'|url}">{'menuMenuHeader_users'|lang}</a> &gt; <a href="{'/admin/user/administrator'|url}">{'menuLeftUsers_admin'|lang}</a> &gt; {$administrator.email}
</div>
                             
<div class="title_h_1">
<h1>{'userEditAdmin_h1'|lang} : {$administrator.email}</h1>
</div>
<div class="column_in_table2">
<form action="{"/admin/user/save"|url}" method="post">
<input type="hidden" name="userId" value="{$administrator.userId}"/>
<table class="table2" cellspacing="1">
<col class="col3" /><col class="col4" />
<tbody>
<tr>
	<td>{'userAdministrator_login'|lang}: </td>
	<td><input type="text" class="input_text_medium" name="login" value="{$administrator.login}" /></td>
</tr>
<tr>
    <td>{'userAdministrator_password'|lang}: </td>
    <td><input type="text" class="input_text_medium" name="password" value="" /></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" name="save" class="button" value="{'button_save'|lang}" /> {if $administrator.userId != 1}<input type="submit" name="delete" class="button" value="{'button_delete'|lang}" onclick="return $.confirmLinkClick('{'Do you really want to delete it?'|lang}', '{"/admin/user/delete/$administrator.userId"|url}');" />{/if}</td>
</tr>
</tbody>
</table>
</form>
</div>

{include file='includes/footer.tpl'}    