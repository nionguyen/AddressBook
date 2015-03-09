<?php
namespace Database\Adapter\DBStatement;

class MysqlStmt implements IStmt 
{
    protected $stmt;
    public $query;
    protected $db;
    
    public function __construct($db, $query, $stmt) {
        $this->query = $query;
        $this->db = $db;
        $this->stmt = $stmt;
    }

    public function bind_param()
    {
        $refs = array();
        $arg_list = func_get_args();
        foreach($arg_list as $key => $value)
            $refs[$key] = &$arg_list[$key];

        $rc = call_user_func_array(array($this->stmt, 'bind_param'), $refs);
        if ( !$rc ) {
            throw new \RuntimeException("Mysql bind_param fail : " . mysqli_errno($this->db) . ": " . mysqli_error($this->db) . "<br>" . "Query : " . $this->query . "\n");
        }
        return $rc;
    }
    
    public function execute()
    {
        $rc = $this->stmt->execute();
        
        if ( !$rc ) {
            throw new \RuntimeException("Mysql execute fail : " . mysqli_errno($this->db) . ": " . mysqli_error($this->db) . "<br>" . "Query : " . $this->query . "\n");
        }
        return $rc;
    }
    
    public function close()
    {
        $this->stmt->close();
    }
    
    public function get_result()
    {
        $rc = $this->stmt->get_result();
        if ( !$rc ) {
            throw new \RuntimeException("Mysql get_result fail : " . mysqli_errno($this->db) . ": " . mysqli_error($this->db) . "<br>" . "Query : " . $this->query . "\n");
        }
        return new MysqlRsl($this->db, $this->query, $rc);
    }
}
?>