{if empty($edit)}
<div class="search_cat_place">
<span class="text_search">{'extraFieldSearch_category'|lang}</span>
<select name="categoryId" id="searchEngineCategoryId">
<option value="0">{'extraFieldSearch_all_categories'|lang}</option>
{foreach from=$searchCategories value=searchCategory}
<option class="selectCategory" value="{$searchCategory.categoryId}" {if $searchCategory.categoryId==$categoryId}selected="selected"{/if}>{$searchCategory.name}</option>
{foreach from=$searchCategory.subcategories value=subcategory}
<option class="selectSubcategory" value="{$subcategory.categoryId}" {if $subcategory.categoryId == $categoryId}selected="selected"{/if}>    &nbsp;&nbsp;&nbsp; {$subcategory.name}</option>
{/foreach}
<option class="space" value=""></option>
{/foreach}
</select>
</div>

<div class="din_search_engine">&nbsp;
{/if}

    
{if !empty($extraFields)}
<style>
{literal}
.searchModule
{
padding: 0px 5px;
width: 200px;
line-height: 1.8;
position: absolute;
}

{/literal}
</style>
{if empty($edit)}<div style="position:relative">{/if}


{foreach from=$extraFields value=extraField}

{if !empty($searchEngineSettings.fields[$extraField.fieldId])}
{assign var="fieldSetting" value=$searchEngineSettings.fields[$extraField.fieldId]}
{else}
{assign var="fieldSetting" value=""}
{/if}

{if !empty($edit) || !empty($fieldSetting.display)}

<div class="searchModule" fieldId="{$extraField.fieldId}" style="{if $fieldSetting}left: {$fieldSetting.left}px; top: {$fieldSetting.top}px; width: {$fieldSetting.width}px; height: {$fieldSetting.height}px;{/if}{if empty($fieldSetting) || empty($fieldSetting.display)}display:none;{/if}">
<span class="text_search">{$extraField.name}</span>
<div>
{assign var="fieldName" value="extraField[$extraField.fieldId]"}
{if $extraField.type == "checkbox"} 
{assign var="fieldName" value=$fieldName|cat:'[]'}
{/if}
{switch from=$extraField.type}
{case value="textarea"}
<input type="text" name="{$fieldName}"/>
{case value="text"}
<input type="text" name="{$fieldName}"/>
{case value="select"}
<select name="{$fieldName}">
<option value="">{'extraFieldSearch_select_option'|lang}</option>
{foreach from=$extraField.options value=option}
<option value="{$option.value}">{$option.label}</option>
{/foreach}
</select>
{case value="radio"}
{foreach from=$extraField.options value=option}
<input type="radio" name="{$fieldName}" value="{$option.value}"/> {$option.label}
{/foreach}
{case value="checkbox"}
{foreach from=$extraField.options value=option name=loop}
<span style="width:100px;display:block;float:left"><input type="checkbox" name="{$fieldName}" value="{$option.value}"/> {$option.label}</span>

{/foreach}
{case value="range"}
{'extraFieldSearch_from'|lang} <input type="text" name="{$fieldName}[from]" size="5"/> &nbsp;
{'extraFieldSearch_to'|lang} <input type="text" name="{$fieldName}[to]" size="5"/>
{case}
{/switch}
</div>
<div style="clear:both"></div>
</div>
{/if}
{/foreach}
{/if}
{if empty($edit)}</div>{/if}