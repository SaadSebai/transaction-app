<?php

namespace App\Http\Requests\Clients;

use App\Core\FormRequest;
use App\Core\Validator;
use App\Repositories\ClientRepository;

class ClientRequest extends FormRequest
{

    /**
     * @inheritDoc
     */
    protected function rules(): array
    {
        return [
            'client' => $this->validateClient(),
        ];
    }

    private function validateClient(): callable
    {
        return function (string $attribute, mixed $value)
        {
            if (
                ($error = Validator::required($attribute, $value))
                || ($error = Validator::int($attribute, $value, 1))
                || ($error = Validator::exists($attribute, $value, ClientRepository::class, 'findById'))
            )
            {
                $this->errors[] = $error;
            }
        };
    }
}