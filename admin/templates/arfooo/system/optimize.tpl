{include file='includes/header.tpl' page="system" title="{'systemOptimize_html_title'|lang}" metaDescription="{'systemOptimize_meta_description'|lang}"}  

<div id="left">

{include file='menu/menuleft/menuleftSystem.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/system'|url}">{'menuMenuHeader_system'|lang}</a> &gt; <a href="{'/admin/system/optimize'|url}">{'menuLeftSystem_optimize'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'systemOptimize_h1'|lang}</h1>
</div>
<div class="column_in">
{'systemOptimize_desc1'|lang}<br />
{'systemOptimize_desc2'|lang}<br /><br />
<form action="{'/admin/system/optimize'|url}" method="post"> 
<input class="button" type="submit" name="Start" value="{'button_start'|lang}" />
</form>
</div>

{include file='includes/footer.tpl'}     