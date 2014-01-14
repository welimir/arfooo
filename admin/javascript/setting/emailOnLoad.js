$(document).ready(function(){
    
    $("input[type=button].autocode").click(function(){
        var $this = $(this);
        var $textarea = $this.parent().find("textarea");
        $textarea.val($textarea.val() + $this.val());
    });
});
