{capture assign="headData"}
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/config'|url}"></script> 
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.form.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.formTool.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery-validate/jquery.validate.js'|resurl}"></script> 
<script type="text/javascript" src="{'/javascript/payment/selectPaymentOptionsOnLoad.js'|resurl}"></script>
<script type="text/javascript">
setting.allopassNumbers = {$allopassNumbersJSON|htmlspecialchars_decode};
</script>
{/capture}

{include file="includes/header.tpl" title="{'selectPaymentOptions_html_title'|lang}" metaDescription="{'selectPaymentOptions_meta_description'|lang}"}

<div class="show_arbo">
<a href="{$setting.siteRootUrl}" class="link_showarbo">{'show_arbo_directory'|lang}</a> &gt;
<a href="{'/payment/selectPaymentOptions'|url}" class="link_showarbo">{'selectPaymentOptions_arbo'|lang}</a>
</div>

{displayAd place="overSitesList"}

<div class="title_h">
<h1>{'selectPaymentOptions_h1'|lang}</h1>
</div>
<form action="{'/payment/makePayment'|url}" method="post" id="paymentOptionsForm">
<fieldset class="column_in">
    <div class="form">
    <label class="title"><span class="text_color_mandatory">*</span></label>
    <div class="infos">{'webmasterSubmitWebsite_mandatory_fields'|lang}</div>
    </div>
	
	<div class="form">
    <label class="title">{'selectPaymentOptions_package'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos"><select name="packageId" id="packageId">
						<option value="">{'selectPaymentOptions_select_package'|lang}</option>
						{foreach from=$packages value=package}
						<option value="{$package.packageId}">{$package.name} - {$package.details}</option>
						{/foreach}
						</select></div>
    </div>
	
	<div class="form">
    <label class="title">{'selectPaymentOptions_package_description'|lang}</label>
    <div id="packageDescription0" class="infos">{'selectPaymentOptions_description'|lang}</div>
	{foreach from=$packages value=package}
    <div id="packageDescription{$package.packageId}" class="infos" style="display:none">{$package.description|htmlspecialchars_decode}</div>
    {/foreach}
    </div>
	
	<div class="form">
    <label class="title">{'selectPaymentOptions_payment_method'|lang} <span class="text_color_mandatory">*</span></label>
    <div class="infos"><select name="processorId">
						<option label="{'selectPaymentOptions_select_payment_method'|lang}" value="">{'selectPaymentOptions_select_payment_method'|lang}</option>
						{html_options options=$paymentProcessors}
						</select></div>
    </div>
	
	<div class="form">
    <label class="title">&nbsp;</label>
    <div class="infos"><input type="submit" class="button" value="{'selectPaymentOptions_next_step'|lang}" /></div>
    </div>
</fieldset>
</form>
              
{include file="includes/footer.tpl"} 