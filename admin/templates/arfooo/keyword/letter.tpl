{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/config'|url}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.autoFill.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<script type="text/javascript" src="{'/admin/javascript/ad/jquery.adEditor.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery-validate/jquery.validate.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.form.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.adminFormTool.js'|resurl}"></script>
<script type="text/javascript" src="{'/admin/javascript/keyword/indexOnLoad.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/tiny_mce/tiny_mce.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/tiny_mce/basic_config.js'|resurl}"></script>
<script type="text/javascript">
tinyMCE.execCommand('mceAddControl', false, 'keywordDescription');
setting.adPage = "letter{$selectedLetter}";
</script>
{/capture}

{include file='includes/header.tpl' page="index" title="{'keywordLetter_html_title'|lang} $selectedLetter" metaDescription="{'keywordLetter_meta_description'|lang} $selectedLetter"} 

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
<h1>{'keywordIndex_h1'|lang}</h1>
</div>
<div class="menukeyword">
<ul>
{foreach from=$letters value=letter}
<li><a href="{"/admin/keyword/letter/$letter"|url}" title="{$letter}">{$letter}</a></li>
{/foreach}
</ul>
</div>

<div class="title_h_2">
<h2>{'keywordLetter_h2'|lang} {$selectedLetter}</h2>
</div>
<div class="menukeyword">
<ul>
{foreach from=$keywordGroups key=groupPrefix value=keywordGroup}
<li><a href="#{$groupPrefix|ucfirst}" title="{$groupPrefix|ucfirst}">{$groupPrefix|ucfirst}</a></li>
{/foreach}
</ul>
</div>

{foreach from=$keywordGroups key=groupPrefix value=keywordGroup} 
<div class="title_h_2">
<h2><a name="{$groupPrefix|ucfirst}">{$groupPrefix|ucfirst}</a></h2>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<thead>
<tr>
	<th>{'keywordLetter_th_name'|lang}</th>
	<th>{'Management'|lang}</th>
</tr>
</thead>
<tbody>
{foreach from=$keywordGroup.keywords value=keyword}
<tr class="line{cycle values='1,2'}">
	<td><a href="{"/admin/keyword/show/$keyword.keywordId"|url}" title="{$keyword.keyword}">{$keyword.keyword}</a></td>
	<td><a href="{"/admin/keyword/edit/$keyword.keywordId"|url}" class="link_green">{'link_edit'|lang}</a> | 
		<a onclick="return $.confirmLinkClick('{'Do you really want to delete it?'|lang}', this.href)" href="{"/admin/keyword/delete/$keyword.keywordId"|url}" class="link_red">{'link_delete'|lang}</a></td>
</tr>
{/foreach}
</tbody>
</table>
</div>
{/foreach}

<div class="title_h_2">
<h2>{'keywordIndex_h2'|lang}</h2>
</div>
<div class="column_in_table2">
<form action="{'/admin/keyword/saveNew'|url}" method="post" id="newKeywordForm">  
<table class="table2" cellspacing="1">
<tbody>
<tr>
	<td>{'keywordEdit_name'|lang}: </td>
	<td><input type="text" class="input_text_medium" name="keyword" value="" /></td>
</tr>
<tr>
    <td>{'keywordEdit_text_description'|lang} <img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" alt="" class="aide" title="{'keywordEdit_text_description_desc'|lang}" /></td>
    <td><textarea class="textarea_extra_large" name="description" cols="50" rows="5" id="keywordDescription"></textarea></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" class="button" value="{'button_create'|lang}" /></td>
</tr>
</tbody>
</table>
</form>
</div>


<form id="editAdsForm">
<div class="title_h_1">
<h2>{'keywordLetter_h2_ad'|lang} {$selectedLetter}</h2>
</div>
<div class="column_in_table2">
<table class="table2" cellspacing="1">
<col class="col3" /><col class="col4" />
<tbody>
<tr>
    <td>{'adPagesAll_activate_ad'|lang}: </td>
    <td><input type="radio" name="general" value="1" /> {'On'|lang} &nbsp;&nbsp;<input type="radio" name="general" value="0" checked="checked" /> {'Off'|lang}</td>
</tr>
</tbody>
</table>
</div>

<div class="title_h_2">
<h2>{'keywordLetter_h2_ad'|lang} {$selectedLetter}</h2>
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
{'Root'|lang} &gt; {'keywordLetter_keyword'|lang}
</div>
    
<div class="ads_column_in_select"> 
<select name="overSitesList">
{html_options options=$adCriterias} 
</select>
</div>

<div class="ads_title_out"> 
<div class="ads_title">
{'keywordLetter_h2'|lang} {$selectedLetter}
</div> 
</div> 
<div class="ads_column_in"> 
{'keywordLetter_keyword'|lang}  
</div>

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