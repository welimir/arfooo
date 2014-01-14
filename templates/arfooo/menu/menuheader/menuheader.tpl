<div id="menutop2">
<ul>
<li id="index"><a href="{$setting.siteRootUrl}">{'menuMenuheader_directory'|lang}</a></li>
{if !empty($setting.newsEnabled)}<li id="news"><a href="{'/site/news'|url}">{'menuMenuheader_news'|lang}</a></li>
{/if}
{if !empty($setting.hitsEnabled)}<li id="tophits"><a href="{'/site/topHits'|url}">{'menuMenuheader_top_hits'|lang}</a></li>
{/if}
{if !empty($setting.notationsEnabled)}<li id="topnotes"><a href="{'/site/topNotes'|url}">{'menuMenuheader_top_rated'|lang}</a></li>
{/if}
{if !empty($setting.topRankEnabled)}<li id="toprank"><a href="{'/site/topRank'|url}">{'menuMenuheader_top_rank'|lang}</a></li>
{/if}
{if !empty($setting.topReferrersEnabled)}<li id="topref"><a href="{'/site/topReferrers'|url}">{'menuMenuheader_top_referrers'|lang}</a></li>
{/if}
{if !empty($setting.allCategoriesPageEnabled)}<li id="cat"><a href="{'/category/showAll'|url}">{'menuMenuheader_categories'|lang}</a></li>
{/if}
<li id="add"><a href="{'/webmaster/submitWebsite'|url}">{'menuMenuheader_submit_website'|lang}</a></li>	
</ul>
</div>
