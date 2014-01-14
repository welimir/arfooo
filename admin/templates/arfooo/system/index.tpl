{include file='includes/header.tpl' page="system" title="{'systemIndex_html_title'|lang}" metaDescription="{'systemIndex_meta_description'|lang}"} 

<div id="left">

{include file='menu/menuleft/menuleftSystem.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/system'|url}">{'menuMenuHeader_system'|lang}</a> &gt; <a href="{'/admin/system'|url}">{'menuLeftSystem_check_updates'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'systemIndex_h1'|lang}</h1>
</div>
<div class="column_in">
{'systemIndex_desc'|lang}.
</div>

{if $newVersionAvailable}
<div class="column_in_bad_version">
{'systemCheckSecurity_desc1'|lang}
{'systemCheckSecurity_desc2'|lang}
</div>
{else}
<div class="column_in_good_version">
{'systemIndex_desc1'|lang}
</div>
{/if}

<div class="column_in_table2">
<table class="table2" cellspacing="1">
<col class="col3" /><col class="col4" />
<tbody>
<tr>
	<td>{'systemIndex_current'|lang}: </td>
	<td><strong>{$currentVersion}</strong></td>
</tr>
<tr>
	<td>{'systemIndex_last'|lang}: </td>
	<td><strong>{$lastVersion}</strong></td>
</tr>
</tbody>
</table>
</div>

{include file='includes/footer.tpl'}   