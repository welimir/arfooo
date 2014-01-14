$(function() {
    var waitingForm = $("#waitingItemsForm");
    
    $("#selectAllButton").click(function(){
        $("input[name^=siteIds]").attr("checked", true);
    });
        
    $("input[type=button].autocode").click(function(){
        var $this = $(this);
        var $textarea = $this.parent().find("textarea");
        $textarea.val($textarea.val() + $this.val());
    });
    
    if(!setting.skipAutoRefresh)
    {
        $.waitingSitesUpdater();
    }
    
    $("input[name^=emailType]").click(function(){
        var siteId = $(this).attr("name").match(/\[(\d+)/i)[1];
        $("#messageTable\\[" + siteId + "\\]").toggle();
    });
});

function fillCustomMessage(siteId)
{
    var form = $("#waitingSitesForm")[0];
    var messageId = form["messageId[" + siteId +"]"].value;
    
    if(messageId)
    {
        var email = emailMessages[messageId];
        
        form["subject[" + siteId +"]"].value = email.title;
        form["description[" + siteId +"]"].value = email.description;
    }
}