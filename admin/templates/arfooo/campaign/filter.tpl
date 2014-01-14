{include file='includes/header.tpl' page="user" title="{'campaignFilter_html_title'|lang}" metaDescription="{'campaignFilter_meta_description'|lang}"}

<div id="left">

{include file='menu/menuleft/menuleftUsers.tpl'}

</div>

<div id="right">
</div>

<div id="middle">
<div class="column">

<div id="show_arbo">
<a href="{'/admin/user'|url}">{'menuMenuHeader_users'|lang}</a> &gt; <a href="{'/admin/campaign/filter'|url}">{'campaignFilter_arbo'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'campaignFilter_h1'|lang}</h1>
</div>
<div class="column_in">
{'campaignFilter_desc1'|lang}<br />
{'campaignFilter_desc2'|lang}<br /><br />
{'campaignFilter_desc3'|lang}<br />
{'campaignFilter_desc4'|lang}<br /><br />
<b>{'campaignFilter_desc5'|lang}</b><br />
{'campaignFilter_desc6'|lang}<br />
{'campaignFilter_desc7'|lang}
</div>

<div class="title_h_2">
<h2>{'campaignFilter_add_filters'|lang}</h2>
</div>
<div class="column_in_table2">
<form action="{'/admin/campaign/saveNewFilter'|url}" method="post">
<table class="table2" cellspacing="1">
<tbody>
<tr>
    <td>{'campaignFilter_filters'|lang}: </td>
    <td><textarea class="textarea_large" name="filters" cols="50" rows="5"></textarea></td>
</tr>
<tr>
    <td></td>
    <td><input type="submit" class="button" value="{'campaignFilter_add'|lang}"  /></td>
</tr>
</tbody>
</table>
</form>
</div>

<div class="title_h_2">
<h2>{'campaignFilter_remove_filters'|lang}</h2>
</div>
<div class="column_in_table2">
<form action="{'/admin/campaign/deleteFilter'|url}" method="post">
<table class="table2" cellspacing="1">
<tbody>
<tr>
    <td>{'campaignFilter_filters'|lang}: </td>
    <td><select id="unban" name="filters[]" multiple="multiple" size="5" style="width: 250px" >
    {html_options options=$filters}
    </select></td>
</tr>
<tr>
    <td></td>
    <td><input type="submit" class="button" value="{'campaignFilter_remove'|lang}" /></td>
</tr>
</tbody>
</table>
</form>
</div>

{include file='includes/footer.tpl'}