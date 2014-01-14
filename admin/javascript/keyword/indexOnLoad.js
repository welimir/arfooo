$(document).ready(function(){

    $("#editAdsForm").adEditor(setting.adPage);
    
    $("#newKeywordForm").validate({
        rules: {
            keyword: {
                remote: {
                    url: AppRouter.getRewrittedUrl("/admin/keyword/checkIsBusy"),
                    type: "POST"
                }
            }
        },
        messages: {
            keyword: {
                required: _t("Please enter keyword"),
                remote: _t("already present")
            }
        }
    });
    
});