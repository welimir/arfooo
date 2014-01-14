$(function(){
    
    tinyMCE.execCommand('mceAddControl', false, 'emailText');
    $.backgroundTask('newsletter');
});
