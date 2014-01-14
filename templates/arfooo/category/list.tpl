{if !empty($categoriesList)}
<div class="column_in">
{for start=0 stop=3 step=1 value=columnNr}
{if $categoriesList|@count > $columnNr}
    <div class="menucategories">
    <ul>
{for start=$columnNr stop=$categoriesList|@count step=3 value=i}{assign var=category value=$categoriesList[$i] }
      <li class="maincat">
{if $setting.categoriesImages}
        <img src="{"/uploads/images_categories/$category.imageSrc"|resurl}" alt="{$category.name}" class="category_image"/>
{/if}
        <a href="{$category|objurl:'category'}" title="{$category.name}">{$category.name}</a>
        <span class="text_numbers">({$category.validatedSitesCount})</span>
      </li>
{if !empty($category.subcategories)}
      <li class="subcat">
{foreach from=$category.subcategories value=subcategory}
        <a href="{$subcategory|objurl:'category'}" title="{$subcategory.name}">{$subcategory.name}</a>
{/foreach}
      </li>
{/if}

{/for}
    </ul>
    </div>
{/if}
{/for}
</div>
{/if}
