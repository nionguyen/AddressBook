<?php
namespace Database\Adapter\DBStatement;

interface IResult 
{
    public function fetch_array($array_type); 
    public function fetch_row(); 
    public function fetch_assoc(); 
    public function fetch_object(); 
    public function num_rows();
    public function close();
}
?>