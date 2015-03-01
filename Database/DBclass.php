<?php
require_once 'PostgresDB.php';
require_once 'MySqlDB.php';
require_once 'SqliteDB.php';

abstract class TypeDB
{
    const MySql 	= 0;
    const Postgres 	= 1;
    const SqliteDB 	= 2;
}
$TypeDB = array ("MySql" => 0,"Postgres" => 1,"SqliteDB" => 2); 

abstract class ConnData { }
class MySqlConn extends ConnData
{
	public $server;
	public $username;
	public $password;
	public $dbName;
	function __construct($server, $username, $password, $dbName)
	{
		$this->server 	= $server;
		$this->username = $username;
		$this->password = $password;
		$this->dbName 	= $dbName;
	}
}

class PostgresConn extends ConnData
{
	public $server;
	public $username;
	public $password;
	public $dbName;
	function __construct($server, $username, $password, $dbName)
	{
		$this->server 	= $server;
		$this->username = $username;
		$this->password = $password;
		$this->dbName 	= $dbName;
	}
}

class SqliteDBConn extends ConnData
{
	public $location;
	function __construct($location)
	{
		$this->location = $location;
	}
}

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
			case TypeDB::MySql:
			{
				$this->db = new MySqlDB();
				break;
			}
			case TypeDB::Postgres:
			{
				$this->db = new PostgresDB();
				break;
			}
			case TypeDB::SqliteDB:
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
			case TypeDB::MySql:
			{
				$this->db->connect($connData->server, $connData->username, $connData->password, $connData->dbName);
				break;
			}
			case TypeDB::Postgres:
			{
				$this->db->connect($connData->server, $connData->username, $connData->password, $connData->dbName);
				break;
			}
			case TypeDB::SqliteDB:
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
}

?>