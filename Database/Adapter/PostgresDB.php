<?php
//http://php.net/manual/en/book.pgsql.php
namespace Database\Adapter;

class PostgresDB implements IDatabase
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
        
        $connString = 'host='.$dbhost.' dbname='.$dbname.' user='.$user.' password='.$pass;
        $this->db = pg_connect($connString);
    }
    
    public function error()
    {
        //return pg_result_error($this->db);
    }
    
    public function query($query)
    {		
		$result = pg_query($this->db, $query);
		return new DBStatement\PostgresRsl($this->db, $query, $result);
    }
	public function prepare($query)
	{
		$result = pg_prepare($this->db, "my_query", $query);
		return new DBStatement\PostgresStmt($this->db, $query, $result);
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
        throw new Exception('This Database type is not supported this function');
    }
	
    public function multi_query($query)
    {
        throw new Exception('This Database type is not supported this function');
    }
	
    public function real_escape_string($escapeStr)
    {
        throw new Exception('This Database type is not supported this function');
    }
	
}

?>