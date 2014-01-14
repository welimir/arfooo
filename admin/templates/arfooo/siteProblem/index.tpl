{include file='includes/header.tpl' page="index" title="{'siteProblem_html_title'|lang}" metaDescription="{'siteProblem_meta_description'|lang}"} 

<div id="left">

{include file='menu/menuleft/menuleftIndex.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/'|url}">{'menuMenuHeader_directory'|lang}</a> &gt; <a href="{'/admin/siteProblem'|url}">{'menuLeftIndex_problem'|lang}</a>
</div>

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
	<th>{'siteProblem_th_problem_type'|lang}</th>
	<th>{'siteProblem_th_problem_detail'|lang}</th>
	<th>{'Management'|lang}</th>
</tr>
</thead>
<tbody>
{foreach from=$siteProblems value=siteProblem}
<tr class="line1">
	<td><a href="{"/admin/site/edit/$siteProblem.siteId"|url}">{$siteProblem.siteTitle}</a></td>
	<td>
    {switch from=$siteProblem.type}
    {case value="badCategory"}
    {'siteProblem_bad_category'|lang}
    {case value="spam"}
    {'siteProblem_spam'|lang}
    {case}
    {'siteProblem_other'|lang} 
    {/switch}
    </td>
	<td><textarea class="textarea_large" name="text" cols="50" rows="5">{$siteProblem.description}</textarea></td>
	<td><a href="{"/admin/site/edit/$siteProblem.siteId"|url}" class="link_green">{'link_edit'|lang}</a> | <a href="{"/admin/siteProblem/delete/$siteProblem.problemId"|url}" class="link_red">{'link_delete'|lang}</a></td>
</tr>
{/foreach}
</tbody>
</table>
</div>


{include file='includes/footer.tpl'}