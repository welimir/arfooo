{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/site/visitSite.js'|resurl}"></script> 
{/capture}

{include file="includes/header.tpl" title="{'siteTopReferrers_html_title'|lang}" metaDescription="{'siteTopReferrers_meta_description'|lang}" includeSearchEngine=true} 

<div class="show_arbo"> 
<a href="{$setting.siteRootUrl}" class="link_showarbo">{'show_arbo_directory'|lang}</a> &gt;
<a href="{'/site/topReferrers'|url}" class="link_showarbo">{'siteTopReferrers_arbo'|lang}</a>
</div>

{displayAd place="overSitesList"} 

<div class="title_h_1">
<h1>{'siteTopReferrers_h1'|lang}</h1>
</div>

{include file="site/item.tpl" sites=$topReferrerSites}
                
{include file="includes/footer.tpl"} 