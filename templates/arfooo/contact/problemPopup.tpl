<head>
<meta name="robots" content="noindex, nofollow" />
</head>

<script type="text/javascript" src="{'/javascript/jquery/jquery-validate/jquery.validate.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.form.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.formTool.js'|resurl}"></script> 
<script type="text/javascript" src="{'/javascript/contact/problemPopup.js'|resurl}"></script> 

<div id="popup_principal">

<div id="popup_top">
{'problemPopup_title'|lang}
</div>


<div id="popup_main1">
<div id="popup_main2">

<div id="popup_middle">
<div id="popup_column">

<form action="{'/contact/saveItemProblem'|url}" method="post" id="problemPopupForm">
<input type="hidden" name="siteId" value="{$item.siteId}"> 
<fieldset class="column_in_popup">
    <div class="form_popup">
    <label class="title_popup"><span class="text_color_mandatory">*</span></label>
    <div class="infos_popup">{'problemPopup_mandatory_fields'|lang}</div>
    </div>
    
    <div class="form_popup">
    <label class="title_popup">{'problemPopup_problem_type'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos_popup">
		<select name="type">
		<option value="">{'problemPopup_select_choice'|lang}</option>
		<option value="spam">{'problemPopup_spam'|lang}</option>
		<option value="badCategory">{'problemPopup_bad_category'|lang}</option>
		<!-- <option value="expired">{'problemPopup_expired'|lang}</option> -->
		<option value="others">{'problemPopup_others'|lang}</option>
    	</select>
	</div>
    </div>
    
    <div class="form_popup">
    <label class="title_popup">{'problemPopup_message'|lang}</label>
    <div class="infos_popup"><textarea class="textarea_large" name="description" cols="50" rows="5" id="categoryDescription"></textarea></div>
    </div>
    
    <div class="form_popup">
    <label class="title_popup">&nbsp;</label>
    <div class="infos_popup">{'problemPopup_description_why'|lang}</div>
    </div>
    
    {if $setting.captchaEnabledOnContactForm}
    <div class="form_popup">
    <label class="title_popup">{'problemPopup_security_code'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos_popup captchaCode"></div>
    </div>
    {/if}
    
    <div class="form_popup">
    <label class="title_popup">&nbsp;</label>
    <div class="infos_popup"><input type="submit" class="button" value="{'problemPopup_button_send'|lang}" /> &nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class="button close" value="{'problemPopup_button_cancel'|lang}" /></div>
    </div>
</fieldset>
</form>


</div>
</div>
<div class="fixe">&nbsp;</div>
</div>
</div>
    

</div>
</body>
                            