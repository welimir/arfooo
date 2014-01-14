(function($){

    $.fn.itemEditor = function(params){
    
        var that = {
            form: $("#itemForm")[0],
            __construct: function(){
                var defaults = {
                    mode: "user",
                    captchaEnabled: false,
                    extraFieldTooltipsEnabled: true,
                    data: null,
                    categoryChainSelect: true
                };
                
                params = $.extend(defaults, params);

                var url = AppRouter.getRewrittedUrl("/category/getChildsOptionList");
                var selectedId = setting.item ? setting.item.categoryId : undefined;
                 
                if(params.categoryChainSelect)
                {
                    $("#itemForm input[name=categoryId]").chainSelect({
                        url: url, 
                        selectedId: selectedId, 
                        defaultOption: {
                            value: "",
                            label: " - "
                        },
                        fade: true,
                        change: that.onCategoryIdChange
                    });
                }
                
                var rules = {
                    webmasterEmail: {required: true, email: true},
                    categoryId: "required",
                    siteTitle: "required"
                };

                if (params.mode == 'user' || params.mode == 'newUser') {
                    rules.countryCode = 'required';

                    if (setting.siteDescriptionMinLength > 0) {
                        rules.description = "required";
                    }
                }
                
                if (params.captchaEnabled) 
                    rules = $.extend(rules, {
                        privateCode: "required"
                    });
                
                if (setting.backLinkMandatory) 
                    rules = $.extend(rules, {
                        returnBond: "required"
                    });
                
                if (setting.urlMandatory) 
                    rules = $.extend(rules, {
                        url: {
                            required: true,
                            url: true
                        }
                    });
                
                var validator = $("#itemForm").validate({
                    rules: rules,
                    messages: {
                        privateCode: _t("Please enter captcha code"),
                        webmasterEmail: {
                            required: _t("Please enter your email"),
                            email: _t("Your email must be in format - name@domain.com"),
                            remote: _t("Email was used earlier")
                        }
                    },
                    submitHandler: function(form){
                        if (typeof(tinyMCE) != 'undefined') {
                            tinyMCE.triggerSave(true,true);
                        }
                        $(form).ajaxSubmit({
                            dataType: 'json',
                            success: function(response){
                                if (response.status == "error") {
                                    $.alertDialog(response.message);
                                    $("a.linkGenerateNewCaptchaImg", $(form)).click();
                                }
                                
                                if (response.status == "ok") {
                                
                                    if (response.message) {
                                        $.alertDialog(response.message, function(){
                                        
                                            if (response.redirectUrl) {
                                                location.href = response.redirectUrl;
                                            }
                                        });
                                    }
                                    else {
                                        if (response.redirectUrl) {
                                            location.href = response.redirectUrl;
                                        }
                                        
                                    }
                                }
                            }
                        });
                        return false;
                    }
                });

            validator.focusInvalid = function() {
                // put focus on tinymce on submit validation
                if( this.settings.focusInvalid ) {
                    try {
                        var toFocus = $(this.findLastActive() || this.errorList.length && this.errorList[0].element || []);
                        if (toFocus.is("textarea") && typeof(tinyMCE) != 'undefined' && tinyMCE.get(toFocus.attr("id"))) {
                            // scroll window to textarea
                            toFocus.show().focus().hide();

                            // focus tinyMCE window
                            tinyMCE.get(toFocus.attr("id")).focus();
                        } else {
                            toFocus.filter(":visible").focus();
                        }
                    } catch(e) {
                        // ignore IE throwing errors when focusing hidden elements
                    }
                }
            }
                
                $("#itemForm input[name=previewAd]").click(function(){
                    $("#itemForm input[name=preview]").val("1");
                });
                
                $("#itemForm select[name=priceType]").change(function(){
                    $("#itemForm input[name=price]").valid();
                });
                
                var options = {
                    saveUrl: AppRouter.getRewrittedUrl('/photo/save'),
                    deleteUrl: AppRouter.getRewrittedUrl('/photo/delete'),
                    filesMaxCount: setting.itemGalleryImagesMaxCount,
                    $uploadButton: $('#uploadGalleryImageButton')
                };

                if (params.item) {
                    if (params.item) {
                        options['data'] = {
                            itemId: params.item.siteId
                        };
                    }
                    
                    if (params.item.photos) {
                        $.each(params.item.photos, function() {
                            this.uniqueId = this.photoId;
                        });
                        options['files'] = params.item.photos;
                    }
                    
                    $("#itemForm").autoFill(params.item);
                    
                    if (that.form.countryCode) {
                        that.onCountryCodeChange();
                    }
                    
                    if (that.form.backLinkCode2) {
                        that.onCategoryIdChange();
                    }
                }
                else {
                    if (params.tempId) {
                        options['data'] = {
                            tempId: params.tempId
                        };
                    }
                }
                
                if (params.categoryId) 
                    that.loadCategoryExtraFields(params.categoryId);
                if (params.item && params.item.categoryId) 
                    that.loadCategoryExtraFields(params.item.categoryId);
                
                $("#fileUploadPanel").fileUploader(options);
                $("#itemForm").keywordSelector({
                    keywordIds: params.item ? params.item.keywordIds : new Array()
                });
                
                if($("#descriptionCharsLeftCounter").length)
                {
                    $("#itemForm textarea[name=description]").charCounter(setting.siteDescriptionMaxLength, {
                        container: "#descriptionCharsLeftCounter",
                        format: "%1",
                        min: setting.siteDescriptionMinLength,
                        ignoreHtmlTags: true
                    });
                }
                
                $(that.form.metaTagButton).click(that.onMetaTagButtonClick);
                $(that.form.countryCode).change(that.onCountryCodeChange);
                $(that.form.categoryId).change(that.onCategoryIdChange);
                $(that.form.categoryId).change(that.onCategoryIdChange);

                $('input[name=descriptionDisplayMethod]', that.form).change(
                    function()
                    {
                        if ($(this).val() == 'text') {
                            tinyMCE.execCommand('mceRemoveControl', false, 'itemDescription');
                        } else {
                            tinyMCE.execCommand('mceAddControl', false, 'itemDescription');
                        }
                    }
                );

                if (params.item && params.item.descriptionDisplayMethod != 'text') {
                    tinyMCE.execCommand('mceAddControl', false, 'itemDescription');
                }

                window.setInterval(that.updateTextarea, 200);

            },
            updateTextarea: function()
            {
                if (typeof(tinyMCE) != 'undefined') {
                    tinyMCE.triggerSave(true,true);
                }
                 $("#itemForm textarea[name=description]").trigger('paste');
            },
            loadCategoryExtraFields: function(categoryId){
                $.post(AppRouter.getRewrittedUrl("/category/isPossibleSubmission"), {
                    categoryId: categoryId
                }, function(response){
                
                    if (response.status == "ok") {
                        $("#newItemStepsDiv").show();
                        $("#selectOtherCategoryDiv").hide();
                    }
                    else {
                        $("#newItemStepsDiv").hide();
                        $("#selectOtherCategoryDiv").show();
                    }
                }, "json");
                
                var url = "";
                
                switch (params.mode) {
                    case "admin":
                        url = AppRouter.getRewrittedUrl("/admin/extraField/getByCategoryId");
                        break;
                    case "moderator":
                        url = AppRouter.getRewrittedUrl("/moderation/extraField/getByCategoryId");
                        break;
                    default:
                        url = AppRouter.getRewrittedUrl("/extraField/getByCategoryId");
                }
                
                $.post(url, {
                    categoryId: categoryId
                }, function(response){
                
                    $("#itemFormExtraFields").html(response);
                    
                    if (params.item) {
                        params.item.categoryId = categoryId;
                        $("#itemForm").autoFill(params.item);

                        $('.extraField_file_manage_area input.extraField_file_fileSrc').each(
                            function()
                            {
                                var fileSrc = $(this).val();
                                if (fileSrc) {
                                    var fileDownloadUrl = AppRouter.getRewrittedUrl('/uploads/files/' + fileSrc);
                                    var parent = $(this).parent();
                                    parent.find('.extraField_file_download_link')
                                        .attr('href', fileDownloadUrl)
                                        .show();

                                    parent.find('input[type=file]').hide();

                                    var fieldId = parent.find('.extraField_file_fieldId').val();
                                    var fileDeleteUrl = AppRouter.getRewrittedUrl('/extraField/deleteExtraFieldValue/' + params.item.siteId + '/' + fieldId);
                                    parent.find('.extraField_file_delete_link').click(
                                        function ()
                                        {
                                            $.post(fileDeleteUrl, function()
                                            {
                                                parent.find('input[type=file]').show();
                                                parent.find('.extraField_file_delete_link').hide();
                                                parent.find('.extraField_file_download_link').hide();
                                            });
                                            return false;
                                        }
                                    ).show();
                                }
                            }
                        );
                    }
                });
            },
            onMetaTagButtonClick: function(){
                //ajax.set("onLoading", this.onMetaDataLoading.handler(this));
                $.post(setting.metaDataUrl, {
                    url: this.form.url.value
                }, function(metaData){
                    that.form.description.value = metaData.description;
                    that.form.siteTitle.value = metaData.title;
                    //that.counter.updateStringLength();
                }, "json");
            },
            
            onCategoryIdChange: function(){
            
                var categoryId = that.form.categoryId.value;
                that.loadCategoryExtraFields(categoryId);
                
                if (setting.backLinkCodeDataUrl && that.form.backLinkCode2) {
                
                    if (categoryId) {
                        $.post(setting.backLinkCodeDataUrl, {
                            "categoryId": categoryId
                        }, function(resp){
                            that.form.backLinkCode2.value = resp.categoryBackLinkCode;
                        }, "json");
                    }
                    else {
                        that.form.backLinkCode2.value = "";
                    }
                }
            },
            
            onCountryCodeChange: function(){
                var countryCode = that.form.countryCode.value;
                var countryFlagImage = $("#countryFlagImage");
                
                if (countryCode) {
                    countryFlagImage.show();
                    countryFlagImage.attr("src", setting.siteRootUrl + "/templates/arfooo/images/flags/" + countryCode + ".png");
                }
                else {
                    countryFlagImage.hide();
                }
                
            }
        };
        
        that.__construct();
    }
    
})(jQuery);
