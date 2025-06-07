<?php

namespace App\Services;

use App\Models\Transaction;
use App\Repositories\TransactionRepository;

class TransactionService
{
    private readonly TransactionRepository $transactionRepository;

    public function __construct()
    {
        $this->transactionRepository = new TransactionRepository();
    }

    public function getByClientId(int $client_id, ?string $start_date = null, ?string $end_date = null): array
    {
        return $this->transactionRepository->getByClientId($client_id, $start_date, $end_date);
    }

    public function getBalance(int $client_id, ?string $start_date = null, ?string $end_date = null): int
    {
        return $this->transactionRepository->getBalance($client_id, $start_date, $end_date);
    }

    public function store(int $client_id, float $amount, string $currency, string $type, ?string $description): Transaction
    {
        return $this->transactionRepository->store($client_id, $amount, $currency, $type, $description);
    }
}