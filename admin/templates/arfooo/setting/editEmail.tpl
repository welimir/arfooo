{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/config'|url}"></script> 
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<script type="text/javascript" src="{'/admin/javascript/setting/emailOnLoad.js'|resurl}"></script>
{/capture}

{include file='includes/header.tpl' page="setting" title="{'settingEditEmail_html_title'|lang} $message.userText" metaDescription="{'settingEditEmail_meta_description'|lang} $message.userText"} 

<div id="left">

{include file='menu/menuleft/menuleftSettings.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/setting'|url}">{'menuMenuHeader_settings'|lang}</a> &gt; <a href="{'/admin/setting/email'|url}">{'menuLeftSettings_email'|lang}</a> &gt; {$message.userText}
</div>

<div class="title_h_1">
<h1>{'settingEditEmail_h1'|lang} {$message.userText}</h1>
</div>
<div class="column_in_table2">
<form action="{'/admin/setting/saveEditMessage'|url}" method="post" id="newEmailForm">
<input type="hidden" name="messageId" value="{$message.messageId}" > 
<table class="table2" cellspacing="1">
<col class="col5-1" /><col class="col5-2" />
<tbody>
{if $message.userDefined}
<tr>
    <td>{'settingEditEmail_description'|lang}: </td>
    <td><input type="text" class="input_text_large" name="userText" value="{$message.userText}" /></td>
</tr>
{/if}
{if $message.messageId != "newsletterFooter"}
<tr>
    <td>{'settingEditEmail_subject'|lang}: </td>
    <td><input type="text" class="input_text_large" name="title" value="{$message.title}" /></td>
</tr>
{/if}
<tr>
    <td>{'settingEditEmail_description'|lang}: </td>
    <td>
    <input type="button" class="button autocode" value="[url site]" />
    <input type="button" class="button autocode" value="[site name]" /> 
    <input type="button" class="button autocode" value="[url site details]" />
    <input type="button" class="button autocode" value="[description of the site]" />
    <input type="button" class="button autocode" value="[site type]" /> <br/>
    <input type="button" class="button autocode" value="[name of the category]" /> 
    <input type="button" class="button autocode" value="[name of directory]" />
    <input type="button" class="button autocode" value="[url of your directory]" />
    <br/>
    <textarea class="textarea_extra_large" name="description" cols="50" rows="5">{$message.description}</textarea></td>
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