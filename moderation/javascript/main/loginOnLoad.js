$(function() {
    $("#loginInput").focus();
    $("#forgotPassword").click(function() {
        window.location.replace(AppRouter.getRewrittedUrl("/admin/main/lostPassword"));
    });
});