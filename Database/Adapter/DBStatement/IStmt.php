<?php
namespace Database\Adapter\DBStatement;

interface IStmt
{
    public function bind_param($types,...$numbers);
    public function execute();
    public function close();
    public function get_result();
}
?>