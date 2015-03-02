<?php
namespace Database\Adapter;
require_once $_SERVER['DOCUMENT_ROOT']."/AddressBook/".'AutoLoad.php';
class PostgresConn extends AbstractConnData
{
	public $server;
	public $username;
	public $password;
	public $dbName;
	function __construct($server, $username, $password, $dbName)
	{
		$this->server 	= $server;
		$this->username = $username;
		$this->password = $password;
		$this->dbName 	= $dbName;
	}
}
?>