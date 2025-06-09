<?php

namespace App\Http\Controllers;

use App\Core\Exceptions\ValidationException;
use App\Core\Session;
use App\Http\Requests\Clients\ClientRequest;
use App\Http\Requests\Transactions\IndexTransactionRequest;
use App\Http\Requests\Transactions\StoreTransactionRequest;
use App\Services\TransactionService;

class TransactionController
{
    private readonly transactionService $transactionService;

    public function __construct()
    {
        $this->transactionService = new transactionService();
    }

    /**
     * @throws ValidationException
     */
    public function index(mixed $client)
    {
        $request = new IndexTransactionRequest(compact('client'));

        $data = $request->validated();
        $start_date = $data['start_date'] ?? null;
        $end_date = $data['end_date'] ?? null;

        return view(path: 'transactions/index', attributes: [
            'transactions' => $this->transactionService->getByClientId(client_id: (int) $data['client'], start_date: $start_date, end_date: $end_date),
            'balance' => $this->transactionService->getBalance(client_id: (int) $data['client'], start_date: $start_date, end_date: $end_date),
            'client' => $data['client'],
            'start_date' => $start_date,
            'end_date' => $end_date,
        ], layout: 'main.layout');
    }

    /**
     * @throws ValidationException
     */
    public function create(mixed $client)
    {
        $request = new ClientRequest(compact('client'));

        $data = $request->validated();

        return view(path: 'transactions/create', attributes: ['client' => $data['client']], layout: 'main.layout');
    }

    /**
     * @throws ValidationException
     */
    public function store(mixed $client)
    {
        $request = new StoreTransactionRequest(compact('client'));

        $data = $request->validated();

        $this->transactionService->store(
            client_id: (int) $data['client'],
            amount: $data['amount'],
            currency: $data['currency'],
            type: $data['type'],
            description: $data['description']
        );

        Session::flash('success', 'Transaction created successfully');

        redirect(path: "/clients/{$data['client']}/transactions");
    }
}