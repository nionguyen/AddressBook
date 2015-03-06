<?php
namespace Database\Adapter\Conn;

class PostgresConn extends AbstractConnData
{
    public $dbhost;
    public $user;
    public $pass;
    public $dbname;
    
    function __construct($dbhost, $user, $pass, $dbname)
    {
        $this->dbhost   = $dbhost;
        $this->user     = $user;
        $this->pass     = $pass;
        $this->dbname   = $dbname;
    }
}
?>