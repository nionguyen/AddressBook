<?php
namespace Database\Adapter\Conn;

class SqliteConn implements AbstractConnData
{
    public $location;
    
    function __construct($location)
    {
        $this->location = $location;
    }
    public function validate()
    {
        if(strcmp($this->location,'') == 0) {
            throw new \InvalidArgumentException('Sqlite Location is empty');
        }
        return true;
    }
}
?>