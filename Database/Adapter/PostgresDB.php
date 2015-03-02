<?php
//http://php.net/manual/en/book.pgsql.php
namespace Database\Adapter;
require_once $_SERVER['DOCUMENT_ROOT']."/AddressBook/".'AutoLoad.php';
class PostgresDB implements IDatabase
{
	private $db;
	public function connect($server='', $username='', $password='', $dbName='')
	{
		$conn_string = "host=".$server." dbname=".$dbName." user=".$username." password=".$password;
		$this->db = pg_connect($conn_string);
	}
	
	public function error()
	{
		return pg_result_error($this->db);
	}
	
    public function query($query)
	{
		return pg_query($this->db, $query);
	}
	public function fetch_array($result, $array_type)
	{
		return pg_fetch_array($result, NULL, array_type);
	}		
    public function fetch_row($result)
	{
		return pg_fetch_row($result);
	}		
    public function fetch_assoc($result)
	{
		return pg_fetch_assoc($result);
	}		
    public function fetch_object($result)
	{
		return pg_fetch_object($result);
	}		
    public function num_rows($result)
	{
		return pg_num_rows($result);
	}
	public function affected_rows()
	{
		return pg_affected_rows($result);
	}	
    public function close()
	{
		pg_close($this->db);
	}
	public function insert_id()
	{
	}
	public function multi_query($query)
	{
	}
	public function real_escape_string($escapestr)
	{
	}
}

?>