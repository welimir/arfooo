$(document).ready(function(){

    PaymentOptionsForm = function(){
        var that = {
            form: $("#paymentOptionsForm")[0],
            allopassNumbers: setting.allopassNumbers,
            lastSelectedPackageId: 0,
            __construct: function(){
            
                $(that.form.packageId).change(that.onPackageChange);
                $(that.form.packageId).keypress(that.onPackageChange);
                
                jQuery.validator.addMethod("allowAllopass", function(value, element){
                    return (value != 'Allopass' || that.allopassNumbers[that.form.packageId.value] != 0);
                }, "You cant use allopass payment processor for this package");
                
                $("#paymentOptionsForm").validate({
                    rules: {
                        packageId: "required",
                        processorId: {
                            required: true,
                            "allowAllopass": true
                        },
                        custom: "required"
                    },
                    messages: {
                        privateCode: _t("Please enter captcha code"),
                        pseudo: _t("Please enter your name"),
                        custom: _t("You can`t select this payment method for selected package.")
                    }
                });
            },
            onPackageChange: function(){
                var currentPackageId = $(this).val();
                if (that.lastSelectedPackageId == currentPackageId) 
                    return;
                
                $("#packageDescription" + that.lastSelectedPackageId).hide();
                $("#packageDescription" + currentPackageId).show();
                that.lastSelectedPackageId = currentPackageId;
            }
        };
        
        that.__construct();
        
    };
    
    var paymentOptionsForm = new PaymentOptionsForm();
    
});
