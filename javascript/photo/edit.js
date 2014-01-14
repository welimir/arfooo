$(document).data("popupStart", function(popupWindow)
{
  $("#photoPopupForm", popupWindow).validate({
   rules: {

   },
   messages: {

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
          }
          
          if(response.status == "ok")
          {
            $.alertDialog(response.message, function()
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