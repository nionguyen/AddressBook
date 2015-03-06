<?php
namespace Database\Adapter\DBStatement;

class SqliteStmt implements IStmt 
{
    protected $stmt;
    public $query;
    protected $db;
    
    public function __construct($db, $query, $stmt) {
        $this->query = $query;
        $this->db = $db;
        $this->stmt = $stmt;
    }
    
    public function bind_param($types,...$numbers)
    {
    }
    
    public function execute()
    {
    }
    
    public function close()
    {
    }
    
    public function get_result()
    {
    }
}
?>