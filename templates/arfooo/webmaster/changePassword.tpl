{include file="includes/header.tpl" title="{'webmasterChangePassword_html_title'|lang}" metaDescription="{'webmasterChangePassword_meta_description'|lang}"}

<div class="show_arbo">
<a href="{$setting.siteRootUrl}" class="link_showarbo">{'show_arbo_directory'|lang}</a> &gt; 
<a href="{'/webmaster/changePassword'|url}" class="link_showarbo">{'webmasterChangePassword_arbo'|lang}</a>
</div>

<div class="title_h">
<h1>{'webmasterChangePassword_h1'|lang}</h1>
</div>
<fieldset class="column_in">
<form id="changePasswordForm" method="post" action="{'/webmaster/saveNewPassword'|url}">

    <div class="form">
    <label class="title"><span class="text_color_mandatory">*</span></label>
    <div class="infos">{'webmasterSubmitWebsite_mandatory_fields'|lang}</div>
    </div>
	
	<div class="form">
    <label class="title">{'webmasterChangePassword_new_pass'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos"><input type="password" class="input_text_large" name="newPassword" value="" /></div>
    </div>
	
	<div class="form">
    <label class="title">{'webmasterChangePassword_repeat_pass'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos"><input type="password" class="input_text_large" name="repeatedNewPassword" value="" /></div>
    </div>
	
	<div class="form">
    <label class="title">&nbsp;</label>
    <div class="infos"><input type="submit" class="button" value="{'webmasterChangePassword_button'|lang}" /></div>
    </div>
</fieldset>
                        
{include file="includes/footer.tpl"}