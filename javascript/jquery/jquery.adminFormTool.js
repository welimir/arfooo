$(document).ready(function(){

    $.alertDialog = function(message, callback){
        $("<div title='" + _t('Validation message') + "'><p style='text-align:center;font-size:1.2em'><br/><b>" + message + "</b></p></div>").dialog({
            autoOpen: true,
            modal: true,

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
        $("<div title='" + _t('Validation message') + "'><p style='text-align:center;font-size:1.2em'><br/><b>" + message + "</b></p></div>").dialog({
            autoOpen: true,
            modal: true,
            resizable: false,
            draggable: false,
            close: function(){
                $(this).remove();
            },
            buttons: {
            "Cancel": function(){

                    $(this).dialog("close");
                },
            "Yes": function(){
                
                    $(this).dialog("close");
                    if (callback) 
                        callback();
                }
            }
        });
    }
    
    $.confirmLinkClick = function(msg, url)
    {        
        $.confirmDialog(msg, function()
        {
            location.href = url;
        });
        
        return false;    
    };
    
    if (jQuery.validator) {
    
        var parentSelector = "tr";
        
        jQuery.validator.setDefaults({
            debug: false,
            errorElement: "label",
            errorClass: "text_error",
            
            highlight: function(element, errorClass){
                var $row = $(element).closest(parentSelector);
                
                if (!$row.hasClass("error")) {
                    $row.addClass("error");
                }
            },
            unhighlight: function(element, errorClass){
                var $row = $(element).closest(parentSelector);
                if ($row.hasClass("error")) {
                    $row.removeClass("error");
                }
            },
            errorPlacement: function(error, element){
                error.prependTo(element.closest("td"));
            }
        });
        
    }
    
});
