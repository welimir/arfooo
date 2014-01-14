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
<textarea name="{$fieldName}" class="extraField_textarea {if $extraField.required}required{/if}"></textarea>
{case value="text"}
<input type="text" name="{$fieldName}" class="extraField_text {if $extraField.required}required{/if}"/>
{case value="select"}
<select name="{$fieldName}" class="extraField_select {if $extraField.required}required{/if}">
<option value="">{'extraFieldItemForm_select_option'|lang}</option>
{foreach from=$extraField.options value=option}
<option value="{$option.value}">{$option.label}</option>
{/foreach}
</select>
{case value="radio"}
{foreach from=$extraField.options value=option}
<input type="radio" name="{$fieldName}" value="{$option.value}" class="extraField_radio {if $extraField.required}required{/if}"/> {$option.label}
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
<input type="checkbox" name="{$fieldName}" value="{$option.value}" class="extraField_checkbox {if $extraField.required}required{/if}"/> {$option.label}
</label>
{/foreach}
</p>
{case value="range"}
<input type="text" name="{$fieldName}" class="extraField_range {if $extraField.required}required{/if}" size="5"/>
{case value="url"}
{'extraFieldItemForm_url'|lang}<br />
<input type="text" name="{$fieldName}[url]" class="extraField_url_url {if $extraField.required}required{/if}" />
{if $extraField.config.anchor}
<br />
{'extraFieldItemForm_anchor_text'|lang}<br />
<input type="text" name="{$fieldName}[anchor]" class="extraField_url_anchor" />
{/if}
{case value="file"}
<span class="extraField_file_manage_area">
<input type="hidden" class="extraField_file_fileSrc {if $extraField.required}required{/if}" name="{$fieldName}[fileSrc]" />
<input type="hidden" class="extraField_file_fieldId" name="{$fieldName}[fileId]" value="{$extraField.fieldId}" />
{'extraFieldItemForm_file'|lang} ({$extraField.config.extensions})<br />
<input type="file" class="extraField_file_file" onchange="$(this).prevAll('.extraField_file_fileSrc').val('selected');" name="{$fieldName|replace:'[':'_'|replace:']':'_'}file" />
<br />
{'extraFieldItemForm_file_title'|lang}<br />
<input type="text" name="{$fieldName}[title]" class="extraField_file_title"  />

<a href="" class="extraField_file_download_link" style="display:none;">See file</a>
<a href="" class="extraField_file_delete_link"  style="display:none;">Delete</a>
</span>
<br />
{case}
{/switch}
{if $extraField.suffix}
{$extraField.suffix}
{/if}
{if $extraField.description}
<img src="{"/templates/$templateName/images/icone_info.gif"|resurl}" class="aide" title="{$extraField.description}">    
{/if}
</td>
</tr>
{/foreach}