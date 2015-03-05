<?php
namespace Database\Adapter\DBStatement;

class SqliteRsl implements IResult 
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
		return $this->result->fetchArray(array_type);
	}
	
    public function fetch_row()
	{
	}
	
    public function fetch_assoc()
	{
	}		
    public function fetch_object()
	{
	}

	public function num_rows()
    {
    }
	
    public function close()
	{
	}
}
?>