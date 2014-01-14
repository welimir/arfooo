(function($){

    $.searchEnginePanel = function(){
    
        var that = {
            filled: false,
            loadCategoryFields: function(categoryId){
            
                $.ajax({
                    global: false,
                    type: "POST",
                    url: AppRouter.getRewrittedUrl("/extraField/getByCategoryId"),
                    data: {
                    categoryId: categoryId,
                    mode: "search"
                }, success: function(response){
                    var height = 0;
                    
                    $searchModules = $("#searchEngineExtraFields").empty().append(response).find(".searchModule");
                    
                    $searchModules.each(function(){
                        $this = $(this);
                        height = Math.max(height, parseInt($this.css("height")) + parseInt($this.css("top")));
                    }).end().css("height", height ? height + 10 : 20);
                      
                    if (setting.searchValues && setting.searchValues.categoryId == categoryId) {
                        $("#searchPanelForm").autoFill(setting.searchValues);
                    }
                    
                    $("#searchEngineCategoryId").change(function(){
                        that.loadCategoryFields($(this).val());
                    });
                    $("#searchEngineExtraFields").show();
                    
                }});
                
            },
            
            setEventsHandlers: function()
            {
                $("#searchPanelForm [name=categoryId]").change(function()
                {
                        that.loadCategoryFields($(this).val()); 
                });
                
                $("#advancedSearchLink").click(function()
                {
                    if($("#searchEngineExtraFields").is(":visible"))
                    {
                        $("#searchEngineExtraFields").hide();
                    }
                    else
                    {
                        that.loadCategoryFields(setting.categoryId || 0);
                    }
                    
                    return false;
                });
            },
            
            init: function(){
                    
                    that.setEventsHandlers();
            }
        }
        
        that.init();
        
    };
    
})(jQuery);
