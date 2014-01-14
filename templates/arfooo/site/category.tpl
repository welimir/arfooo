{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/site/visitSite.js'|resurl}"></script>
<script type="text/javascript">
setting.categoryId = {$category.categoryId};
</script>
{/capture}

{if $category.title}
    {assign var="pageTitle" value=$category.title}
{else}
    {assign var="pageTitle" value=$category.name}
{/if}

{if $category.metaDescription}
    {assign var="metaDescription" value=$category.metaDescription}
{else}
    {if $category.description || $sitesInCategory|@count > 0}
        {if $category.description}
            {assign var="metaDescription" value=$category.description}
        {else}
            {assign var="metaDescription" value=$sitesInCategory[0].description}
        {/if}
        {assign var="metaDescription" value=$metaDescription|htmlspecialchars_decode|strip_tags|regex_replace:"#\r?\n#":""|utf8_substr:0:100|htmlspecialchars}
    {else}
        {assign var="metaDescription" value=$pageTitle}
    {/if}
{/if}

{if $pageNavigation.currentPage > 1}
   {assign var="pageTitle" value=$pageTitle|cat:" - {'page'|lang} "|cat:$pageNavigation.currentPage}
   {assign var="metaDescription" value=$metaDescription|cat:" - {'page'|lang} "|cat:$pageNavigation.currentPage}   
{/if}
   
{include file="includes/header.tpl" title=$pageTitle includeSearchEngine=true}

<div class="show_arbo">
<a href="{$setting.siteRootUrl}" class="link_showarbo">{'show_arbo_directory'|lang}</a>
{foreach from=$categoryParentsData value=categoryParent}
    &gt; <a href="{$categoryParent|objurl:'category'}" class="link_showarbo"> {if !empty($categoryParent.navigationName)}{$categoryParent.navigationName}{else}{$categoryParent.name}{/if} </a>
{/foreach}
</div>

{displayAd place="overSubcategories"}

<div class="title_h_1">
<h1>{if !empty($category.headerDescription)}{$category.headerDescription}{else}{$category.name}{/if}</h1>

{if $setting.rssCategoriesEnabled && isset($display.categoryRssHref)}
<a href="{$display.categoryRssHref}" ><img src="{"/templates/$templateName/images/rss.gif"|resurl}" class="rss_image" alt="{'siteCategory_rss'|lang} {$category.name}" /></a>
{/if}
</div>

{"category/list"|action}

{if !empty($category.description)}
{displayAd place="overDescription"}
<div class="column_in">
{$category.description|htmlspecialchars_decode|nl2br}
</div>
{/if}

{displayAd place="overSitesList"}

{include file="site/item.tpl" sites=$sitesInCategory}

{include file="includes/footer.tpl"}