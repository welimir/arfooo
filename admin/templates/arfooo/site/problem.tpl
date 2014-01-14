{include file='includes/header.tpl' page="index" title="{'siteProblem_html_title'|lang}" metaDescription="{'siteProblem_meta_description'|lang}"} 

<div id="left">

{include file='menu/menuleft/menuleftIndex.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div class="title_h_1">
<h1>{'siteProblem_h1'|lang}</h1>
</div>
<div class="column_in">
{'siteProblem_desc1'|lang}
</div>

<div class="column_in_table">
<table class="table1" cellspacing="1">
<thead>
<tr>
	<th>{'siteProblem_th_website_name'|lang}</th>
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

{include file='includes/footer.tpl'}       