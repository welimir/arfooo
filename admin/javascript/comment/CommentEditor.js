
CommentEditor = function(){

    $("tr[id^=commentForm]").each(function(){
        var $tr = $(this);
        
        $("a[rel]", $tr).each(function(){
        
            var $link = $(this);
            var execute = $link.attr("rel");
            switch (execute) {
                case "save":
                    
                    func = function(event){
                    
                        $.post(AppRouter.getRewrittedUrl("/admin/comment/save"), {
                            "commentId": $("[name=commentId]", $tr).val(),
                            "pseudo": $("[name=pseudo]", $tr).val(),
                            "date": $("[name=date]", $tr).val(),
                            "text": $("[name=text]", $tr).val(),
                        }, function(){
                            $.alertDialog(_t("The comment was saved."));
                        });
                        return false;
                    }
                    
                    break;
                    
                case "delete":
                    
                    func = function(event){
                    
                        $.confirmDialog(_t("Do you really want to delete it?"), function(){
                            $tr.hide();
                            $.post(AppRouter.getRewrittedUrl("/admin/comment/delete"), {
                                "commentId": $("[name=commentId]", $tr).val()
                            }, function(){
                                $.alertDialog(_t("The comment was deleted."));
                            });
                        });
                        
                        return false;
                        
                    }
                    
                    break;
                    
                case "banIp":
                    
                    func = function(event){
                        $.post(AppRouter.getRewrittedUrl("/admin/comment/banIp"), {
                            "remoteIp": $("[name=remoteIp]", $tr).val()
                        }, function(){
                            $.alertDialog(_t("The IP was banned."));
                        });
                        return false;
                        
                    }
                    
                    break;
                    
                    
                default:
                    
                    func = null;
            }
            
            if (func) {
                $link.click(func);
            }
            
        });
        
    });
};
