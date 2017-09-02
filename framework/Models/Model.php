<?php
namespace InstaRouter\Model;

use InstaRouter\Database\Worker;

class Model {

    public $table;
    public $editables = array();
    public $conn;
    public $schema = '';
    public $collection = array();

    public function __construct()
    {
        $worker = new Worker;
        $this->conn = $worker->conn;
    }

    public function getModel($id)
    {
        $this->where('id', '=', $id)->select();
    }

    public function create($array)
    {
        $insertSchema = "";
        $valueSchema = "";
        $i = 0;

        $array = array_filter($array, function($index)
        {
            return array_search($index, $this->editables) > -1;
        }, ARRAY_FILTER_USE_KEY);

        foreach($array as $index => $item)
        {
            if($i < count($array) - 1)
            {
                $insertSchema .= $index . ', ';
                $valueSchema .= "'" . $item . "', ";
            } else {
                $insertSchema .= $index;
                $valueSchema .= "'" . $item . "'";
            }
            $i++;
        }

        $sql = "INSERT INTO " . $this->table . " (" . $insertSchema . ")
            VALUES (" . $valueSchema . ")";

        if ($this->conn->query($sql) === TRUE) {
            return $array;
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    public function parseSchema($array)
    {
        $schema = '';
        $i = 0;
        foreach($array as $index => $item)
        {
            if($i < count($array) - 1)
            {
                $schema .= $index . "= '" . $item . "', ";

            } else {
                $schema .= $index . "= '" . $item . "'";
            }
            $i++;
        }
        return $schema;
    }

    public function select($mode = null)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE " . $this->schema;
        $result = $this->conn->query($sql);

        switch ($result->num_rows)
        {
            case 0:
                return false;
                break;
            case 1:
                // get result as array even if it has 1 element
                if($mode == "array")
                {
                    while($row = $result->fetch_assoc())
                    {
                        array_push($this->collection, $row);
                    }
                    return $this->collection;
                    break;
                }
                return $result->fetch_assoc();
                break;
            default:
                while($row = $result->fetch_assoc())
                {
                    array_push($this->collection, $row);
                }
                return $this->collection;
        }
    }

    public function where($valueA, $operand, $valueB)
    {
        if($this->schema == "")
        {
            $this->schema .= $valueA . $operand . "'" . $valueB . "'";
        } else {
            $this->schema .= " AND " . $valueA . $operand . "'" . $valueB . "'";
        }
        return $this;
    }

    public function orWhere($valueA, $operand, $valueB)
    {
        if($this->schema == "")
        {
            $this->schema .= $valueA . $operand . "'" . $valueB . "' OR ";
        } else {
            $this->schema .= " OR " . $valueA . $operand . "'" . $valueB . "'";
        }
        return $this;
    }

    public function delete()
    {
        $sql = "DELETE FROM " . $this->table . " WHERE " . $this->schema;

        if ($this->conn->query($sql) === TRUE)
        {
            $this->schema = '';
            return true;
        } else {
            return false;
        }
    }

    public function update($array)
    {
        $schemaSet = $this->parseSchema($array);

        $sql = "UPDATE " . $this->table . " SET " . $schemaSet . " WHERE " . $this->schema;

        if ($this->conn->query($sql) === TRUE)
        {
            $this->schema = '';
            return true;
        } else {
            //echo "Error updating record: " . $this->conn->error;
            return false;
        }
    }
}
