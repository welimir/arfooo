{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/tooltip/jquery.tooltip.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/tooltip/jquery.tooltip.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.addTooltip.js'|resurl}"></script>
{/capture}

{include file='includes/header.tpl' page="index" title="{'mainIndex_html_title'|lang}" metaDescription="{'mainIndex_meta_description'|lang}"} 

<div id="left">

{include file='menu/menuleft/menuleftIndex.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div class="title_h_1">
<h1>{'mainIndex_h1'|lang}</h1>
</div>
<div class="column_in">
{'mainIndex_desc1'|lang}<br /><br />
{'mainIndex_desc2'|lang} <a href="{'includesFooter_link'|lang}" target="_blank" class="link_black_grey">{'mainIndex_desc3'|lang}</a><br /><br />
{'mainIndex_desc4'|lang}
</div>

<div class="column_in_table">
<table class="table1" cellspacing="1">
<col class="col1" /><col class="col2" /><col class="col1" /><col class="col2" />
<thead>
<tr>
    <th>{'mainIndex_th_stats'|lang}</th>
    <th>{'mainIndex_th_value'|lang}</th>
    <th>{'mainIndex_th_stats'|lang}</th>
    <th>{'mainIndex_th_value'|lang}</th>
</tr>
</thead>
<tbody>
<tr>
    <td>{'mainIndex_referenced'|lang}: </td>
    <td><strong>{$validatedSitesCount}</strong></td>
    <td>{'mainIndex_pending'|lang}: </td>
    <td><strong>{$waitingSitesCount}</strong></td>
</tr>
<tr>
    <td>{'mainIndex_rejected'|lang}: </td>
    <td><strong>{$refusedSitesCount}</strong></td>
    <td>{'mainIndex_banned'|lang}: </td>
    <td><strong>{$bannedSitesCount}</strong></td>
</tr>
<tr>
    <td>{'mainIndex_keywords'|lang}: </td>
    <td><strong>{$keywordsCount}</strong></td>
    <td>{'mainIndex_categories'|lang}: </td>
    <td><strong>{$categoriesCount}</strong></td>
</tr>
<tr>
    <td>{'mainIndex_open'|lang}: </td>
    <td><strong>{$setting.directoryOpeningDate}</strong></td>
    <td>{'mainIndex_webmasters'|lang}: </td>
    <td><strong>{$webmastersCount}</strong></td>
</tr>
<tr>
    <td>{'mainIndex_version'|lang}: </td>
    <td><strong>{$directoryVersion}</strong></td>
    <td>{'mainIndex_db'|lang}: </td>
    <td><strong>{$databaseSize}</strong></td>
</tr>
</tbody>
</table>
</div>

<div class="column_in_table">
<form action="{'/admin/main/clear'|url}" method="post">
<table class="table1" cellspacing="1">
<thead>
<tr>
    <th>{'mainIndex_reset_part'|lang}</th>
    <th>{'mainIndex_run'|lang}</th>
</tr>
</thead>
<tbody>
<tr class="line1">
    <td><strong>{'mainIndex_reset_hits'|lang}</strong> <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'mainIndex_reset_hits_desc'|lang}" /></td>
    <td><input class="button" type="submit" name="topHits" value="{'mainIndex_run'|lang}" /></td>
</tr>
<tr class="line2">
    <td><strong>{'mainIndex_reset_referrers'|lang}</strong> <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'mainIndex_reset_referrers_desc'|lang}" /></td>
    <td><input class="button" type="submit" name="topReferrers" value="{'mainIndex_run'|lang}" /></td>
</tr>
<tr class="line1">
    <td><strong>{'mainIndex_clear_cache'|lang}</strong> <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'mainIndex_clear_cache_desc'|lang}" /></td>
    <td><input class="button" type="submit" name="fileCache" value="{'mainIndex_run'|lang}" /></td>
</tr>
<tr class="line2">
    <td><strong>{'mainIndex_clear_cache_pr'|lang}</strong> <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'mainIndex_clear_cache_pr_desc'|lang}" /></td>
    <td><input class="button" type="submit" name="googleCache" value="{'mainIndex_run'|lang}" /></td>
</tr>
<tr class="line1">
    <td><strong>{'mainIndex_url'|lang}</strong> <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'mainIndex_url_desc'|lang}" /></td>
    <td><input class="button" type="submit" name="createUrlNames" value="{'mainIndex_run'|lang}" /></td>
</tr>
<tr class="line2">
    <td><strong>{'mainIndex_reset_category_order'|lang}</strong> <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'mainIndex_reset_category_order_desc'|lang}" /></td>
    <td><input class="button" type="submit" name="categoryOrder" value="{'mainIndex_run'|lang}" /></td>
</tr>
</tbody>
</table>
</form>
</div>

{include file='includes/footer.tpl'}