<?php
namespace App\Core\Database\Drivers;

use App\Core\Database\Contracts\DatabaseInterface;

class MysqlDriver implements DatabaseInterface 
{
    private $connection;
    private static $table;


    private $conditions = [];

    public function connect() :object 
    {
        if ($this->connection === null) {
            $dsn = "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};charset=utf8mb4";
            $options = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $this->connection = new \PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $options);
        }
        return $this->connection;
    }

    // class API

    public function setTable($table)
    {
        if (isset(self::$table)) {
            return self::$table;
        } else {
            self::$table = $table;
            return self::$table;
        }
    }

    public function getTable()
    {
        return self::$table;
    }


    public function find(int $id, string $table) :array
    {
        $this->connect();
        $sth=$this->connection->prepare("SELECT * FROM $table WHERE id = $id");
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_OBJ);
    }

    public function all(string $table) :array
    {
        $this->connect();
        $sth=$this->connection->prepare("SELECT * FROM $table");
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_OBJ);
    }

    public function create(string $table, array $data) :int
    {
        $this->connect();
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $sth=$this->connection->prepare("INSERT INTO $table ($columns) VALUES ($placeholders)");
        $sth->execute(array_values($data));
        return $this->connection->lastInsertId();
    }

    public function delete(string $table, int $id) : bool
    {
        $this->connect();
        $sth = $this->connection->prepare("DELETE FROM $table WHERE id = ?");    
        $sth->bindParam(1, $id, \PDO::PARAM_INT);
        return $sth->execute();
    }

    public function update(string $table, int $id, array $data) : bool
    {
        $this->connect();
        $setValues = [];
        foreach ($data as $key => $value) {
            $setValues[] = "$key = ?";
        }
        $setClause = implode(', ', $setValues);
        $sth = $this->connection->prepare("UPDATE $table SET $setClause WHERE ID = ?");
        $bindValues = array_merge(array_values($data), [$id]);
        return $sth->execute($bindValues);        
    }

    public function where($key, $value,$table=null)
    {
        //$this->conditions[$key] = $value;
        $this->conditions[] = [$key, $value];

        $this->setTable($table);
        return $this;
    }

    public function get()
    {
        $this->connect();
        $query = "SELECT * FROM " . self::$table;
        if (!empty($this->conditions)) {
            $whereClause = [];
            $bindings = [];
            foreach ($this->conditions as $condition) {
                $whereClause[] = $condition[0] . ' = ?';
                $bindings[] = $condition[1];
            }
            $query .= " WHERE " . implode(" AND ", $whereClause);
        }
        $sth = $this->connection->prepare($query);
    
        foreach ($bindings as $i => $value) {
            $sth->bindValue($i + 1, $value);
        }
    
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_OBJ);
    }
    
    public function search(string $table, array $columns, string $text)
    {
        $this->connect();
    
        // Create placeholders for columns in the WHERE clause
        $columnConditions = [];
        foreach ($columns as $column) {
            $columnConditions[] = "$column LIKE ?";
        }
    
        // Join the column conditions with OR
        $columnCondition = implode(" OR ", $columnConditions);
    
        // Prepare the statement
        $query = "SELECT * FROM $table WHERE $columnCondition";
        $stmt = $this->connection->prepare($query);
    
        // Bind the search text to each placeholder
        $searchText = "%" . $text . "%";
        foreach ($columns as $index => $column) {
            $stmt->bindValue($index + 1, $searchText, \PDO::PARAM_STR);
        }
    
        // Execute the statement
        $stmt->execute();
    
        // Fetch the results
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    


    
    
    
    

}