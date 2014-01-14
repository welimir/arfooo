<script type="text/javascript" src="{'/javascript/jquery/jquery-validate/jquery.validate.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.form.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.formTool.js'|resurl}"></script> 
<script type="text/javascript" src="{'/javascript/webmaster/lostPasswordPopup.js'|resurl}"></script> 

<div id="popup_principal">

<div id="popup_top">
{'webmasterLostPass_lost_pass'|lang}
</div>


<div id="popup_main1">
<div id="popup_main2">

<div id="popup_middle">
<div id="popup_column">

<form action="{'/webmaster/sendLostPassword'|url}" method="post" id="lostPasswordPopupForm">

<fieldset class="column_in_popup">
    <div class="form_popup">
    {'webmasterLostPass_desc'|lang}
	{'webmasterLostPass_desc2'|lang}
    <label for="nom" class="title_popup"><span class="text_color_mandatory">*</span></label>
    <div class="infos_popup">{'webmasterLostPass_mandatory'|lang}</div>
    </div>
    
    <div class="form_popup">
    <label for="nom" class="title_popup">{'webmasterLostPass_your_email'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos_popup"><input type="text" class="input_text_large" name="email" value="" /></div>
    </div>
    
    {if $setting.captchaEnabledOnContactForm}
    <div class="form_popup">
    <label for="nom" class="title_popup">{'webmasterLostPass_security_code'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos_popup captchaCode"></div>
    </div>
    {/if}
    
    <div class="form_popup">
    <label for="nom" class="title_popup">&nbsp;</label>
    <div class="infos_popup"><input type="submit" class="button" value="{'webmasterLostPass_button_send'|lang}" /> &nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class="button close" value="{'webmasterLostPass_button_cancel'|lang}" /></div>
    </div>
</fieldset>

</form>

</div>
</div>
<div class="fixe">&nbsp;</div>
</div>
</div>
    

</div>