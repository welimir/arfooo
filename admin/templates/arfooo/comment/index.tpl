{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/config'|url}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.adminFormTool.js'|resurl}"></script>
<script type="text/javascript" src="{'/admin/javascript/comment/CommentEditor.js'|resurl}"></script>
<script type="text/javascript" src="{'/admin/javascript/comment/indexOnLoad.js'|resurl}"></script>
{/capture}

{include file='includes/header.tpl' page="index" title="{'commentIndex_html_title'|lang}" metaDescription="{'commentIndex_meta_description'|lang}"}

<div id="left">

{include file='menu/menuleft/menuleftIndex.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/'|url}">{'menuMenuHeader_directory'|lang}</a> &gt; <a href="{'/admin/comment'|url}">{'menuLeftIndex_manage_comments'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'commentIndex_h1'|lang}</h1>
</div>
<div class="column_in">
<select id="commentSelect">
<option value="0" {if $validatedComment == "0"}selected="selected"{/if}> {'commentIndex_not_validated'|lang} </option>
<option value="1" {if $validatedComment == "1"}selected="selected"{/if}> {'commentIndex_validated'|lang} </option>
</select>
</div>

<div class="title_h_2">
<h2>{'commentIndex_h1'|lang}</h2>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<thead>
<tr>
    <th>{'commentIndex_th_comment'|lang}</th>
	<th>{'commentIndex_th_website'|lang}</th>
	<th>{'commentIndex_th_user'|lang}</th>
	<th>{'commentIndex_th_date'|lang}</th>
	<th>{'commentIndex_th_ip'|lang}</th>
	<th>{'commentIndex_th_validated'|lang}</th>
	<th>{'commentIndex_th_management'|lang}</th>
</tr>
</thead>
<tbody>
{foreach from=$comments value=comment}

<tr class="line{cycle values='1,2'}" id="commentForm{$comment.commentId}">                                              
    <td><textarea class="textarea_large" name="text" cols="50" rows="5">{$comment.text}</textarea></td>
	<td><a href="{"/admin/site/edit/$comment.siteId"|url}" title="{$comment.siteTitle}">{$comment.siteTitle}</a></td>
	<td><input type="text" class="input_text_small" name="pseudo" value="{$comment.pseudo}" /></td>
	<td><input type="text" class="input_text_small" name="date" value="{$comment.date}" /></td>
	<td>{$comment.remoteIp}</td>
	<td>{if $comment.validated}<span class="text_green">{'Yes'|lang}</span>{else}<span class="text_red">{'No'|lang}</span>{/if}</td>
	<td>
    <input type="hidden" name="commentId" value="{$comment.commentId}"/>
    <input type="hidden" name="remoteIp" value="{$comment.remoteIp}"/>
    <a href="" title="Save comment" class="link_green" rel="save">{'link_save'|lang}</a> |
		<a href="" title="Delete comment" class="link_red" rel="delete">{'link_delete'|lang}</a> |
		<a href="" title="Ban IP" class="link_red" rel="banIp" >{'link_ban'|lang}</a></td>
</tr>
{/foreach}

</tbody>
</table>

{include file="includes/pageNavigation.tpl"} 

</div>

{include file='includes/footer.tpl'}   