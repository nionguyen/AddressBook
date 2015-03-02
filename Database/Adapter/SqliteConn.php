<?php
spl_autoload_register(function ($class) {
    require_once $class.'.php';
});
class SqliteConn extends AbstractConnData
{
	public $location;
	function __construct($location)
	{
		$this->location = $location;
	}
}
?>