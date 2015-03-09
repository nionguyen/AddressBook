<?php
//http://stackoverflow.com/questions/5280347/autoload-classes-from-different-folders
//http://stackoverflow.com/questions/7713072/how-can-i-load-classes-from-multiple-directories-with-autoload
namespace Database;

class DBClass implements Adapter\IDatabase
{
    private $db;
    private $type;
    private $connData;
    
    function __construct()
    {
    }

    function __destruct()
    {
        $this->close();
    }

    public function setDB($db)
    {
        $this->db = new Adapter\MySqlDB();
        $this->db->setDB($db);
    }

    public function setTypeDB($typeDB)
    {
        $this->switchDB($typeDB);
    }
    public function setConnData($connData)
    {
        if(!$connData)
            throw new \InvalidArgumentException('ConnData is null');
        $this->connData = $connData;
    }
    
    function switchDB($typeDB)
    {
        $this->type = $typeDB;
        switch ($this->type) {
            case Adapter\TypeDB::MYSQL: {
                $this->db = new Adapter\MySqlDB();
                break;
            }
            case Adapter\TypeDB::POSTGRES: {
                $this->db = new Adapter\PostgresDB();
                break;
            }
            case Adapter\TypeDB::SQLITE: {
                $this->db = new Adapter\SqliteDB();
                break;
            }
            default: {
                throw new InvalidArgumentException('TypeDB is not appropriate');
                break;
            }
        }
    }
    
    public function connect()
    {
        switch ($this->type) {
            case Adapter\TypeDB::MYSQL: {
                $this->db->connect(
                                $this->connData->dbhost,
                                $this->connData->user,
                                $this->connData->pass,
                                $this->connData->dbname
                );
                break;
            }
            case Adapter\TypeDB::POSTGRES: {
                $this->db->connect(
                                $this->connData->dbhost,
                                $this->connData->user,
                                $this->connData->pass,
                                $this->connData->dbname
                );
                break;
            }
            case Adapter\TypeDB::SQLITE: {
                $this->db->connect($this->connData->location);
                break;
            }
            default: {
                throw new InvalidArgumentException('TypeDB is not appropriate');
                break;
            }
        }
    }
    
    public function error()
    {
        return $this->db->error();
    }
    
    public function query($query)
    {
        return $this->db->query($query);
    }
    public function affected_rows()
    {
        return $this->db->affected_rows();
    }
    
    public function close()
    {
        $this->db->close();
    }
    
    public function insert_id()
    {
        return $this->db->insert_id();
    }
    
    public function multi_query($query)
    {
        return $this->db->multi_query($query);
    }
    
    public function real_escape_string($escapeStr)
    {
        return $this->db->real_escape_string($escapeStr);
    }
    
    public function prepare($query)
    {
        return $this->db->prepare($query);
    }
}

?>