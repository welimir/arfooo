{if $paymentOptions.processorId == "PayPal"}
<html>
<head><title>{'processPayment_html_title'|lang}</title></head>
<h1>{'processPayment_h1'|lang}</h1>
<body onload="document.getElementById('payPalForm').submit();">
   <form action="{$paymentOptions.formActionUrl}" method="post" id="payPalForm">
   <input type="hidden" name="cmd" value="_xclick">
   <input type="hidden" name="business" value="{$paymentOptions.email}">
   <input type="hidden" name="item_name" value="{$paymentOptions.itemName}">
   <input type="hidden" name="item_number" value="{$paymentOptions.itemNumber}">
   <input type="hidden" name="amount" value="{$paymentOptions.amount}">
   <input type="hidden" name="no_shipping" value="2">
   <input type="hidden" name="no_note" value="1">
   <input type="hidden" name="currency_code" value="{$paymentOptions.currency}">
   <input type="hidden" name="notify_url" value="{$paymentOptions.notifyUrl}">
   <input type="hidden" name="return" value="{$paymentOptions.returnUrl}">
   <input type="hidden" name="cancel_return" value="{$paymentOptions.cancelReturnUrl}">
   <input type="hidden" name="bn" value="IC_Sample">
</form>
</body>
</html>
{/if}