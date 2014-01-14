
$(document).ready(function(){
    $("#registerForm").validate({
        rules: {
            privateCode: "required",
            password: "required",
            email: {
                required: true,
                email: true,
                remote: {
                    url: AppRouter.getRewrittedUrl("/webmaster/isEmailAcceptable"),
                    type: "POST",
                    global: false
                }
            },
            passwordConfirmation: {
                required: true,
                equalTo: "#registerForm input[name=password]"
            }
        },
        messages: {
            privateCode: _t("Please enter captcha code"),
            password: _t("Please enter password"),
            email: {
                required: _t("Please enter your email"),
                email: _t("Your email must be in format - name@domain.com"),
                remote: _t("Email was used earlier")
            },
            passwordConfirmation: {
                required: _t("Please confirm your password"),
                equalTo: _t("Passwords aren't equal")
            }
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
                        $.alertDialog(response.message, function(){
                            $("#registerLayer").slideUp("slow");
                            $("#loginForm input[name=email]").focus();
                        });
                    }
                    
                }
            });
            return false;
        }
    });
    
    $("#loginForm").validate({
        rules: {
            email: "required",
            password: "required"
        },
        messages: {
            email: _t("Please enter your email"),
            password: _t("Please enter password")
        }
    });
    
    $(".captchaCode").livequery(function()
    {
        $(this).captchaCode();
    });
    
    $("#lostPasswordLink").click(function()
    {
        $.popup.open(this.href, this.title);
        return false;
    });
    
});
