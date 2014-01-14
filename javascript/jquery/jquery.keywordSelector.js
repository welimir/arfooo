(function($){

    $.fn.keywordSelector = function(params){
    
        
        return $(this).each(function(){
            var that = {
                maxSelectsCount: 0,
                form: $(this)[0],
                duplicateMsg: setting.lang['You have already added this keyword. Select another one.'],
                keywordIds: new Array(),
                lp: 0,
                
                addNewRow: function(){
                    var template = $.format($("#keywordRowTemplate").val());
                    var $newRow = $(template(++that.lp));
                    $("#keywordsSelectTable").append($newRow);
                    return $newRow;
                },
                
                init: function(){
                
                    if($("#keywordRowTemplate").length == 0)return;
                    
                    that.maxSelectsCount = setting.maxKeywordsCountPerSite;
                    
                    if(params.keywordIds)
                    {
                        that.keywordIds = params.keywordIds;
                    
                        if(that.keywordIds.length < that.maxSelectsCount)
                        {
                            params.keywordIds.push("");
                        }
                    } 
                    
                    $("[name=keywords\[\]]", this.form).livequery("change", this.onKeywordChanged);
                    that.setKeywords(that.keywordIds);
                },
                
                setKeywords: function(keywordIds){
                    for (var i = 0; i < keywordIds.length; i++) {
                        $("[name=keywords\[\]]", that.addNewRow()).val(keywordIds[i]);
                    }
                },
                
                onKeywordChanged: function(){
                    var value = $(this).val();
                    var wasTimes = {};
                    var $keywords = $("[name=keywords\[\]]", this.form);
                    
                    $keywords.each(function(){
                        if (!wasTimes[$(this).val()]) 
                            wasTimes[$(this).val()] = 0;
                        wasTimes[$(this).val()]++;
                    });
                    
                    if (value != "" && wasTimes[value] > 1) {
                        $.alertDialog(that.duplicateMsg);
                        $(this).val("");
                        return false;
                    }
                    
                    if (!wasTimes[''] && $keywords.length < that.maxSelectsCount) 
                        that.addNewRow();
                }
            };
            
            that.init();
            
        });
    }
    
})(jQuery);
