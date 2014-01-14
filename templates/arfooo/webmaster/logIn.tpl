{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/config'|url}"></script>  
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.livequery.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script> 
<script type="text/javascript" src="{'/javascript/jquery/jquery.captchaCode.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.form.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.formTool.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery-validate/jquery.validate.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.popup.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/webmaster/loginOnLoad.js'|resurl}"></script> 
<script type="text/javascript">
setting.isEmailAcceptable = "/webmaster/isEmailAcceptable";
setting.registerUrl = "/webmaster/register"; 
</script>
{/capture}

{include file="includes/header.tpl" title="{'webmasterLogIn_html_title'|lang}" metaDescription="{'webmasterLogIn_meta_description'|lang}"}

<div class="show_arbo">
<a href="{$setting.siteRootUrl}" class="link_showarbo">{'show_arbo_directory'|lang}</a> &gt; 
<a href="{'/user/logIn'|url}" class="link_showarbo">{'webmasterLogIn_arbo'|lang}</a>
</div>

<form id="webmasterLoginForm" action="{'/webmaster/logIn'|url}" method="post"> 
<div class="title_h">
<h1>{'webmasterLogIn_h1'|lang}</h1>
</div>
<fieldset class="column_in"> 
    <div class="form">
    <label class="title">&nbsp;</label>
    <div class="infos">{'webmasterLogIn_desc'|lang} {if !empty($loginError)}<br/><b>{'webmasterLogIn_wrong'|lang}</b>{/if}</div>
    </div>
    
    <div class="form">
    <label class="title">{'webmasterLogIn_email'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos"><input type="text" class="input_text_large" name="email" value="" /></div>
    </div>
    
    <div class="form">
    <label class="title">{'webmasterLogIn_pass'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos"><input type="password" class="input_text_large" name="password" value="" /></div>
    </div>
    
    <div class="form">
    <label class="title">&nbsp;</label>
    <div class="infos"><input type="checkbox" name="rememberMe" value="1" /> {'webmasterLogIn_remember'|lang} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="{'/webmaster/lostPassword'|url}" title="{'webmasterLogIn_forgot_pass'|lang}" class="link_small_underline" id="lostPasswordLink">{'webmasterLogIn_forgot_pass'|lang}</a></div>
    </div>
    
    <div class="form">
    <label class="title">&nbsp;</label>
    <div class="infos"><input type="submit" class="button" value="{'webmasterLogIn_button_login'|lang}" /></div>
    </div>
</fieldset>
</form>
<!--
<div class="title_h">
<h2>{'webmasterLogIn_terms'|lang}</h2>
</div>
<div class="column_in"> 			
{$directoryCondition.description|htmlspecialchars_decode|nl2br}
</div>
-->
<form action="{'/webmaster/register'|url}" method="post" id="registerForm">
<div class="title_h">
<h1>{'webmasterLogIn_new_create'|lang}</h1>
</div>
<fieldset class="column_in" id="registerLayer">
    <div class="form">
	<label class="title">&nbsp;</label>
    <div class="infos">{'webmasterLogIn_desc2'|lang}</div>
    </div>
	
    <div class="form">
    <label class="title">{'webmasterLogIn_email'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos"><input type="text" class="input_text_large" name="email" value="" />
        				<span id="indicatorWhetherEmailIsBusy" class="text_red"></span></div>
    </div>
    
    <div class="form">
    <label class="title">{'webmasterLogIn_pass'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos"><input type="password" class="input_text_large" name="password" value="" /></div>
    </div>
	
	<div class="form">
    <label class="title">{'webmasterLogIn_repeat_pass'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos"><input type="password" class="input_text_large" name="passwordConfirmation" value="" /></div>
    </div>
    
    {if $setting.newsletterEnabled}
    <div class="form">
    <label class="title">&nbsp;</label>
    <div class="infos"><input type="checkbox" name="newsletterEnabled" value="1" /> {'webmasterLogIn_subscribe_news'|lang}</div>
    </div>
    {/if}
	
	{if $setting.captchaEnabledOnWebmasterRegistration}
	<div class="form">
    <label class="title">{'webmasterLogIn_security_code'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos captchaCode"></div>
    </div>
	{/if}
	
	<div class="form">
    <label class="title">&nbsp;</label>
    <div class="infos"><input type="submit" class="button" value="{'webmasterLogIn_button_registration'|lang}" /></div>
    </div>
</fieldset>
                
{include file="includes/footer.tpl"} 
