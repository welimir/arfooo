<head>
<meta name="robots" content="noindex, nofollow" />
</head>

<script type="text/javascript" src="{'/javascript/jquery/jquery-validate/jquery.validate.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.form.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.formTool.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/photo/edit.js'|resurl}"></script>


<div id="popup_principal">

<div id="popup_top">
{'photoEdit_title'|lang}
</div>


<div id="popup_main1">
<div id="popup_main2">

<div id="popup_middle">
<div id="popup_column">

<form action="{'/photo/saveEdit'|url}" method="post" id="photoPopupForm">
<input type="hidden" name="photoId" value="{$photo.photoId}">
<input type="hidden" name="tempId" value="{$tempId}">
<fieldset class="column_in_popup">

    <div class="form_popup">
    <label class="title_popup">{'photoEdit_name_alt'|lang}</label>
    <div class="infos_popup"><input type="text" class="input_text_large" name="altText" value="{$photo.altText}" /></div>
    </div>
    
    <div class="form_popup">
    <label class="title_popup">&nbsp;</label>
    <div class="infos_popup"><input type="submit" class="button" value="{'photoEdit_save_button'|lang}" /> &nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class="button close" value="{'photoEdit_cancel_button'|lang}" /></div>
    </div>
</fieldset>
</form>


</div>
</div>
<div class="fixe">&nbsp;</div>
</div>
</div>
    

</div>