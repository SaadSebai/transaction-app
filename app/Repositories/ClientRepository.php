<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Models\Client;

class ClientRepository extends Repository
{
    public function findById(int $id): ?Client
    {
        $result = $this
            ->db
            ->query(
                query: 'SELECT * FROM clients WHERE id = :id',
                params: compact('id')
            )
            ->first();

        return $result ? $this->toModel($result, Client::class) : null;
    }

    public function get(): array
    {
        $clients = $this
            ->db
            ->query(
                query: 'SELECT * FROM clients',
            )
            ->get();

        return $this->arrayToModels($clients, Client::class);
    }

    public function store(string $name, string $email, ?string $phone): Client
    {
        $data = compact('name', 'email', 'phone');

        $data['created_at'] = date('Y-m-d H:i:s');

        $data['id'] = $this
            ->db
            ->query(
                query: "INSERT INTO clients (name, email, phone, created_at) VALUES (:name, :email, :phone, :created_at)",
                params: $data
            )->lastInsertId();

        return $this->toModel($data, Client::class);
    }

    public function update(int $id, string $name, string $email, ?string $phone): bool
    {
        $data = compact('id', 'name', 'email', 'phone');

        $result = $this
            ->db
            ->query(
                query: "UPDATE clients SET name = :name, email = :email, phone = :phone WHERE id = :id",
                params: $data
            );


        return $result !== false;
    }

    public function delete(int $id): bool
    {
        $result = $this
            ->db
            ->query(
                query: 'DELETE FROM clients WHERE id = :id',
                params: compact('id')
            );

        return $result !== false;
    }
}