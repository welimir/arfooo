<div class="menuleft">
<ul>
<li class="header">{'menuleftStatistics_stats'|lang}</li>
{if isset($statistic.validatedSitesCount)}<li class="text">{'menuleftStatistics_approved_links'|lang} : {$statistic.validatedSitesCount}</li>
{/if}
{if isset($statistic.waitingSitesCount)}<li class="text">{'menuleftStatistics_pending_links'|lang} : {$statistic.waitingSitesCount}</li>
{/if}
{if isset($statistic.refusedSitesCount)}<li class="text">{'menuleftStatistics_rejected_links'|lang} : {$statistic.refusedSitesCount}</li>
{/if}
{if isset($statistic.bannedSitesCount)}<li class="text">{'menuleftStatistics_banned_links'|lang} : {$statistic.bannedSitesCount}</li>
{/if}
{if isset($statistic.allCategoriesCount)}<li class="text">{'menuleftStatistics_categories'|lang} : {$statistic.allCategoriesCount}</li>
{/if}
{if isset($statistic.keywordsCount)}<li class="text">{'menuleftStatistics_keywords'|lang} : {$statistic.keywordsCount}</li>
{/if}
{if isset($statistic.webmastersCount)}<li class="text">{'menuleftStatistics_webmasters'|lang} : {$statistic.webmastersCount}</li>
{/if}
<li class="text_last"></li>
</ul>
</div>