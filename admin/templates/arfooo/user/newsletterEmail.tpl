{include file='includes/header.tpl' page="user" title="{'userNewsletterEmail_html_title'|lang}" metaDescription="{'userNewsletterEmail_meta_description'|lang}"}  

<div id="left">

{include file='menu/menuleft/menuleftUsers.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/user'|url}">{'menuMenuHeader_users'|lang}</a> &gt; <a href="{'/admin/user/newsletterEmail'|url}">{'menuLeftUsers_export_email'|lang}</a>
</div>


<div class="title_h_1">
<h1>{'userNewsletterEmail_h1'|lang}: {$newsletterEmailsCount}</h1>
</div>
<div class="column_in">
{'userNewsletterEmail_desc1'|lang}
</div>

<div class="title_h_2">
<h2>{'userNewsletterEmail_h2_export'|lang}</h2>
</div>
<div class="column_in">
<form action="{'/admin/user/exportNewsletterEmail'|url}" method="post"> 
<input class="button" type="submit" name="Start" value="{'userNewsletterEmail_dl_export'|lang}" />
</form>
</div>

<div class="title_h_2">
<h2>{'userNewsletterEmail_h2_import'|lang}</h2>
</div>
<div class="column_in_table2">
<form action="{'/admin/user/importNewsletterEmail'|url}" method="post" enctype="multipart/form-data">    
<table class="table2" cellspacing="1">
<tbody>
<tr>
    <td>{'userNewsletterEmail_csv_file'|lang}: </td>
    <td><input type="file" class="input_text_medium" style="width:247px;" name="csvFile" /></td>
</tr>
<tr>
    <td></td>
    <td><input type="submit" class="button" value="{'userNewsletterEmail_import_email'|lang}" /></td>
</tr>
</tbody>
</table>
</form>
</div>

{include file='includes/footer.tpl'}    