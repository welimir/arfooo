$(document).ready(function(){

    $("#commentSelect").change(function()
    {
        window.location.replace(AppRouter.getRewrittedUrl("/admin/comment/index/" + this.value));
    }
    );
    
    var commentEditor = new CommentEditor();

});
