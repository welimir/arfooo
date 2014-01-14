{include file='includes/header.tpl' page="system" title="{'systemInfo_meta_description'|lang}" metaDescription="{'systemInfo_meta_description'|lang}"} 

<div id="left">

{include file='menu/menuleft/menuleftSystem.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/system'|url}">{'menuMenuHeader_system'|lang}</a> &gt; <a href="{'/admin/system/information'|url}">{'menuLeftSystem_infos'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'systemInfo_h1'|lang}</h1>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<col class="col1-1" /><col class="col2-2" />
<thead>
<tr>
	<th>{'settingIndex_explain'|lang}</th>
	<th>{'settingIndex_value'|lang}</th>
</tr>
</thead>
<tbody>
<tr class="line1">
	<td>{'systemInfo_install_dir'|lang}: </td>
	<td>{if $installDirExists}<span class="text_red">{'Yes'|lang}</span>{else}<span class="text_green">{'No'|lang}</span>{/if}</td>
</tr>
<tr class="line2">
	<td>{'systemInfo_cache_dir'|lang}: </td>
	<td>{if $cacheDirWritable}<span class="text_green">{'Yes'|lang}</span>{else}<span class="text_red">{'No'|lang}</span>{/if}</td>
</tr>
<tr class="line1">
	<td>{'systemInfo_save_dir'|lang}: </td>
	<td>{if $saveDirWritable}<span class="text_green">{'Yes'|lang}</span>{else}<span class="text_red">{'No'|lang}</span>{/if}</td>
</tr>
<tr class="line2">
	<td>{'systemInfo_uploads_img_cat_dir'|lang}: </td>
	<td>{if $imagesCategoriesDirWritable}<span class="text_green">{'Yes'|lang}</span>{else}<span class="text_red">{'No'|lang}</span>{/if}</td>
</tr>
<tr class="line1">
	<td>{'systemInfo_uploads_img_thumbs_dir'|lang}: </td>
	<td>{if $imagesThumbsDirWritable}<span class="text_green">{'Yes'|lang}</span>{else}<span class="text_red">{'No'|lang}</span>{/if}</td>
</tr>
</tbody>
</table>
</div>

<div class="title_h_2">
<h2>{'systemInfo_h2'|lang}</h2>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<col class="col1-1" /><col class="col2-2" />
<thead>
<tr>
	<th>{'settingIndex_explain'|lang}</th>
	<th>{'settingIndex_value'|lang}</th>
</tr>
</thead>
<tbody>
<tr class="line1">
	<td>{'systemInfo_php_version'|lang}: </td>
	<td><span class="text_green">{$phpVersion}</span></td>
</tr>
<tr class="line2">
	<td>{'systemInfo_mysql_version'|lang}: </td>
	<td><span class="text_green">5.0.44</span></td>
</tr>
<tr class="line1">
	<td>{'systemInfo_template_version'|lang}: </td>
	<td><span class="text_green">2.10</span></td>
</tr>
</tbody>
</table>
</div>

{include file='includes/footer.tpl'}     