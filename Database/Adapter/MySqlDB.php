<?php
namespace Database\Adapter;

//http://php.net/manual/en/ref.mysql.php
class MySqlDB implements IDatabase
{
    private $db;
	
    public function connect($dbhost='', $user='', $pass='', $dbname='')
    {
        if(strcmp($dbhost,'') == 0) {
            throw new InvalidArgumentException('dbhost is empty');
        }
        if(strcmp($dbname,'') == 0) {
            throw new InvalidArgumentException('dbname is empty');
        }
        if(strcmp($user,'') == 0) {
            throw new InvalidArgumentException('user is empty');
        }
        $this->db = new \mysqli($dbhost, $user, $pass, $dbname);
    }
    
    public function error()
    {
        return $this->db->error;//mysqli_connect_errno();
    }
    
    public function query($query)
    {
		$result = $this->db->query($query);
		return new DBStatement\MysqlRsl($this->db, $query, $result);
    }
	
	public function prepare($query)
	{
		$stmt = $this->db->prepare($query);
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
        $this->db->multi_query($query);
    }
	
    public function real_escape_string($escapeStr)
    {
        return $this->db->real_escape_string($escapeStr);
    }
}

?>