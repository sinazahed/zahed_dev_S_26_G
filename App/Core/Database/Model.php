<?php

namespace App\Core\Database;
use App\Core\Database\Contracts\DatabaseInterface;

abstract class Model
{
    protected static $db;
    protected static $table;

    public static function setDatabase(DatabaseInterface $db) :void
    {
        self::$db = $db;
    }

    public static function find(int $id) 
    {
        return self::$db->find($id , static::$table);
    }

    public static function create($data) 
    {
        return self::$db->create($data, static::$table);
    }

}