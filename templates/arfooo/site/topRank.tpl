{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/site/visitSite.js'|resurl}"></script> 
{/capture}

{include file="includes/header.tpl" title="{'siteTopRank_html_title'|lang} $pageRank" metaDescrption="{'siteTopRank_meta_description'|lang} $pageRank" includeSearchEngine=true} 

<div class="show_arbo"> 
<a href="{$setting.siteRootUrl}" class="link_showarbo">{'show_arbo_directory'|lang}</a> &gt;
<a href="{'/site/topRank'|url}" class="link_showarbo">{'siteTopRank_arbo'|lang} {$pageRank}</a>
</div>

{displayAd place="overSitesList"}

<div class="title_h_1">
<h1>{'siteTopRank_h1'|lang} {$pageRank}</h1>
</div>

<div id="menuin">
<ul> 
{for start=1 stop=11 step=1 value=i}
    <li><a href="{"/site/topRank/$i"|url}" title="{'siteTopRank_whit_pagerank'|lang} {$i}" class="link_black_grey_bold">PR{$i}</a></li>
{/for}
</ul>
</div>
                                            
{include file="site/item.tpl" sites=$topRankSites} 
          
{include file="includes/footer.tpl"} 