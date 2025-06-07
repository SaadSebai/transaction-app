<?php

namespace App\Repositories;

use App\Models\Admin;

class AdminRepository extends Repository
{
    public function findById(int $id): ?Admin
    {
        $result = $this
            ->db
            ->query(
                query: 'SELECT * FROM admins WHERE id = :id',
                params: compact('id')
            )
            ->first();

        return $result ? $this->toModel($result, Admin::class) : null;
    }

    public function findByEmail(string $email): ?Admin
    {
        $result = $this
            ->db
            ->query(
                query: 'SELECT * FROM admins WHERE email = :email',
                params: compact('email')
            )
            ->first();

        return $result ? $this->toModel($result, Admin::class) : null;
    }
}