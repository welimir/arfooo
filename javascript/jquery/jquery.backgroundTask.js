(function($){

    $.backgroundTask = function(taskId){
    
        var that = {
            taskId: taskId,
            form: $("#backgroundTaskControlForm")[0],
            buttonsUpdated: false,
            executed: false,
            
            init: function(){
            
                var buttons = new Array("start", "stop", "pause", "resume");
                
                for (i in buttons) {
                    var buttonName = buttons[i];
                    
                    if (that.form[buttonName]) {
                        $(that.form[buttonName]).click(that[buttonName + "OnClick"]);
                    }
                }
                
                that.onStartSuccess();
            },
            
            sendControlAction: function(action){
                $.post(AppRouter.getRewrittedUrl('/admin/task/' + action), {
                    taskId: that.taskId
                });
            },
            
            startOnClick: function(){
                that.executed = true;
                $(that.form.start).hide();
                $(that.form.pause).show();
                $(that.form.stop).show();
                
                if (typeof(tinyMCE) != 'undefined') {
                    tinyMCE.triggerSave(true,true);
                }

                // form has own action
                if ($(that.form).attr('action')) {
                    $(that.form).ajaxSubmit(that.onStartSuccess);
                } else {
                    var query = $(that.form).formSerialize();
                    query += "&taskId=" + that.taskId;

                    $.post(AppRouter.getRewrittedUrl('/admin/task/init'), query, that.onStartSuccess);
                }
            },
            
            stopOnClick: function(){
                $(that.form.start).show();
                $(that.form.pause).hide();
                $(that.form.resume).hide();
                that.sendControlAction("stop");
            },
            
            pauseOnClick: function(){
                $(that.form.pause).hide();
                $(that.form.resume).show();
                that.sendControlAction("pause");
            },
            
            resumeOnClick: function(){
                $(that.form.resume).hide();
                $(that.form.pause).show();
                that.sendControlAction("resume");
            },
            
            onStartSuccess: function(){
                $("#progressBar").css("width", "0%");
                that.updateStatus();
            },
            
            updateStatus: function(){
                $.post(AppRouter.getRewrittedUrl('/admin/task/getStatus'), {
                    taskId: that.taskId
                }, that.onUpdateStatusSuccess, "json");
            },
            
            updateButtonsState: function(status){
                that.buttonsUpdated = true;
                
                if (status == "active") {
                    $(that.form.start).hide();
                    $(that.form.pause).show();
                    $(that.form.stop).show();
                }
                
                if (status == "pause") {
                    $(that.form.start).hide();
                    $(that.form.pause).hide();
                    $(that.form.resume).show();
                    $(that.form.stop).show();
                }
            },
            
            onUpdateStatusSuccess: function(response){
                var task = response;
                
                if (task.status == "active" || task.status == "finish" || task.status == "pause") {
                    if (!that.buttonsUpdated) {
                        that.updateButtonsState(task.status);
                    }
                    
                    $("#progressBarOutline").show();
                    
                    $("#taskParsedItems").html(task.parsedItems);
                    $("#taskStatus").html(task.status);
                    
                    if (task.totalItems > 0) 
                        var percentage = (Math.floor(task.parsedItems * 100 / task.totalItems)).toString() + "%";
                    else 
                        var percentage = "100%";
                    
                    $("#progressBar").css("width", percentage);
                    $("#taskPercentage").html(percentage);
                    $("#progressInformation").show();
                }
                
                if (!task.status || task.status == "finish") {
                    $(that.form.resume).hide();
                    $(that.form.pause).hide();
                    $(that.form.stop).hide();
                    $(that.form.start).show();
                    $('#progressBarOutline').hide();
                    
                    if (that.executed) {
                        window.location.reload(false);
                    }
                }
                else {
                    window.setTimeout(that.updateStatus, 1000);
                }
                
            }
        }
        
        that.init();
    }
    
})(jQuery);
