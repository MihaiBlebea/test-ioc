<?php

namespace Framework\Database;

class Connector
{
    private $host;
    private $dbName;
    private $user;
    private $password;

    public $connector;

    public function __construct($host, $dbName, $user, $password)
    {
        $this->host = $host;
        $this->dbName = $dbName;
        $this->user = $user;
        $this->password = $password;

        $this->connector = $this->connect();
    }

    public function setUp()
    {
        $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT );
        $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }

    public function connect()
    {
        $connector = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName . ";charset=utf8", $this->user, $this->password);
        return $connector;
        /*
        try {
            $connector = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName . ";charset=utf8", $this->user, $this->password);
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
        return $connector;
        */
    }

    public function getConnector()
    {
        return $this->connector;
    }
}
