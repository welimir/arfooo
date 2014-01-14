{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/config'|url}"></script> 
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.adminFormTool.js'|resurl}"></script>
<script type="text/javascript" src="{'/admin/javascript/setting/emailOnLoad.js'|resurl}"></script>  
{/capture}

{include file='includes/header.tpl' page="setting" title="{'settingEmail_html_title'|lang}" metaDescription="{'settingEmail_meta_description'|lang}"} 

<div id="left">

{include file='menu/menuleft/menuleftSettings.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/setting'|url}">{'menuMenuHeader_settings'|lang}</a> &gt; <a href="{'/admin/setting/email'|url}">{'menuLeftSettings_email'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'settingEmail_h1'|lang}</h1>
</div>
<div class="column_in">
{'settingEmail_desc1'|lang}<br />
{'settingEmail_desc2'|lang}<br />
{'settingEmail_desc3'|lang}<br />
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<col class="col1-1" /><col class="col2-2" />
<thead>
<tr>
    <th>{'settingEmail_th_email'|lang}</th>
    <th>{'Management'|lang}</th>
</tr>
</thead>
<tbody>
{foreach from=$emails value=email}
<tr class="line{cycle values='1,2'}">
    <td>{$email.userText}</td>
    <td><a href="{"/admin/setting/editEmail/$email.messageId"|url}" class="link_green">{'link_edit'|lang}</a> 
        | <a onclick="return $.confirmLinkClick('{'Do you really want send test email?'|lang}', this.href)" href="{"/admin/setting/sendTestEmail/$email.messageId"|url}" class="link_green">{'settingEmail_test'|lang}</a>     
    {if $email.userDefined} | 
        <a onclick="return $.confirmLinkClick('{'Do you really want to delete it?'|lang}', this.href)" href="{"/admin/setting/deleteEmail/$email.messageId"|url}" class="link_red">{'link_delete'|lang}</a>
    {/if}

    </td>
</tr>
{/foreach}
</tbody>
</table>
</div>

<div class="title_h_2">
<h2>{'settingEmail_add_email'|lang}</h2>
</div>
<div class="column_in_table2">
<form action="{'/admin/setting/saveNewEmail'|url}" method="post" id="newEmailForm">
<table class="table2" cellspacing="1">
<col class="col5-1" /><col class="col5-2" />
<tbody>
<tr>
    <td>{'settingEmail_desc'|lang}: </td>
    <td><input type="text" class="input_text_medium" name="userText" value="" /></td>
</tr>
<tr>
    <td>{'settingEmail_subject'|lang}: </td>
    <td><input type="text" class="input_text_medium" name="title" value="" /></td>
</tr>
<tr>
    <td>{'settingEmail_desc'|lang}: </td>
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
    <textarea class="textarea_extra_large" name="description" cols="50" rows="5"></textarea></td>
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