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
        return pg_result_error($this->db);
    }
    
    public function query($query)
    {
        return pg_query($this->db, $query);
    }
	public function prepare($query)
	{
	}
	/*
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
	*/
	
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