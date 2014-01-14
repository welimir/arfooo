{capture assign="headData"}
<link href="{"/templates/$templateName/jquery/colorbox/colorbox.css"|resurl}" rel="stylesheet" type="text/css" />
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<link href="{"/templates/$templateName/jquery/jquery-rating/jquery.rating.css"|resurl}" rel="stylesheet" type="text/css" />    <script type="text/javascript" src="{'/javascript/jquery/jquery.captchaCode.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.livequery.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery-validate/jquery.validate.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.popup.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/colorbox/jquery.colorbox.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.form.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.formTool.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery-rating/jquery.rating.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/site/detailsOnLoad.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/site/visitSite.js'|resurl}"></script>
<script type="text/javascript">
{if isset($ajaxGoogleDetails)}setting.retrieveGoogleDetailsSiteId = {$site.siteId};
{/if}
setting.categoryId = {$site.categoryId};
</script>
{/capture}

{include file="includes/header.tpl" title=$site.siteTitle includeSearchEngine=true}

<div class="show_arbo">
<a href="{$setting.siteRootUrl}" class="link_showarbo">{'show_arbo_directory'|lang}</a> &gt; 
{foreach from=$site.categoryParents value=categoryParent}
    <a href="{$categoryParent|objurl:'category'}" class="link_showarbo">{if !empty($categoryParent.navigationName)}{$categoryParent.navigationName}{else}{$categoryParent.name}{/if}</a> &gt;
{/foreach}
<a href="{$site|objurl:'siteDetails'}" class="link_showarbo">{$site.siteTitle}</a>
</div>

{displayAd place="overInformationOfWebsite"}

<div class="title_h">
<h1>{$site.siteTitle}</h1>
{if $setting.rssSitesEnabled && isset($display.siteRssHref)}
<a href="{$display.siteRssHref}" ><img src="{"/templates/$templateName/images/rss.gif"|resurl}" class="rss_image" alt="{'siteDetails_rss'|lang} {$site.siteTitle}" /></a>
{/if}
</div>

<div class="column_in">

<div id="column_in_details">
{if $site.htmlModeEnabled}
{$site.description|htmlspecialchars_decode|nl2br}
{else}
{$site.description|nl2br}
{/if}

<br /><br />

{if $site.url}
{'siteDetails_see_sentence'|lang} <a href="{$site.url}" title="{$site.siteTitle}" class="link_black_blue_b_u" target="_blank" onclick="return visitSite({$site.siteId})">{$site.siteTitle}</a>{'siteDetails_categorie'|lang} 
{assign var="lastCategory" value=$site.categoryParents|@array_slice:-1}
{foreach from=$lastCategory value=category} <a href="{$category|objurl:'category'}" class="link_black_grey">{$category.name}</a> {/foreach}
<br /><br />
{/if}

{if $setting.keywordsEnabled && !empty($site.keywords)}
{'siteDetails_keyword_sentence'|lang} {assign var="counter" value=$site.keywords|@count}
{foreach from=$site.keywords value=keyword}
{ math equation="x - 1" x=$counter assign="counter" }
<a href="{$keyword|objurl:'keyword'}" title="{$keyword.keyword}" class="link_black_grey">{$keyword.keyword}</a>{if $counter > 0}, {/if}
{/foreach}
<br /><br />
{/if}

	{if $setting.countryFlagsEnabled && $site.countryCode}
	<div class="form_details">
    <label class="title_details">{'siteDetails_language'|lang}</label>
	<div class="infos_details"><img src="{"/templates/$templateName/images/flags/$site.countryCode"|resurl}.png" alt="{$site.countryCode}" class="flag_image_details" /></div>
    </div>
	{/if}

	{if $site.url}
	<div class="form_details">
    <label class="title_details">{'siteDetails_url'|lang}</label>
	<div class="infos_details"><span class="text_characters_orange">{$site.url|domain}</span></div>
    </div>
	{/if}
	
	{if $site.returnBond != ''}
	<div class="form_details">
    <label class="title_details">{'siteDetails_backlink'|lang}</label>
	<div class="infos_details"><a href="{$site.returnBond}" title="{$site.returnBond}" class="link_black_grey" target="_blank">{$site.returnBond}</a></div>
    </div>
	{/if}
	
	<div class="form_details">
    <label class="title_details">{'siteDetails_hits'|lang}</label>
	<div class="infos_details">{$site.visitsCount}</div>
    </div>
	
	<div class="form_details">
    <label class="title_details">{'siteDetails_rate'|lang}</label>
	<div class="infos_details">
	<div class="column_in_comment_in_right">
	 {assign var='roundedVotesAverage' value=$site.votesAverage|round}
    {for start=1 stop=6 step=1 value=i}
    <input name="starmain" type="radio" value="{$i}" class="star" disabled="disabled" {if $roundedVotesAverage == $i}checked="checked"{/if}/>
    {/for}
	</div>
	<div class="column_in_comment_in_right">
	{$site.votesAverage}/5 {'siteDetails_for'|lang} {$site.votesCount} {'siteDetails__rate'|lang}
	</div>
    </div>
    </div>

	{if $setting.commentsEnabled}
	<div class="form_details">
    <label class="title_details">{'siteDetails_comments'|lang}</label>
	<div class="infos_details">{$site.commentsCount}</div>
    </div>
	{/if}
	
	<div class="form_details">
    <label class="title_details">{'siteDetails_validation_date'|lang}</label>
	<div class="infos_details">{$site.creationDate|strtotime|date:$setting.dateFormat}</div>
    </div>
    
{if !empty($site.extraFields)}  
{foreach from=$site.extraFields value=extraField}
{if $extraField.label || $extraField.value}
<div class="form_details">
<label class="title_details">{$extraField.name}</label>
<div class="infos_details">
{switch from=$extraField.type}
{case value="text"}
    {$extraField.value}
{case value="textarea"}
    {$extraField.value}
{case value="range"}
    {$extraField.value}   
{case value="select"}
    {$extraField.label}   
{case value="radio"}
    {$extraField.label}   
{case value="checkbox"}
    {foreach from=$extraField.label value=extraFieldLabel name="loop"}{if $templatelite.foreach.loop.iteration == 1}{$extraFieldLabel}{else}, {$extraFieldLabel}{/if}{/foreach}
{case value="url"}
<a href="{$extraField.value.url}"{if !empty($extraField.config.nofollow)} rel="nofollow"{/if}>{if !empty($extraField.config.anchor) && !empty($extraField.value.anchor)}{$extraField.value.anchor}{else}{$extraField.value.url}{/if}</a>
{case value="file"}
<a href="{"/uploads/files/$extraField.value.fileSrc"|resurl}" target="_blank">{$extraField.value.title}</a>
{/switch}
{if $extraField.suffix}
{$extraField.suffix}
{/if}
</div>
</div>
{/if}
{/foreach}
{/if}
    
</div>


<div id="column_in_right_details">

{if $setting.sitesImages && empty($site.photos)}
<img src="{$site.imageSrc}" alt="{$site.siteTitle}" class="website_image" />
{/if}

{if !empty($site.photos)}
{foreach from=$site.photos value=photo}
<a href="{$photo.src|realImgSrc:'gallery':'normal':$photo.altText}" rel="galleryPhotos" style="display:none;" id="mediumImageLink{$photo.photoId}"><img src="{$photo.src|realImgSrc:'gallery':'medium'}" alt="{$photo.altText}" class="mediumImage" /></a>
{/foreach}

{foreach from=$site.photos value=photo}
<img src="{$photo.src|realImgSrc:'gallery':'nano'}" photoId="{$photo.photoId}" mediumSrc="{$photo.src|realImgSrc:'gallery':'medium'}" normalSrc="{$photo.src|realImgSrc:'gallery':'normal'}" alt="" class="nanoImage" />
{/foreach}
{/if}

<div class="menudetails">
<ul>                               
<li id="header_interaction">{'siteDetails_interaction'|lang}</li>
<li id="warn"><a href="{"/contact/problemPopup/$site.siteId"|url}" class="link_black_grey_underline dialog" rel="nofollow" title="{'siteDetails_report_problem'|lang}" id="problemPopupLink">{'siteDetails_report_problem'|lang}</a></li>
{if $setting.commentsEnabled}
<li id="comment_rating"><a href="{"/comment/popup/$site.siteId"|url}" class="link_black_grey_underline dialog" rel="nofollow" title="{'siteDetails_write_comment'|lang} / {'siteDetails_rate_website'|lang}" id="commentPopupLink">{'siteDetails_write_comment'|lang} / {'siteDetails_rate_website'|lang}</a></li>
{/if}
{if $site.searchPartnership}
<li id="contact"><a href="{"/contact/contactPopup/$site.siteId"|url}" class="dialog" rel="nofollow" title="{'siteDetails_contact_webmaster'|lang}" id="contactAdvertiserLink">{'siteDetails_contact_webmaster'|lang}</a></li>
{/if}
{if $site.url}
    {if $setting.showingPagerankEnabled || $setting.showingBacklinksCountEnabled ||$setting.showingIndexedPagesCountEnabled}
    <li id="header_info_google">{'siteDetails_google_infos'|lang}</li>
    {if $setting.showingPagerankEnabled}
    <li class="text">{'siteDetails_pagerank'|lang} <span id="pageRank"> {if isset($site.pageRank) && empty($ajaxGoogleDetails)}
    <img src="{"/templates/$templateName/images/pagerank/pr"|resurl}{$site.pageRank}.gif" alt="{'siteDetails_pagerank'|lang} {$site.pageRank}" />{else}{'siteDetails_loading'|lang}{/if}</span></li>{/if}
    {if $setting.showingBacklinksCountEnabled}
    <li class="text">{'siteDetails_number_backlinks'|lang} <span id="backlinksCount">{if isset($site.backlinksCount)}{$site.backlinksCount}{else}{'siteDetails_loading'|lang}{/if}</span></li>{/if}
    {if $setting.showingIndexedPagesCountEnabled}
    <li class="text">{'siteDetails_number_indexed_pages'|lang} <span id="indexedPagesCount"> {if isset($site.indexedPagesCount)}{$site.indexedPagesCount}{else}{'siteDetails_loading'|lang}{/if}</span></li>{/if}
    {/if}
{/if}
</ul>
</div>

</div>


{displayAd place="underInformationOfWebsite"}

{displayAd place="underInformationGoogle"}
</div>

{if $setting.remoteRssParsingEnabled && ($site.rssFeedOfSite != '' && $site.rssTitle != '')}
<div class="title_h_2">
<h2>{'siteDetails_rss_feed'|lang} {$site.siteTitle}: <a href="{$site.rssFeedOfSite}" title="{$site.rssTitle}" class="link_black_blue_b_u">{$site.rssTitle}</a></h2>
</div>
<div class="column_in">
{if !empty($remoteRss)}
{foreach from=$remoteRss.items value=item}
<a href="{$item.link}" class="link_black_blue_b_u" target="_blank">{$item.title|truncate:$setting.numberOfCharactersForRssParsing}</a><br />
{if isset($item.description)}{$item.description|truncate:$setting.numberOfCharactersForRssParsing}<br />{/if}<br />
{/foreach}
{/if}
</div>
{/if}

{displayAd place="underInformationFluxRss"}

{if $setting.companyInfoEnabled && ($site.address != '' || $site.zipCode != '' || $site.city != '' || $site.country != '' || $site.phoneNumber != '' || $site.faxNumber)}
<div class="title_h_2">
<h2>{'siteDetails_company_information'|lang}: {$site.siteTitle}</h2>
</div>
<div class="column_in">
	
	{if $site.address != ''}
	<div class="form_details">
    <label class="title_details">{'siteDetails_adress'|lang}</label>
	<div class="infos_details">{$site.address}</div>
    </div>
	{/if}
	
	{if $site.zipCode != ''}
	<div class="form_details">
    <label class="title_details">{'siteDetails_postal_code'|lang}</label>
	<div class="infos_details">{$site.zipCode}</div>
    </div>
	{/if}
	
	{if $site.city != ''}
	<div class="form_details">
    <label class="title_details">{'siteDetails_city'|lang}</label>
	<div class="infos_details">{$site.city}</div>
    </div>
	{/if}
	
	{if $site.country != ''}
	<div class="form_details">
    <label class="title_details">{'siteDetails_country'|lang}</label>
	<div class="infos_details">{$site.country}</div>
    </div>
	{/if}
	
	{if $site.phoneNumber != ''}
	<div class="form_details">
    <label class="title_details">{'siteDetails_phone_number'|lang}</label>
	<div class="infos_details">{$site.phoneNumber}</div>
    </div>
	{/if}
	
	{if $site.faxNumber != ''}
	<div class="form_details">
    <label class="title_details">{'siteDetails_fax_number'|lang}</label>
	<div class="infos_details">{$site.faxNumber}</div>
    </div>
	{/if}

{if !empty($googleMap)}
<div id="map">
{$googleMap|htmlspecialchars_decode}
</div>
{/if}
</div>
{displayAd place="underInformationCompany"}
{/if}

{if !empty($site.comments)}
<div class="title_h_2" id="commentPost">
<h2>{'siteDetails_comments'|lang}: {$site.siteTitle}</h2>
</div>
<div class="column_in">
<!-- Comment Item -->
{foreach from=$site.comments value=comment}
<div class="column_in_comment{cycle values='_grey,'}">
<div class="column_in_comment_in">
<div class="column_in_comment_in_left">
{$comment.pseudo} <span class="text_comment">{'siteDetails_wrote_on'|lang}, {$comment.date|strtotime|date:$setting.dateFormat} |
</div>
<div class="column_in_comment_in_right">
{'siteDetails_comment_rate'|lang}
</div>
<div class="column_in_comment_in_right">
 {if $comment.rating != ""}     {for start=1 stop=6 step=1 value=i}<input name="star-c{$comment.commentId}" type="radio" value="{$i}" class="star" disabled="disabled" {if $comment.rating == $i}checked="checked"{/if}/>{/for}  {$comment.rating}{'siteDetails_5'|lang}{else}{'siteDetails_na'|lang}{/if}</span>
</div>
</div>
{$comment.text|nl2br} 
</div>
{/foreach}
<!-- END Comment Item -->
</div>
{/if}

{if !empty($site.randomSites)}
<div class="title_h_2">
<h2>{'siteDetails_related_sites'|lang} {$site.siteTitle}</h2>
</div>
<div class="column_in">
{foreach from=$site.randomSites value=randomSite}
<div class="column_in_thematic">
<a href="{$randomSite|objurl:'siteDetails'}" title="{$randomSite.siteTitle}" class="link_black_blue_b_u">{$randomSite.siteTitle}</a><br />
<span class="text_thematic_close">{$randomSite.description|htmlspecialchars_decode|strip_tags|truncate:$setting.randomSitesInDetailsDescriptionLength}</span>
</div>
{/foreach}
</div>
{displayAd place="underThematicCloseWebsite"}
{/if}

{include file="includes/footer.tpl"}