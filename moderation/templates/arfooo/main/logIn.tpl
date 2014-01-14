<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{'includesHeader_language'|lang}" lang="{'includesHeader_language'|lang}">
<head>
<title>{'mainLogIn_html_title'|lang}</title>
<meta name="description" content="{'mainLogIn_meta_description'|lang}" />
<meta name="robots" content="index, follow" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="{'/moderation/templates/arfooo/stylecss/style.css'|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script> 
<script type="text/javascript" src="{'/moderation/javascript/main/loginOnLoad.js'|resurl}"></script>   
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
<form id="login_form" method="post" action="{'/moderation/main/logIn'|url}"> 
<table class="table_login" cellspacing="1">
<col class="collogin1" /><col class="collogin2" /><col class="collogin3" />
<tbody>
<tr>
	<td></td>
	<td><span class="text_login">{'mainLogIn_login'|lang}</span><br /><input type="text" class="input_text_login" name="email" value="" id="loginInput"/></td>
	<td></td>
</tr>
<tr>
	<td></td>
	<td><span class="text_login">{'mainLogIn_pass'|lang}</span><br /><input type="password" class="input_text_login" name="password" value="" /></td>
	<td></td>
</tr>
<tr>
	<td class="td_login"></td>
	<td><input type="submit" class="input_button_login" value="{'mainLogIn_button_login'|lang}" /> <a href="{'/moderation/main/lostPassword'|url}" rel="nofollow" class="link_pass_forg">{'mainLogIn_forgot_pass'|lang}</a></td>
	<td></td>
</tr>
</tbody>
</table>
</form>
</div>

{include file='includes/footerLogin.tpl'} 