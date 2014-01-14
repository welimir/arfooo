<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{'en'|lang}" lang="{'en'|lang}">
<head>
<title>{'lostPassword_html_title'|lang}</title>
<meta name="description" content="{'lostPassword_meta_description'|lang}" />
<meta name="robots" content="noindex, nofollow" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="{'/admin/templates/arfooo/stylecss/style.css'|resurl}" rel="stylesheet" type="text/css" />
</head>
<body id="login">
<div id="principal_login">

<div id="top_login">
<a href="{'includesFooter_link'|lang}" title="{'includesFooter_powered'|lang} {'includesFooter_arfooo'|lang}"><img src="{'/admin/templates/arfooo/images/bg_header_login.png'|resurl}" alt="{'includesFooter_powered'|lang} {'includesFooter_arfooo'|lang}" class="logo_login" /></a>
</div>

<div id="main1">
<div id="main2">

<div id="left_login">
</div>

<div id="right">
</div>

<div id="middle_login"> 
<div class="column">

<div class="column_in_table_login">
<form action="{'/admin/main/lostPassword'|url}" method="post"> 
<table class="table_login" cellspacing="1">
<col class="collogin1" /><col class="collogin2" /><col class="collogin3" />
<tbody>
<tr>
	<td></td>
	<td><div id="column_desc_generate_login">{'lostPassword_desc'|lang}</div></td>
	<td></td>
</tr>
<tr>
	<td></td>
	<td><span class="text_login">{'lostPassword_email'|lang}</span><br /><input type="text" class="input_text_login" name="email" value="" /></td>
	<td></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" class="input_button_generate_login" value="{'lostPassword_button'|lang}" /></td>
	<td></td>
</tr>
</tbody>
</table>
</form>
</div>

{include file='includes/footerLogin.tpl'}  