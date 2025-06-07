<?php

namespace App\Http\Controllers;

use App\Core\Exceptions\ValidationException;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\LoginService;

class LoginController
{
    private readonly LoginService $loginService;

    public function __construct()
    {
        $this->loginService = new LoginService();
    }

    public function create()
    {
        return view(path: 'auth/login', layout: 'guest.layout');
    }

    /**
     * @throws ValidationException
     */
    public function store()
    {
        $request = new LoginRequest();

        $data = $request->validated();

        $this->loginService->login($data['email'], $data['password']);

        redirect(path: '/home');
    }

    public function destroy()
    {
        $this->loginService->logout();

        redirect(path: '/');
    }
}