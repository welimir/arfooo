{include file="includes/header.tpl" title="{'webmasterChooseSiteType_html_title'|lang}" metaDescription="{'webmasterChooseSiteType_meta_description'|lang}"}

<div class="show_arbo"> 
<a href="{$setting.siteRootUrl}" class="link_showarbo">{'show_arbo_directory'|lang}</a> &gt; 
<a href="{'/webmaster/chooseSiteType'|url}" class="link_showarbo">{'webmasterChooseSiteType_arbo'|lang}</a> 
</div>
                
<div class="title_h_1">
<h1>{'webmasterChooseSiteType_h1'|lang}</h1>
</div>
<div class="column_in">

{if $setting.availableSiteTypes == "both"}
<div class="column_in_choose_left">
<div class="menuchoose_left">
<ul>
<li><a href="{'/webmaster/submitWebsite/basic'|url}">{'webmasterChooseSiteType_free'|lang}</a></li>
</ul>
</div>
<span class="text_center">{'webmasterChooseSiteType_free_submission'|lang}</span><br />
{'webmasterChooseSiteType_standard_submission'|lang}
</div>
{/if}

<div class="column_in_choose_right">
<div class="menuchoose_right">
<ul>
<li><a href="{'/webmaster/submitWebsite/premium'|url}">{'webmasterChooseSiteType_privileged'|lang}</a></li>
</ul>
</div>
<span class="text_center">{'webmasterChooseSiteType_privilege_submission'|lang}</span><br />
{'webmasterChooseSiteType_submission_allowing_you'|lang}
</div>

</div>

{include file="includes/footer.tpl"}