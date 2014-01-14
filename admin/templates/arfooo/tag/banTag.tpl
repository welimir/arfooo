{include file='includes/header.tpl' page="user" title="{'tagBan_html_title'|lang}" metaDescription="{'tagBan_meta_description'|lang}"}

<div id="left">

{include file='menu/menuleft/menuleftUsers.tpl'}

</div>

<div id="right">
</div>

<div id="middle">
<div class="column">

<div id="show_arbo">
<a href="{'/admin/user'|url}">{'menuMenuHeader_users'|lang}</a> &gt; <a href="{'/admin/tag/banTag'|url}">{'menuLeftUsers_ban_tags'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'tagBan_h1'|lang}</h1>
</div>
<div class="column_in">
{'tagBan_desc1'|lang}<br />
{'tagBan_desc2'|lang}
</div>

<div class="title_h_2">
<h2>{'tagBan_h1'|lang}</h2>
</div>
<div class="column_in_table2">
<form action="{'/admin/tag/saveNewTagBan'|url}" method="post">
<table class="table2" cellspacing="1">
<tbody>
<tr>
    <td>{'tagBan_tags'|lang}: </td>
    <td><textarea class="textarea_large" name="bannedTags" cols="50" rows="5"></textarea></td>
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
<h2>{'Remove tags banned'|lang}</h2>
</div>
<div class="column_in_table2">
<form action="{'/admin/tag/deleteTagBan'|url}" method="post">
<table class="table2" cellspacing="1">
<tbody>
<tr>
    <td>{'tagBan_tags'|lang}: </td>
    <td><select id="unban" name="unbanTags[]" multiple="multiple" size="5" style="width: 250px" >
    {html_options options=$bannedTags}
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