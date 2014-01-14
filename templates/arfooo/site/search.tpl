{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/site/visitSite.js'|resurl}"></script> 
{/capture}

{assign var="pageTitle" value="{'siteSearch_html_title'|lang}"}

{if !empty($searchValues.phrase)}
{assign var="pageTitle" value=$pageTitle,' ',$searchValues.phrase}
{/if}

{if !empty($searchValues.where)}
{if !empty($searchValues.phrase)}
{assign var="pageTitle" value=$pageTitle,', '}   
{/if}
{assign var="pageTitle" value=$pageTitle,' ',$searchValues.where}
{/if}

{if $pageNavigation.currentPage > 1}
   {assign var="pageTitle" value=$pageTitle|cat:" - {'page'|lang} "|cat:$pageNavigation.currentPage}
{/if}

{include file="includes/header.tpl" title=$pageTitle includeSearchEngine=true}

<div class="show_arbo"> 
<a href="{$setting.siteRootUrl}" class="link_showarbo">{'show_arbo_directory'|lang}</a> &gt;
<a href="{'/site/search/1'|url}" class="link_showarbo">{'siteSearch_arbo'|lang}</a>
</div>

{displayAd place="overSitesList"} 

<div class="title_h_1">
<h1>
{'siteSearch_h1'|lang}

{if !empty($searchValues.phrase)}
{$searchValues.phrase}
{/if}

{if !empty($searchValues.where)}
{if !empty($searchValues.phrase)}
{', '}   
{/if}

{' ',$searchValues.where}
{/if}
</h1>
</div>

{include file="site/item.tpl" sites=$searchedSites}
            
{include file="includes/footer.tpl"} 