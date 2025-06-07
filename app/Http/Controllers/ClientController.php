<?php

namespace App\Http\Controllers;

use App\Core\Exceptions\ValidationException;
use App\Core\Session;
use App\Http\Requests\Clients\ClientRequest;
use App\Http\Requests\Clients\StoreClientRequest;
use App\Http\Requests\Clients\UpdateClientRequest;
use App\Services\ClientService;

class ClientController
{
    private readonly ClientService $clientService;

    public function __construct()
    {
        $this->clientService = new ClientService();
    }

    public function index()
    {
        return view(path: 'clients/index', attributes: [
            'clients' => $this->clientService->getAll()
        ], layout: 'main.layout');
    }

    public function create()
    {
        return view(path: 'clients/create', layout: 'main.layout');
    }

    /**
     * @throws ValidationException
     */
    public function store()
    {
        $request = new StoreClientRequest();

        $data = $request->validated();

        $this->clientService->store(name: $data['name'], email: $data['email'], phone: $data['phone']);

        Session::flash('success', 'Client created successfully');

        redirect(path: '/clients');
    }

    /**
     * @throws ValidationException
     */
    public function edit(mixed $client)
    {
        $request = new ClientRequest(compact('client'));

        $data = $request->validated();

        $client = $this->clientService->getById((int) $data['client']);

        return view(path: 'clients/edit', attributes: compact('client'), layout: 'main.layout');
    }

    /**
     * @throws ValidationException
     */
    public function update(mixed $client)
    {
        $request = new UpdateClientRequest(compact('client'));

        $data = $request->validated();

        $this->clientService->update((int)$data['client'], $data['name'], $data['email'], $data['phone']);

        Session::flash('success', 'Client updated successfully');

        redirect(path: '/clients');
    }

    /**
     * @throws ValidationException
     */
    public function destroy(mixed $client)
    {
        $request = new ClientRequest(compact('client'));

        $data = $request->validated();

        $this->clientService->delete((int) $data['client']);

        Session::flash('success', 'Client deleted successfully');

        redirect(path: '/clients');
    }
}