<div id="top3">

<div id="search">
<div id="searchEnginePanel">
<form action="{'/site/search/'|url}" id="searchform" onsubmit="if(this.phrase.value == this.phrase.defaultValue)this.phrase.value='';if(this.where.value == this.where.defaultValue)this.where.value='';">
<div>
<div id="search_keyword_text">{'menuSearchEngine_what'|lang}</div>
<div id="search_where_text">{'menuSearchEngine_where'|lang}</div>
<input id="search_keyword_buton" type="text" name="phrase" value="{'menuSearchEngine_type_keyword'|lang}" onfocus="this.value=''" />
<input id="search_where_buton" type="text" name="where" value="{'menuSearchEngine_adress'|lang}" onfocus="this.value=''" />
<input id="search_ok_buton" type="submit" name="go" value="{'menuSearchEngine_search_button'|lang}" />
<input type="hidden" name="isNewSearch" value="true" />
{if $setting.advancedSearchEnabled}
<a href="#" id="advancedSearchLink">{'menuSearchEngine_advanced_search'|lang}</a>
<div id="searchEngineExtraFields">

</div>
{/if}
</div>
</form>
</div>
</div>

</div>