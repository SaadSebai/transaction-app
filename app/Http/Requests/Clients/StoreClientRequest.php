<?php

namespace App\Http\Requests\Clients;

use App\Core\FormRequest;
use App\Core\Validator;

class StoreClientRequest extends FormRequest
{

    protected function rules(): array
    {
        return [
            'name' => $this->validateName(),
            'email' => $this->validateEmail(),
            'phone' => $this->validatePhone(),
        ];
    }

    private function validateName(): callable
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

    private function validateEmail(): callable
    {
        return function (string $attribute, mixed $value)
        {
            if (
                ($error = Validator::required($attribute, $value))
                || ($error = Validator::string($attribute, $value))
                || ($error = Validator::email($attribute, $value))
            )
            {
                $this->errors[] = $error;
            }
        };
    }

    private function validatePhone(): callable
    {
        return function (string $attribute, mixed $value)
        {
            if (
                $value
                && (
                    ($error = Validator::string($attribute, $value))
                    || ($error = Validator::phone($attribute, $value))
                )
            )
            {
                $this->errors[] = $error;
            }
        };
    }
}