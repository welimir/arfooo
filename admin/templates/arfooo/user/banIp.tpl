{include file='includes/header.tpl' page="user" title="{'userBanIp_html_title'|lang}" metaDescription="{'userBanIp_meta_description'|lang}"}  

<div id="left">

{include file='menu/menuleft/menuleftUsers.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/user'|url}">{'menuMenuHeader_users'|lang}</a> &gt; <a href="{'/admin/user/banIp'|url}">{'menuLeftUsers_ban_ip'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'userBanIp_h1'|lang}</h1>
</div>
<div class="column_in">
{'userBanIp_desc1'|lang}<br />
{'userBanIp_desc2'|lang}
</div>

<div class="title_h_2">
<h2>{'userBanIp_h1'|lang}</h2>
</div>
<div class="column_in_table2">
<form action="{'/admin/user/saveNewIpBan'|url}" method="post"> 
<table class="table2" cellspacing="1">
<tbody>
<tr>
	<td>{'userBanIp_ip'|lang}: </td>
	<td><textarea class="textarea_large" name="bannedIps" cols="50" rows="5"></textarea></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" class="button" value="{'tagBan_button_ban_tags'|lang}"  /></td>
</tr>
</tbody>
</table>
</form>
</div>

<div class="title_h_2">
<h2>{'userBanIp_unban_ip'|lang}</h2>
</div>
<div class="column_in_table2">
<form action="{'/admin/user/deleteIpBan'|url}" method="post">    
<table class="table2" cellspacing="1">
<tbody>
<tr>
	<td>{'userBanIp_ip'|lang}: </td>
	<td><select id="unban" name="unbanIps[]" multiple="multiple" size="5" style="width: 250px" >
    {html_options options=$bannedIps} 
    </select></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" class="button" value="{'tagBan_button_unban_tags'|lang}" /></td>
</tr>
</tbody>
</table>
</form>
</div>

{include file='includes/footer.tpl'}    