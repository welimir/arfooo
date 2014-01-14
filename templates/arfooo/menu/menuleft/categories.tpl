{if !empty($categories)}
<div class="menuleft">
<ul>
<li class="header">{'menuleftCategories_categories'|lang}</li>
{foreach from=$categories value=category}
<li><a href="{$category|objurl:'category'}" title="{$category.name}">{$category.name}</a></li>
{/foreach}
<li class="text_last"></li>
</ul>
</div>
{/if}