<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{'includesHeader_language'|lang}" lang="{'includesHeader_language'|lang}">
<head>
<title>{$title}</title>
<meta name="description" content="{$title}" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="{'/admin/templates/arfooo/stylecss/style.css'|resurl}" rel="stylesheet" type="text/css" />
{if isset($headData)}
{$headData}{/if}
{if $sessionLifeTime}
<script type="text/javascript">
var sessionLifeTime = {$sessionLifeTime};
{literal}
function sessionKeepAlive() {
    $.post({/literal}"{$setting.siteRootUrl}"{literal});
}
window.setInterval(sessionKeepAlive, 1000 * sessionLifeTime / 2);
{/literal}
</script>
{/if}
</head>
<body>
<div id="principal">

<div id="top1">

{"admin/system/checkSecurity"|action}

</div>

<div id="top2">
{include file='menu/menuheader/menuheader.tpl'} 
</div>

<div id="main1">
<div id="main2">