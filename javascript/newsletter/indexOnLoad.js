$(document).ready(function(){ 
                        
    var options = { 
        beforeSubmit:  function()
        {
        
        },
        success: function(response)
        {
            switch(response.status)
            {
                case "error":
                    $.alertDialog(response.message);
                    break;
                
                case "ok":
                    $.alertDialog(response.message, function()
                    {
                        location.href = response.redirectUrl;
                    });
            }
        },
        dataType: "json"
    };
    
    $("#newsletterForm").ajaxForm(options);
});