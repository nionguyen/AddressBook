<?php
namespace Database\Adapter\Connection;

class MysqlConnection extends \mysqli
{
    public function getLastError()
    {
        return mysqli_errno($this);
    }

    public function getLastErrno()
    {
        return mysqli_errno($this);
    }
}
?>