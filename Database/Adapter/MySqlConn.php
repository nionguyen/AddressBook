<?php
spl_autoload_register(function ($class) {
    require_once $class.'.php';
});
class MySqlConn extends AbstractConnData
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