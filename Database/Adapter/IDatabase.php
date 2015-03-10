<?php
namespace Database\Adapter;

interface IDatabase 
{
    public function getLastError();
    public function getLastErrno();
    public function query($query);
    public function affected_rows();
    public function close();
    public function insert_id();
    public function multi_query($query);
    public function real_escape_string($escapeStr);
    public function prepare($query);
}
?>