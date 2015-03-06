<?php
namespace Database\Adapter;

interface IDatabase 
{
    public function connect(); 
    public function error();
    public function query($query);
    public function affected_rows();
    public function close();
    public function insert_id();
    public function multi_query($query);
    public function real_escape_string($escapeStr);
    public function prepare($query);
}

class DatabaseException extends \Exception {}
class MysqlException extends DatabaseException {}
class PostgresException extends DatabaseException {}
class SqliteException extends DatabaseException {}

?>