{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/config'|url}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.autoFill.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery-validate/jquery.validate.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/json.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.tablednd.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.adminFormTool.js'|resurl}"></script>
<script type="text/javascript" src="{'/admin/javascript/extraField/editOnLoad.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/tooltip/jquery.tooltip.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/tooltip/jquery.tooltip.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.addTooltip.js'|resurl}"></script>
<script>
setting.extraField = {$extraFieldJson|htmlspecialchars_decode};
</script>
{/capture}

{include file='includes/header.tpl' page="index" title="{'extraFieldEdit_html_title'|lang}" metaDescription="{'extraFieldEdit_html_title'|lang}"}

<div id="left">

{include file='menu/menuleft/menuleftIndex.tpl'}

</div>

<div id="right">
</div>

<div id="middle">
<div class="column">

<div id="show_arbo">
<a href="{'/admin/'|url}">{'menuMenuHeader_directory'|lang}</a> &gt; <a href="{'/admin/category'|url}">{'menuLeftIndex_site_cat'|lang}</a> 
</div>

<div class="title_h_1">
<h1>{'extraFieldEdit_h1'|lang}</h1>
</div>
<div class="column_in_table2">
<form action="{'/admin/extraField/saveField'|url}" method="post" id="editExtraFieldForm">
<input type="hidden" name="fieldId" value=""/>
<input type="hidden" name="returnUrl" value="{$returnUrl}"/>
<table class="table2" cellspacing="1">
<col class="col7-1" /><col class="col7-2" />
<tr>
    <td>{'categoryEdit_field_name'|lang}: </td>
    <td><input type="text" class="input_text_large" name="name" value="" /></td>
</tr>
<tr>
    <td>{'categoryEdit_select_type_field'|lang}: </td>
    <td><select name="type" id="categoriesSelect">
<option value="">{'categoryEdit_select_type_field'|lang}</option>
<option value="text">{'categoryEdit_type_text'|lang}</option>
<option value="textarea">{'categoryEdit_type_textarea'|lang}</option>
<option value="radio">{'categoryEdit_type_radio'|lang}</option>
<option value="checkbox">{'categoryEdit_type_check'|lang}</option>
<option value="select">{'categoryEdit_type_select'|lang}</option>
<option value="range">{'categoryEdit_type_range'|lang}</option>
<option value="url">{'categoryEdit_type_url'|lang}</option>
<option value="file">{'categoryEdit_type_file'|lang}</option>
</select></td>
</tr>
<tr>
    <td>{'categoryEdit_mandatory_field'|lang}: </td>
    <td><input type="radio" name="required" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="required" value="0" /> {'Off'|lang}</td>
</tr>
<tr>
    <td>{'categoryEdit_suffix'|lang}: </td>
    <td><input type="text" class="input_text_medium" name="suffix" value="" /></td>
</tr>
<tr class="extraField_row_url" style="display:none;">
    <td>{'categoryEdit_anchor'|lang}: </td>
    <td><input type="radio" name="config[anchor]" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="config[anchor]" value="0" checked="checked" /> {'Off'|lang}</td>
</tr>
<tr class="extraField_row_url" style="display:none;">
    <td>{'categoryEdit_nofollow'|lang}: </td>
    <td><input type="radio" name="config[nofollow]" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="config[nofollow]" value="0" checked="checked" /> {'Off'|lang}</td>
</tr>
<tr class="extraField_row_file" style="display:none;">
    <td>{'categoryEdit_extensions'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'categoryEdit_extensions_desc'|lang}" /></td>
    <td><input type="text" class="input_text_medium" name="config[extensions]" value="" /></td>
</tr>
<tr class="extraField_row_file" style="display:none;">
    <td>{'categoryEdit_maxSize'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'categoryEdit_maxSize_desc'|lang}" /></td>
    <td><input type="text" class="input_text_medium" name="config[maxSize]" value="" /></td>
</tr>
<tr>
    <td>{'categoryEdit_field_description'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'categoryEdit_field_description_desc'|lang}" /> </td>
    <td><textarea class="textarea_large" name="description" cols="50" rows="5" id="categoryDescription"></textarea></td>
</tr>
<tr style="display:none;" id="batchModeControlDiv">
    <td>
    <input type="button" class="button" id="addNewFieldButton" value="{'categoryEdit_add_new_option'|lang}"  />
    <a href="#" id="batchModeLink">{'categoryEdit_quick_add'|lang}</a> <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'categoryEdit_quick_add_desc'|lang}" />
    </td>
    <td>
    <div style="display:none;" id="batchModeDiv">
    <textarea id="batchTextarea" class="textarea_large"></textarea><br/>
    <input type="button" class="button" id="addBatchButton" value="{'categoryEdit_button_add'|lang}"  /><br/>
    </div>
    </td>
</tr>
<tr>
<td colspan="2">

<textarea style="display: none" id="extraFieldOptionTemplate">
{literal}
<tr class="extraField">
<td>{'categoryEdit_option'|lang}</td>
<td><input type="text" name="option[{1}]"> <input type="button" class="button" value="{'button_delete'|lang}"/></td>
</tr>
{/literal}
</textarea>
<input type="hidden" name="option[0]" value="">
<table style="margin: auto;width: 400px;" id="extraFieldTable">

</table>
</td>
</tr>
<tr>
    <td></td>
    <td><input type="submit" class="button" value="{'button_edit'|lang}"  />
        <input type="button" name="delete" class="button2" value="{'button_delete'|lang}" onclick="return $.confirmLinkClick('{'Do you really want to delete it?'|lang}', '{"/admin/extraField/delete/$extraField.fieldId"|url}');" />
    </td>
</tr>
</table>

</form>

</div>


{include file='includes/footer.tpl'}