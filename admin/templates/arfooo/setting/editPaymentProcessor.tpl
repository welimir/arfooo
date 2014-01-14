{include file='includes/header.tpl' page="setting" title="{'settingEditPaymentProcessor_html_title'|lang}" title="{'settingEditPaymentProcessor_meta_description'|lang}"} 

<div id="left">

{include file='menu/menuleft/menuleftSettings.tpl'}

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/setting'|url}">{'menuMenuHeader_settings'|lang}</a> &gt; <a href="{'/admin/setting/paymentProcessor'|url}">{'menuLeftSettings_pay_proc'|lang}</a> &gt; {$paymentProcessor.processorId}
</div>

<div class="title_h_1">
<h1>{'settingEditPaymentProcessor_h1'|lang}</h1>
</div>
<div class="column_in_table2">
<form action="{"/admin/setting/savePaymentProcessor/$paymentProcessor.processorId"|url}" method="post">
<table class="table2" cellspacing="1">
<col class="col3" /><col class="col4" />
<tbody>
<tr>
	<td>{'settingEditPaymentProcessor_payment_method_name'|lang}: </td>
	<td>{$paymentProcessor.processorId}</td>
</tr>
<tr>
	<td>{'settingEditPaymentProcessor_display_name'|lang}:</td>
	<td><input type="text" class="input_text_medium" name="displayName" value="{$paymentProcessor.displayName}" /></td>
</tr>
<tr>
	<td>{'settingEditPaymentProcessor_enabled'|lang}:</td>
	<td><input type="radio" name="active" value="1" {if $paymentProcessor.active}checked="checked"{/if} /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="active" value="0" {if !$paymentProcessor.active}checked="checked"{/if} /> {'Off'|lang}</td>
</tr>
{if $paymentProcessor.processorId == "PayPal"}
<tr>
    <td>{'settingEditPaymentProcessor_currency'|lang}:</td>
    <td><input type="text" class="input_text_medium" name="currency" value="{$paymentProcessor.currency}" /></td>
</tr>
<tr>
    <td>{'settingEditPaymentProcessor_email'|lang}:</td>
    <td><input type="text" class="input_text_medium" name="email" value="{$paymentProcessor.email}" /></td>
</tr>
<tr>
    <td>{'settingEditPaymentProcessor_test'|lang}:</td>
    <td><input type="radio" name="testMode" value="1" {if $paymentProcessor.testMode}checked="checked"{/if} /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="testMode" value="0" {if !$paymentProcessor.testMode}checked="checked"{/if} /> {'Off'|lang}</td>
</tr>
{/if}
<tr>
	<td></td>
	<td><input type="submit" class="button" value="{'button_save'|lang}" /></td>
</tr>
</tbody>
</table>
</form>
</div>

{include file='includes/footer.tpl'}