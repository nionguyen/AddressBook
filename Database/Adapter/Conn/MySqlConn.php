<?php
namespace Database\Adapter\Conn;

class MySqlConn implements  AbstractConnData
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

    public function validate()
    {
        if(strcmp($this->dbhost, '') == 0) {
            throw new \InvalidArgumentException('MySql dbhost is empty'.
                '<br> host : ' . $this->dbhost .
                '<br> username : ' . $this->user .
                '<br> pass : ' . $this->pass .
                '<br> dbname : ' . $this->dbname
            );
        }
        if(strcmp($this->dbname, '') == 0) {
            throw new \InvalidArgumentException('MySql dbname is empty'.
                '<br> host : ' . $this->dbhost .
                '<br> username : ' . $this->user .
                '<br> pass : ' . $this->pass .
                '<br> dbname : ' . $this->dbname
            );
        }
        if(strcmp($this->user, '') == 0) {
            throw new \InvalidArgumentException('MySql username is empty'.
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