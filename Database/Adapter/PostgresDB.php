<?php
//http://php.net/manual/en/book.pgsql.php
//http://www.postgresql.org/docs/current/static/errcodes-appendix.html
namespace Database\Adapter;

class PostgresDB implements IDatabase
{
    private $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    public function error()
    {
        $rs = pg_get_result($this->db);
        return pg_result_error($rs);
    }

    public function getLastError()
    {
        return pg_last_error($this->db);
    }

    public function getLastErrno()
    {
        return pg_last_error($this->db);
    }

    public function query($query)
    {       
        $result = @pg_query($this->db, $query);
        if(!$result)
            throw new \RuntimeException("Postgres query fail : " . $this->getLastError() . "<br>" . "Query : " . $this->query . "\n");
        return new DBStatement\PostgresRsl($this->db, $query, $result);
    }
    public function prepare($query)
    {
        $result = @pg_prepare($this->db, "my_query", $query);
        if(!$result)
            throw new \RuntimeException("Postgres prepare fail : " . $this->getLastError() . "<br>" . "Query : " . $this->query . "\n");
        return new DBStatement\PostgresStmt($this->db, $query, $result);
    }

    public function affected_rows($result='')
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