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
 * Class which map db table to object
 */
abstract class Model extends Object
{
    protected $dbTable;
    protected $primaryKey = "id";
    protected $name;
    protected $lastInsertId;
    protected $foundRows;
    /**
     * @var Database
     */
    protected $db;

    /**
     * Singleton instances - one per language
     */
    private static $instances = array();

    /**
     * Returns an instance of model passed in parameter
     * @param string $className Model to return
     * @return mixed
     */
    public static function factoryInstance($className)
    {
        $className = ucfirst($className . "Model");

        if (!isset(self::$instances[$className])) {
            self::$instances[$className] = new $className();
        }

        return self::$instances[$className];
    }

    /**
     * Generates the standard Model object
     */
    public function __construct()
    {
        $this->db = Database::getInstance();

        if (!$this->name) {
            $this->name = substr(get_class($this), 0, -5); // "Model" length
        }

        if (!$this->dbTable) {
            $this->dbTable = strtolower($this->name) . "s";
        }
    }

    public function __get($name)
    {
        $this->$name = Model::factoryInstance($name);
        return $this->$name;
    }

    /**
     * Get primary key for Model table
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    /**
     * Find row in database and return it
     * @param Criteria $criteria Criteria object contain search filters
     * @param string $fields Row fields which will be returned
     * @return ModelRecord
     */
    public function find(Criteria $criteria, $fields = "*")
    {
        $fields = Criteria::addPrefixToValueName($fields);

        $sql = $this->prepareCriteriaQuery($criteria, $fields);
        $itemData = $this->db->sqlGetRow($sql);

        return $this->populateObject($itemData);
    }

    /**
     * Convert association array to ModelRecord object
     * @param array $data array which will be converted
     * @return ModelRecord
     */
    protected function populateObject($data)
    {
        if (empty($data)) {
            return false;
        }
        $cls = $this->name . "record";
        $record = new $cls($data, false);
        return $record;
    }

    /**
     * Find row in database basing on primary key
     * @param int $key Primary Key value
     * @param string $fields Row fields which will be returned
     * @return ModelRecord
     */
    public function findByPk($key, $fields = "*")
    {
        $c = new Criteria();
        $c->add($this->primaryKey, $key);
        return $this->find($c, $fields);
    }

    /**
     * Find all rows row in database matching criteria and return it
     * @param Criteria $criteria Criteria object contain search filters
     * @param string $fields Row fields which will be returned
     * @return array
     */
    public function findAll(Criteria $criteria = null, $fields = "*", $returnModelRecords = false)
    {
        $fields = Criteria::addPrefixToValueName($fields);

        if (!$criteria) {
            $criteria = new Criteria();
        }
        $sql = $this->prepareCriteriaQuery($criteria, $fields);

        $results = $this->db->sqlGetAll($sql);

        if ($criteria->getCalcFoundRows()) {
            $this->saveFoundRowsCount();
        }

        if (empty($results)) {
            return array();
        }
        if (!$returnModelRecords) {
            return $results;
        }

        $modelRecords = array();

        foreach ($results as $data) {
            if ($criteria->keyArray) {
                $pk = $data[$this->getPrimaryKey()];
                $modelRecords[$pk] = $this->populateObject($data);
            } else {
                $modelRecords[] = $this->populateObject($data);
            }
        }

        return $modelRecords;
    }

    /**
     * Get count of rows which match critera
     * @param Criteria $criteria Filter criteria
     * @return mixed
     */
    public function getCount(Criteria $criteria = null)
    {
        if (!$criteria) {
            $criteria = new Criteria();
        }
        $sql = $this->prepareCriteriaQuery($criteria, "count(*) as cnt");
        return intval($this->db->sqlGet($sql));
    }

    /**
     * Delete row with primary key equal $key
     * @param int $key Primary key of record
     */
    public function delByPk($key)
    {
        $c = new Criteria();
        $c->add($this->primaryKey, $key);
        $this->del($c);
    }

    /**
     * Delete rows which match to criteria
     * @param Criteria $c Criteria filter
     */
    public function del(Criteria $c)
    {
        if (!$c) {
            $c = new Criteria();
        }
        $where = $c->prepareQuery();
        $prefix = Config::get("DB_PREFIX");
        $this->db->sqlDelete($prefix . $this->dbTable, $where);
    }

    /**
     * Insert new row to table
     * @param array $data Row data
     */
    public function insert($data)
    {
        $prefix = Config::get("DB_PREFIX");
        $this->db->sqlInsert($prefix . $this->dbTable, $data);
        $this->lastInsertId = $this->db->getLastInsertId();
    }

    /**
     * Updata table row matched Criteria
     * @param array $data Row data
     * @param Criteria $c
     */
    public function update($data, Criteria $c)
    {
        if (empty($c)) {
            $c = new Criteria();
        }
        $where = $c->prepareQuery();
        $prefix = Config::get("DB_PREFIX");
        $this->db->sqlUpdate($prefix . $this->dbTable, $data, $where);
    }

    /**
     * Update table row which have primary key equal to $key
     * @param array $data Row data
     * @param int|string $key
     */
    public function updateByPk($data, $key)
    {
        $c = new Criteria();
        $c->add($this->primaryKey, $key);
        $this->update($data, $c);
    }

    /**
     * Get field value from row which matched criteria
     * @param string $what Field Name
     * @param Criteria $c
     * @return mixed
     */
    public function get($what, Criteria $c = null)
    {
        if (!$c) {
            $c = new Criteria();
        }
        $where = $c->prepareQuery();
        $prefix = Config::get("DB_PREFIX");
        return $this->db->sqlGet($what, $prefix . $this->dbTable, $where);
    }

    /**
     * Generate association array where keys are primary keys asn values is $field Field
     * @param Criteria $c
     * @param string $field Field name
     */
    public function getArray(Criteria $c = null, $field, $key = null, $wholeRow = false)
    {
        if (!$c) {
            $c = new Criteria();
        }
        if ($key === null) {
            $key = $this->primaryKey;
        }

        $fields = $field;

        if ($fields != "*" && $key) {
            $fields .= ", " . $key;
        }

        $rows = $this->findAll($c, $fields);

        $results = array();

        $key = preg_replace("#.+\.#", "", trim($key, "`"));
        $field = preg_replace("#.+\.#", "", trim($field, "`"));

        foreach ($rows as $row) {
            $value = $wholeRow ? $row : $row[$field];

            if ($key) {
                $results[$row[$key]] = $value;
            } else {
                $results[] = $value;
            }
        }

        return $results;
    }

    /**
     * Convert criteria to SQL representation
     * @param  Criteria $criteria
     * @param  string fields
     * @return string SQL query
     */
    public function prepareCriteriaQuery(Criteria $criteria, $fields = "*")
    {
        $c = new Criteria();
        $c = clone $criteria;
        $c->addColumn($fields);
        $c->addTable($this->dbTable);

        $sql = $c->prepareQuery();
        return $sql;
    }

    public function getLastInsertId()
    {
        return $this->lastInsertId;
    }

    protected function saveFoundRowsCount()
    {
        $this->foundRows = $this->db->sqlGet("SELECT FOUND_ROWS()");
    }

    public function getFoundRowsCount()
    {
        return $this->foundRows;
    }

    public function truncate()
    {
        $this->db->sqlQuery("TRUNCATE " . Config::get("DB_PREFIX") . $this->dbTable);
    }

}
