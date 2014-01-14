$(document).data("popupStart", function(popupWindow)
{
  $("#problemPopupForm", popupWindow).validate({
   rules: {
     type: "required",
     privateCode: "required"
   },
   messages: {
     privateCode: _t("Please enter captcha code")
   },
   errorPlacement: function()
   {
   
   },
  submitHandler: function(form)
  {
      $(form).ajaxSubmit({dataType:  'json',
      success : function(response)
      {
          if(response.status == "error")
          {
              $.alertDialog(response.message);
              $("a.linkGenerateNewCaptchaImg", $(form)).click();
          }
          
          if(response.status == "ok")
          {
            $.alertDialog(_t("Your message was saved"), function()
            {
                popupWindow.dialog("close");
            });
          }
          
      }});
      return false;
  }
  });
  
  $("input.close", popupWindow).click(function()
  {
      popupWindow.dialog("close");
  });
  
});