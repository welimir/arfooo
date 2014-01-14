{if $paymentOptions.processorId == "Allopass"}
{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/config'|url}"></script> 
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery-validate/jquery.validate.js'|resurl}"></script> 
<script type="text/javascript" src="{'/javascript/jquery/jquery.form.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.formTool.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/payment/makePaymentAllopassOnLoad.js'|resurl}"></script>
{/capture}
{/if}

{include file="includes/header.tpl" title="{'makePayment_html_title'|lang}" metaDescription="{'makePayment_meta_description'|lang}"} 

<div class="show_arbo">
<a href="{$setting.siteRootUrl}" class="link_showarbo">{'show_arbo_directory'|lang}</a> &gt;
<a href="{'/payment/selectPaymentOptions'|url}" class="link_showarbo">{'makePayment_arbo'|lang}</a>
</div>

{displayAd place="overSitesList"}

<div class="title_h">
<h1>{$paymentOptions.displayName}</h1>
</div>
<fieldset class="column_in">
    <div class="form">
    <label class="title">{'makePayment_your_choice'|lang}</label>
    <div class="infos">{$package.name}</div>
    </div>
	
{if $paymentOptions.processorId == "PayPal"}
	<div class="form">
    <label class="title">{'makePayment_price'|lang}</label>
    <div class="infos">{$package.amount} {$paymentOptions.currency}</div>
    </div>
{/if}
	
	<div class="form">
    <label class="title">{'makePayment_choice_description'|lang}</label>
    <div class="infos">{$package.description|htmlspecialchars_decode}</div>
    </div>
	
{if $paymentOptions.processorId == "PayPal"}
	<div class="form">
    <label class="title">&nbsp;</label>
    <div class="infos"><form action="{"/payment/processPayment"|url}" method="post">
						<input type="hidden" name="processorId" value="PayPal">
						<input type="hidden" name="packageId" value="{$package.packageId}">
						<p>
						<input type="submit" class="button" value="{'makePayment_next_step'|lang}" />
						</p>
						</form></div>
    </div>
{/if}


{if $paymentOptions.processorId == "Allopass"}

<div class="form">
<label class="title">&nbsp;</label>
<div class="infos">
<table cellpadding="0" cellspacing="0" style="border: 0px; width: 300px;">
<tr>
<td style="text-align: center; vertical-align: top; background-color: #FFF; width: 300px;">
<img src="http://www.allopass.com/imgweb/script/fr_uk/acces_title.jpg" alt="Logo" style="width: 300px; height: 25px;" />
</td>
</tr>
<tr>
<td style="text-align: center; width: 300px; height: 137px;">
<img src="http://www.allopass.com/show_top2.php4?SITE_ID={$paymentOptions.siteId}&amp;DOC_ID={$paymentOptions.docId}&amp;LG=fr_uk" style="width: 300px; height: 137px;" alt="" />
</td>
</tr>
<tr>
<td style="text-align: right; vertical-align: top; background-color: #FFF;">
<img src="http://www.allopass.com/imgweb/script/fr_uk/acces_left.jpg" width="79" height="29" alt="" style="float:left" />

{assign var=flags value=","|explode:"fr,be,ch,lu,de,uk,ca,au,nl,es,at,it,ie,hk,nz,se,no,pl,us"}

{foreach from=$flags value=flag}
<a href="javascript:;" onclick="javascript:window.open('http://www.allopass.com/show_accessv2.php4?CODE_PAYS={$flag}&amp;SITE_ID={$paymentOptions.siteId}&amp;DOC_ID={$paymentOptions.docId}&amp;LG=fr','phone','toolbar=0,location=0,directories=0,status=0,scrollbars=0,resizable=0,copyhistory=0,menuBar=0,width=300,height=340');"><img  src="http://www.allopass.com/imgweb/common/flag_{$flag}.gif" alt="" style="width: 35px; height: 29px; border: 0px;" /></a>
{/foreach}
</td>
</tr>
</table>
</div>
</div>


<form action="{"/payment/processPayment"|url}" method="post" id="allopassForm">
<input type="hidden" name="processorId" value="Allopass">
<input type="hidden" name="packageId" value="{$package.packageId}">

{for start=0 stop=$paymentOptions.allopassNumber value=i}

{math equation="x + 1" x=$i assign="lp"}

<div class="form">
    <label class="title">{'makePayment_allopass_code'|lang} {$lp}:</label>
    <div class="infos"><input type="text" class="input_text_small" name="code[{$i}]" value="" /></div>
</div>
{/for}

<div class="form">
    <label class="title">&nbsp;</label>
    <div class="infos"><input type="submit" class="button" value="{'makePayment_next_step'|lang}" /></div>
</div>

</form>

{/if}

</fieldset>

{include file="includes/footer.tpl"}