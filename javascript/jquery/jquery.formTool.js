$(document).ready(function(){

    $.alertDialog = function(message, callback){
        $("<div title='" + _t('Validation message') + "'><p style='text-align:center;font-size:1.1em'><br/><b>" + message + "</b></p></div>").dialog({
            autoOpen: true,
            modal: true,
			width: 600,
            resizable: false,
            draggable: false,
            close: function(){
                $(this).remove();
            },
            buttons: {
                "Ok": function(){
                
                    $(this).dialog("close");
                    if (callback) 
                        callback();
                }
            }
        });
    }
    
    $.confirmDialog = function(message, callback){
        $("<div title='" + _t('Validation message') + "'><p style='text-align:center;font-size:1.1em'><br/><b>" + message + "</b></p></div>").dialog({
            autoOpen: true,
            modal: true,
            resizable: false,
            draggable: false,
            close: function(){
                $(this).remove();
            },
            buttons: {
                "Ok": function(){
                
                    $(this).dialog("close");
                    if (callback) 
                        callback();
                }
            }
        });
        
        return false;
    }
    
    var errorParentSelector = "div[class^=form], td";
    
    jQuery.validator.setDefaults({
        errorElement: "div",
        errorClass: "text_error",
        
        highlight: function(element, errorClass){
            var $row = $(element).closest(errorParentSelector);
            
            if (!$row.hasClass("error")) {
                $row.addClass("error");
            }
        },
        unhighlight: function(element, errorClass){
            var $row = $(element).closest(errorParentSelector);
            if ($row.hasClass("error")) {
                $row.removeClass("error");
            }
        },
        errorPlacement: function(error, element){
            error.prependTo(element.closest(errorParentSelector));
        }
        
    });
    
    $.fn.ajaxFormSubmitter = function(params){
        var defaults = {
            submitHandler: function(form){
            
                $(form).ajaxSubmit({
                    dataType: 'json',
                    success: function(response){
                        if (response.status == "error") {
                            $.alertDialog(response.message);
                        }
                        
                        if (response.status == "ok") {
                            $.alertDialog(response.message, function() {
                            if (response.redirectUrl) {
                               location.href = response.redirectUrl;
                            }
                            });
                        }
                        
                    }
                })
            }
        };
        
        return $(this).each(function(){
        
            $(this).validate($.extend(defaults, params));
        });
    };
    
    $.extend($.validator.messages, {
        required: setting.lang["This field is required"]
    });
    
    var ajaxInProgress = 0;
    var progressDialog = $("<div title='" + setting.lang["Loading"] + "'><p style='text-align:center;font-size:1.6em'><br/><b>" + setting.lang["Loading..."] + "</b><br><img style=\"margin-top:10px;\" src=\"" + setting.siteRootUrl + "/templates/arfooo/images/loader.gif\"></p></div>").dialog({ autoOpen: false, resizable: false, modal: false, width: 500, draggable :false });
    
    $(document).ajaxSend(function(r,s){

       ajaxInProgress++;
       
       if(ajaxInProgress == 1)
       {
           progressDialog.dialog("open");
       }
         
    });  

    $(document).ajaxStop(function(r,s){
        ajaxInProgress = 0;
        progressDialog.dialog("close");
    });
      
});
