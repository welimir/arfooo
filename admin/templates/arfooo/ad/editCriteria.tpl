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

{include file='includes/header.tpl' page="ad" title="{'adEditCriteria_html_title'|lang}" metaDescription="{'adEditCriteria_meta_description'|lang}"} 

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
<h1>{'adEditCriteria_h1'|lang}</h1>
</div>
<div class="column_in_table2">
<form action="{"/admin/ad/saveAdCriteriaEdit/$adCriteria.adCriterionId"|url}" method="post">
<table class="table2" cellspacing="1">
<tbody>
<tr>
	<td>{'adEditCriteria_criteria_name'|lang}: </td>
	<td><input type="text" class="input_text_medium" name="name" value="{$adCriteria.name}" /></td>
</tr>
<tr>
	<td>{'adEditCriteria_form_title1'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'adEditCriteria_form_desc1'|lang}" /></td>
	<td><textarea class="textarea_large" name="htmlContent" cols="50" rows="5">{$adCriteria.htmlContent}</textarea></td>
</tr>
<tr>
	<td></td>                                                                                                                                                                                                                              
	<td><input type="submit" class="button" value="{'button_save'|lang}" /> <input type="button" class="button" value="{'button_delete'|lang}" id="deleteButton" onclick="return $.confirmLinkClick('{'Do you really want to delete it?'|lang}', '{"/admin/ad/deleteCriteria/$adCriteria.adCriterionId"|url}');" /></td>
</tr>
</tbody>
</table>
</form>
</div>

{include file='includes/footer.tpl'}  