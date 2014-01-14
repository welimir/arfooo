{capture assign="headData"}
    <script type="text/javascript" src="{'/javascript/tiny_mce/tiny_mce.js'|resurl}"></script>
    <script type="text/javascript" src="{'/javascript/tiny_mce/basic_config.js'|resurl}"></script>
    <script type="text/javascript">tinyMCE.execCommand('mceAddControl', false, 'description');</script>
{/capture}

{include file='includes/header.tpl' page="setting" title="{'settingDescription_html_title'|lang}" metaDescription="{'settingDescription_meta_description'|lang}"} 

<div id="left">

{include file='menu/menuleft/menuleftSettings.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/setting'|url}">{'menuMenuHeader_settings'|lang}</a> &gt; <a href="{'/admin/setting/description'|url}">{'menuLeftSettings_dir_desc'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'settingDescription_h1'|lang}</h1>
</div>
<div class="column_in">
{'settingDescription_desc1'|lang}<br />
{'settingDescription_desc2'|lang}<br />
{'settingDescription_desc3'|lang}
</div>

<div class="column_in_table">
<form action="{'/admin/setting/saveEditMessage'|url}" method="post">
<input type="hidden" name="messageId" value="{$message.messageId}" >  
<table class="table2" cellspacing="1">
<tbody>
<tr>
	<td>{'settingDescription_title'|lang}: </td>
	<td><input type="text" class="input_text_large" name="title" value="{$message.title}" /></td>
</tr>
<tr>
	<td>{'settingDescription_desc'|lang}: </td>
	<td><textarea class="textarea_extra_large" name="description" cols="50" rows="5" id="description">{$message.description}</textarea></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" class="button" value="{'button_save'|lang}"  /></td>
</tr>
</tbody>
</table>
</form>
</div>

{include file='includes/footer.tpl'}  