{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/config'|url}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/json.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.autoFill.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.chainSelect.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.tablednd.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery-validate/jquery.validate.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.adminFormTool.js'|resurl}"></script>
<script type="text/javascript" src="{'/admin/javascript/category/editOnLoad.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/tiny_mce/tiny_mce.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/tiny_mce/basic_config.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/tooltip/jquery.tooltip.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/tooltip/jquery.tooltip.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.addTooltip.js'|resurl}"></script>
<script type="text/javascript">
setting.category = {$categoryJson|htmlspecialchars_decode};
</script>
{/capture}

{include file='includes/header.tpl' page="index" title="{'categoryEdit_html_title'|lang}" metaDescription="{'categoryEdit_meta_description'|lang}"}

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
<h1>{'categoryEdit_h1'|lang}</h1>
</div>
<div class="column_in_table2">
<form action="{"/admin/category/saveCategory"|url}" method="post" id="editCategoryForm" enctype="multipart/form-data">
<input type="hidden" name="categoryId" value="{$category.categoryId}"/>
<table class="table2" cellspacing="1">
<col class="col5-1" /><col class="col5-2" />
<tbody>
<tr>
    <td>{'categoryEdit_parent_category'|lang}: </td>
    <td><select name="parentCategoryId">
<option value="0">{'Root'|lang}</option>
{html_options options=$categoriesSelect}
        </select></td>
</tr>
</tbody>
</table>

<table class="table2" cellspacing="1">
<col class="col7-1" /><col class="col7-2" />
<tbody>
<tr>
    <td>{'categoryEdit_category_name'|lang}: </td>
    <td><input type="text" class="input_text_large" name="name" value="" /></td>
</tr>
<tr>
    <td>{'categoryEdit_category_title'|lang}: </td>
    <td><input type="text" class="input_text_large" name="title" value="" /></td>
</tr>
<tr>
    <td>{'categoryEdit_nav'|lang}: </td>
    <td><input type="text" class="input_text_large" name="navigationName"/></td>
</tr>
<tr>
    <td>{'categoryEdit_tag_h1'|lang}: </td>
    <td><input type="text" class="input_text_large" name="headerDescription"/></td>
</tr>
<tr>
    <td>{'categoryEdit_meta'|lang}: </td>
    <td><textarea name="metaDescription" class="textarea_metas" ></textarea></td>
</tr>
<tr>
    <td>{'categoryEdit_possible_sub'|lang}: </td>
    <td><input type="radio" name="possibleTender" value="1" checked="checked" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="possibleTender" value="0" /> {'Off'|lang}</td>
</tr>
<tr>
    <td>{'categoryEdit_forbidden'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'categoryEdit_forbidden_desc'|lang}" /></td>
    <td><input type="radio" name="forbidden" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="forbidden" value="0" checked="checked" /> {'Off'|lang}</td>
</tr>
<tr>
    <td>{'categoryEdit_category_image'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'categoryEdit_category_image_desc'|lang}" /></td>
    <td><input type="file" class="input_text_medium" style="width:247px;" name="categoryImage" /></td>
</tr>
<tr>
    <td>{'categoryEdit_text_description'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'categoryEdit_text_description_desc'|lang}" /></td>
    <td><textarea class="textarea_extra_large" name="description" cols="50" rows="5" id="categoryDescription"></textarea></td>
</tr>
<tr>
    <td></td>
    <td><input type="submit" name="edit" class="button2" value="{'button_edit'|lang}" /> <input type="button" name="delete" class="button2" value="{'button_delete'|lang}" onclick="return $.confirmLinkClick('{'Do you really want to delete it?'|lang}', '{"/admin/category/delete/$category.categoryId"|url}');" /></td>
</tr>
</tbody>
</table>
</form>
</div>



<form action="{'/admin/extraField/saveField'|url}" method="post" id="newExtraFieldForm">
<div class="title_h_2">
<h2>{'categoryEdit_add_new_fields'|lang}</h2>
</div>
<div class="column_in_table2">
<input type="hidden" name="categoryId" value="{$category.categoryId}"/>
<table class="table2" cellspacing="1">
<col class="col7-1" /><col class="col7-2" />
<tbody>
<tr>
    <td>{'categoryEdit_field_name'|lang}: </td>
    <td><input type="text" class="input_text_large" name="name" value="" /></td>
</tr>
<tr>
    <td>{'categoryEdit_select_type_field'|lang}: </td>
    <td><select name="type">
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
    <td><input type="radio" name="required" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="required" value="0" checked="checked" /> {'Off'|lang}</td>
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
    <td>{'categoryEdit_extensions'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'categoryEdit_extensions_desc'|lang}" /> </td>
    <td><input type="text" class="input_text_medium" name="config[extensions]" value="" /></td>
</tr>
<tr class="extraField_row_file" style="display:none;">
    <td>{'categoryEdit_maxSize'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'categoryEdit_maxSize_desc'|lang}" /> </td>
    <td><input type="text" class="input_text_medium" name="config[maxSize]" value="" /></td>
</tr>
<tr>
    <td>{'categoryEdit_field_description'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'categoryEdit_field_description_desc'|lang}" /> </td>
    <td><textarea class="textarea_large" name="description" cols="50" rows="5"></textarea></td>
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
    <td><input type="submit" class="button" value="{'categoryEdit_button_create_field'|lang}"  /></td>
</tr>
</tbody>
</table>
</div>
</form>

<div class="title_h_2">
<h2>{'categoryEdit_organization'|lang}</h2>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1" id="extraFieldsTable">
<thead>
<tr>
    <th>{'categoryEdit_th_name'|lang}</th>
    <th>{'categoryEdit_th_type'|lang}</th>
    <th>{'categoryEdit_th_desc'|lang}</th>
    <th>{'categoryEdit_th_search'|lang}</th>
    <th>{'categoryEdit_th_mandatory'|lang}</th>
    <th>{'categoryEdit_th_management'|lang}</th>
</tr>
</thead>
<tbody>
{foreach from=$categoryExtraFields value=categoryExtraField}
<tr class="line{cycle values='1,2'}" id="extraFieldsTable-row-{$categoryExtraField.fieldId}">
    <td>{$categoryExtraField.name}</td>
    <td>{$categoryExtraField.type}</td>
    <td>{$categoryExtraField.description}</td>
    <td><input type="checkbox" name="inSearchEngine[{$categoryExtraField.fieldId}]"></td>
    <td>{if $categoryExtraField.required}<span class="text_green">{'Yes'|lang}</span>{else}<span class="text_red">{'No'|lang}</span>{/if}</td>
    <td><a href="{"/admin/extraField/edit/$categoryExtraField.fieldId"|url}" class="link_green">{'link_edit'|lang}</a> |
        <a onclick="return $.confirmLinkClick('Do you really want to delete it?', this.href)" href="{"/admin/extraField/delete/$categoryExtraField.fieldId"|url}" class="link_red">{'link_delete'|lang}</a></td>
</tr>
{/foreach}
</tbody>
</table>
</div>

<form action="" method="post" id="searchEngineExtraFieldsForm">
<div class="column_in_table2">

<div id="searchEngineExtraFields" style="height: 200px; border-bottom:1px solid #aaa; overflow: hidden; position: relative;">

</div>

<div style="padding:10px; text-align:center">
<input type="submit" value="{'button_save'|lang}">
</div>

</div>
</form>

{include file='includes/footer.tpl'}