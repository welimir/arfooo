{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/config'|url}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.autoFill.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.adminFormTool.js'|resurl}"></script>
<script type="text/javascript" src="{'/admin/javascript/ad/jquery.adEditor.js'|resurl}"></script>
<script type="text/javascript" src="{'/admin/javascript/ad/inOnLoad.js'|resurl}"></script>
<script>
setting.adPage = "{$adPage}";
</script>
{/capture}

{include file='includes/header.tpl' page="ad" title="{'predefineCategory_html_title'|lang}" metaDescription="{'predefineCategory_meta_description'|lang}"} 

<div id="left">

{include file='menu/menuleft/menuleftAdsense.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/ad'|url}">{'menuMenuHeader_ad'|lang}</a> &gt; <a href="{'/admin/ad/in/predefineCategory'|url}">{'menuLeftAd_ad_predefine_cat'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'predefineCategory_h1'|lang}</h1>
</div>
<div class="column_in">
{'predefineCategory_desc1'|lang}<br />
{'predefineCategory_desc2'|lang}<br />
{'predefineCategory_desc3'|lang}<br /><br />

{'predefineCategory_desc4'|lang}<br /><br />

{'predefineCategory_desc5'|lang}
</div>

<form id="editAdsForm">
<div class="title_h_1">
<h1>{'predefineCategory_h1'|lang}</h1>
</div>
<div class="column_in_table2">
<table class="table2" cellspacing="1">
<tbody>
<tr>
    <td>{'Activate Advertisement'|lang}: </td>
    <td><input type="radio" name="general" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="general" value="0" checked="checked" /> {'Off'|lang}</td>
</tr>
</tbody>
</table>
</div>

<div class="title_h_2">
<h2>{'predefineCategory_h1'|lang}</h2>
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
{'Root'|lang} &gt; {'predefineCategory_category'|lang}
</div>

<div class="ads_column_in_select"> 
<select name="overSubcategories">
{html_options options=$adCriterias}  
</select>
</div>

<div class="ads_title_out"> 
<div class="ads_title">
{'Name of categorie'|lang}
</div> 
</div> 
<div class="ads_column_in"> 
{'predefineCategory_category'|lang} 1 {'predefineCategory_category'|lang} 2<br />
{'predefineCategory_category'|lang} 3 {'predefineCategory_category'|lang} 4      
</div>
    
<div class="ads_column_in_select"> 
<select name="overDescription">
{html_options options=$adCriterias}  
</select>
</div>
    
<div class="ads_column_in"> 
<i>{'predefineCategory_category_description'|lang}</i>
</div>
    
<div class="ads_column_in_select"> 
<select name="overSitesList">
{html_options options=$adCriterias} 
</select>
</div>

{math equation="x + 1" x=$setting.sitesPerPageInCategory assign="stopLimit"} 
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