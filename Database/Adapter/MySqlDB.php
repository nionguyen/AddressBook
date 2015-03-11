<?php
namespace Database\Adapter;

//http://php.net/manual/en/ref.mysql.php
class MySqlDB implements IDatabase
{
    private $db;
    function __construct($db)
    {
        $this->db = $db;
    }

    public function getLastError()
    {
        return $this->db->error;
    }

    public function getLastErrno()
    {
        return $this->db->errno;
    }
    
    public function query($query)
    {
        $result = $this->db->query($query);
        if(!$result)
            throw new \RuntimeException("Mysql query fail : " . $this->getLastErrno() . ": " . $this->getLastError() . "<br>" . "Query : " . $query . "\n");
        return new DBStatement\MysqlRsl($this->db, $query, $result);
    }

    public function prepare($query)
    {
        $stmt = $this->db->prepare($query);
        if(!$stmt)
            throw new \RuntimeException("Mysql prepare fail : ".
                $this->getLastErrno().": ".
                $this->getLastError()."<br> Query : ".$query."\n"
            );
            return new DBStatement\MysqlStmt($this->db, $query, $stmt);

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
        return mysqli_insert_id($this->db);
    }
    
    public function multi_query($query)
    {
        $result = $this->db->multi_query($query);
        if(!$result)
            throw new \RuntimeException("Mysql multi query fail : " . $this->getLastErrno() . ": " . $this->getLastError() . "<br>" . "Query : " . $query . "\n");
        return new DBStatement\MysqlRsl($this->db, $query, $result);
    }

    public function real_escape_string($escapeStr)
    {
        return $this->db->real_escape_string($escapeStr);
    }
}

?>