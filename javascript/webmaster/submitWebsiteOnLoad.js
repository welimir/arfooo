
$(document).ready(function(){
    
    var mode = setting.newUser ? "newUser" : "user";
    var captchaEnabled = setting.newUser ? true : false;
    
    $("#itemForm").itemEditor({
        mode: mode, 
        item: setting.item,
        tempId: setting.tempId,
        metaDataUrl: setting.metaDataUrl,
        captchaEnabled: captchaEnabled 
    });
    
    $("img[class^=aide]").livequery(function(){
        $(this).tooltip({
            showURL: false,
            top: -15
        });
    });
    
    $(".captchaCode").captchaCode();
});