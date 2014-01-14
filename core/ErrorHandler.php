<?php
/**
 * Arfooo
 * 
 * @package    Arfooo
 * @copyright  Copyright (c) Arfooo Annuaire (fr) and Arfooo Directory (en)
 *             by Guillaume Hocine (c) 2007 - 2010
 *             http://www.arfooo.com/ (fr) and http://www.arfooo.net/ (en)
 * @author     Guillaume Hocine & Adrian Galewski
 * @license    http://creativecommons.org/licenses/by/2.0/fr/ Creative Commons
 */


/**
 * Class to handle execution errors
 */
class ErrorHandler
{
    private static $instance = null;

    protected $options = array(
        'saveToFile'   => true,
        'displayError' => true);

    /**
     * Returns an instance of Session object
     * @return Session
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Error handling start
     */
    public function __construct()
    {
        set_error_handler(array($this, "handler"));
    }

    public function setOption($key, $value)
    {
        $this->options[$key] = $value;
    }

    /**
     * Show execution stack
     */
    private static function showDebugBacktrace()
    {
        $s = '';
        $MAXSTRLEN = 64;

        $s = '<pre align=left style="font-size:13px;">';
        $traceArr = debug_backtrace();
        array_shift($traceArr);
        array_shift($traceArr);
        $traceArr = array_reverse($traceArr);
        $tabs = 0;

        foreach ($traceArr as $arr) {
            for ($i = 0; $i < $tabs; $i++) {
                $s .= '&nbsp; ';
            }
            $s .= "";
            $tabs++;
            $s .= '<font face="Courier New,Courier">';
            if (isset($arr['class'])) {
                $s .= "<font color=yellow><b>" . $arr['class'] . '</b></font><font color=#AAAAAA>-></font>';
            }
            $args = array();
            if (!empty($arr['args'])) {
                foreach ($arr['args'] as $v) {
                    if (is_null($v)) {
                        $args[] = 'null';
                    }
                    else
                        if (is_array($v)) {
                            $args[] = 'Array[' . sizeof($v) . ']';
                        } else {
                            if (is_object($v)) {
                                $args[] = 'Object:' . get_class($v);
                            }
                            else {
                                if (is_bool($v)) {
                                    $args[] = $v ? 'true' : 'false';
                                }
                                else {
                                    $v = (string) @$v;
                                    $str = htmlspecialchars(substr($v, 0, $MAXSTRLEN));
                                    if (strlen($v) > $MAXSTRLEN) {
                                        $str .= '...';
                                    }
                                    $args[] = "\"" . $str . "\"";
                                }
                            }
                        }
                }
            }
            $color = isset($arr['class']) ? "#FFFFFF" : "#00FF00";
            $s .= '<font color=' . $color . '>' . $arr['function'] . '</font><font color=#AAAAAA>(</font><font color=#9BAFFF>' . implode(', ', $args) . '</font><font color=#AAAAAA>)</font>';
            $Line = (isset($arr['line']) ? $arr['line'] : "unknown");
            $File = (isset($arr['file']) ? $arr['file'] : "unknown");
            $s .= sprintf("<font color=#AAAAAA size=-1> # line %4d, file: <font color=#ABCCDD>%s</font>", $Line, $File);
            $s .= "\n";
        }
        $s .= '</pre>';
        return $s;
    }

    /**
     * Handler function used by set_error_handler
     */
    public function handler($errno, $errstr, $errfile, $errline, $cont)
    {
        $errorReporting = error_reporting(E_ALL);
        error_reporting($errorReporting);

        if (($errorReporting & $errno) == 0) {
            return;
        }

        $hour = date("G:i");
        $day = date("j-n-y");
        $s = '';
        $s .= "<b>" . $_SERVER['REQUEST_URI'] . "</b><br>";
        if (isset($_SERVER['HTTP_REFERER'])) {
            $s .= $_SERVER['HTTP_REFERER'] . "<br>";
        }
        $s .= '<table border=1 cellpadding=6 cellspacing=0>';
        $s .= "<tr><td style=\"font-family:Tahoma; font-size: 13px; background-color: #FFCCCC\">&nbsp; <b> ($errno) $errstr</b> &nbsp; " . basename($errfile) . " &nbsp; line  <b>$errline</b> &nbsp; &nbsp; $day &nbsp; <b>$hour</b> </td></tr>";
        $s .= '<tr><td style="background-color:#000000">';
        $s .= $this->showDebugBacktrace();
        $s .= '</td></tr>';
        $s .= '</table><br>';

        if (!empty($this->options['displayError'])) {
            echo $s;
        }

        if (!empty($this->options['saveToFile'])) {
            $fp = @fopen(CODE_ROOT_DIR . 'save/error.html', 'a');
            if ($fp) {
                fwrite($fp, $s);
                fclose($fp);
            }
        }

        exit();
    }
}
