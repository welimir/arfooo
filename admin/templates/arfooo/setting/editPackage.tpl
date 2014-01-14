{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/config'|url}"></script> 
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.adminFormTool.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.autoFill.js'|resurl}"></script>
<script type="text/javascript" src="{'/admin/javascript/setting/editPackageOnLoad.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/tiny_mce/tiny_mce.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/tiny_mce/basic_config.js'|resurl}"></script>
<script type="text/javascript">tinyMCE.execCommand('mceAddControl', false, 'packageDescription');</script>
<link href="{"/templates/$templateName/jquery/tooltip/jquery.tooltip.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/tooltip/jquery.tooltip.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.addTooltip.js'|resurl}"></script>
<script type="text/javascript">
setting.packageJSON = {$packageJSON|htmlspecialchars_decode};
</script>
{/capture}

{include file='includes/header.tpl' page="setting" title="{'settingEditPackage_html_title'|lang}" metaDescription="{'settingEditPackage_meta_description'|lang}"}

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
<h1>{'settingEditPackage_h1'|lang}</h1>
</div>
<div class="column_in_table2">
<form action="{"/admin/setting/savePackage/$package.packageId"|url}" method="post" enctype="multipart/form-data" id="packageEditForm">
<table class="table2" cellspacing="1">
<col class="col7-1"><col class="col7-2">
<tbody>
<tr>
	<td>{'settingEditPackage_criteria_name'|lang}: </td>
	<td><input type="text" class="input_text_medium" name="name" value="" /></td>
</tr>
<tr>
	<td>{'settingEditPackage_criteria_image'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingEditPackage_criteria_image_desc'|lang}" /></td>
	<td>{if $package.imageSrc}
    <span id="removeImageLink"><a href="{"/admin/setting/deletePackageImage/$package.packageId"|url}" onclick="return $.confirmLinkClick('{'Do you really want to delete image?'|lang}', this.href);">{'Delete Image'|lang}</a><br /></span> 
    <img src="{$package.imageSrc}" alt="" width="30" height="30"/><br/>{/if}
    <input type="file" class="input_text_small" style="width:155px;" name="uploadImage" /></td>
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
    <td>{'settingEditPackage_allopass_number'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingEditPackage_id_allopass_desc'|lang}" /></td>
    <td><input type="text" class="input_text_small" name="allopassNumber" value="" /></td>
</tr>
<tr>
	<td>{'settingEditPackage_priority'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'settingEditPackage_priority_desc'|lang}" /></td>
	<td><select name="priority" class="select-categoriesandgames">
        {html_options options=$priorities}
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
    <td>{'settingEditPackage_backlink'|lang}: </td>
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
	<td><textarea class="textarea_extra_large" name="description" cols="50" rows="5" id="packageDescription">{$package.description}</textarea></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" class="button" value="{'button_save'|lang}" /> <input type="button" name="delete" class="button" value="{'button_delete'|lang}" onclick="return $.confirmLinkClick('{'Do you really want to delete it?'|lang}', '{"/admin/setting/deletePackage/$package.packageId"|url}');" /></td>
</tr>
</tbody>
</table>
</form>
</div>

{include file='includes/footer.tpl'}