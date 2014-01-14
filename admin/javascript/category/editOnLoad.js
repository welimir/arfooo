$(document).ready(function(){
	
    $("#editCategoryForm").autoFill(setting.category);
    
    $("#editCategoryForm input[name=parentCategoryId]").chainSelect({
        url: AppRouter.getRewrittedUrl("/category/getChildsOptionList"),
        selectedId: setting.category.parentCategoryId,
        defaultOption: {
            value: "0",
            label: " - "
        }
    });
    
    tinyMCE.execCommand('mceAddControl', false, 'categoryDescription');
    
    $.post(AppRouter.getRewrittedUrl("/extraField/getByCategoryId"), {
        categoryId: setting.category.categoryId,
        mode: "searchEdit"
    }, function(response){
        $("#searchEngineExtraFields").append(response).find(".searchModule").draggable({
            containment: 'parent'
        }).resizable({
            containment: 'parent'
        }).css("backgroundColor", "#fff").css("cursor", "move").css("border", "1px solid #ccc").each(function(){
            var $this = $(this);
            
            var name = "inSearchEngine\[" + $this.attr("fieldId") + "\]";
            var checkbox = $("#extraFieldsTable input[name=" + name + "]");
            
            if ($this.is(":visible")) {
                checkbox.attr("checked", true);
            }
            
            checkbox.change(function(){
                $this.toggle();
            });
        });
    });
    
    $("#searchEngineExtraFieldsForm").submit(function(){
        var fields = {};
        
        $("#searchEngineExtraFields .searchModule").each(function(){
            var $this = $(this);
            var isVisible = $this.is(":visible");
            
            if (!isVisible) 
                $this.show();
            
            fieldId = $this.attr("fieldId");
            var position = $this.position();
            fields[fieldId] = {
                left: position.left,
                top: position.top,
                width: $this.width(),
                height: $this.height(),
                display: isVisible ? 1 : 0
            };
            
            if (!isVisible) 
                $this.hide();
        });
        
        var data = js2php({
            categoryId: setting.category.categoryId,
            fields: fields
        });
        
        $.post(AppRouter.getRewrittedUrl("/admin/category/saveSearchEngineExtraFieldSettings"), data, function(response){
            $.alertDialog(_t("Changes were saved"));
        }, "json");
        
        return false;
    });
    
    var intervalId = null;
    
    $("#extraFieldsTable").tableDnD({
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
            
            $.post(AppRouter.getRewrittedUrl("/admin/extraField/savePositions"), data, function(){
            
            });
        }
    });
    
    var template = $.format('<tr class="extraField"> \
<td>Option</td> \
<td><input type="text" name="option[{1}]"> <input type="button" class="button" value="' + _t("Delete") + '"/></td> \
</tr>');
    var lp = 1;
    
    function addRow(label, value){
        value = value || "";
        var $newRow = $(template(lp++, value));
        $("#extraFieldTable").append($newRow);
        
        if (label) {
            var $input = $("input:first", $newRow);
            $input.val(label);
            
            $("input:last", $newRow).click(function(){
                $input.val("");
                $newRow.hide();
            });
        }
        
        return $newRow;
    }
    
    $("#addNewFieldButton").click(function(){
        var $newRow = addRow();
        
        var $input = $("input:first", $newRow);
        
        $("input:last", $newRow).click(function(){
            $input.val("");
            $newRow.hide();
        });
    });
    
    $("#batchModeLink").click(function(){
        $("#batchModeDiv").toggle();
        return false;
    });
    
    $("#addBatchButton").click(function(){
        var values = ($("#batchTextarea").val().split(/\r?\n/));
        
        for (var i = 0; i < values.length; i++) {
            addRow(values[i]);
        }
        
        $("#batchTextarea").val("");
        
    });
    
    $("#newExtraFieldForm select[name=type]").change(function(){
        $("#batchModeControlDiv").toggle($.inArray($(this).val(), ["radio", "select", "checkbox"]) != -1);
        $("tr[class^=extraField_row_]").hide();
        $("tr[class^=extraField_row_" + $(this).val() + "]").show();
    });
});
