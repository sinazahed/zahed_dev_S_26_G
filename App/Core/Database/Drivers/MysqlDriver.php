<?php
namespace App\Core\Database\Drivers;

use App\Core\Database\Contracts\DatabaseInterface;

class MysqlDriver implements DatabaseInterface 
{
    private $connection;

    public function connect() {
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

    public function find(int $id, string $table)
    {
        echo $table;
        $this->connect();
        $this->connection->prepare("SELECT * FROM users ORDER BY id ASC");
    }
}