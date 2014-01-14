$(document).ready(function(){

    $("#editAdsForm").adEditor(setting.adPage);
    
    if (setting.adPage2) {
        $("#editAdsForm2").adEditor(setting.adPage2);
    }
    
});


