{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/config'|url}"></script> 
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.adminFormTool.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/tiny_mce/tiny_mce.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/tiny_mce/basic_config.js'|resurl}"></script>
<script>
tinyMCE.execCommand('mceAddControl', false, 'keywordDescription');
</script>
{/capture}
{include file='includes/header.tpl' page="index" title="{'keywordEdit_html_title'|lang}" metaDescription="{'keywordEdit_meta_description'|lang}"} 

<div id="left">

{include file='menu/menuleft/menuleftIndex.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/'|url}">{'menuMenuHeader_directory'|lang}</a> &gt; <a href="{'/admin/keyword'|url}">{'menuLeftIndex_manage_keywords'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'keywordEdit_h1'|lang}</h1>
</div>
<div class="column_in_table2">
<form action="{"/admin/keyword/saveEdit/$keywordId"|url}" method="post">
<table class="table2" cellspacing="1">
<tbody>
<tr>
	<td>{'keywordEdit_name'|lang}: </td>
	<td><input type="text" class="input_text_medium" name="keyword" value="{$keyword.keyword}" /></td>
</tr>
<tr>
    <td>{'keywordEdit_text_description'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'keywordEdit_text_description_desc'|lang}" /></td>
    <td><textarea class="textarea_extra_large" name="description" cols="50" rows="5" id="keywordDescription">{$keyword.description}</textarea></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" class="button2" value="{'button_edit'|lang}" />
        <input type="button" class="button2" value="{'button_delete'|lang}" onclick="return $.confirmLinkClick('{'Do you really want to delete it?'|lang}', '{"/admin/keyword/delete/$keywordId"|url}')" /></td>
</tr>
</tbody>
</table>
</form>
</div>

{include file='includes/footer.tpl'} 