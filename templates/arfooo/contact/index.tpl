{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/config'|url}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.captchaCode.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery-validate/jquery.validate.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.form.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.formTool.js'|resurl}"></script> 
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/contact/indexOnLoad.js'|resurl}"></script>    
{/capture}

{include file="includes/header.tpl" title="{'contactIndex_html_title'|lang}" metaDescription="{'contactIndex_meta_description'|lang}"}    
	
<div class="show_arbo">
<a href="{$setting.siteRootUrl}" class="link_showarbo">{'show_arbo_directory'|lang}</a> &gt; 
<a href="{'/contact'|url}" class="link_showarbo">{'contactIndex_contact'|lang}</a>
</div>

<form action="{'/contact/sendMessageToAdmin'|url}" method="post" id="contactForm">
<div class="title_h">
<h1>{'contactIndex_form'|lang}</h1>
</div> 
<fieldset class="column_in">
	<div class="form">
    <label class="title"><span class="text_color_mandatory">*</span></label>
    <div class="infos">{'webmasterSubmitWebsite_mandatory_fields'|lang}</div>
    </div>
	
	<div class="form">
	<label class="title">{'contactIndex_email'|lang} <span class="text_color_mandatory">*</span></label>
	<div class="infos"><input type="text" name="yourEmail" class="input_text_large" /></div>
	</div>
	
	<div class="form">
	<label class="title">{'contactIndex_subject'|lang} <span class="text_color_mandatory">*</span></label>
	<div class="infos"><input type="text" name="title" class="input_text_large" /></div>
	</div>
	
	<div class="form">
	<label class="title">{'contactIndex_message'|lang} <span class="text_color_mandatory">*</span></label>
	<div class="infos"><textarea class="textarea_large" name="description" cols="50" rows="5" id="categoryDescription"></textarea></div>
	</div>
	
    {if $setting.captchaEnabledOnContactForm}
	<div class="form">
    <label class="title">{'contactIndex_security_code'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos captchaCode"></div>
    </div>
    {/if}
	
	<div class="form">
	<label class="title">&nbsp;</label>
	<div class="infos"><input type="submit" class="button" value="{'contactIndex_button_send'|lang}" /></div>
	</div>
</fieldset>
</form>

</div>

{include file="includes/footer.tpl"}