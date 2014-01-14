<div class="menuleft_text_2">
{'menuleftKeywords_keywords'|lang}
</div>
<div class="menuleft_text_keywords">

{foreach from=$keywordParts value=keywordPart}
    <div class="menuleft_keywords">
    <ul>
    {foreach from=$keywordPart value=keyword}
        <li><a href="{"/keyword/show/$keyword.letter"|url}" title="{$keyword.letter}">{$keyword.letter}</a><span class="text_numbers"> ({$keyword.counter})</span></li>
    {/foreach}
    </ul>
    </div>
{/foreach}
           
</div>