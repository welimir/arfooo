{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/config'|url}"></script> 
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.adminFormTool.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/tiny_mce/tiny_mce.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/tiny_mce/basic_config.js'|resurl}"></script>
<script type="text/javascript">tinyMCE.execCommand('mceAddControl', false, 'packageDescription');</script>
<link href="{"/templates/$templateName/jquery/tooltip/jquery.tooltip.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/tooltip/jquery.tooltip.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.addTooltip.js'|resurl}"></script>
{/capture}

{include file='includes/header.tpl' page="setting" title="{'settingPackage_html_title'|lang}" metaDescription="{'settingPackage_meta_description'|lang}"}

<div id="left">

{include file='menu/menuleft/menuleftSettings.tpl'}

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/setting'|url}">{'menuMenuHeader_settings'|lang}</a> &gt; <a href="{'/admin/setting/package'|url}">{'menuLeftSettings_manage_criteria'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'settingPackage_h1'|lang}</h1>
</div>
<div class="column_in">
{'settingPackage_desc1'|lang}<br />
{'settingPackage_desc2'|lang}<br /><br />
{'settingPackage_desc3'|lang}.<br /><br />
<a href="http://www.allopass.com/index.php4?ADV=12394890" class="link_orange" target="_blank">{'settingPackage_desc4'|lang}</a><br />
<a href="https://www.paypal.com/" class="link_orange" target="_blank">{'settingPackage_desc5'|lang}</a><br /><br /><br />

{'settingPackage_desc6'|lang}<br />
{'settingPackage_desc7'|lang}<br /><br />

{'settingPackage_desc8'|lang}<br />
{'settingPackage_desc9'|lang}<br />
{'settingPackage_desc10'|lang}<br />
{'settingPackage_desc11'|lang}<br />
{'settingPackage_desc12'|lang}<br />
{'settingPackage_desc13'|lang}<br />
{'settingPackage_desc14'|lang}<br /><br />

{'settingPackage_desc15'|lang}<br />
{'settingPackage_desc16'|lang}<br /><br />

{'settingPackage_desc17'|lang}<br /><br /><br />

{'settingPackage_desc18'|lang}<br />
{'settingPackage_desc19'|lang}<br /><br>
{'settingPackage_desc20'|lang}<br />
{'settingPackage_desc21'|lang}
</div>

<div class="title_h_2">
<h2>{'settingPackage_h2'|lang}</h2>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<thead>
<tr>
	<th>{'settingPackage_th_name'|lang}</th>
	<th>{'Management'|lang}</th>
</tr>
</thead>
<tbody>
{foreach from=$packages value=package}
<tr class="line{cycle values='1,2'}">
	<td><a href="{"/admin/setting/editPackage/$package.packageId"|url}">{$package.name}</a></td>
	<td><a href="{"/admin/setting/editPackage/$package.packageId"|url}" class="link_green">{'link_edit'|lang}</a> | 
		<a onclick="return $.confirmLinkClick('Do you really want to delete it?', this.href)" href="{"/admin/setting/deletePackage/$package.packageId"|url}" class="link_red">{'link_delete'|lang}</a></td>
</tr>
{/foreach}
</tbody>
</table>
</div>

<div class="title_h_2">
<h2>{'settingPackage_h2_create'|lang}</h2>
</div>
<div class="column_in_table2">
<form action="{"/admin/setting/savePackage"|url}" method="post" enctype="multipart/form-data">
<table class="table2" cellspacing="1">
<col class="col7-1"><col class="col7-2">

<tbody>
<tr>
	<td>{'settingEditPackage_criteria_name'|lang}:</td>
	<td><input type="text" class="input_text_medium" name="name" value="" /></td>
</tr>
<tr>
	<td>{'settingEditPackage_criteria_image'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingEditPackage_criteria_image_desc'|lang}" /></td>
	<td><input type="file" class="input_text_small" style="width:155px;" name="uploadImage" /></td>
</tr>
<tr>
	<td>{'settingEditPackage_price'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingEditPackage_price_desc'|lang}" /></td>
	<td><input type="text" class="input_text_small" name="amount" value="" /></td>
</tr>
<tr>
    <td>{'settingEditPackage_id_allopass'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingEditPackage_id_allopass_desc'|lang}" /></td>
    <td><input type="text" class="input_text_small" name="allopassId" value="" /></td>
</tr>
<tr>
	<td>{'settingEditPackage_allopass_number'|lang}:</td>
	<td><input type="text" class="input_text_small" name="allopassNumber" value="" /></td>
</tr>
<tr>
	<td>{'settingEditPackage_priority'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingEditPackage_priority_desc'|lang}" /></td>
	<td><select name="priority" class="select-categoriesandgames">
        <option value="0" selected="selected"> 0 </option>
        <option value="1"> 1 </option>
        <option value="2"> 2 </option>
        <option value="3"> 3 </option>
        <option value="4"> 4 </option>
        <option value="5"> 5 </option>
        <option value="6"> 6 </option>
        <option value="7"> 7 </option>
        <option value="8"> 8 </option>
        <option value="9"> 9 </option>
        <option value="10"> 10 </option>
        </select></td>
</tr>
<tr>
    <td>{'settingEditPackage_characters_numb'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingEditPackage_characters_numb_desc'|lang}" /></td>
    <td><input type="text" class="input_text_small" name="siteDescriptionMaxLength" value="" /></td>
</tr>
<tr>
    <td>{'settingEditPackage_characters_min_numb'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingEditPackage_characters_min_numb_desc'|lang}" /></td>
    <td><input type="text" class="input_text_small" name="siteDescriptionMinLength" value="" /></td>
</tr>
<tr>
    <td>{'settingEditPackage_keywords'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingEditPackage_keywords_desc'|lang}" /></td>
    <td><input type="text" class="input_text_small" name="maxKeywordsCountPerSite" value="" /></td>
</tr>
<tr>
    <td>{'settingEditPackage_backlink'|lang}:</td>
    <td><input type="radio" name="backLinkMandatory" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="backLinkMandatory" value="0" checked="checked" /> {'Off'|lang}</td>
</tr>
<tr>
    <td>{'settingEditPackage_html_enabled'|lang}:</td>
    <td><input type="radio" name="siteDescriptionHtmlEnabled" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="siteDescriptionHtmlEnabled" value="0" checked="checked" /> {'Off'|lang}</td>
</tr>
<tr>
    <td>{'settingEditPackage_html_allowed_tags'|lang}:</td>
    <td><textarea class="textarea_large" name="siteDescriptionHtmlAllowedTags" cols="30" rows="5"></textarea></td>
</tr>
<tr>
    <td>{'settingEditPackage_html_allowed_css_properties'|lang}:</td>
    <td><textarea class="textarea_large" name="siteDescriptionHtmlAllowedCssProperties" cols="30" rows="5"></textarea></td>
</tr>
<tr>
	<td>{'settingEditPackage_criteria_description'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingEditPackage_criteria_description_desc'|lang}" /></td>
	<td><textarea class="textarea_extra_large" name="description" cols="50" rows="5" id="packageDescription"></textarea></td>
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