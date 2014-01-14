$(document).ready(function(){

    $("tr[tagId]").each(function(){
        var $tr = $(this);
        var tagId = $tr.attr("tagId");
        
        $("a", $tr).each(function(){
            var $link = $(this);
            var func;
            var action = $link.attr("execute");
            
            switch (action) {
                case "save":
                    func = function(){
                        $("#tagForm" + $(this).data("tagId")).ajaxSubmit();
                        $.alertDialog(setting.lang['The tag was saved.']);
                        return false;
                    }
                    
                    break;
                    
                default:
                    
                    func = null;
            }
            
            if (func) {
                $link.data("tagId", tagId);
                $link.click(func);
            }
        });
    });
    
});
