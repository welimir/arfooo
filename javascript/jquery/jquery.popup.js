(function($){
	
    $.popup = {};
    $.popup.open = function(url, title){
        $.ajaxSetup({
            cache: true
        });
        
        var $content = $("<div style='block'></div>").load(url, function(){
            $.ajaxSetup({
                cache: null
            });
            
            $content.dialog({
                modal: true,
                width: 540,
                resizable: false,
                draggable: false,
                height: "auto",
                title: title,
                bgiframe: true,
                close: function(event, ui){
                    $(this).remove();
                }
            });
            
            var popupStart = $(document).data("popupStart");
            if (popupStart) {
                $(document).data("popupStart", null);
                popupStart($content);
            }
            
        });
        
    }
    
})(jQuery);
