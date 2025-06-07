<?php

namespace App\Http\Controllers\Api;

use App\Core\Exceptions\ValidationException;
use App\Http\ApiResponse\TransactionApiResponse;
use App\Http\Requests\Clients\ClientRequest;
use App\Services\TransactionService;
use JsonException;

class TransactionApiController
{
    private readonly TransactionService $transactionService;

    public function __construct()
    {
        $this->transactionService = new TransactionService();
    }

    /**
     * @throws ValidationException
     * @throws JsonException
     */
    public function index(string $client)
    {
        $request = new ClientRequest(compact('client'));

        $data = $request->validated();

        (new TransactionApiResponse($this->transactionService->getByClientId((int) $data['client'])))
            ->arrayToJson();
    }
}