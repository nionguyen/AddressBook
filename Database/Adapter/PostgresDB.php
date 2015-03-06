<?php
//http://php.net/manual/en/book.pgsql.php
//http://www.postgresql.org/docs/current/static/errcodes-appendix.html
namespace Database\Adapter;

class PostgresDB implements IDatabase
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
        
        $connString = 'host='.$dbhost.' dbname='.$dbname.' user='.$user.' password='.$pass;
        
        if(!$this->db = @pg_connect($connString))
        {
            throw new \RuntimeException("Postgres Connect failed ");
        }
        
    }
    
    public function error()
    {
        $res1 = pg_get_result($this->db);
        return pg_result_error($res1);
    }
    
    public function query($query)
    {       
        $result = @pg_query($this->db, $query);
        if(!$result)
            throw new \RuntimeException("Postgres query fail : " . pg_last_error($this->db) . "\n");
        return new DBStatement\PostgresRsl($this->db, $query, $result);
    }
    public function prepare($query)
    {
        $result = @pg_prepare($this->db, "my_query", $query);
        if(!$result)
            throw new \RuntimeException("Postgres prepare fail : " . pg_last_error($this->db) . "\n");
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
        throw new \Exception('This Database type is not supported this function');
    }
    
    public function multi_query($query)
    {
        throw new \Exception('This Database type is not supported this function');
    }
    
    public function real_escape_string($escapeStr)
    {
        throw new \Exception('This Database type is not supported this function');
    }
    
}

?>