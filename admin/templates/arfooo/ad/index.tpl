{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/config'|url}"></script> 
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.adminFormTool.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/tooltip/jquery.tooltip.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/tooltip/jquery.tooltip.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.addTooltip.js'|resurl}"></script>
{/capture}

{include file='includes/header.tpl' page="ad" title="{'adIndex_html_title'|lang}" metaDescription="{'adIndex_html_title'|lang}"} 

<div id="left">

{include file='menu/menuleft/menuleftAdsense.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/ad'|url}">{'menuMenuHeader_ad'|lang}</a> &gt; <a href="{'/admin/ad'|url}" title="{'Manage criteria'|lang}">{'menuLeftAd_manage_criteria'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'adIndex_h1'|lang}</h1>
</div>
<div class="column_in">
{'adIndex_desc1'|lang} 
{'adIndex_desc2'|lang}<br /><br />
{'adIndex_desc3'|lang}
</div>

<div class="title_h_2">
<h2>{'adIndex_h2'|lang}</h2>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<thead>
<tr>
	<th>{'adIndex_criteria_name'|lang}</th>
	<th>{'Management'|lang}</th>
</tr>
</thead>
<tbody>
{foreach from=$adCriterias value=criteria}
<tr class="line{cycle values='1,2'}">
	<td><a href="" title="{$criteria.name}">{$criteria.name}</a></td>
	<td><a href="{"/admin/ad/editCriteria/$criteria.adCriterionId"|url}" title="{'link_edit'|lang}" class="link_green">{'link_edit'|lang}</a> | 
		<a onclick="return $.confirmLinkClick('{'Do you really want to delete it?'|lang}', this.href);return false;" href="{"/admin/ad/deleteCriteria/$criteria.adCriterionId"|url}" title="{'link_edit'|lang}" class="link_red">{'link_delete'|lang}</a></td>
</tr>
{/foreach}
</tbody>
</table>
</div>

<div class="title_h_2">
<h2>{'adIndex_h2_create'|lang}</h2>
</div>
<div class="column_in_table2">
<form action="{'/admin/ad/saveNewCriteria'|url}" method="post">
<table class="table2" cellspacing="1">
<tbody>
<tr>
	<td>{'adIndex_criteria_name'|lang}: </td>
	<td><input type="text" class="input_text_large" name="name" value="" /></td>
</tr>
<tr>
	<td>{'adIndex_form_title1'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'adIndex_form_desc1'|lang}" /></td>
	<td><textarea class="textarea_extra_large" name="htmlContent" cols="50" rows="5"></textarea></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" class="button" value="{'button_create'|lang}" /></td>
</tr>
</tbody>
</table>
</form>
</div>

{include file='includes/footer.tpl'}  