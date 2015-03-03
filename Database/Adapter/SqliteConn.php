<?php
namespace Database\Adapter;
class SqliteConn extends AbstractConnData
{
	public $location;
	function __construct($location)
	{
		$this->location = $location;
	}
}
?>