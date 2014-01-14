{if $setting.referrersSavingEnabled}{saveReferrer}{/if}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{'includesHeader_language'|lang}" lang="{'includesHeader_language'|lang}">
<head>
<title>{$title}</title>
<meta name="description" content="{if isset($metaDescription)}{$metaDescription}{else}{$title}{/if}" />
{if isset($metaKeywords)}<meta name="keywords" content="{$metaKeywords}" />   
{/if}
<meta name="robots" content="index, follow" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="{"/templates/$templateName/css/style.css"|resurl}" rel="stylesheet" type="text/css" />
{if isset($includeSearchEngine)}
<script type="text/javascript" src="{'/javascript/config'|url}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.searchEnginePanel.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/main/loadSearchEngine.js'|resurl}"></script>
{/if}
{if isset($headData)}
{$headData}{/if}
</head>
<body>
<div id="principal">

<div id="top1">{displayAd place="header"}
</div>

<div id="top2">
{include file="menu/menuheader/menuheader.tpl"}
</div>

{if isset($includeSearchEngine)}
{include file="menu/menuheader/searchEngine.tpl"}  
{/if}

<div id="main1">
<div id="main2">

<div id="left">
{include file="menu/menuleft/menuleft.tpl"}
{displayAd place="leftMenu"}
</div>

<div id="right">
{include file="menu/menuright/menuright.tpl"}
{displayAd place="rightMenu"}
</div>

<div id="middle">
<div class="column">