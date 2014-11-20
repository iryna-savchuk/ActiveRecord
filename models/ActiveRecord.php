<?php

class ActiveRecord {

    public $className;
    protected $_db;
    protected $_tableName;

    /**
     * Constructor for creating a new object.
     * @param $id  - if no $id is given, creates an empty object;
     *             - if $id is specified, selects the corresponding record from the table and loads parametrs from it;
     *             - when no record found in the table, creates empty object filling in just $id argument.  
     */
    protected function __construct($id = null) {
        $this->className = get_class($this);
        $this->_db = DB::getInstance();
        $this->_tableName = strtolower($this->className);
        if (is_int($id)) {
            $this->load($id);
        } else {
            $this->id = $id;
        }
    }

    /**
     * Function to load data from table to object parametrs. Is used by __constructor.
     */
    private function load($id = null) {
        //$this->id = $id;
        $result = $this->_db->getRow("SELECT * FROM ?n WHERE id = ?i LIMIT 1", $this->_tableName, $id);
        if (empty($result)) {
            $this->id = $id;
            return;
        }
        foreach ($result as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Function to delete object.
     * @return true on success, false on failure
     */
    public function delete() {
        $id = $this->id;
        if (is_numeric($id)) {
            $result = $this->_db->query("DELETE FROM ?n WHERE id=?i", $this->_tableName, $id);
            if (!$result) {
                return false;
            }
            unset($this);
            return true;
        } else {
            unset($this);
            return true;
        }
    }

    /**
     * Function to save object in table: updates/creates corresponding table record. 
     * @return: true on successful save, false - on failure.
     */
    public function save() {
        $data = array(); //data to be saved
        $columns = $this->_db->getColumns($this->_tableName);
        foreach ($columns as $value) {
            $data[$value] = $this->$value;
        }
        try {
            $this->verifySave($data);
            $idsearch = $this->_db->getRow("SELECT * FROM ?n WHERE id = ?i LIMIT 1", $this->_tableName, $this->id);
            if (empty($idsearch)) {  // if the record doesn't exist, it should be created
                $sql = "INSERT INTO ?n SET ?u";
                $result = $this->_db->query($sql, $this->_tableName, $data);
                if (!$result) {
                    return false;
                }
                $this->id = $this->_db->insertId();
                return true;
            }
            $sql = "UPDATE ?n SET ?u WHERE id = ?i"; //if the record exists it should be updated
            $result = $this->_db->query($sql, $this->_tableName, $data, $this->id);
            if (!$result) {
                return false;
            }
            return true;
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    /**
     * Verifies data before saving. Is used by save().
     * @param array $data
     * @return true when $data is correct for saving
     * @throws Exception
     */
    private function verifySave($data = array()) {
        if (!(ctype_digit($this->id) || ($this->id) == null)) {
            throw new Exception("SAVING FAILED: Object ID is incorrect!");
        }
        $this->id = intval($this->id);
        foreach ($data as $key => $value) {
            if (empty($value) && ($key !== 'id')) {
                throw new Exception("SAVING FAILED: Oject contains some empty fields!");
            }
        }
        return true;
    }

    /**
     * Oveloading some nonexistent methods
     */
    public function __call($name, $arguments) {
        $method = substr($name, 0, 3);
        $field = strtolower(substr($name, 3));
        if ($method == 'get') {
            return $this->$field;
        }
        if ($method == 'set') {
            $this->$field = $arguments[0];
            return;
        }
    }

    /**
     * Function to get all records from table
     * @return array
     */
    public function getArrayOfAll() {
        $result = $this->_db->getAll("SELECT * FROM ?n", $this->_tableName);
        return $result;
    }

}
