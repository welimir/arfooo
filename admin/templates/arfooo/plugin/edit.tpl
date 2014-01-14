{include file='includes/header.tpl' page="plugin" title="{'pluginEdit_html_title'|lang}" metaDescription="{'pluginEdit_meta_description'|lang}"}   

<div id="left">

{include file='menu/menuleft/menuleftPlugins.tpl'}  

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/plugin'|url}">{'menuMenuHeader_plugins'|lang}</a> &gt; <a href="{'/admin/plugin'|url}">{'menuLeftPlugins_manage_plugins'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'pluginEdit_h1'|lang}</h1>
</div>
<div class="column_in">
{$pluginDescription|nl2br}
</div>

<div class="title_h_2">
<h2>{'pluginEdit_h2'|lang}</h2>
</div>
<div class="column_in">
{foreach from=$pluginFunctions item=function}
<p>
<b><a href="{$function.action|url}">{$function.action}</a></b><br/>
{$function.description}
</p>
{/foreach}
</div>

{include file='includes/footer.tpl'}