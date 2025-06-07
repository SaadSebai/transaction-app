<?php

namespace App\Services;

use App\Models\Client;
use App\Repositories\ClientRepository;

class ClientService
{
    private readonly ClientRepository $clientRepository;

    public function __construct()
    {
        $this->clientRepository = new ClientRepository();
    }

    public function getAll(): array
    {
        return $this->clientRepository->get();
    }

    public function getById(int $id): Client
    {
        return $this->clientRepository->findById($id);
    }

    public function store(string $name, string $email, ?string $phone): Client
    {
        return $this->clientRepository->store($name, $email, $phone);
    }

    public function update(int $id, string $name, string $email, ?string $phone): bool
    {
        return $this->clientRepository->update($id, $name, $email, $phone);
    }

    public function delete(int $id): bool
    {
        return $this->clientRepository->delete($id);
    }
}