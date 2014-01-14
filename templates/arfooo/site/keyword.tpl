{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/site/visitSite.js'|resurl}"></script> 
{/capture}

{assign var="pageTitle" value=$keyword.keyword}

{if $keyword.description || $keywordSites|@count > 0}
    {if $keyword.description}
        {assign var="metaDescription" value=$keyword.description}
    {else}
        {assign var="metaDescription" value=$keywordSites[0].description}
    {/if}
    {assign var="metaDescription" value=$metaDescription|htmlspecialchars_decode|strip_tags|regex_replace:"#\r?\n#":""|utf8_substr:0:100|htmlspecialchars}
{else}
    {assign var="metaDescription" value=$pageTitle}
{/if}

{if $pageNavigation.currentPage > 1}
   {assign var="pageTitle" value=$pageTitle|cat:" - {'page'|lang} "|cat:$pageNavigation.currentPage} 
   {assign var="metaDescription" value=$metaDescription|cat:" - {'page'|lang} "|cat:$pageNavigation.currentPage} 
{/if}
    
{include file="includes/header.tpl" title=$pageTitle includeSearchEngine=true} 

<div class="show_arbo">
<a href="{$setting.siteRootUrl}" class="link_showarbo">{'show_arbo_directory'|lang}</a> &gt;
<a href="{$keyword|objurl:'keyword'}" class="link_showarbo">{$keyword.keyword}</a>
</div>

{displayAd place="overSitesList"} 

<div class="title_h_1">
<h1>{$keyword.keyword}</h1>
</div>

{if !empty($keyword.description)}
<div class="column_in">{$keyword.description|htmlspecialchars_decode|nl2br}</div>
{/if}

{include file="site/item.tpl" sites=$keywordSites}
              
{include file="includes/footer.tpl"} 