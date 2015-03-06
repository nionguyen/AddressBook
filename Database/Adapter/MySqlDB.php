<?php
namespace Database\Adapter;

//http://php.net/manual/en/ref.mysql.php
class MySqlDB implements IDatabase
{
    private $db;
    
    public function connect($dbhost='', $user='', $pass='', $dbname='')
    {
        if(strcmp($dbhost,'') == 0) {
            throw new \InvalidArgumentException('dbhost is empty');
        }
        if(strcmp($dbname,'') == 0) {
            throw new \InvalidArgumentException('dbname is empty');
        }
        if(strcmp($user,'') == 0) {
            throw new \InvalidArgumentException('user is empty');
        }
        
        $this->db = @new \mysqli($dbhost, $user, $pass, $dbname);
                
        if (mysqli_connect_error()) {
            throw new \RuntimeException("Mysql Connect failed: ".mysqli_connect_error());
        }
    }
    
    public function error()
    {
        return mysqli_error($this->db);
    }
    
    public function query($query)
    {
        $result = $this->db->query($query);
        if(!$result)
            throw new \RuntimeException("Mysql query fail : " . mysqli_errno($this->db) . ": " . mysqli_error($this->db) . "\n");
        return new DBStatement\MysqlRsl($this->db, $query, $result);
    }
    
    public function prepare($query)
    {
        $stmt = $this->db->prepare($query);
        if(!$stmt)
            throw new \RuntimeException("Mysql prepare fail : " . mysqli_errno($this->db) . ": " . mysqli_error($this->db) . "\n");
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
        if(!$result)
            throw new \RuntimeException("Mysql multi query fail : " . mysqli_errno($this->db) . ": " . mysqli_error($this->db) . "\n");
        $this->db->multi_query($query);
    }
    
    public function real_escape_string($escapeStr)
    {
        return $this->db->real_escape_string($escapeStr);
    }
}

?>