{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/config'|url}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.form.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.adminFormTool.js'|resurl}"></script>
<script type="text/javascript" src="{'/admin/javascript/tag/indexOnLoad.js'|resurl}"></script>
{/capture}

{include file='includes/header.tpl' page="index" title="{'tagIndex_html_title'|lang}" metaDescription="{'tagIndex_html_title'|lang}"} 

<div id="left">

{include file='menu/menuleft/menuleftIndex.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/'|url}">{'menuMenuHeader_directory'|lang}</a> &gt; <a href="{'/admin/tag'|url}">{'menuLeftIndex_manage_tags'|lang}</a>
</div>

<div class="column_in_table">
{include file="includes/pageNavigation.tpl"} 
<table class="table1" cellspacing="1">
<thead>
<tr>
    <th>{'tagIndex_th_tags'|lang}</th>
    <th>{'tagIndex_th_search_times'|lang}</th>
    <th>{'tagIndex_th_banned'|lang}</th>
    <th>{'Management'|lang}</th>
</tr>
</thead>
<tbody>
{foreach from=$tags value=tag}
<tr class="line{cycle values='1,2'}" tagId="{$tag.tagId}">
    <td><a href="{"/admin/tag/show/$tag.tagId"|url}">{$tag.tag}</a></td>
    <td><form action="{"/admin/tag/saveTag/$tag.tagId"|url}" method="post" id="tagForm{$tag.tagId}"><input type="text" name="searchTimes" value="{$tag.searchTimes}" class="input_text_small" /> <a href="" class="link_green" execute="save">{'link_save'|lang}</a></form></td>
    <td>{if $tag.banned}<span class="text_red">{'Yes'|lang}</span>{else}<span class="text_green">{'No'|lang}</span>{/if}</td>
    <td><a href="{"/admin/tag/ban/$tag.tagId"|url}" class="link_red">{if $tag.banned}{'link_unban'|lang}{else}{'link_ban'|lang}{/if}</a> |
        <a onclick="return $.confirmLinkClick('{'Do you really want to delete it?'|lang}', this.href)" href="{"/admin/tag/delete/$tag.tagId"|url}" {$tag.tag}" class="link_red">{'link_delete'|lang}</a>
        </td>
</tr>
{/foreach}
</tbody>
</table>
</div>

{include file='includes/footer.tpl'}