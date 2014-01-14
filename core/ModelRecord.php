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
 * Class which map db table row to object implementation of ActiveRecord
 */
abstract class ModelRecord extends DataAggregator
{
    private $Model;
    private $_new = true;
    private $modifiedColumns = array();

    /**
     * Generates the standard ModelRecord object
     * @param array $data Row data - associated array
     * @param bollean $new is new instance, not loaded from database
     */
    public function __construct($data = false, $new = true)
    {
        parent::__construct($data);
        $modelName = substr(get_class($this), 0, -6); // "Record" length
        $this->Model = Model::factoryInstance($modelName);
        $this->_new = $new;
    }

    /**
     * Set field of active record
     * @param string $name Field name
     * @param string $value New value
     */
    public function __set($name, $value)
    {
        if (!isset($this->data[$name]) || $this->data[$name] != $value) {
            $this->data[$name] = $value;
            $this->modifiedColumns[$name] = true;
        }

        return $this;
    }

    /**
     * Load data from array into active record
     * @param array $data Associated array contain values
     * @param array|string $fields Filter - specify which data should be loaded from array
     */
    public function fromArray($data, $fields = false)
    {
        if ($fields) {
            if (is_string($fields)) {
                $fields = preg_split("#\s*,\s*#", $fields);
            }

            $data = array_intersect_key($data, array_combine($fields, $fields));
        }

        foreach ($data as $name => $value) {
            $this->__set($name, $value);
        }
    }

    /**
     * Magic php method to set active record field in $record->setFieldName() way
     * @param string $method Method name to execute set* or get*
     * @param string $params Params passed to function
     */
    public function __call($method, $params)
    {
        if (preg_match("#^set(.*)#i", $method, $m)) {
            return $this->__set($m[1], $params[0]);
        }

        if (preg_match("#^get(.*)#i", $method, $m)) {
            return $this->__get($m[1]);
        }

    }

    /**
     * Remove this active record/row from database
     */
    public function del()
    {
        $pk = $this->Model->getPrimaryKey();
        $c = new Criteria();
        $c->add($pk, $this->data[$pk]);
        $this->Model->del($c);
    }

    /**
     * Save this active record/row in database. UPDATE or INSERT basing on _new flag
     */
    public function save()
    {
        if ($this->_new) {
            $this->Model->insert($this->data);
            $pk = $this->Model->getPrimaryKey();
            if (!isset($this->data[$pk])) {
                $this->data[$pk] = $this->Model->getLastInsertId();
            }

            $this->_new = false;
        } else {
            $fields = array_intersect_key($this->data, $this->modifiedColumns);
            if ($fields) {
                $pk = $this->Model->getPrimaryKey();
                $c = new Criteria();
                $c->add($pk, $this->data[$pk]);
                $this->Model->update($fields, $c);
            }
        }

        $this->modifiedColumns = array();
    }

}
