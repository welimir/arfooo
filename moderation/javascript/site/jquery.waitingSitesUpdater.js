
(function($){

    $.waitingSitesUpdater = function(){
    
        var that = {
        
            waitingSitesIds: new Array(),
            
            init: function(){
                $("#waitingSitesForm input[name=siteIds\\[\\]]").each(function(){
                    that.waitingSitesIds.push($(this).val());
                });
                
                setInterval(that.refreshWaitingSites, 1000 /* milliseconds */ * 10 /* seconds */);
            },
            
            updateWaitingForms: function(){
                // display new waiting sites count
                $('#countOfWaitingSites').text(that.waitingSitesIds.length);
                
                // set alternative colours (repaint list items after removing/adding)
                var alt = true;
                $('#holderOfWaitingSites > div').each(function(){
                    if (alt) {
                        this.className = "column_in_waiting_site_grey";
                    }
                    else {
                        this.className = "column_in_waiting_site_blue";
                    }
                    
                    alt = !alt;
                });
                
            },
            
            waitingSitesHtmlSuccess: function(responseHtml){
                $('#holderOfWaitingSites').html($('#holderOfWaitingSites').html() + responseHtml);
                that.updateWaitingForms();
            },
            
            compareWaitingSitesSuccess: function(sites){
                that.waitingSitesIds = sites.waiting;
                
                // remove moderated sites
                for (var i = 0; i < sites.toRemove.length; i++) {
                    var siteId = sites.toRemove[i];
                    $("#siteItem" + siteId).remove();
                }
                
                // add newly appeared waiting sites
                if (sites.toAdd.length) {
                
                    $.post(AppRouter.getRewrittedUrl('/moderation/site/getWaitingSitesHtml'), {
                        'siteIds': sites.toAdd.join(",")
                    }, that.waitingSitesHtmlSuccess);
                }
                else {
                    that.updateWaitingForms();
                }
                
            },
            
            refreshWaitingSites: function(){
                var sitesList = that.waitingSitesIds.join(',');
                $.post(AppRouter.getRewrittedUrl('/moderation/site/compareWaitingSites'), {
                    'waitingSitesIds': sitesList
                }, that.compareWaitingSitesSuccess, 'json');
            }
            
        }
        
        that.init();
        
    }
    
})(jQuery);
