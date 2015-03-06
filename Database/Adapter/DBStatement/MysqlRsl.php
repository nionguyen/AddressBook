<?php
namespace Database\Adapter\DBStatement;

class MysqlRsl implements IResult
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
        return $this->result->fetch_array($array_type);
    }
    
    public function fetch_row()
    {
        if(!$this->result) {
            throw new Exception("Query not executed");
        }
        return $this->result->fetch_row();
    }
    
    public function fetch_assoc()
    {
        return $this->result->fetch_assoc();
    }       
    public function fetch_object()
    {
        return $this->result->fetch_object();
    }

    public function num_rows()
    {
        return $this->result->num_rows;
    }
    
    public function close()
    {
        $this->result->close();
    }
}
?>