<?php
namespace Database\Adapter\DBStatement;

class PostgresRsl implements IResult 
{
    protected $result;
    public $query;
    protected $db;
    
    public function __construct($db, $query, $result) {
        $this->query = $query;
        $this->db = $db;
        $this->result = $result;
    }
    
    public function fetch_array($array_type)
    {
        return pg_fetch_array($this->result, null, $array_type);
    }
    
    public function fetch_row()
    {
        return pg_fetch_row($this->result);
    }
    
    public function fetch_assoc()
    {
        return pg_fetch_assoc($this->result);
    }       
    public function fetch_object()
    {
        return pg_fetch_object($this->result);
    }

    public function num_rows()
    {
        return pg_num_rows($this->result);
    }
    
    public function close()
    {
        $this->result->close();
    }
}
?>