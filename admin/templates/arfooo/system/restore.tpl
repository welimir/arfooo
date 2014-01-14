{include file='includes/header.tpl' page="system" title="{'systemRestore_html_title'|lang}" metaDescription="{'systemRestore_meta_description'|lang}"}   

<div id="left">

{include file='menu/menuleft/menuleftSystem.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/system'|url}">{'menuMenuHeader_system'|lang}</a> &gt; <a href="{'/admin/system/restore'|url}">{'menuLeftSystem_restore'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'systemRestore_h1'|lang}</h1>
</div>
<div class="column_in">
{'systemRestore_desc1'|lang}<br />
{'systemRestore_desc2'|lang}<br /><br />
<strong>{'systemRestore_desc3'|lang}<br /><br />
{'systemRestore_desc4'|lang}
{'systemRestore_desc5'|lang}<br />
{'systemRestore_desc6'|lang}</strong>
</div>

<div class="column_in_table2">
<form action="{'/admin/system/restore'|url}" method="post" enctype="multipart/form-data">
<table class="table2" cellspacing="1">
<col class="col3" /><col class="col4" />
<tbody>
<tr>
	<td>{'systemRestore_file_type'|lang}: </td>
	<td><input type="radio" name="fileType" value="gzip" checked="checked" /> {'systemRestore_file_gzip'|lang} &nbsp;&nbsp;<input type="radio" name="fileType" value="text" /> {'systemRestore_file_text'|lang}</td>
</tr>
<tr>
	<td>{'systemRestore_backup_file'|lang}: </td>
	<td><input type="file" class="input_text_medium" style="width:247px;" name="backupFile" /></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" class="button" value="{'systemRestore_button_restore'|lang}" /></td>
</tr>
</tbody>
</table>
</form>
</div>

{include file='includes/footer.tpl'}     