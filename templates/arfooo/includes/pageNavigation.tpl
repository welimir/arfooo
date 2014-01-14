{if !empty($pageNavigation.totalPages) && $pageNavigation.totalPages > 1}
<div class="column_in_pagination">
{assign var="visiblePageRadius" value=5}
{math equation="max(1, x - r)" r=$visiblePageRadius x=$pageNavigation.currentPage assign="startLimit"}
{math equation="min(x + r*2, y) + 1" r=$visiblePageRadius x=$startLimit y=$pageNavigation.totalPages assign="stopLimit"}
{math equation="x - 1" x=$pageNavigation.currentPage assign="previousPage"}
{math equation="x + 1" x=$pageNavigation.currentPage assign="nextPage"}

{if $pageNavigation.currentPage > 1}
{assign var="pageLink" value=$pageNavigation.baseLink|cat:$previousPage}       
<a href="{$pageLink|url}"{if !empty($pageNavigation.title)} title="{$pageNavigation.title} - {'includesPageNavigation_page'|lang} {$previousPage}"{/if}> 
<img src="{"/templates/$templateName/images/leftNavigationArrow.gif"|resurl}" style="vertical-align:middle;" alt="{if !empty($pageNavigation.title)}{$pageNavigation.title} - {'includesPageNavigation_page'|lang} {$previousPage}{else}left arrow{/if}" />
</a>
{/if}  

{for start=$startLimit stop=$stopLimit step=1 value=page}
{if $page == $pageNavigation.currentPage}
<b>{$page}</b>
{else}
{assign var="pageLink" value=$pageNavigation.baseLink|cat:$page}
<a href="{$pageLink|url}"{if !empty($pageNavigation.title)} title="{$pageNavigation.title} - {'includesPageNavigation_page'|lang} {$page}"{/if}>{$page}</a>  
{/if}
{/for}

{'includesPageNavigation_from'|lang} {$pageNavigation.totalPages}

{if $pageNavigation.currentPage < $pageNavigation.totalPages}
{assign var="pageLink" value=$pageNavigation.baseLink|cat:$nextPage}       
<a href="{$pageLink|url}"{if !empty($pageNavigation.title)} title="{$pageNavigation.title} - {'includesPageNavigation_page'|lang} {$nextPage}"{/if}> 
<img src="{"/templates/$templateName/images/rightNavigationArrow.gif"|resurl}" style="vertical-align:middle;" alt="{if !empty($pageNavigation.title)}{$pageNavigation.title} - {'includesPageNavigation_page'|lang} {$nextPage}{else}right arrow{/if}"/>
</a>
{/if}   
 
</div>
{/if}