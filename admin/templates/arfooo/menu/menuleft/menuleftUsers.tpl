<div id="menuleft_login">
{include file='menu/menuleft/login.tpl'} 
</div>

<div class="menuleft">
<ul>
<li class="header">{'menuLeftUsers_users'|lang}</li>
<li><a href="{'/admin/user'|url}">{'menuLeftUsers_change_pass'|lang}</a></li>
<li><a href="{'/admin/user/administrator'|url}">{'menuLeftUsers_admin'|lang}</a></li>
<li><a href="{'/admin/user/moderator'|url}">{'menuLeftUsers_moderators'|lang}</a></li>
<li><a href="{'/admin/user/webmaster'|url}">{'menuLeftUsers_webmasters'|lang}</a></li>
<li class="text_last"></li>
</ul>
</div>

<div class="menuleft">
<ul>
<li class="header">{'menuLeftUsers_security'|lang}</li>
<li><a href="{'/admin/user/banIp'|url}">{'menuLeftUsers_ban_ip'|lang}</a></li>
<li><a href="{'/admin/user/banEmail'|url}">{'menuLeftUsers_ban_email'|lang}</a></li>
<li><a href="{'/admin/site/banSite'|url}">{'menuLeftUsers_ban_website'|lang}</a></li>
<li><a href="{'/admin/tag/banTag'|url}">{'menuLeftUsers_ban_tags'|lang}</a></li>
<li class="text_last"></li>
</ul>
</div>

<div class="menuleft">
<ul>
<li class="header">{'menuLeftUsers_newsletter'|lang}</li>
<li><a href="{'/admin/user/newsletter'|url}">{'menuLeftUsers_send_newsletter'|lang}</a></li>
<li><a href="{'/admin/user/newsletterEmail'|url}">{'menuLeftUsers_export_email'|lang}</a></li>
<li class="text_last"></li>
</ul>
</div>

<div class="menuleft">
<ul>
<li class="header">{'menuLeftSettings_campaign_tracking'|lang}</li>
<li><a href="{'/admin/campaign/filter'|url}">{'menuLeftSettings_manage_filters'|lang}</a></li>
<li class="text_last"></li>
</ul>
</div>
