<?php
//http://stackoverflow.com/questions/5280347/autoload-classes-from-different-folders
//http://stackoverflow.com/questions/7713072/how-can-i-load-classes-from-multiple-directories-with-autoload
namespace Database;

class DBClass implements Adapter\IDatabase
{
    private $db;
    private $type;

    function __construct($db, $typeDB)
    {
        $this->db = $db;
        $this->type = $typeDB;
    }

    function __destruct()
    {
        $this->close();
    }

    public function getLastError()
    {
        return $this->db->getLastError();
    }

    public function getLastErrno()
    {
        return $this->db->getLastErrno();
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