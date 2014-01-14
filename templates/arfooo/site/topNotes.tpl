{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/site/visitSite.js'|resurl}"></script> 
{/capture}

{include file="includes/header.tpl" title="{'siteTopNotes_html_title'|lang}" metaDescription="{'siteTopNotes_meta_description'|lang}" includeSearchEngine=true} 

<div class="show_arbo">
<a href="{$setting.siteRootUrl}" class="link_showarbo">{'show_arbo_directory'|lang}</a> &gt;
<a href="{'/site/topNotes'|url}" class="link_showarbo">{'siteTopNotes_arbo'|lang}</a>
</div>

{displayAd place="overSitesList"}

<div class="title_h_1">
<h1>{'siteTopNotes_h1'|lang}</h1>
</div>

{include file="site/item.tpl" sites=$topNoteSites}
              
{include file="includes/footer.tpl"} 