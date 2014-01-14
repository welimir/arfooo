{include file="includes/header.tpl" title="{'Keywords'|lang} - "|cat:$letter metaDescription="{'keywordShow_meta_description'|lang}"|cat:" "|cat:$letter includeSearchEngine=true}   

<div class="show_arbo"> 
<a href="{$setting.siteRootUrl}" class="link_showarbo">{'show_arbo_directory'|lang}</a> 
&gt; <a href="{"/keyword/show/$letter"|url}" class="link_showarbo">{'keywordShow_arbo'|lang} {$letter}</a> 
</div>

{displayAd place="overSitesList"} 

<div class="title_h_1">
<h1>{'keywordShow_h1'|lang} {$letter}</h1>
</div>
                    
<div id="menuin">
<ul>
{foreach from=$keywordGroups key=groupPrefix value=keywordGroup}
<li><a href="#{$groupPrefix}" title="{'Keywords, starting with'|lang} {$groupPrefix}">{$groupPrefix}</a></li>
{/foreach}
</ul>
</div>
 
{foreach from=$keywordGroups key=groupPrefix value=keywordGroup}
    <div class="title_h_2_out">
    <div class="title_h_2" id="{$groupPrefix}">
    <h2>{$groupPrefix}</h2>
    </div>
    </div>
                                 
    <div class="column_in">
    {for start=0 stop=3 step=1 value=columnNr}    
        <div class="menucategories"><ul>
        {if $columnNr < $keywordGroup.keywords|@count}
        {for start=$columnNr stop=$keywordGroup.keywords|@count step=3 value=i}   
            {assign var=keyword value=$keywordGroup.keywords[$i] }
            <li class="keyword"><a href="{$keyword|objurl:'keyword'}" title="{$keyword.keyword}">{$keyword.keyword}</a>
                <span class="text_numbers">({$keyword.count})</span>
            </li>
        {/for}
        {/if}       
        </ul></div> 
    {/for}            
    </div>
{/foreach}
             
{include file="includes/footer.tpl"}   