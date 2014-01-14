{if $setting.categoriesInLeftMenuEnabled}{"menu/displayCategories"|action}{/if}
{if $setting.keywordsEnabled}{"menu/displayKeywords"|action}{/if}

{if $setting.statisticsEnabled}{"menu/displayStatistics"|action}{/if}

{if $setting.registrationOfWebmastersEnabled}
<div class="menuright">
<ul>
<li class="header">{'menuright_members_area'|lang}</li>
<li><a href="{'/webmaster/manage'|url}" title="{'Members area management'|lang}">{'menuright_management'|lang}</a></li>
{if isset($session.role) && $session.role == "webmaster"}
<li><a href="{'/webmaster/changePassword'|url}" title="{'Change password'|lang}">{'menuright_change_password'|lang}</a></li>
<li><a href="{'/webmaster/logoff'|url}" title="{'Members area management'|lang}">{'menuright_logout'|lang}</a></li>
{/if}
<li class="text_last"></li>
</ul>
</div>
{/if}

{if $setting.tagCloudEnabled}
{"menu/displayTagCloud"|action}
{/if}
