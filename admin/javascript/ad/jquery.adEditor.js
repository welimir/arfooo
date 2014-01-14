(function($){

    $.fn.adEditor = function(page){
    
        return $(this).each(function(){
        
            var that = {
                $form: $(this),
                page: page
            }
            
            $.post(AppRouter.getRewrittedUrl("/admin/ad/getAdsOnPage"), {
                page: that.page
            }, function(response){
                var ads = response;
                that.$form.autoFill(ads);
                that.$form.css("visibility", "visible");
            }, "json");
            
            var elements = that.$form[0].elements;
            
            for (i = 0; i < elements.length; i++) {
                var $e = $(elements[i]);
                $e.change(onChange);
                if ($e.attr("type") == "radio") {
                    $e.click(function(){
                        this.blur()
                    });
                }
            }
            
            function onChange(){
                var $this = $(this);
                
                var place = this.name;
                
                if (place == "predefine") {
                    var predefineOn = this.value;
                    var generalField = that.$form[0].general;
                    
                    for (var i = 0; i <= 1; i++) {
                        generalField[i].checked = (generalField[i].value == predefineOn)
                    }
                }
                
                $.post(AppRouter.getRewrittedUrl("/admin/ad/update"), {
                    page: page,
                    place: place,
                    adCriterionId: $this.val()
                }, function(){
                    $.alertDialog(_t("Change was saved"));
                });
            }
            
        });
        
    }
    
})(jQuery);
