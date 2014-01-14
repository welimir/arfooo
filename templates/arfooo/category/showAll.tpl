{include file="includes/header.tpl" title="{'categoryShowAll_html_title'|lang}" metaDescription="{'categoryShowAll_meta_description'|lang}" includeSearchEngine=true} 

<div class="show_arbo"> 
<a href="{$setting.siteRootUrl}" class="link_showarbo">{'show_arbo_directory'|lang}</a> &gt;
<a href="{'/category/showAll'|url}" class="link_showarbo">{'categoryShowAll_categories'|lang}</a>
</div>

<div class="title_h_1"> 
<h1>{'categoryShowAll_h1'|lang}</h1>
</div>

<div class="column_in"> 
{foreach from=$allCategories value=category}
    {foreach from=$category.parents value=parent}
        <a href="{$parent|objurl:'category'}" class="link_black_grey_bold">{$parent.name}</a> <span class="text_numbers">({$parent.validatedSitesCount})</span> &gt;
    {/foreach}
    <a href="{$category|objurl:'category'}" class="link_black_grey_bold">{$category.name}</a> <span class="text_numbers">({$category.validatedSitesCount})</span> <br /> 
{/foreach}
</div>
               
{include file="includes/footer.tpl"} 