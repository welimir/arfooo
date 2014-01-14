{if !empty($pageNavigation.totalPages) && $pageNavigation.totalPages > 1}

<!-- PAGINATION -->
<div class="column_in_pagination">
{'includesPageNavigation_pages'|lang} :

{math equation="x + 1" x=$pageNavigation.totalPages assign="stopLimit"}

{for start=1 stop=$stopLimit step=1 value=page}

{if $page == $pageNavigation.currentPage}
<b>{$page}</b>
{else}
{assign var="pageLink" value=$pageNavigation.baseLink|cat:$page}
<a href="{$pageLink|url}">{$page}</a>  
{/if}

{/for}
</div> 

<!-- END PAGINATION -->
{/if}