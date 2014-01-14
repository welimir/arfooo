
jQuery(document).ready(function(){
	
    $("#contactForm").validate({
        rules: {
            yourEmail: "required",
            title: "required",
            description: "required",
            privateCode: "required"
        },
        messages: {
            yourEmail: {
                required: _t("Please enter your email"),
                email: _t("Your email must be in format - name@domain.com")
            },
            privateCode: _t("Please enter captcha code")
        },
        submitHandler: function(form){
            $(form).ajaxSubmit({
                dataType: 'json',
                success: function(response){
                    if (response.status == "error") {
                        $.alertDialog(response.message);
                        $("a.linkGenerateNewCaptchaImg", $(form)).click();
                    }
                    
                    if (response.status == "ok") {
                        $.alertDialog(_t("Your message was sent"));
                        $("#contactForm")[0].reset();
                    }
                    
                }
            });
            return false;
        }
    });
    
    $(".captchaCode").captchaCode();
});

