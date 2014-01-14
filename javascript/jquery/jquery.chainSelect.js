(function($)
{

$.fn.chainSelect = function (params)
{
    params.separator = params.separator || " ";
    
    $(this).each(function()
    {
        var $this = $(this);
        var id = $this.attr("name");
    
        var categories = {};
        var selectedCategoriesIds = [0];
        
        var url = params.url;
        var levelMove = 0;
        var totalLength = 0;
        var selectsCount = 0;
        var maxSelectsCount = 0;
        var $selectTemplate;
        init();
        
        function addNewSelect()
        {
            selectsCount++;
            
            if(selectsCount > 1)
            {
                var $lastSelect = $("select[name=" + id + (selectsCount - 1).toString() + "]");
                var $newSelect = $selectTemplate.clone();
                $newSelect.attr("id", id + selectsCount.toString());
                $newSelect.attr("name", id + selectsCount.toString());
                $newSelect.css("display", "none");
                $lastSelect.after(" " + params.separator + " ", $newSelect);
            }
            
            $("select[name=" + id + selectsCount.toString() + "]").each(function()
            {
                var $select = $(this);
                $select[0]._depth = selectsCount;
                
                $select.change(function()
                {
                    var $this = $(this);
                    loadChilds($this.val(), $this[0]._depth  + levelMove);
                    if(params.change)params.change($this.val());   
                }
                );
            });        
        }

        function init()
        {
            $selectTemplate = $("select[name=" + id + "1]").clone();
            addNewSelect();
                                
            if(params.selectedId)
            {
                $.post(url,
                {
                    id: params.selectedId,
                    all: true
                },
                function(response)
                {
                    selectedCategoriesIds.length = 0;
                    var level = null;
                    
                    for(var i = 0; i < response.levels.length; i++)
                    {
                        level = response.levels[i]; 
                        selectedCategoriesIds.push(level.selectedId);
                        
                        if(level.childs && level.childs.length)
                        {
                            categories[level.selectedId] = {};
                            categories[level.selectedId].childs = level.childs;
                            totalLength++;
                        }
                    }
                    
                    if(params.change)params.change(level.selectedId);
                    
                    fillOptions();
                },
                "json");
            }
            else
            {
                loadChilds(0, 0);
            }  
        }
    
        function fillOptions()
        {         
            while(totalLength > selectsCount && (maxSelectsCount == 0 || maxSelectsCount > selectsCount))
            {
                addNewSelect();
            }
            
            levelMove = Math.max(totalLength - selectsCount, 0);
            
            for(var i = 1; i <= selectsCount; i++) 
            {        
                var r = i + levelMove;
                var selector = "select[name=" + id + i.toString() + "]";
                var $select = $(selector);
                var selectedCategoryId = selectedCategoriesIds[r-1];  
                var lastCategoryId = $select.attr("_lastCategoryId");
                var change = false;
                
                if(lastCategoryId != selectedCategoryId)
                {
                    $select.children().remove();
                    $select.attr("_lastCategoryId", selectedCategoryId);
                    change = true;
                }
                
                //category have childs
                if(categories[selectedCategoryId])
                {
                    if(change || !$select.is(":visible"))
                    {
                        var childs = categories[selectedCategoryId].childs;
                        if(params.defaultOption && !$select.attr("size"))$select.append('<option value="' + params.defaultOption.value + '">' + params.defaultOption.label + '</option>');
                         
                        for(j in childs)
                        {
                            var child = childs[j]; 
                            var option = document.createElement("option");
                            option.value = child.id;
                            option.text = child.name;
                            
                            $select[0].options[j] = option;
                            
                            if(selectedCategoriesIds[r] && child.id == selectedCategoriesIds[r])
                            {
                                option.selected = true;
                            }
                        }
                    } 
                    
                    if(!$select.is(":visible"))$select[params.fade ? 'fadeIn' : 'show']();
                }
                else
                {
                    if($select.is(":visible"))$select[params.fade ? 'fadeOut' : 'hide'](); 
                }
            }
        }
    
        function loadChilds(selectedId, depth)
        {
            if(selectedId)
            {
                $this.val(selectedId); 
                $this.keyup(); 
            }
            
            $.post(url,
            {
                id: selectedId
            },
            function(response)
            {
                totalLength = depth;
                selectedCategoriesIds.length = depth;
                selectedCategoriesIds.push(selectedId);
                
                if(response.childs && response.childs.length)
                {
                    categories[selectedId] = {};
                    categories[selectedId].childs = response.childs;
                    totalLength++;
                }

                fillOptions();   
            },
            "json");   
        }
    
    });
}

})(jQuery);  
