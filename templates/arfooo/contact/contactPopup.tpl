<head>
<meta name="robots" content="noindex, nofollow" />
</head>

<script type="text/javascript" src="{'/javascript/jquery/jquery-validate/jquery.validate.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.form.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.formTool.js'|resurl}"></script> 
<script type="text/javascript" src="{'/javascript/contact/contactPopup.js'|resurl}"></script> 


<div id="popup_principal">

<div id="popup_top">
{'contactPopup_send_message'|lang}
</div>


<div id="popup_main1">
<div id="popup_main2">

<div id="popup_middle">
<div id="popup_column">

<form action="{'/contact/sendMessageToUser'|url}" method="post" id="contactPopupForm">
<input type="hidden" name="siteId" value="{$item.siteId}">  
<fieldset class="column_in_popup">
    {if $session.role != "administrator" && $session.role != "moderator"}
    <div class="form_popup">
    <label class="title_popup"><span class="text_color_mandatory">*</span></label>
    <div class="infos_popup">{'contactPopup_mandatory_fields'|lang}</div>
    </div>
   
    <div class="form_popup">
    <label class="title_popup">{'contactPopup_your_email'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos_popup"><input type="text" class="input_text_large" name="yourEmail" value="" /></div>
    </div>
    {else}
    <input type="hidden" name="yourEmail" value="{$session.email}"/>
    {/if}
    
    <div class="form_popup">
    <label class="title_popup">{'contactPopup_object'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos_popup"><input type="text" class="input_text_large" name="title" value="RE: {$item.siteTitle}" /></div>
    </div>
    
    <div class="form_popup">
    <label class="title_popup">{'contactPopup_message'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos_popup"><textarea class="textarea_large" name="description" cols="50" rows="5" id="categoryDescription"></textarea></div>
    </div>
    
    {if $setting.captchaEnabledOnContactForm && $session.role != "administrator" && $session.role != "moderator"}
    <div class="form_popup">
    <label class="title_popup">{'contactPopup_security_code'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos_popup captchaCode"></div>
    </div>
    {/if}
    
    <div class="form_popup">
    <label class="title_popup">&nbsp;</label>
    <div class="infos_popup"><input type="submit" class="button" value="{'contactPopup_button_send'|lang}" /> &nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class="button close" value="{'contactPopup_button_cancel'|lang}" /></div>
    </div>
</fieldset>
</form>


</div>
</div>
<div class="fixe">&nbsp;</div>
</div>
</div>
    

</div>