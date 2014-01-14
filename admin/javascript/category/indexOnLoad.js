$(document).ready(function(){

    $("#categoriesSelect").change(function(){
        window.location.href = AppRouter.getRewrittedUrl('/admin/category/index/' + $(this).val());
    });
    
    $("#categoriesTable").tableDnD({
        onDragClass: "rowDrag",
        onChange: function(table){
            $("tbody tr", table).each(function(index){
                $(this).addClass("line" + ((index % 2) ? "2" : "1"));
                $(this).removeClass("line" + ((index % 2) ? "1" : "2"));
            });
        },
        onDrop: function(table, row){
        
            var data = js2php({
                positions: $.tableDnD.getRowsPositions()
            });
            
            $.post(AppRouter.getRewrittedUrl("/admin/category/savePositions"), data, function(){
            
            });
        }
    });
    
    if (setting.categoryId) {
    
        $("#itemForm").itemEditor({
            mode: "admin",
            categoryId: setting.categoryId,
            tempId: setting.tempId,
            categoryChainSelect: false
        });
        
        $("#editAdsForm").adEditor(setting.adPage);
        $("#editAdsForm2").adEditor(setting.adPage2);
    }
});
