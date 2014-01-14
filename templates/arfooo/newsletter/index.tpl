{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/config'|url}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery-validate/jquery.validate.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/jquery.form.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.formTool.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/newsletter/indexOnLoad.js'|resurl}"></script>    
{/capture}

{include file="includes/header.tpl" title="{'newsletterIndex_html_title'|lang}" metaDescription="{'newsletterIndex_meta_description'|lang}"}  
	
<div class="show_arbo">
<a href="{$setting.siteRootUrl}" class="link_showarbo">{'show_arbo_directory'|lang}</a> &gt; 
<a href="{'/newsletter'|url}" class="link_showarbo">{'newsletterIndex_arbo'|lang}</a>
</div>

<form action="{'/newsletter/setEmail'|url}" method="post" id="newsletterForm">
<div class="title_h">
<h1>{'newsletterIndex_h1'|lang}</h1>
</div> 
<fieldset class="column_in">
	<div class="form">
	<label class="title">{'newsletterIndex_email'|lang}</label>
	<div class="infos"><input type="text" name="email" class="input_text_large" /></div>
	</div>
	
	<div class="form">
	<label class="title">&nbsp;</label>
	<div class="infos"><input type="submit" name="addEmail" class="button" value="{'newsletterIndex_button_subscribe'|lang}" /> <input type="submit" name="deleteEmail" class="button" value="{'newsletterIndex_button_unsubscribe'|lang}" /></div>
	</div>
</fieldset>
</form>

</div>

{include file="includes/footer.tpl"}  