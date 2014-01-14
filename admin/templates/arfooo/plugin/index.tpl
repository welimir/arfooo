{include file='includes/header.tpl' page="plugin" title="{'pluginIndex_html_title'|lang}" metaDescription="{'pluginIndex_meta_description'|lang}"}   

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
<h1>{'pluginIndex_h1'|lang}</h1>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<col class="col1-1" /><col class="col2-2" />
<thead>
<tr>
	<th>{'pluginIndex_th_name'|lang}</th>
	<th>{'Management'|lang}</th>
</tr>
</thead>
<tbody>
{foreach from=$plugins value=plugin}
<tr class="line{cycle values='1,2'}">
	<td>{$plugin}</td>
	<td><a href="{"/admin/plugin/edit/$plugin"|url}" class="link_green">{'link_edit'|lang}</a></td>
</tr>
{/foreach}
</tbody>
</table>
</div>

{include file='includes/footer.tpl'} 