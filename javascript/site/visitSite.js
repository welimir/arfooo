function visitSite(siteId){
    $.ajax({
        type: 'POST',
        data: {
            'siteId': siteId
        },
        url: AppRouter.getRewrittedUrl('/site/visit'),
        async: false
    });
    
    return true;
}
