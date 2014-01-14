<head>
<meta name="robots" content="noindex, nofollow" />
</head>

<script type="text/javascript" src="{'/javascript/comment/popupOnLoad.js'|resurl}"></script> 
<script type="text/javascript" src="{'/javascript/jquery/jquery-rating/jquery.rating.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/jquery-rating/jquery.rating.css"|resurl}" rel="stylesheet" type="text/css" />

<div id="popup_principal">

<div id="popup_top">
{'commentPopup_post_comment'|lang} <!-- {$item.siteTitle} -->
</div>


<div id="popup_main1">
<div id="popup_main2">

<div id="popup_middle">
<div id="popup_column">

{if $canVote}

<form action="{'/comment/saveComment'|url}" method="post" id="commentPopupForm">
<input type="hidden" name="itemId" value="{$item.siteId}">  
<fieldset class="column_in_popup">
    
    <div class="form_popup">
    <label class="title_popup">{'commentPopup_name'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos_popup"><input type="text" class="input_text_large" name="pseudo" value="" /></div>
    </div>
	
	<div class="form_popup">
    <label class="title_popup">{'commentPopup_rating'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos_popup">
    
<input name="rating" type="radio" class="star" value="1"/>
<input name="rating" type="radio" class="star" value="2"/>
<input name="rating" type="radio" class="star" value="3"/>
<input name="rating" type="radio" class="star" value="4"/>
<input name="rating" type="radio" class="star" value="5"/>

    </div>
    </div>
    
    <div class="form_popup">
    <label class="title_popup">{'commentPopup_message'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos_popup"><textarea class="textarea_large" name="text" cols="50" rows="5" id="categoryDescription"></textarea></div>
    </div>
    
    <div class="form_popup">
    <label class="title_popup">{'commentPopup_security_code'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos_popup captchaCode"></div>
    </div>
    
    <div class="form_popup">
    <label class="title_popup">&nbsp;</label>
    <div class="infos_popup"><input type="submit" class="button" value="{'commentPopup_button_send'|lang}" /> &nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class="button close" value="{'commentPopup_button_cancel'|lang}" /></div>
    </div>
</fieldset>
</form>

{else}
{'commentPopup_already_commented'|lang}
{/if}


</div>
</div>
<div class="fixe">&nbsp;</div>
</div>
</div>
    

</div>