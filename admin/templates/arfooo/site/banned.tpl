{include file='includes/header.tpl' page="index" title="{'siteBanned_html_title'|lang}" metaDescription="{'siteBanned_meta_description'|lang}"}

<div id="left">

{include file='menu/menuleft/menuleftIndex.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/'|url}">{'menuMenuHeader_directory'|lang}</a> &gt; <a href="{'/admin/site/banned'|url}">{'siteBanned_show_arbo'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'siteBanned_h1'|lang}</h1>
</div>
<div class="column_in">
{'siteBanned_desc1'|lang}<br />
{'siteBanned_desc2'|lang}
</div>

<div class="column_in_table">
<table class="table1" cellspacing="1">
<thead>
<tr>
	<th>{'siteBanned_th_website_name'|lang}</th>
	<th>{'Management'|lang}</th>
</tr>
</thead>
<tbody>
{foreach from=$sites value=site}
<tr class="line1">
	<td><a href="{"/admin/site/edit/$site.siteId"|url}">{$site.siteTitle}</a></td>
	<td><a href="{"/admin/site/edit/$site.siteId"|url}" class="link_green">{'link_edit'|lang}</a></td>
</tr>
{/foreach}
</tbody>
</table>

</div>

{include file="includes/pageNavigation.tpl"}

{include file='includes/footer.tpl'}       