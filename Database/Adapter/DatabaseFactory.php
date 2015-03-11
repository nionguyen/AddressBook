<?php

namespace Database\Adapter;


class DatabaseFactory {
    public static function create($typeDB, $connData)
    {
        switch($typeDB) {
            case \Database\Adapter\TypeDB::MYSQL: {
                $mysqli = new \mysqli($connData->dbhost, $connData->user, $connData->pass, $connData->dbname);
                if (mysqli_connect_error()) {
                    throw new \RuntimeException("Mysql Connect failed: ".mysqli_connect_error());
                }
                return new \Database\Adapter\MySqlDB($mysqli);
                break;
            }
            case \Database\Adapter\TypeDB::POSTGRES: {
                if(!$postgresDB = @pg_connect($connData->connString))
                {
                    throw new \RuntimeException("Postgres Connect failed ");
                }
                return new \Database\Adapter\PostgresDB($postgresDB);
                break;
            }
            case \Database\Adapter\TypeDB::SQLITE: {
                $sqliteDB = new SQLite3($connData->location);
                return new \Database\Adapter\SqliteDB($sqliteDB);
                break;
            }
            default: {
                throw new InvalidArgumentException('$dbtype is not appropriate');
                break;
            }
        }
    }
}