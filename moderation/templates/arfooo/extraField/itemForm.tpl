{foreach from=$extraFields value=extraField}
<tr>
<td>{$extraField.name}
{if $extraField.required}<span class="text_color_mandatory">*</span>{/if}
</td>
<td>
{assign var="fieldName" value="extraField[$extraField.fieldId]"}
{if $extraField.type == "checkbox"} 
{assign var="fieldName" value=$fieldName|cat:'[]'}
{/if}
{switch from=$extraField.type}
{case value="textarea"}
<textarea name="{$fieldName}" class="{if $extraField.required}required{/if}"></textarea>
{case value="text"}
<input type="text" name="{$fieldName}" class="{if $extraField.required}required{/if}"/>
{case value="select"}
<select name="{$fieldName}" class="{if $extraField.required}required{/if}">
{foreach from=$extraField.options value=option}
<option value="{$option.value}">{$option.label}</option>
{/foreach}
</select>
{case value="radio"}
{foreach from=$extraField.options value=option}
<input type="radio" name="{$fieldName}" value="{$option.value}" class="{if $extraField.required}required{/if}"/> {$option.label}
{/foreach}
{case value="checkbox"}
{foreach from=$extraField.options value=option name=loop}
{if $templatelite.foreach.loop.iteration % 3 == 1}
{if $templatelite.foreach.loop.iteration != 1}
</p>
{/if}
<p class="form">
{/if}
<label class="infos_checkbox">
<input type="checkbox" name="{$fieldName}" value="{$option.value}" class="{if $extraField.required}required{/if}"/> {$option.label} 
</label>
{/foreach}
</p>
{case value="range"}
<input type="text" name="{$fieldName}" class="{if $extraField.required}required{/if}" size="5"/> 
{case}
{/switch}
{if $extraField.description}
<img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" class="aide" title="{$extraField.description}">    
{/if}
</td>
</tr>
{/foreach}