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

    public static function find(int $id) : array
    {
        return self::$db->find($id , static::$table);
    }

    public static function all() : array
    {
        return self::$db->all(static::$table);
    }

    public static function create(array $data)
    {
        return self::$db->create(static::$table, $data);
    }

    public static function delete(int $id)
    {
        return self::$db->delete(static::$table, $id);
    }

    public static function update(int $id , array $data)
    {
        return self::$db->update(static::$table, $id, $data);
    }

    public static function where(string $key , string $value)
    {
        return self::$db->where($key,$value,static::$table);
    }

    public static function get()
    {
        return self::$db->get();
    }

    public static function search(array $columns, string $text)
    {
        return self::$db->search(static::$table, $columns, $text);
    }

}