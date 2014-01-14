{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/config'|url}"></script> 
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.adminFormTool.js'|resurl}"></script>
{/capture}

{include file='includes/header.tpl' page="user" title="{'userEditWebmaster_html_title'|lang}" metaDescription="{'userEditWebmaster_html_title'|lang}"}  

<div id="left">

{include file='menu/menuleft/menuleftUsers.tpl'} 

</div>

<div id="right">
</div>

<div id="middle"> 
<div class="column">

<div id="show_arbo">
<a href="{'/admin/user'|url}">{'menuMenuHeader_users'|lang}</a> &gt; <a href="{'/admin/user/webmaster'|url}">{'menuLeftUsers_webmasters'|lang}</a> &gt; {$webmaster.email}
</div>

<div class="title_h_1">
<h1>{'userEditWebmaster_h1'|lang} : {$webmaster.email}</h1>
</div>
<div class="column_in_table2">
<table class="table1" cellspacing="1">
<thead>
<tr>
	<th>{'userEditWebmaster_th_url'|lang}</th>
	<th>{'userEditWebmaster_th_status'|lang}</th>
	<th>{'userEditWebmaster_th_backlink'|lang}</th>
	<th>{'Management'|lang}</th>
</tr>
</thead>
<tbody>
{foreach from=$userSites value=site}
<tr class="line{cycle values='1,2'}">
	<td><a href="{$site.url}" title="{$site.siteTitle}">{$site.url}</a></td>
	<td>

    {switch from=$site.status}
        {case value="validated"}
            <span class="text_green">{'userEditWebmaster_approved'|lang}</span>
        {case value="waiting"}
            <span class="text_red">{'userEditWebmaster_pending'|lang}</span>
        {case value="banned"}
            <span class="text_red">{'userEditWebmaster_banned'|lang}</span>
    {/switch}
    
    </td>
	<td>{if $site.returnBond != ""}<span class="text_green">{'Yes'|lang}</span>{else}<span class="text_red">{'No'|lang}</span>{/if}</td>
	<td><a href="{"/admin/site/edit/$site.siteId"|url}" class="link_green">{'link_edit'|lang}</a> | 
		<a onclick="return $.confirmLinkClick('{'Do you really want to delete it?'|lang}', this.href)" href="{"/admin/site/delete/$site.siteId"|url}" class="link_red">{'link_delete'|lang}</a></td>
</tr>
{/foreach}

</tbody>
</table>
</div>
                         
<div class="title_h_2">
<h2>{'userEditWebmaster_h1'|lang}</h2>
</div>
<div class="column_in_table2">
<form action="{"/admin/user/updateWebmaster/$webmaster.userId"|url}" method="post">
<table class="table2" cellspacing="1">
<col class="col3" /><col class="col4" />
<tbody>
<tr>
	<td>{'userEditWebmaster_email'|lang}: </td>
	<td><input type="text" class="input_text_medium" name="email" value="{$webmaster.email}" /></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" name="save" class="button" value="{'button_save'|lang}" /> <input type="button" name="delete" class="button" value="{'button_delete'|lang}" onclick="return $.confirmLinkClick('{'Do you really want to delete it?'|lang}', '{"/admin/user/delete/$webmaster.userId"|url}');" /></td>
</tr>
</tbody>
</table>
</form>
</div>

{include file='includes/footer.tpl'}    