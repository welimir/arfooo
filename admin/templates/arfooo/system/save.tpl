{include file='includes/header.tpl' page="system" title="{'systemSave_html_title'|lang}" metaDescription="{'systemSave_meta_description'|lang}"}  

<div id="left">

{include file='menu/menuleft/menuleftSystem.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/system'|url}">{'menuMenuHeader_system'|lang}</a> &gt; <a href="{'/admin/system/save'|url}">{'menuLeftSystem_save'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'systemSave_h1'|lang}</h1>
</div>
<div class="column_in">
{'systemSave_desc1'|lang}<br />
{'systemSave_desc2'|lang}<br /><br />
<strong>{'systemRestore_desc3'|lang}</strong>
</div>

<div class="column_in_table2">
<form action="{'/admin/system/save'|url}" method="post">
<table class="table2" cellspacing="1">
<col class="col3" /><col class="col4" />
<tbody>
<tr>
	<td>{'systemRestore_file_type'|lang}: </td>
	<td><input type="radio" name="fileType" value="gz" checked="checked" /> {'systemRestore_file_gzip'|lang} &nbsp;&nbsp;<input type="radio" name="fileType" value="sql" /> {'systemRestore_file_text'|lang}</td>
</tr>
<tr>
	<td>{'systemSave_action'|lang}: </td>
	<td><input type="radio" name="saveMethod" value="store|download" checked="checked" /> {'systemSave_action_both'|lang} &nbsp;&nbsp;<input type="radio" name="saveMethod" value="download" /> {'systemSave_action_dl'|lang} &nbsp;&nbsp;<input type="radio" name="saveMethod" value="store" /> {'systemSave_action_store'|lang}</td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" class="button" value="{'button_save'|lang}" /></td>
</tr>
</tbody>
</table>
</div>

{include file='includes/footer.tpl'}     