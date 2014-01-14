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
 * Class which is object representation of SQL query
 */
class Criteria extends DataAggregator
{
    private $limit;
    private $offset;
    private $joins = array();
    private $innerJoins = array();
    private $leftJoins = array();
    private $conditions = array();
    private $orders = array();
    private $havings = array();
    private $groups = array();
    public $keyArray = false;
    private $modelMap = array();
    private $columns = array();
    private $tables = array();
    private $calcFoundRows = false;

    /**
     * Add WHERE rule
     *
     * @param string $key         Name of field
     * @param string $value       Value of field
     * @param string $comparison  Comparistion which shoul be used
     * @param string $conjunction Conjunction which shoul be used
     * @return Criteria
     */
    public function add($key, $value = null, $comparison = "=", $conjunction = "AND")
    {
        $this->conditions[] = array("key" => $key,
                                    "value" => $value,
                                    "comparison" => $comparison,
                                    "conjunction" => $conjunction);

        return $this;
    }

    /**
     * Add complete condition
     * @param array $condition Condition array contain key, value, comparison, conjunction
     * @return Criteria
     */
    public function addCondition($condition)
    {
        $this->conditions[] = $condition;
        return $this;
    }

    /**
     * Add WHERE rule with OR conjunction
     *
     * @param string $key         Name of field
     * @param string $value       Value of field
     * @param string $comparison  Comparistion which shoul be used
     * @return Criteria
     */
    public function addOr($key, $value = null, $comparison = "=")
    {
        return $this->add($key, $value, $comparison, "OR");
    }

    /**
     * Add joined tables to query
     *
     * @param string $tableName1 Name of first joined table
     * @param string $tableName2 Name of second joined table
     * @return Criteria
     */
    public function addJoin($tableName1, $tableName2)
    {
        $this->addTable($tableName1);
        $this->addTable($tableName2);
        $this->joins[] = array($tableName1,
        $tableName2);
        return $this;
    }

    /**
     * Add table with INNER JOIN
     *
     * @param string $tableName Name of added table
     * @param string $field1 Full field name (table.field) in relation from base table
     * @param string $field2 Full field name (table.field) in relation from added table
     * @return Criteria
     */
    public function addInnerJoin($tableName, $field1, $field2)
    {
        $prefix = Config::get("DB_PREFIX");
        $parts = preg_split("#\s+#", $tableName);
        $parts[0] = strtolower($parts[0]);
        $this->innerJoins[] = array(
        $prefix . implode(" ", $parts),
        Criteria::addPrefixToValueName($field1),
        Criteria::addPrefixToValueName($field2));
        return $this;
    }

    public function addLeftJoin($tableName, $field1, $field2)
    {
        $prefix = Config::get("DB_PREFIX");
        $this->leftJoins[] = array(
        $prefix . strtolower($tableName),
        Criteria::addPrefixToValueName($field1),
        Criteria::addPrefixToValueName($field2));
        return $this;
    }

    /**
     * Add order to criteria
     *
     * @param string $order Order
     * @return Criteria
     */
    public function addOrder($order)
    {
        $this->orders[] = $this->addPrefixToValueName($order);
        return $this;
    }

    /**
     * Add column to criteria
     *
     * @param string $column Column
     * @return Criteria
     */
    public function addColumn($column)
    {
        $this->columns[] = $column;
        return $this;
    }

    /**
     * Add table to criteria
     *
     * @param string $table Table
     * @return Criteria
     */
    public function addTable($table)
    {
        $table = Config::get("DB_PREFIX") . $table;

        if (!in_array($table, $this->tables)) {
            $this->tables[] = $table;
        }
        return $this;
    }

    /**
     * Add having to criteria
     *
     * @param string $having Having
     * @return Criteria
     */
    public function addHaving($having)
    {
        $this->havings[] = $having;
        return $this;
    }

    /**
     * Add group to criteria
     *
     * @param string $group Group
     * @return Criteria
     */
    public function addGroup($group)
    {
        $this->groups[] = $group;
        return $this;
    }

    /**
     * Set LIMIT of results
     *
     * @param int $limit Limit
     * @return Criteria
     */
    public function setLimit($limit)
    {
        $this->limit = intval($limit);
        return $this;
    }

    /**
     * Set OFFSET of results
     *
     * @param int $offset Offset
     * @return Criteria
     */
    public function setOffset($offset)
    {
        $this->offset = intval($offset);
        return $this;
    }

    public function getCondition($key)
    {
        foreach ($this->conditions as $condition) {
            if ($condition['key'] == $key) {
                return $condition;
            }
        }

        return false;
    }

    public static function replaceCallback($m)
    {
        $prefix = Config::get("DB_PREFIX");
        return $prefix . strtolower($m[1]);
    }

    public static function addPrefixToValueName($value)
    {
        $prefix = Config::get("DB_PREFIX");

        if ($prefix && strpos($value, ".") !== false) {
            $value = preg_replace_callback("#(\w+\.)#", array("Criteria",
                                                              "replaceCallback"),
                                           $value);
        }

        return $value;
    }

    public function setCalcFoundRows($value)
    {
        $this->calcFoundRows = $value;
    }

    public function getCalcFoundRows()
    {
        return $this->calcFoundRows;
    }

    public function setPagination($page, $resultsPerPage)
    {
        if (empty($page) || $page < 1) {
            $page = 1;
        }
        $this->setLimit($resultsPerPage);
        $this->setOffset(($page - 1) * $resultsPerPage);
    }

    /**
     * Converts inner values to SQL query
     *
     * @return string
     */

    public function prepareQuery()
    {
        $joins = array();
        $where = "";
        $sql = "";

        if (!empty($this->columns) && !empty($this->tables)) {
            $sql .= "SELECT ";

            if ($this->calcFoundRows) {
                $sql .= "SQL_CALC_FOUND_ROWS ";
            }

            $sql .= implode(",", $this->columns) . " FROM " . implode(",", $this->tables);
        }

        foreach ($this->joins as $joinTable) {
            $mapKeys = $this->modelMap[$joinTable[0]][$joinTable[1]];
            $joins[] = $joinTable[0] . "." . $mapKeys['local'] . "=" . $joinTable[1] . "." . $mapKeys['foreign'];
        }

        foreach ($this->innerJoins as $join) {
            $sql .= " INNER JOIN " . $join[0] . " ON " . $join[1] . " = " . $join[2];
        }

        foreach ($this->leftJoins as $join) {
            $sql .= " LEFT JOIN " . $join[0] . " ON " . $join[1] . " = " . $join[2];
        }

        foreach ($this->conditions as $condition) {
            $key = $condition['key'];

            if ($key instanceof Criteria) {
                $key = $key->prepareQuery();
                if ($key) {
                    $key = "(" . $key . ")";
                }
            }

            if (!empty($where) && $key) {
                $where .= " " . $condition['conjunction'] . " ";
            }

            if ($condition['value'] === null) {
                $where .= $key;
            } else {
                //prevent injections
                $condition['value'] = is_array($condition['value']) ? array_map("addslashes", $condition['value']) : addslashes($condition['value']);

                if ($condition['comparison'] == "IN") {
                    $where .= self::addPrefixToValueName($key) . " IN (";

                    if (!is_array($condition['value'])) {
                        $condition['value'] = array($condition['value']);
                    }

                    $where .= "'" . implode("','", $condition['value']) . "'";
                    $where .= ") ";
                } else {
                    $where .= self::addPrefixToValueName($key) . " " . $condition['comparison'] . " '" . $condition['value'] . "' ";
                }
            }
        }

        if ($joins) {
            if ($where) {
                $where .= " AND ";
            }
            $where .= implode(" AND ", $joins);
        }

        if ($where) {
            if ($sql) {
                $sql .= " WHERE ";
            }
            $sql .= $where;
        }

        if ($this->groups) {
            $sql .= " GROUP BY " . implode(", ", $this->groups);
        }
        if ($this->havings) {
            $sql .= " HAVING " . implode(" AND ", $this->havings);
        }
        if ($this->orders) {
            $sql .= " ORDER BY " . implode(", ", $this->orders);
        }
        if ($this->limit !== null) {
            $sql .= " LIMIT $this->limit";
        }
        if ($this->offset !== null) {
            $sql .= " OFFSET $this->offset";
        }

        return $sql;
    }
}
