<?php

namespace App\Core;

use PDO;
use PDOStatement;

class Database
{
    private PDO $connection;
    private false|PDOStatement $statement;

    public function __construct($config, $username = 'root', $password = '')
    {
        $dsn = "mysql:" . http_build_query(data: $config, arg_separator: ';');

        $this->connection = new PDO(
            $dsn,
            $username,
            $password,
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    }

    public function query(string $query, array $params = []): static
    {
        $this->statement = $this->connection->prepare($query);

        $this->statement->execute($params);

        return $this;
    }

    public function get(): bool|array
    {
       return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function first(): mixed
    {
       return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    public function lastInsertId(): string
    {
        return $this->connection->lastInsertId();
    }
}