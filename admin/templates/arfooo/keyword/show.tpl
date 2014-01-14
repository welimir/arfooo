{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/config'|url}"></script> 
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.autoFill.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.adminFormTool.js'|resurl}"></script>
<script type="text/javascript" src="{'/admin/javascript/ad/jquery.adEditor.js'|resurl}"></script>
<script type="text/javascript" src="{'/admin/javascript/keyword/showOnLoad.js'|resurl}"></script>
<script type="text/javascript">
setting.adPage = "keyword{$keyword.keywordId}";
</script>
{/capture}

{include file='includes/header.tpl' page="index" title="{'keywordShow_html_title'|lang} $keyword.keyword" metaDescription="{'keywordShow_meta_description'|lang} $keyword.keyword"} 

<div id="left">

{include file='menu/menuleft/menuleftIndex.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/'|url}">{'menuMenuHeader_directory'|lang}</a> &gt; <a href="{'/admin/keyword'|url}">{'menuLeftIndex_manage_keywords'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'keywordShow_h1'|lang} {$keyword.keyword}</h1>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<thead>
<tr>
	<th>{'keywordLetter_th_name'|lang}</th>
	<th>{'keywordShow_th_banned'|lang}</th>
	<th>{'Management'|lang}</th>
</tr>
</thead>
<tbody>

{foreach from=$keywordSites value=site}
<tr class="line{cycle values='1,2'}">
	<td><a href="{"/admin/site/edit/$site.siteId"|url}" title="{$site.siteTitle}">{$site.siteTitle}</a></td>
	<td>{if $site.status == 'banned'}<span class="text_red">{'Yes'|lang}</span>{else}<span class="text_green">{'No'|lang}</span>{/if}</td>
	<td><a href="{"/admin/site/edit/$site.siteId"|url}" class="link_green">{'link_edit'|lang}</a> | 
		<a onclick="return $.confirmLinkClick('{'Do you really want to delete it?'|lang}', this.href)" href="{"/admin/site/delete/$site.siteId"|url}" class="link_red">{'link_delete'|lang}</a></td>
</tr>
{/foreach}

</tbody>
</table>
</div>

<form id="editAdsForm" style="visibility:hidden">
<div class="title_h_2">
<h2>{'keywordShow_h2_ad'|lang} {$keyword.keyword}</h2>
</div>
<div class="column_in_table2">
<table class="table2" cellspacing="1">
<col class="col3" /><col class="col4" />
<tbody>
<tr>
	<td>{'keywordShow_predefine_ad'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'keywordShow_predefine_ad_desc1'|lang} {'keywordShow_predefine_ad_desc2'|lang}" /></td>
	<td><input type="radio" name="predefine" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="predefine" value="0" checked="checked" /> {'Off'|lang}</td>
</tr>
<tr>
	<td>{'adPagesAll_activate_ad'|lang}: </td>
	<td><input type="radio" name="general" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="general" value="0" checked="checked" /> {'Off'|lang}</td>
</tr>
</tbody>
</table>
</div>

<div class="title_h_2">
<h2>{'keywordShow_h2_ad'|lang} {$keyword.keyword}</h2>
</div>
<div id="ads_principal">
    
<div id="ads_top1">
<div id="ads_top_left">
{'HEADER - BANNER'|lang}
</div>
<div id="ads_top_right">
<select name="header">
{html_options options=$adCriterias}
</select>
</div>
</div>

<div id="ads_top2">
{'HORIZONTAL MENU'|lang}
</div>
    
<div id="ads_main1">
<div id="ads_main2">
    
<div id="ads_left">
<div class="ads_menuleft">
<ul>
<li class="text">{'Left menu'|lang}</li>
</ul>
</div>
<div class="ads_menu_ads">
<select name="leftMenu">
{html_options options=$adCriterias}
</select>
</div>
</div>
    
<div id="ads_right">
<div class="ads_menuright">
<ul>
<li class="text">{'Right menu'|lang}</li>
</ul>
</div>
<div class="ads_menu_ads">
<select name="rightMenu">
{html_options options=$adCriterias}
</select>
</div>
</div>
    
<div id="ads_middle">
<div class="ads_column">
    
<div class="ads_show_arbo">
{'Root'|lang} &gt; {$keyword.keyword}
</div>
    
<div class="ads_column_in_select"> 
<select name="overSitesList">
{html_options options=$adCriterias}  
</select>
</div>

<div class="ads_title_out"> 
<div class="ads_title">
{'keywordLetter_keyword'|lang}
</div> 
</div> 
    
{math equation="x + 1" x=$setting.sitesPerPageInKeywords assign="stopLimit"} 
{for start=1 stop=$stopLimit value=i} 
<div class="ads_column_in{cycle values=',_grey'}"> 
{'Website'|lang} {$i}
</div>
        
<div class="ads_column_in_select"> 
<select name="sitePosition{$i}">
{html_options options=$adCriterias}  
</select>
</div>
{/for}

    
</div> 
</div>
    
<div class="fixe">&nbsp;
</div>
    
</div>
</div>
       
<div id="ads_bottom">
<div class="ads_column_bottom">
{'FOOTER'|lang}
</div>
</div>
      
</div>

</form>

{include file='includes/footer.tpl'}  