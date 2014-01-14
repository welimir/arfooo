    var setting = new Array();
    setting.siteRootUrl = "{$setting.siteRootUrl|rtrim:'/'}";
    setting.siteDescriptionMaxLength = {$setting.siteDescriptionMaxLength};
    setting.siteDescriptionMinLength = {$setting.minSiteDescriptionLength};
    setting.maxKeywordsCountPerSite = {$setting.maxKeywordsCountPerSite};
    setting.itemGalleryImagesMaxCount = {$setting.itemGalleryImagesMaxCount};
    setting.metaDataUrl = "{'/webmaster/getMetaData'|url}";
    setting.urlMandatory = {$setting.urlMandatory};
    setting.backLinkMandatory = {$setting.backLinkMandatory};
    setting.urlRewriting = {$setting.urlRewriting};
    
    setting.lang = new Array();                    
    setting.lang['You have already added this keyword. Select another one.'] = "{'javascriptConfig_you_have_already_chosen_this_keyword_Select_another_one'|lang}"; 
    setting.lang['loading...'] = "{'javascriptConfig_loading'|lang}"; 
    setting.lang['Please, fill in the fields URL of site, Title and Description.'] = "{'javascriptConfig_please_fill_in_the_website_Url_Title_and_Description_fields'|lang}"; 
    setting.lang['The URL must start with http://'] = "{'javascriptConfig_the_Url_must_start_with_http://'|lang}"; 
    setting.lang['Please, enter a valid e-mail address.'] = "{'javascriptConfig_please_enter_valid_email_address'|lang}"; 
    setting.lang['You modify the webmaster of this site. Do you want the fields Webmaster Email and Webmaster Name to be refreshed, or you want to modify them manually?'] = "{'javascriptConfig_when_changing_the_website_webmaster_the_email_will_also_change'|lang}"; 
    setting.lang['The comment was saved.'] = "{'javascriptConfig_the_comment_was_saved'|lang}";
    setting.lang['The comment was deleted.'] = "{'javascriptConfig_the_comment_was_deleted'|lang}";
    setting.lang['The IP was banned.'] = "{'javascriptConfig_the_IP_was_banned'|lang}";
    setting.lang['Please, select a package.'] = "{'javascriptConfig_please_select_package'|lang}";
    setting.lang['Please, select a payment processor.'] = "{'javascriptConfig_please_select_payment_processor'|lang}";
    setting.lang['Please, enter a name or nickname.'] = "{'javascriptConfig_please_enter_your_username'|lang}";
    setting.lang['Please, enter a comment.'] = "{'Please, enter a comment.'|lang}";
    setting.lang['Please, enter the protection code.'] = "{'javascriptConfig_please_enter_the_security_code'|lang}";
    setting.lang['The tag was saved.'] = "{'javascriptConfig_the_tag_was_saved'|lang}";
    setting.lang['You can`t select this payment method for selected package.'] = "{'javascriptConfig_you_cant_select_this_payment_method_for_selected_package'|lang}";
    setting.lang["Delete"] = "{'javascriptConfig_delete'|lang}";
	setting.lang["Edit"] = "{'javascriptConfig_edit'|lang}";
    setting.lang["File"] = "{'javascriptConfig_file'|lang}";
    setting.lang["was uploaded sucessfully"] = "{'javascriptConfig_was_uploaded_sucessfully'|lang}";
    setting.lang["of"] = "{'javascriptConfig_of'|lang}";
    setting.lang["available photos uploaded"] = "{'javascriptConfig_available_photos_uploaded'|lang}";
    setting.lang["Loading"] = "{'javascriptConfig_popup_loading_title'|lang}";
    setting.lang["Loading..."] = "{'javascriptConfig_popup_loading_content'|lang}";
    setting.lang["Your email must be in format - name@domain.com"] = "{'javascript_config_email_format'|lang}";
    setting.lang["Email was used earlier"] = "{'javascript_config_email_was_used_earlier'|lang}";
    setting.lang["Please enter password"] = "{'javascript_config_please_enter_password'|lang}";
    setting.lang["Please confirm your password"] = "{'javascript_config_please_confirm_your_password'|lang}";
    setting.lang["Please enter captcha code"] = "{'javascript_config_please_enter_captcha_code'|lang}";
    setting.lang["Passwords aren't equal"] = "{'javascript_config_passwords_are_not_equal'|lang}";
    setting.lang["This field is required"] = "{'This field is required'|lang}";  
    setting.lang["Please enter your email"] = "{'javascript_config_please_enter_your_email'|lang}";
    setting.lang["Validation message"] = "{'javascript_config_validation_message'|lang}";
	setting.lang["Your message was saved"] = "{'javascript_config_your_message_was_saved'|lang}";
	setting.lang["Your message was sent"] = "{'javascript_config_your_message_was_sent'|lang}";
	setting.lang["New file has been uploaded sucessfully"] = "{'javascript_config_new_file_has_been_uploaded_sucessfully'|lang}";
	setting.lang["Uploading..."] = "{'javascript_config_uploading'|lang}";
	setting.lang["You have entered an invalid code"] = "{'javascript_config_you_have_entered_an_invalid_code'|lang}";
    
    {literal}
    function _t($phrase)
    {
        return setting.lang[$phrase] || $phrase;
    }
    
    
    var AppRouter =
    {
        rewrites: new Array(),
        addRewriteRule: function(pattern, replacement)
        {
            AppRouter.rewrites.push({"pattern": new RegExp(pattern), replacement: replacement});
        },
        
        getRewrittedUrl: function(url)
        {
            var rewrittedUrl = setting.siteRootUrl;
            if(!setting.urlRewriting)rewrittedUrl += "/index.php";
             
            for(var i = 0; i < AppRouter.rewrites.length; i++)
            {
                var rewrite = AppRouter.rewrites[i];
                url = url.replace(rewrite.pattern, rewrite.replacement); 
            }
            
            rewrittedUrl += url;
            return rewrittedUrl;
        }
    }
    
    {/literal}