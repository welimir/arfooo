{include file='includes/header.tpl' page="user" title="{'siteBanSite_html_title'|lang}" metaDescription="{'siteBanSite_html_title'|lang}"}

<div id="left">

{include file='menu/menuleft/menuleftUsers.tpl'}

</div>

<div id="right">
</div>

<div id="middle">
<div class="column">

<div id="show_arbo">
<a href="{'/admin/user'|url}">{'menuMenuHeader_users'|lang}</a> &gt; <a href="{'/admin/site/banSite'|url}">{'menuLeftUsers_ban_website'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'siteBanSite_h1'|lang}</h1>
</div>
<div class="column_in">
{'siteBanSite_desc1'|lang}<br />
{'siteBanSite_desc2'|lang}
</div>

<div class="title_h_2">
<h2>{'siteBanSite_h1'|lang}</h2>
</div>
<div class="column_in_table2">
<form action="{'/admin/site/saveNewSiteBan'|url}" method="post">
<table class="table2" cellspacing="1">
<tbody>
<tr>
    <td>{'Websites'|lang}: </td>
    <td><textarea class="textarea_large" name="bannedSites" cols="50" rows="5"></textarea></td>
</tr>
<tr>
    <td></td>
    <td><input type="submit" class="button" value="{'button_save'|lang}"  /></td>
</tr>
</tbody>
</table>
</form>
</div>

<div class="title_h_2">
<h2>{'siteBanSite_h2_unban'|lang}</h2>
</div>
<div class="column_in_table2">
<form action="{'/admin/site/deleteSiteBan'|url}" method="post">
<table class="table2" cellspacing="1">
<tbody>
<tr>
    <td>{'Websites'|lang}: </td>
    <td><select id="unban" name="unbanSites[]" multiple="multiple" size="5" style="width: 250px" >
    {html_options options=$bannedSites}
    </select></td>
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