{assign var="sitePosition" value=0}
{foreach from=$sites value=site}
<div class="column_in{cycle values='_grey,'}">
{if $setting.sitesImages}
<a href="{$site|objurl:'siteDetails'}" title="{'siteItem_details'|lang} : {$site.siteTitle}">
<img src="{$site.imageSrc}" alt="{'siteItem_details'|lang} : {$site.siteTitle}" class="website_image" />
</a> 
{/if}

{if $setting.countryFlagsEnabled && $site.countryCode}
<img src="{"/templates/$templateName/images/flags/$site.countryCode"|resurl}.png" alt="{$site.countryCode}" class="flag_image" />
{/if}

<div class="column_in_description_site_category">
{if $site.url}
<a href="{$site.url}" title="{$site.siteTitle}" class="link_black_blue_b_u" target="_blank" onclick="return visitSite({$site.siteId})">{$site.siteTitle}</a>
{else}
<a href="{$site|objurl:'siteDetails'}" class="link_black_blue_b_u">{$site.siteTitle}</a>
{/if}
{if !empty($site.isNew)}<img src="{"/templates/$templateName/images/new.gif"|resurl}" alt="{'siteItem_new_website'|lang}" class="new_image" />{/if}
{if $site.packageImageSrc}
<img src="{"/uploads/images_packages/$site.packageImageSrc"|resurl}" alt="" class="package_image"  />
{/if}
<br /><br />
{if isset($display.highlightKeywords)}
{$site.description|htmlspecialchars_decode|strip_tags|truncate:$setting.numberOfCharactersForItemDescription|highlight:$display.highlightKeywords|nl2br}
{else}
{$site.description|htmlspecialchars_decode|strip_tags|truncate:$setting.numberOfCharactersForItemDescription|nl2br}
{/if}
<br /><br />
{if isset($site.keywords)}
<span class="text_characters_boldgras">{'siteItem_keywords'|lang} :</span> 
{foreach from=$site.keywords value=keyword key=keywordId}
<a href="{"site/keyword/$keywordId/%s/1"|url:$keyword}" title="{$keyword}" class="link_black_grey">{$keyword}</a>
{/foreach}
<br /><br />
{/if}

{if isset($display.referrersCountInListItem)}
<span class="text_characters_boldgras">{'siteItem_number_visitors_sent'|lang} :</span> 
{$site.referrerTimes}
<br /><br />
{/if}

{if isset($display.pageRankImgInListItem)}
<span class="text_characters_boldgras">{'siteItem_pagerank'|lang} :</span>
<img src="{"/templates/$templateName/images/pagerank/"|resurl}pr{$site.pageRank}.gif" alt="PageRank" />
<br /><br />
{/if}

{if isset($display.hitsCountInListItem)}
<span class="text_characters_boldgras">{'siteItem_hits'|lang} :</span> 
{$site.visitsCount}
<br /><br />
{/if}

{if isset($display.notesCountInListItem)}
<span class="text_characters_boldgras">{'siteItem_rate'|lang} :</span> 
{$site.votesAverage}{'siteItem_5'|lang} {'siteItem_for'|lang} {$site.votesCount}  {'siteItem__rate'|lang} 
<br /><br />
{/if}
  
{if $site.url}
<span class="text_characters_orange">
{if isset($display.highlightKeywords)}
{$site.url|domain|highlight:$display.highlightKeywords}
{else}
{$site.url|domain}
{/if}
</span>
|
{/if}
<a href="{$site|objurl:'siteDetails'}" {if $setting.sitesImages == 0}title="{'siteItem_details'|lang} : {$site.siteTitle}"{/if} class="link_black_grey_bold">{'siteItem_details'|lang}</a>               
</div>
</div>
{math equation="x + 1" x=$sitePosition assign="sitePosition"}
{displayAd place="sitePosition$sitePosition"}
{foreachelse}

{/foreach}

{include file="includes/pageNavigation.tpl"}