<?php
//http://php.net/manual/en/book.sqlite3.php
namespace Database\Adapter;

class SqliteDB implements IDatabase
{
    private $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    public function getLastError()
    {
        return $this->db->lastErrorMsg();
    }

    public function getLastErrno()
    {
        return $this->db->lastErrorCode();
    }

    public function query($query)
    {
        return $this->db->query($query);
    }

    public function prepare($query)
    {
    }

    public function affected_rows()
    {
        return $this->db->affected_rows;
    }
    
    public function close()
    {
        $this->db->close();
    }
    
    public function insert_id()
    {
        throw new \Exception('This Database type is not supported this function');
    }
    
    public function multi_query($query)
    {
        throw new \Exception('This Database type is not supported this function');
    }
    
    public function real_escape_string($escapeStr)
    {
        throw new \Exception('This Database type is not supported this function');
    }
}

?>