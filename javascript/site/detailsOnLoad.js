jQuery(document).ready(function(){

    var lastMediumImageLink = null;
    
    $("img.nanoImage").mouseover(function(){
        var $this = $(this);
        var photoId = $this.attr("photoId");
        var currentMediumImageLink = $("#mediumImageLink" + photoId);
        
        if (lastMediumImageLink) {
            lastMediumImageLink.hide();
        }
        
        currentMediumImageLink.show();
        lastMediumImageLink = currentMediumImageLink;
        
    }).eq(0).mouseover();
    
    $("a.dialog").each(function(){
        $this = $(this);
        $this.click(function(){
            var link = this;
            $.popup.open(link.href, $(link).attr("title"));
            
            return false;
        });
    });
    
    $(".captchaCode").livequery(function(){
        $(this).captchaCode();
    });
    
    if (setting.retrieveGoogleDetailsSiteId) {
        $.ajax({
            global: false,
            type: "POST",
            url: AppRouter.getRewrittedUrl("/site/getGoogleDetails"),
            data: {
                "siteId": setting.retrieveGoogleDetailsSiteId
            },
            success: function(site){
                var imgSrc = '<img src="' + setting.siteRootUrl + '/templates/arfooo/images/pagerank/pr' + site.pageRank + '.gif" alt="PageRank ' + site.pageRank + '" />';
                
                if ($("#pageRank").length) 
                    $("#pageRank").html(imgSrc);
                if ($("#backlinksCount").length) 
                    $("#backlinksCount").html(site.backlinksCount);
                if ($("#indexedPagesCount").length) 
                    $("#indexedPagesCount").html(site.indexedPagesCount);
            },
            dataType: "json"
        });
    }
    
    $("a[rel='galleryPhotos']").colorbox({maxWidth: "90%", maxHeight: "90%"});
});
