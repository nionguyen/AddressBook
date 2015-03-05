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
		return $this->stmt->bind_param($types,...$numbers);
	}
	
	public function execute()
	{
		return $this->stmt->execute();
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