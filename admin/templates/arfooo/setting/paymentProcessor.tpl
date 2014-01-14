{include file='includes/header.tpl' page="setting" title="{'settingPaymentProcessor_html_title'|lang}" metaDescription="{'settingPaymentProcessor_meta_description'|lang}"} 

<div id="left">

{include file='menu/menuleft/menuleftSettings.tpl'}

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/setting'|url}">{'menuMenuHeader_settings'|lang}</a> &gt; <a href="{'/admin/setting/paymentProcessor'|url}">{'menuLeftSettings_pay_proc'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'settingPaymentProcessor_h1'|lang}</h1>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<thead>
<tr>
	<th>{'settingPaymentProcessor_th_payment_method_name'|lang}</th>
	<th>{'settingPaymentProcessor_th_enabled'|lang}</th>
	<th>{'Management'|lang}</th>
</tr>
</thead>
<tbody>
{foreach from=$paymentProcessors value=paymentProcessor} 
<tr class="line{cycle values='1,2'}">
	<td>{$paymentProcessor.processorId}</td>
	<td>{if $paymentProcessor.active}<span class="text_green">{'Yes'|lang}</span>{else}<span class="text_red">{'No'|lang}</span>{/if}</td>
	<td><a href="{"/admin/setting/editPaymentProcessor/$paymentProcessor.processorId"|url}" class="link_green">{'link_edit'|lang}</a></td>
</tr>
{/foreach}
</tbody>
</table>
</div>

{include file='includes/footer.tpl'} 