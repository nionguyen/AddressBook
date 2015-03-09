<?php
namespace Database\Adapter\DBStatement;

class PostgresStmt implements IStmt
{
    protected $stmt;
    public $query;
    protected $db;
    private $arr;
    private $result; 
    public function __construct($db, $query, $stmt) {
        $this->query = $query;
        $this->db = $db;
        $this->stmt = $stmt;
    }
    
    public function bind_param()
    {
        $arg_list = func_get_args();
        for($i = 1; $i < func_num_args(); $i++)
        {
            $this->arr[$i - 1] = $arg_list[$i];
        }
    }
    
    public function execute()
    {
        $this->result = @pg_execute($this->db, "my_query", $this->arr);
        if(!$this->result)
            throw new \RuntimeException("Postgres execute fail : " . pg_last_error($this->db) . "<br>" . "Query : " . $this->query . "\n");
        return new PostgresRsl($this->db, $this->query, $this->result);
    }
    
    public function close()
    {
    }
    
    public function get_result()
    {
        return new PostgresRsl($this->db, $this->query, $this->result);
    }
}
?>