<?php

namespace App\Services;

use App\Core\Exceptions\ValidationException;
use App\Core\Helpers\Hash;
use App\Core\Session;
use App\Models\Admin;
use App\Repositories\AdminRepository;

class LoginService
{
    private readonly AdminRepository $adminRepository;

    public function __construct()
    {
        $this->adminRepository = new AdminRepository();
    }

    /**
     * @throws ValidationException
     */
    public function login(string $email, string $password): ?Admin
    {
        $admin = $this->adminRepository->findByEmail($email);

        if (!Hash::verify($password, $admin->getPassword()))
            throw ValidationException::throw(['email' => 'Record not found.'], compact('email'));

        Session::put('user', $admin);

        return $admin;
    }

    public function logout(): void
    {
        if (Session::has('user'))
            Session::flush();
    }
}