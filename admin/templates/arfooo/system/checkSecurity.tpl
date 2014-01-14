{if $installDirExists || $newVersionAvailable}
    <div id="column_in_warning_out">
    {if $newVersionAvailable}
        <div class="column_in_warning">
        {'systemCheckSecurity_desc1'|lang}
        {'systemCheckSecurity_desc2'|lang}
    </div>
    {/if}
    {if $installDirExists}
        <div class="column_in_warning">
        {'systemCheckSecurity_install_dir'|lang}
        </div>
    {/if}
    </div>
{/if}