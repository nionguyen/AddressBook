<?php
namespace Database\Adapter\Conn;

class SqliteConn extends AbstractConnData
{
    public $location;
    
    function __construct($location)
    {
        $this->location = $location;
    }
}
?>