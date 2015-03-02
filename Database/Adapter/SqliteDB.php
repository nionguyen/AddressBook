<?php
//require_once 'IDatabase.php';
//http://php.net/manual/en/book.sqlite3.php
spl_autoload_register(function ($class) {
    require_once $class.'.php';
});
class SqliteDB implements IDatabase
{
	private $db;
	public function connect($location='')
	{
		if(strcmp($location,"") == 0)
		{
			throw new InvalidArgumentException('Location is empty');
		}
		$this->db = new SQLite3($location); 
	}
	public function error()
	{
		return $this->db->lastErrorMsg();
	}
    public function query($query)
	{
		return $this->db->query($query);
	}
	public function fetch_array($result, $array_type)
	{
		return $this->result->fetchArray(array_type);
	}		
    public function fetch_row($result)
	{
	}		
    public function fetch_assoc($result)
	{
	}		
    public function fetch_object($result)
	{
	}		
    public function num_rows($result)
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
	}
	public function multi_query($query)
	{
	}
	
	public function real_escape_string($escapestr)
	{
	}
}

?>