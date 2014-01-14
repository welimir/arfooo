{include file='includes/header.tpl' page="template" title="{'templateIndex_html_title'|lang}" title="{'templateIndex_meta_description'|lang}"}   

<div id="left">

{include file='menu/menuleft/menuleftTemplates.tpl'}  

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/template'|url}">{'menuMenuHeader_templates'|lang}</a> &gt; <a href="{'/admin/template'|url}">{'menuLeftTemplates_manage_templates'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'templateIndex_h1'|lang}</h1>
</div>
<div class="column_in">
{'templateIndex_desc1'|lang}<br />
{'templateIndex_desc2'|lang}
</div>
<div class="column_in_table2">
<form action="{'/admin/template/update'|url}" method="post" id="templateForm">
<table class="table1" cellspacing="1">
<thead>
<tr>
	<th>{'templateIndex_th_template_name'|lang}</th>
	<th>{'Management'|lang}</th>
</tr>
</thead>
<tbody>
{foreach from=$alltemplates value=templateName}
<tr class="line{cycle values='1,2'}">
	<td>{$templateName}</td>
	<td><a href="{"/admin/template/preview/$templateName"|url}">{'templateIndex_preview'|lang}</a> | 
		<input type="radio" class="checkbox" name="templateName" value="{$templateName}" style="border:0px;" {if $templateName == $setting.templateName}checked="checked"{/if}  /> 
        {if $templateName == $setting.templateName}
            <span class="text_green">{'templateIndex_enabled'|lang}</span>
        {else}
            <span class="text_red">{'templateIndex_disabled'|lang}</span>
        {/if}
          </td>
</tr>
{/foreach}
</tbody>
</table>

<div class="column_in_center">
<input type="submit" class="button" value="{'button_save'|lang}" />
</div>

</form>
</div>

{include file='includes/footer.tpl'}   