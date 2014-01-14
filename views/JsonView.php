<?php
//////////////////////////////////////////////////////////////////////////////////
//    					 copyright (c) Arfooo Annuaire                          //
//   				 by Hocine Guillaume (c) 2007 - 2008                        //
//       					http://www.arfooo.com/                              //
//    Licence Creative Commons http://creativecommons.org/licenses/by/2.0/fr/   //
//////////////////////////////////////////////////////////////////////////////////


class JsonView extends View
{
    public static function php2js($a)
    {
        if (function_exists('json_encode')) {
            if ($a instanceof ArrayAccess) {
                return json_encode($a->toArray());
            } else {
                return json_encode($a);
            }
        }

        if (is_null($a)) {
            return 'null';
        }
        if ($a === false) {
            return 'false';
        }
        if ($a === true) {
            return 'true';
        }
        if (is_scalar($a)) {
            $a = addslashes($a);
            $a = str_replace("\n", '\n', $a);
            $a = str_replace("\r", '\r', $a);
            $a = preg_replace('{(</)(script)}i', "$1'+'$2", $a);
            return '"' . $a . '"';
        }
        $isList = true;
        for ($i = 0, reset($a); $i < count($a); $i++, next($a))
            if (key($a) !== $i) {
                $isList = false;
                break;
            }
        $result = array();
        if ($isList) {
            foreach ($a as $v) {
                $result[] = self::php2js($v);
            }
            return '[ ' . join(', ', $result) . ' ]';
        } else {
            foreach ($a as $k => $v) {
                $result[] = self::php2js($k) . ': ' . self::php2js($v);
            }
            return '{ ' . join(', ', $result) . ' }';
        }
    }

    public function render($controller)
    {
        return self::php2js($controller->viewVars);
    }
}
