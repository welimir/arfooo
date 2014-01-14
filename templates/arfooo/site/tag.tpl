{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/site/visitSite.js'|resurl}"></script> 
{/capture}

{assign var="pageTitle" value=$searchTag.tag}

{if !empty($searchedSites)}
    {assign var="metaDescription" value=$searchedSites[0].description}
    {assign var="metaDescription" value=$metaDescription|htmlspecialchars_decode|strip_tags|regex_replace:"#\r?\n#":""|utf8_substr:0:100|htmlspecialchars}
{else}
    {assign var="metaDescription" value=$pageTitle} 
{/if}

{if $pageNavigation.currentPage > 1}
   {assign var="pageTitle" value=$pageTitle|cat:" - {'page'|lang} "|cat:$pageNavigation.currentPage}
   {assign var="metaDescription" value=$metaDescription|cat:" - {'page'|lang} "|cat:$pageNavigation.currentPage} 
{/if}

{include file="includes/header.tpl" title=$pageTitle}

<div class="show_arbo"> 
<a href="{$setting.siteRootUrl}" class="link_showarbo">{'show_arbo_directory'|lang}</a> &gt;
<a href="{$searchTag|objurl:'tag'}" class="link_showarbo">{$searchTag.tag}</a>
</div>

{displayAd place="overSitesList"} 

<div class="title_h_1">
<h1>{$searchTag.tag}</h1>
</div>

{include file="site/item.tpl" sites=$searchedSites}
            
{include file="includes/footer.tpl"} 