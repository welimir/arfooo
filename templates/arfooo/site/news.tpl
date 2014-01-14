{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/site/visitSite.js'|resurl}"></script> 
{/capture}

{include file="includes/header.tpl" title="{'siteNews_html_title'|lang}" metaDescription="{'siteNews_meta_description'|lang}" includeSearchEngine=true} 

<div class="show_arbo"> 
<a href="{$setting.siteRootUrl}" class="link_showarbo">{'show_arbo_directory'|lang}</a> &gt;
<a href="{'/site/news'|url}" class="link_showarbo">{'siteNews_arbo'|lang}</a>
</div>

{displayAd place="overSitesList"} 

<div class="title_h_1">
<h1>{'siteNews_h1'|lang}</h1>

{if $setting.rssNewsEnabled}
<a href="{'/rss/news'|url}" title="{'siteNews_rss'|lang}"><img src="{"/templates/$templateName/images/rss.gif"|resurl}" class="rss_image" alt="{'siteNews_rss'|lang}" /></a>
{/if}
</div>

{include file="site/item.tpl" sites=$newSites}    
          
{include file="includes/footer.tpl"} 