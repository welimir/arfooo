{include file="includes/header.tpl" title=$setting.siteTitle|htmlspecialchars includeSearchEngine=true} 

{displayAd place="overCategories"}               
    
<div class="title_h_1">
<h1>{$setting.siteTitle|htmlspecialchars}</h1>
</div>
{"/category/list"|action}

{displayAd place="underCategories"}

<div class="title_h_2">
<h2>{'mainIndex_h2'|lang}</h2>
</div>
<div class="column_in">
{'/site/randomList'|action}
</div>

{displayAd place="underRandomSites"}

<div class="title_h_2">
<h2>{$directoryDescription.title}</h2>
</div>
<div class="column_in">
{$directoryDescription.description|htmlspecialchars_decode|nl2br}
</div>

{displayAd place="underIntroductionText"}

{include file="includes/footer.tpl"}