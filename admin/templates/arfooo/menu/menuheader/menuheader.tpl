<div id="menutop"> 
<ul>
<li{if $page == 'index'} class="current"{/if}><a href="{'/admin/'|url}">{'menuMenuHeader_directory'|lang}</a></li>
<li{if $page == 'setting'} class="current"{/if}><a href="{'/admin/setting'|url}">{'menuMenuHeader_settings'|lang}</a></li>
<li{if $page == 'ad'} class="current"{/if}><a href="{'/admin/ad'|url}">{'menuMenuHeader_ad'|lang}</a></li>
<li{if $page == 'user'} class="current"{/if}><a href="{'/admin/user'|url}">{'menuMenuHeader_users'|lang}</a></li>
<li{if $page == 'template'} class="current"{/if}><a href="{'/admin/template'|url}">{'menuMenuHeader_templates'|lang}</a></li>
<li{if $page == 'plugin'} class="current"{/if}><a href="{'/admin/plugin'|url}">{'menuMenuHeader_plugins'|lang}</a></li>
<li{if $page == 'system'} class="current"{/if}><a href="{'/admin/system'|url}">{'menuMenuHeader_system'|lang}</a></li>
</ul>
</div>
