jQuery.fn.captchaCode = function(){
    return $(this).each(function(){
        var $this = $(this);
        
        $.ajax({
            url: AppRouter.getRewrittedUrl("/captcha/show"),
            type: "POST",
            cache: false,
            success: function(response){
            var $captcha = $(response);
            $this.append($captcha);
            
            var $publicCode = $("input[name=publicCode]", $this);
            var $linkGenerateNewCaptchaImg = $("a.linkGenerateNewCaptchaImg", $this);
            var $captchaImage = $("img.captchaImage", $this);
            
            var form = $publicCode.attr("form");
            
            $linkGenerateNewCaptchaImg.click(function(){
                $.post(AppRouter.getRewrittedUrl("/captcha/change/" + form.publicCode.value), {}, function(response){
                    var newPublicCode = response.newPublicCode;
                    $captchaImage.attr("src", AppRouter.getRewrittedUrl('/captcha/png/' + response.newPublicCode));
                    form.publicCode.value = newPublicCode;
                }, "json");
                
                return false;
            });
        }
        });
    });
};
