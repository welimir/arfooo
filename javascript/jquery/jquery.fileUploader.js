(function($)
{
    $.fn.fileUploader = function(options){
        var $this = $(this);

        var that = {
            options: {
                filesMaxCount: 10,
                savePhotoUrl: null,
                deletePhotoUrl: null,
                $uploadButton: null,
                displayAvailableFileCount: true
            },
            $responseMessage: null,
            $uploadedFilesStats: null,
            files: {},
            __construct: function()
            {
                that.options = $.extend(that.options, options);

                if (that.options.$uploadButton) {
                    new $.AjaxUpload(
                        that.options.$uploadButton,
                        {
                            action: that.options.saveUrl,
                            name: 'file',
                            data: that.options.data,
                            responseType: 'json',
                            onSubmit: that.onSubmit,
                            onComplete: that.onComplete
                        }
                    );
                }

                $this.append(
                    $('<div class="fileUploader_uploadedFilesStats"></div>'),
                    $('<div class="fileUploader_responseMessage"></div>'),
                    $('<ul class="fileUploader_uploadedFiles"></ul>')
                );

                that.$uploadedFilesStats = $('.fileUploader_uploadedFilesStats', $this);
                that.$responseMessage = $('.fileUploader_responseMessage', $this);
                that.$uploadedFiles = $('.fileUploader_uploadedFiles', $this);


                $('.fileUploader_delete', $this).livequery(
                    'click',
                    function()
                    {
                        $(this).unbind('click');
                        that.deletePhoto($(this));
                    }
                );

                that.updateCounter();

                $(options.files).each(
                    function (index, file)
                    {
                        that.addFile(file);
                    }
                );
            },
            onSubmit: function()
            {
                that.$responseMessage.text("Uploading...").addClass("waiting").show();
            },
            onComplete: function(file, response)
            {
                that.$responseMessage.hide().removeClass('waiting');

                if (typeof response === 'undefined' || response.status == "error") {
                    if (response === 'undefined') {
                        var errorMessage = "Can't connect to server";
                    }
                    else {
                        var errorMessage = response.message;
                    }

                    that.$responseMessage.fadeOut(1000, function(){
                        $(this).html($("<span>" + errorMessage + "</span>").css("color", "#f00"))
                            .fadeIn(1000)
                    });
                } else {
                    that.addFile(response.file);

                    var responseMessage = _t("New file has been uploaded sucessfully");
                    that.$responseMessage.fadeOut(
                        100,
                        function()
                        {
                            $(this).html(responseMessage).fadeIn(1000);
                        }
                    );
                }

                if (!errorMessage && options.afterSave) {
                    options.afterSave(response);
                }
            },
            addFile: function(file)
            {
                var fileThumb = new Image();
                $(fileThumb).attr({
                    src: file.thumbSrc,
                    width: 120,
                    height: 90
                }).addClass('uploaded');

                var $new = $('<div class="fileUploader_fileInfo"></div>');
                var $delete = $('<div id="' + file.uniqueId + '" class="fileUploader_delete" title="' + _t('Delete') + '"></div>');
                var $editLink = $('<div id="' + file.uniqueId + '" class="edit" title="' + _t('Edit') + '">' + _t('Edit') + '</div>');
                $editLink.click(
                    function()
                    {
                        var editUrl = '/photo/edit/' + file.uniqueId;
                        if (that.options.data && that.options.data.tempId) {
                            editUrl += '/' + that.options.data.tempId;
                        }
                        $.popup.open(AppRouter.getRewrittedUrl(editUrl));
                    }
                );

                $new.append($(fileThumb));
                $delete.data("uniqueId", file.uniqueId);

                that.$uploadedFiles.append($('<li></li>').append($delete, $new, $editLink).hide().fadeIn(1000));

                that.updateCounter();
            },
            deletePhoto: function(toDelete)
            {
                var data = {
                    uniqueId: toDelete.data("uniqueId")
                };

                if (that.options.data && that.options.data.tempId) {
                    data.tempId = that.options.data.tempId;
                }

                $.post(
                    that.options.deleteUrl,
                    data,
                    function(response)
                    {
                        toDelete.parents('li').fadeOut(
                            300,
                            function()
                            {
                                $(this).remove();
                                that.updateCounter()
                            }
                        );
                    }
                );
            },
            clean: function()
            {
                that.$responseMessage.html('');
                that.$uploadedFiles.empty();
                that.updateCounter();
            },
            updateCounter: function()
            {
                var uploadedPhotosCount = that.$uploadedFiles.children('li').size();
                if (that.options.displayAvailableFileCount) {
                    that.$uploadedFilesStats.text(
                        uploadedPhotosCount + " " +
                        _t("of") + " " + that.options.filesMaxCount + " " +
                        _t("available photos uploaded")
                    );
                }
                if (that.options.$uploadButton) {
                    that.options.$uploadButton.css({
                        visibility: (uploadedPhotosCount == that.options.filesMaxCount) ? 'hidden' : 'visible'
                    });
                }
            }
        }

        return $this.each(
            function()
            {
                that.__construct();
                $(this).data('fileUploader', that);
            }
        );
    }
})(jQuery);
