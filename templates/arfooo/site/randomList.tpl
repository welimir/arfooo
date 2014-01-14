{foreach from=$randomSites value=site}
    <a href="{$site|objurl:'siteDetails'}" title="{$site.siteTitle}" >
    <img alt="{$site.siteTitle}" src="{$site.imageSrc}" class="random_image" />
    </a> 
{/foreach}