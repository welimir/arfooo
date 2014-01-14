
jQuery.fn.autoFill = function(data)
{
	return this.each(function()
	{
        var elements = this.elements;
        
        for(var nr = 0; nr < elements.length; nr++)
        {
            var e = elements[nr];

            switch(e.type)
            {
                case "radio":
                case "checkbox":
                    
                    if(data[e.name] != undefined)
                    {
                        if($.isArray(data[e.name]))
                            e.checked = ($.inArray(e.value, data[e.name]) != -1) ? true : false;
                        else
                            e.checked = (data[e.name] == e.value) ? true : false;  
                    }
                    
                    break;


                case "select-multiple":
                    $.each($('option', e),function(){
                        this.selected = ($.inArray(this.value, data[e.name]) != -1) ? true : false;
                    });

                    break;

                default:
                    if(data[e.name] != undefined)e.value = data[e.name];

            }

        }
    
	});
};