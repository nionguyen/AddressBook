<?php
namespace Database\Adapter;
interface IDatabase 
{
    public function connect(); 
	public function error();
    public function query($query);
	public function fetch_array($result, $array_type); 
    public function fetch_row($result); 
    public function fetch_assoc($result); 
    public function fetch_object($result); 
    public function num_rows($result);
	public function affected_rows();
    public function close();
	public function insert_id();
	public function multi_query($query);
	public function real_escape_string($escapestr);
}
?>