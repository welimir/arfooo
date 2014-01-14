{capture assign="headData"}
    <script type="text/javascript" src="{'/javascript/config'|url}"></script>
    <script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
    <script type="text/javascript" src="{'/javascript/jquery/jquery.form.js'|resurl}"></script>
    <script type="text/javascript" src="{'/javascript/jquery/jquery.backgroundTask.js'|resurl}"></script>
    <script type="text/javascript" src="{'/javascript/tiny_mce/tiny_mce.js'|resurl}"></script>
    <script type="text/javascript" src="{'/javascript/tiny_mce/basic_config.js'|resurl}"></script> 
    <script type="text/javascript" src="{'/admin/javascript/user/newsletterOnLoad.js'|resurl}"></script>
{/capture}

{include file='includes/header.tpl' page="user" title="{'userNewsletter_html_title'|lang}" metaDescription="{'userNewsletter_meta_description'|lang}"}  

<div id="left">

{include file='menu/menuleft/menuleftUsers.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/user'|url}">{'menuMenuHeader_users'|lang}</a> &gt; <a href="{'/admin/user/newsletter'|url}">{'menuLeftUsers_send_newsletter'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'userNewsletter_h1'|lang}</h1>
</div>
<div class="column_in">
{'userNewsletter_desc1'|lang}<br />
{'userNewsletter_desc2'|lang}<br />
{'userNewsletter_desc3'|lang}<br />
{'userNewsletter_desc4'|lang}
</div>

<div class="title_h_2">
<h2>{'userNewsletter_h1'|lang}</h2>
</div>
<div class="column_in_table2">
<form action="{'/admin/task/init'|url}" method="POST" enctype="multipart/form-data" id="backgroundTaskControlForm">
<input type="hidden" name="taskId" value="newsletter" />
<table class="table2" cellspacing="1">
<tbody>
<tr>
	<td>{'userNewsletter_subject'|lang}: </td>
	<td><input type="text" class="input_text_medium" name="subject" value="" /></td>
</tr>
<tr>
	<td>{'userNewsletter_message'|lang}: </td>
	<td><textarea class="textarea_extra_large" name="text" cols="50" rows="5" id="emailText"></textarea></td>
</tr>
<tr>
	<td>{'userNewsletter_email_number'|lang}: </td>
	<td><input type="text" class="input_text_small" name="mailsPerMinute" value="20" /></td>
</tr>
<tr>
    <td>{'userNewsletter_newsletter_to'|lang}: </td>
    <td><input type="radio" name="newsletterType" value="subscribers" checked="checked"/> {'userNewsletter_subscribers'|lang} ({$statistic.subscribersEmailsCount}) <br/>
        <input type="radio" name="newsletterType" value="all"/> {'userNewsletter_all'|lang} ({$statistic.allCount}) <br/>
        <input type="radio" name="newsletterType" value="admin"/> {'userNewsletter_test'|lang} <br/>
        <input type="radio" name="newsletterType" value="csv"/> {'userNewsletter_csv_file_only'|lang}
        <span id="csvUploadPanel"></span>
        <input type="file" name="csvFile" value="" /><br />
    </td>
</tr>
<tr>
    <td>{'userNewsletter_newsletter_from'|lang}: </td>
    <td><input type="text" name="fromEmail" value="{$adminEmail}" /> </td>
</tr>
<tr>
	<td></td>
	<td>
    <div style="display:none" id="progressInformation">
    {'siteErrorCode_status'|lang}: <b><span id="taskStatus"> </span></b> &nbsp;
    {'siteErrorCode_progress'|lang}: <b><span id="taskPercentage">0%</span></b> &nbsp;
    {'userNewsletter_email_sent'|lang}: <b><span id="taskParsedItems">0</span></b> 
    <br/>
    <div style="width:250px;border: 1px solid #000; background: #fff; height: 10px;display:none" id="progressBarOutline">
       <div style="width:0%; background: #7AB; height: 100%" id="progressBar"></div>
    </div>
    <br/>
    </div>  
   
    <input type="button" class="button" name="start" value="{'button_start'|lang}" />
    <input type="button" class="button" name="pause" value="{'button_pause'|lang}" style="display:none" />
    <input type="button" class="button" name="resume" value="{'button_resume'|lang}" style="display:none" />
    <input type="button" class="button" name="stop" value="{'button_stop'|lang}" style="display:none" /></td>
</tr>
</tbody>
</table>
</form>
</div>

{include file='includes/footer.tpl'}    