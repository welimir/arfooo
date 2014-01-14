$(document).ready(function(){

    $("#editExtraFieldForm").autoFill(setting.extraField);
    
    function updateBatchControlState(){
        var val = $("#editExtraFieldForm select[name=type]").val();
        $("#batchModeControlDiv").toggle($.inArray(val, ["radio", "select", "checkbox", "range"]) != -1);
        $("tr[class^=extraField_row_]").hide();
        $("tr[class^=extraField_row_" + val + "]").show();
    }
    
    $("#editExtraFieldForm select[name=type]").change(updateBatchControlState);
    
    updateBatchControlState();
    
    var template = $.format($("#extraFieldOptionTemplate").val());
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
    
    for (i in setting.extraField.options) {
        var option = setting.extraField.options[i];
        var $newRow = addRow(option.label, option.value);
    }
    
    $("#addNewFieldButton").click(function(){
        var $newRow = addRow();
        
        var $input = $("input:first", $newRow);
        
        $("input:last", $newRow).click(function(){
            $input.val("");
            $newRow.hide();
        });
    });
    
    $("#extraFieldTable").tableDnD({
        onDragClass: "rowDrag"
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
});
