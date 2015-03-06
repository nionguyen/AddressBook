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
	
	public function bind_param($types,...$numbers)
	{
		$rc = $this->stmt->bind_param($types,...$numbers);
		
		if ( !$rc ) {
			throw new \RuntimeException("Mysql bind_param fail : " . mysqli_errno($this->db) . ": " . mysqli_error($this->db) . "\n");
		}
		return $rc;
	}
	
	public function execute()
	{
		$rc = $this->stmt->execute();
		
		if ( !$rc ) {
			throw new \RuntimeException("Mysql execute fail : " . mysqli_errno($this->db) . ": " . mysqli_error($this->db) . "\n");
		}
		return $rc;
	}
	
    public function close()
	{
		$this->stmt->close();
	}
	
	public function get_result()
	{
		return new MysqlRsl($this->db, $this->query, $this->stmt->get_result());
	}
}
?>