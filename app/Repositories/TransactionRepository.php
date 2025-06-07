<?php

namespace App\Repositories;

use App\Models\Transaction;

class TransactionRepository extends Repository
{

    public function getByClientId(int $client_id, ?string $start_date = null, ?string $end_date = null): array
    {
        $params = compact('client_id');

        $query = 'SELECT * FROM transactions WHERE client_id = :client_id';

        if ($start_date)
        {
            $query .= ' AND created_at >= :start_date';
            $params['start_date'] = $start_date . ' 00:00:00';
        }
        if ($end_date)
        {
            $query .= ' AND created_at <= :end_date';
            $params['end_date'] = $end_date . ' 23:59:59';
        }

        $transactions = $this
            ->db
            ->query(
                query: $query,
                params: $params
            )
            ->get();

        return $this->arrayToModels($transactions, Transaction::class);
    }
    public function getBalance(int $client_id, ?string $start_date = null, ?string $end_date = null): int
    {
        $params = compact('client_id');

        $query = <<<SQL
            SELECT 
                SUM(CASE 
                    WHEN type = 'earning' THEN amount 
                    WHEN type = 'expense' THEN -amount 
                    ELSE 0 
                END) as balance
            FROM transactions
            WHERE client_id = :client_id
            SQL;

        if ($start_date)
        {
            $query .= ' AND created_at >= :start_date';
            $params['start_date'] = $start_date . ' 00:00:00';
        }
        if ($end_date)
        {
            $query .= ' AND created_at <= :end_date';
            $params['end_date'] = $end_date . ' 23:59:59';
        }

        $balance = $this
            ->db
            ->query(
                query: $query,
                params: $params
            )
            ->first();

        return (int) $balance['balance'] ?? 0;
    }

    public function store(int $client_id, float $amount, string $currency, string $type, ?string $description): Transaction
    {
        $data = compact('client_id', 'amount', 'currency', 'type', 'description');

        $data['created_at'] = date('Y-m-d H:i:s');

        $data['id'] = $this
            ->db
            ->query(
                query: "INSERT INTO transactions (client_id, amount, currency, type, description, created_at) VALUES (:client_id, :amount, :currency, :type, :description, :created_at)",
                params: $data
            )->lastInsertId();

        return $this->toModel($data, Transaction::class);
    }
}