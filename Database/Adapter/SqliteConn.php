<?php
namespace Database\Adapter;
require_once $_SERVER['DOCUMENT_ROOT']."/AddressBook/".'AutoLoad.php';
class SqliteConn extends AbstractConnData
{
	public $location;
	function __construct($location)
	{
		$this->location = $location;
	}
}
?>