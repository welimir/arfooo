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
 * Class to co-operate with MySQL database.
 */
class Database extends Object
{
    private $dbHost;
    private $dbUser;
    private $dbPass;
    private $dbName;

    private $debug = false;
    private $lastInsertId;
    private $lastAffectedRows;
    private $queriesCnt = 0;
    private $queriesTime = 0;
    private static $instance = null;
    private $connected;

    /**
     * Returns an instance of Database object
     * @return Database
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function setDebug($value)
    {
        $this->debug = $value;
    }

    /**
     * Generates the standard Database object
     */
    public function __construct()
    {
        $this->dbHost = Config::get("DB_HOST");
        $this->dbUser = Config::get("DB_USER");
        $this->dbPass = Config::get("DB_PASS");
        $this->dbName = Config::get("DB_NAME");
    }

    /**
     * Connect to mysql server and selct database to use
     */
    public function connect()
    {
        if (!@mysql_connect($this->dbHost, $this->dbUser, $this->dbPass)) {
            echo mysql_error();
            trigger_error("<b>Can't connect to MySQL server</b></b>");
        }

        if (!@mysql_select_db($this->dbName)) {
            echo mysql_error();
            trigger_error("<b>Can't select database</b>");
        }
    }

    /**
     * Creates and executes UPDATE query
     * @return resource MySQL result resource
     */
    public function sqlUpdate($tabname, $vars, $where = "")
    {
        $sql = "UPDATE $tabname SET ";

        foreach ($vars as $key => $value) {
            if ($key{0} != "_") {
                $value = addslashes($value);
                $value = "'" . $value . "'";
            }

            $sql .= ltrim($key, "_") . "=" . $value . ", ";
        }

        $sql = substr($sql, 0, -2);

        if (!empty($where)) {
            $sql .= " WHERE $where";
        }

        $res = $this->sqlQuery($sql);

        return $res;
    }

    private function removeStartUnderscore($field)
    {
        return ltrim($field, "_");
    }

    /**
     * Creates and executes INSERT query
     * @return resource MySQL result resource
     */
    public function sqlInsert($tabname, $varsTab, $multi = false)
    {
        if (!$multi) {
            $varsTab = array($varsTab);
        }

        $sql = "INSERT INTO $tabname(";
        $sql .= implode(", ", array_map(array($this, "removeStartUnderscore"),
                                        array_keys($varsTab[0])));
        $sql .= ") VALUES";

        $rows = array();
        foreach ($varsTab as $vars) {
            $vals = array();
            foreach ($vars as $key => $val) {
                if ($key{0} != "_") {
                    $val = addslashes($val);
                    $val = "'" . $val . "'";
                }
                $vals[] = "$val";
            }

            $rows[] = "(" . implode(",", $vals) . ")";
        }

        $sql .= implode(", ", $rows);
        $res = $this->sqlQuery($sql);

        return $res;
    }

    /**
     * Creates and executes INSERT query - multi inserts in same time
     * @return resource MySQL result resource
     */
    public function sqlMultiInsert($tabname, $varsTab)
    {
        return $this->sqlInsert($tabname, $varsTab, true);
    }

    /**
     * Creates and executes DELETE query
     * @return resource MySQL result resource
     */
    public function sqlDelete($tabname, $where = "")
    {
        $sql = "DELETE FROM $tabname";
        if ($where) {
            $sql .= " WHERE $where";
        }
        $res = $this->sqlQuery($sql);
        return $res;
    }

    /**
     * Creates and execute SELECT query
     * @return resource MySQL result resource
     */
    public function sqlSelect($tabname, $arrWhat = "*", $where = "", $options = "", $joins = "")
    {
        if (is_array($tabname)) {
            $tabname = implode(", ", $tabname);
        }

        if (is_array($arrWhat)) {
            if (count($arrWhat)) {
                $what = implode(", ", $arrWhat);
            } else {
                $what = "*";
            }
        } else {
            $what = $arrWhat;
        }

        $sql = "SELECT $what FROM $tabname ";
        if (is_array($joins) && count($joins) == 2) {
            $sql .= " LEFT JOIN $joins[0] ON $tabname.$joins[1] = $joins[0].$joins[1]";
        }
        if (!empty($where)) {
            $sql .= " WHERE $where";
        }
        if (!empty($options)) {
            $sql .= " $options";
        }

        $res = $this->sqlQuery($sql);
        return $res;
    }

    /**
     * Executes custom query
     * @return resource MySQL result resource
     */
    public function sqlQuery($sql)
    {
        if (!$this->connected) {
            $this->connect();
            $this->connected = true;
            $this->sqlQuery("SET NAMES " . Config::get('DEFAULT_CHARSET'));
        }

        $startTime = microtime(true);
        $res = mysql_query($sql);
        $endTime = microtime(true);
        $queryTime = $endTime - $startTime;

        if ($this->debug) {
            echo sprintf("%f", $queryTime) . "<br>";
            echo "<b>" . $sql . "</b><br><br>";
        }

        $this->queriesCnt++;
        $this->queriesTime += $queryTime;

        Display::set("queriesCount", $this->queriesCnt);
        Display::set("queriesTime", $this->queriesTime);

        if (!$res) {
            echo $sql;
            $error = mysql_error();
            $errornr = mysql_errno();
            trigger_error("B³±d SQL $error ($errornr)");
        }

        $this->lastInsertId = mysql_insert_id();
        $this->lastAffectedRows = mysql_affected_rows();

        return $res;
    }

    /**
     * Get insert id from last query
     * @return int
     */
    public function insertID()
    {
        return $this->lastInsertId;
    }

    /**
     * Get affected rows count in last query
     * @return int
     */
    public function affectedRows()
    {
        return $this->lastAffectedRows;
    }

    /**
     * Get one row from MySQL result resource
     * @param resource MYSQL result resource
     * @return array
     */
    public function sqlFetchArray($res)
    {
        $row = mysql_fetch_assoc($res);
        return $row;
    }

    /**
     * Get numberer of rows in MySQL result resource
     * @param resource MYSQL result resource
     * @return int
     */
    public function sqlNumRows($res)
    {
        $count = mysql_num_rows($res);
        return $count;
    }

    /**
     * Get value from database
     * @param string $what field name or complete sql query
     * @param string $tabname table which shoulb be used to get value
     * @param string $where WHERE part of query
     * @param string $opt additional query options
     * @return string|boolean return value or false if not exists
     */
    public function sqlGet($what, $tabname = "", $where = "", $opt = "")
    {
        $sql = $what;
        if ($tabname != "") {
            $sql = "SELECT $what FROM $tabname";
        }
        if ($where != "") {
            $sql .= " WHERE $where";
        }
        if ($opt != "") {
            $sql .= " $opt";
        }

        $res = $this->sqlQuery($sql);
        if (mysql_num_rows($res) == 0) {
            return false;
        }

        if (mysql_num_fields($res) > 1) {
            return $this->sqlFetchArray($res);
        } else {
            return mysql_result($res, 0, 0);
        }
    }

    public function sqlGetRow($what, $tabname = "", $where = "", $opt = "")
    {
        $sql = $what;
        if ($tabname != "") {
            $sql = "SELECT $what FROM $tabname";
        }
        if ($where != "") {
            $sql .= " WHERE $where";
        }
        if ($opt != "") {
            $sql .= " $opt";
        }

        $res = $this->sqlQuery($sql);
        if (mysql_num_rows($res) == 0) {
            return false;
        }

        return $this->sqlFetchArray($res);
    }

    /**
     * Get all rows from database which will return query
     * @param string $what field name or complete sql query
     * @param string $tabname table which shoulb be used to get value
     * @param string $where WHERE part of query
     * @param string $opt additional query options
     * @return array
     */
    public function sqlGetAll($what, $tabname = "", $where = "", $opt = "")
    {
        $sql = $what;
        if ($tabname != "") {
            $sql = "SELECT $what FROM $tabname";
        }
        if ($where != "") {
            $sql .= " WHERE $where";
        }
        if ($opt != "") {
            $sql .= " $opt";
        }

        $out = array();
        $res = $this->sqlQuery($sql);
        while ($row = $this->sqlFetchArray($res)) {
            $out[] = $row;
        }
        return $out;
    }

    /**
     * Get rows count which match to query
     * @param string $tabname table to use
     * @param string $where WHERE part of query
     * @return int
     */
    public function sqlCount($tabname, $where = "")
    {
        $sql = "SELECT count(*) as cnt FROM $tabname";
        if ($where != "") {
            $sql .= " WHERE $where";
        }

        $res = $this->sqlQuery($sql);
        $row = $this->sqlFetchArray($res);
        $cnt = intval($row['cnt']);

        return $cnt;
    }

    /**
     * Get total number of executed queriee
     * @return int
     */
    public function getQueriesCnt()
    {
        return $this->queriesCnt;
    }

    public function getLastInsertId()
    {
        return $this->lastInsertId;
    }

    public function getTotalQueriesCount()
    {
        return $this->queriesCnt;
    }

    public function getTotalQueriesTime()
    {
        return $this->queriesTime;
    }
}
