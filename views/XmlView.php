<?php
//////////////////////////////////////////////////////////////////////////////////
//    					 copyright (c) Arfooo Annuaire                          //
//   				 by Hocine Guillaume (c) 2007 - 2008                        //
//       					http://www.arfooo.com/                              //
//    Licence Creative Commons http://creativecommons.org/licenses/by/2.0/fr/   //
//////////////////////////////////////////////////////////////////////////////////


class XmlView extends View
{
    function render($controller)
    {
        header('Content-type: text/xml');
        $doc = $controller->viewVars['doc'];
        return $doc->saveXML();
    }
}
