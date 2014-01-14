$(document).ready(function(){
         
    $("#itemForm").itemEditor({
        mode: "moderator",
        item: setting.item
    });

    $("#editAdsForm").adEditor(setting.adPage);

    new $.AjaxUpload('uploadThumbButton', {
        action: AppRouter.getRewrittedUrl('/admin/site/uploadSiteImage/' + setting.item.siteId),
        name: 'siteImage',
        responseType: 'json',
        onComplete : function(file, response){
            $("#siteThumb").attr('src', response.imageSrc);
            $("#removeImageLink").show();
        }
    });
    
    $("a.dialog").each(function(){
        $this = $(this);
        $this.click(function(){
            var link = this;
            $.popup.open(link.href, $(link).attr("title"));
            
            return false;
        });
    });    
});