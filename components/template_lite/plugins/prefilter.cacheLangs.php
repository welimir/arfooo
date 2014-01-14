<?php

function cacheLangs($tpl_source, &$smarty)
{ 
    return AppTemplateLiteView::preFilterLang($tpl_source);
}
    
?>