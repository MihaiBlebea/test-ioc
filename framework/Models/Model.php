<?php
namespace Framework\Models;

use Framework\Injectables\Injector;

class Model {

    private $connector;

    public function __construct()
    {
        $connector = Injector::resolve("Connector");
        $this->connector = $connector->getConnector();
    }

    public function getTable()
    {
        return $this->table;
    }

    public function create()
    {
        $statement = $this->connector->prepare('Select * From users Where id = :id');
    }

    public function select()
    {
        return $this->connector->query("SELECT * FROM " . $this->getTable())->fetchObject('\TestIoc\Models\User');
    }

    public function selectAll()
    {
        return $this->connector->query("SELECT * FROM " . $this->getTable())->fetchAll(\PDO::FETCH_CLASS, '\TestIoc\Models\User');
    }
}
