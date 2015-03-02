<?php
//http://stackoverflow.com/questions/5280347/autoload-classes-from-different-folders
//http://stackoverflow.com/questions/7713072/how-can-i-load-classes-from-multiple-directories-with-autoload

class DBclass implements IDatabase
{
	private $db;
	private $type;
	function __construct($typeDB, $connData)
	{
		$this->switchDB($typeDB);
		$this->connect($connData);
	}
	function __destruct()
	{
		$this->close();
	}
	function switchDB($typeDB)
	{
		$this->type = $typeDB;
		switch($this->type)
		{
			case TypeDB::MYSQL:
			{
				$this->db = new MySqlDB();
				break;
			}
			case TypeDB::POSTGRES:
			{
				$this->db = new PostgresDB();
				break;
			}
			case TypeDB::SQLITE:
			{
				$this->db = new SqliteDB();
				break;
			}
			default:
			{
				throw new InvalidArgumentException('TypeDB is not appropriate');
				break;
			}
		}
	}
	public function connect($connData='')
	{
		switch($this->type)
		{
			case TypeDB::MYSQL:
			{
				$this->db->connect($connData->server, $connData->username, $connData->password, $connData->dbName);
				break;
			}
			case TypeDB::POSTGRES:
			{
				$this->db->connect($connData->server, $connData->username, $connData->password, $connData->dbName);
				break;
			}
			case TypeDB::SQLITE:
			{
				$this->db->connect($connData->location);
				break;
			}
			default:
			{
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
	public function fetch_array($result, $array_type)
	{
		return $this->db->fetch_array($result, $array_type);
	}		
    public function fetch_row($result)
	{
		return $this->db->fetch_row($result);
	}		
    public function fetch_assoc($result)
	{
		return $this->db->fetch_assoc($result);
	}		
    public function fetch_object($result)
	{
		return $this->db->fetch_object($result);
	}		
    public function num_rows($result)
	{
		return $this->db->num_rows($result);
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
		$this->db->multi_query($query);
	}
	public function real_escape_string($escapestr)
	{
		return $this->db->real_escape_string($escapestr);
	}
}

?>