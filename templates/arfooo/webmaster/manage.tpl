{capture assign="headData"}
<script type="text/javascript" src="{'/javascript/config'|url}"></script> 
<script type="text/javascript" src="{'/javascript/jquery/jquery.js'|resurl}"></script>
<link href="{"/templates/$templateName/jquery/theme/ui.all.css"|resurl}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{'/javascript/jquery/jquery-ui.js'|resurl}"></script>
<script type="text/javascript" src="{'/javascript/jquery/jquery.adminFormTool.js'|resurl}"></script>
{/capture}

{include file="includes/header.tpl" title="{'webmasterManage_html_title'|lang}" metaDescription="{'webmasterManage_meta_description'|lang}"} 

<div class="show_arbo">
<a href="{$setting.siteRootUrl}" class="link_showarbo">{'show_arbo_directory'|lang}</a> &gt; 
<a href="{'/webmaster/manage'|url}" class="link_showarbo">{'webmasterManage_arbo'|lang}</a>
</div>

<div class="title_h_1">
<h1>{'webmasterManage_h1'|lang}</h1>
</div>

<div class="column_in">
<table class="table_user" cellspacing="1">
<col class="col1-3" /><col class="col2-3" />
<tbody>
<tr>
    <td><a href="{'/webmaster/submitWebsite'|url}" class="link_add_website">{'webmasterManage_add_website'|lang}</a></td>
    <td class="td_right">{'webmasterManage_username'|lang}: {$session.email} - <a href="{'/webmaster/logoff'|url}" class="link_black_grey_bold">{'webmasterManage_logout'|lang} </a></td>
</tr>
</tbody>
</table>

<table class="table_website" cellspacing="1">
<thead>
<tr>
    <th>{'webmasterManage_website_url'|lang}</th>
    <th>{'webmasterManage_status'|lang}</th>
    <th>{'webmasterManage_view'|lang}</th>
    <th>{'webmasterManage_details'|lang}</th>
    <th>{'webmasterManage_management'|lang} </th>
</tr>
</thead>
<tbody>
{foreach from=$sites value=site}
    <tr class="line{cycle values='1,2'}">
    <td>{if $site.url}{$site.url}{else}{$site.siteTitle}{/if}</td>
    <td><span class="text_{if $site.status == 'validated'}green{else}red{/if}">{if $site.status == 'validated'}{'webmasterManage_validated'|lang}{else}{'webmasterManage_pending'|lang}{/if}</span></td>
    <td><a href="{$site|objurl:'siteDetails'}">{'webmasterManage_go'|lang}</a></td>
    <td>{if $site.siteType == "basic"}
        {'webmasterManage_free'|lang}
        {else}
        {'webmasterManage_privileged'|lang} - {$site.packageName} - {$site.paymentProcessorName}
        {/if}
    </td>
    <td><a href="{"/webmaster/editSite/$site.siteId"|url}" class="link_edit">{'webmasterManage_edit'|lang} </a>
      | <a href="{"/webmaster/deleteSite/$site.siteId"|url}" onclick="return $.confirmLinkClick('{'webmasterManage_delete_website?'|lang}', this.href)" class="link_delete">{'webmasterManage_delete'|lang}</a></td>
    </tr>
{/foreach}
</tbody>
</table>
</div>
				               
{include file="includes/footer.tpl"}