{capture assign="headData"}
    <script type="text/javascript" src="{'/javascript/config'|url}"></script>
    <script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
    <script type="text/javascript" src="{'/javascript/jquery/jquery.form.js'|resurl}"></script>
    <script type="text/javascript" src="{'/javascript/jquery/jquery.backgroundTask.js'|resurl}"></script>
    <script type="text/javascript" src="{'/admin/javascript/system/thumbOnLoad.js'|resurl}"></script>
{/capture}

{include file='includes/header.tpl' page="system" title="{'systemThumb_html_title'|lang}" metaDescription="{'systemThumb_meta_description'|lang}"}  

<div id="left">

{include file='menu/menuleft/menuleftSystem.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/system'|url}">{'menuMenuHeader_system'|lang}</a> &gt; <a href="{'/admin/system/thumb'|url}">{'menuLeftSystem_update_thumbs'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'systemThumb_h1'|lang}</h1>
</div>
<div class="column_in">

<div style="display:none" id="progressInformation">
{'siteErrorCode_status'|lang}: <b><span id="taskStatus"> </span></b> &nbsp;
{'siteErrorCode_progress'|lang}: <b><span id="taskPercentage">0%</span></b> &nbsp;
{'siteErrorCode_checked_sites'|lang}: <b><span id="taskParsedItems">0</span></b> 
<br/>
<div style="width:100%;border: 1px solid #000; background: #fff; height: 10px;display:none" id="progressBarOutline">
   <div style="width:0%; background: #7AB; height: 100%" id="progressBar"></div>
</div>
<br/>
</div> 
    
{'systemThumb_desc1'|lang}<br /><br />

<form id="backgroundTaskControlForm">  
    <input type="button" class="button" name="start" value="{'button_start'|lang}" />
    <input type="button" class="button" name="pause" value="{'button_pause'|lang}" style="display:none" />
    <input type="button" class="button" name="resume" value="{'button_resume'|lang}" style="display:none" />
    <input type="button" class="button" name="stop" value="{'button_stop'|lang}" style="display:none" />
</form>
</div>

{include file='includes/footer.tpl'} 