<?php
require_once 'IDatabase.php';
//http://php.net/manual/en/ref.mysql.php
class MySqlDB implements IDatabase
{
	private $db;
	public function connect($server='', $username='', $password='', $dbName='')
	{
		if(strcmp($server,"") == 0)
		{
			throw new InvalidArgumentException('Server is empty');
		}
		if(strcmp($dbName,"") == 0)
		{
			throw new InvalidArgumentException('DbName is empty');
		}
		if(strcmp($username,"") == 0)
		{
			throw new InvalidArgumentException('Username is empty');
		}
		$this->db = new mysqli($server, $username, $password, $dbName);
	}
	
	public function error()
	{
		return mysqli_connect_errno();
	}
	
    public function query($query)
	{
		return $this->db->query($query);
	}
	public function fetch_array($result, $array_type)
	{
		return $result->fetch_array($array_type);
	}		
    public function fetch_row($result)
	{
		$result->fetch_row();
	}		
    public function fetch_assoc($result)
	{
		return $result->fetch_assoc();
	}		
    public function fetch_object($result)
	{
		return $result->fetch_object();
	}		
    public function num_rows($result)
	{
		$result->num_rows;
	}
	public function affected_rows()
	{
		return $this->db->affected_rows;
	}	
    public function close()
	{
		$this->db->close();
	}		
}

?>