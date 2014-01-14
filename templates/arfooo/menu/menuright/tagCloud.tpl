{if !empty($tags)}
<div class="menuright">
<ul>
<li class="header">{'menurightTagCloud_tag_cloud'|lang}</li>
{foreach from=$tags value=tag}
<li class="cloudTag{$tag.size}"><a href="{$tag|objurl:'tag'}">{$tag.tag}</a></li>
{/foreach}
<li class="text_last"></li>
</ul>
</div>
{/if}
