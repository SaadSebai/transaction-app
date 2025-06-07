<?php

namespace App\Http\Requests\Auth;

use App\Core\FormRequest;
use App\Core\Validator;
use App\Repositories\AdminRepository;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => $this->validateEmail(),
            'password' => $this->validatePassword()
        ];
    }

    private function validateEmail(): callable
    {
        return function (string $attribute, mixed $value)
        {
            if (
                ($error = Validator::required($attribute, $value))
                || ($error = Validator::string($attribute, $value))
                || ($error = Validator::email($attribute, $value))
                || ($error = Validator::exists($attribute, $value, AdminRepository::class, 'findByEmail'))
            )
            {
                $this->errors[] = $error;
            }
        };
    }

    private function validatePassword(): callable
    {
        return function (string $attribute, mixed $value)
        {
            if (
                ($error = Validator::required($attribute, $value))
                || ($error = Validator::string($attribute, $value))
            )
            {
                $this->errors[] = $error;
            }
        };
    }
}