<?php
namespace Database\Adapter\Conn;

class PostgresConn implements AbstractConnData
{
    public $dbhost;
    public $user;
    public $pass;
    public $dbname;
    public $connString;
    function __construct($dbhost, $user, $pass, $dbname)
    {
        $this->dbhost   = $dbhost;
        $this->user     = $user;
        $this->pass     = $pass;
        $this->dbname   = $dbname;
        $this->connString = 'host='.$dbhost.' dbname='.$dbname.' user='.$user.' password='.$pass;
    }
    public function validate()
    {
        if(strcmp($this->dbhost, '') == 0) {
            throw new \InvalidArgumentException('Postgres dbhost is empty'.
                '<br> host : ' . $this->dbhost .
                '<br> username : ' . $this->user .
                '<br> pass : ' . $this->pass .
                '<br> dbname : ' . $this->dbname
            );
        }
        if(strcmp($this->dbname, '') == 0) {
            throw new \InvalidArgumentException('Postgres dbname is empty'.
                '<br> host : ' . $this->dbhost .
                '<br> username : ' . $this->user .
                '<br> pass : ' . $this->pass .
                '<br> dbname : ' . $this->dbname
            );
        }
        if(strcmp($this->user, '') == 0) {
            throw new \InvalidArgumentException('Postgres username is empty'.
                '<br> host : ' . $this->dbhost .
                '<br> username : ' . $this->user .
                '<br> pass : ' . $this->pass .
                '<br> dbname : ' . $this->dbname
            );
        }
        return true;
    }
}
?>