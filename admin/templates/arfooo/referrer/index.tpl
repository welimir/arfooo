{include file='includes/header.tpl' page="index" title="{'referrerIndex_html_title'|lang}" metaDescription="{'referrerIndex_meta_description'|lang}"} 

<div id="left">

{include file='menu/menuleft/menuleftIndex.tpl'}
 
</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/'|url}">{'menuMenuHeader_directory'|lang}</a> &gt; <a href="{'/admin/referrer'|url}">{'menuLeftIndex_manage_referrers'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'referrerIndex_h1'|lang}</h1>
</div>
<div class="column_in">
{'referrerIndex_desc1'|lang}
</div>

<div class="column_in_table">
<table class="table1" cellspacing="1">
<thead>
<tr>
	<th>{'referrerIndex_th_name'|lang}</th>
	<th>{'referrerIndex_th_visitors'|lang}</th>
	<th>{'Management'|lang}</th>
</tr>
</thead>
<tbody>
{foreach from=$sites value=site}
<tr class="line{cycle values='1,2'}">
	<td><a href="{"/admin/site/edit/$site.siteId"|url}">{$site.siteTitle}</a></td>
	<td>{$site.referrerTimes}</td>
	<td><a href="{"/admin/site/edit/$site.siteId"|url}" class="link_green">{'link_edit'|lang}</a> | <a href="{"/admin/referrer/reset/$site.siteId"|url}" class="link_red">{'referrerIndex_reset'|lang}</a></td>
</tr>
{/foreach}
</tbody>
</table>

{include file="includes/pageNavigation.tpl"} 

</div>

{include file='includes/footer.tpl'}