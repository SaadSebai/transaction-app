<?php

namespace App\Http\Requests\Transactions;

use App\Core\FormRequest;
use App\Core\Validator;
use App\Repositories\ClientRepository;

class IndexTransactionRequest extends FormRequest
{

    /**
     * @inheritDoc
     */
    protected function rules(): array
    {
        return [
            'client' => $this->validateClient(),
            'start_date' => $this->validateStartDate(),
            'end_date' => $this->validateEndDate(),
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

    private function validateStartDate(): callable
    {
        return function (string $attribute, mixed $value)
        {
            if (
                $value
                && (
                    ($error = Validator::string($attribute, $value))
                    || ($error = Validator::date($attribute, $value))
                )
            )
            {
                $this->errors[] = $error;
            }
        };
    }

    private function validateEndDate(): callable
    {
        return function (string $attribute, mixed $value)
        {
            $before = 'start_date';

            if (
                $value
                && (
                    ($error = Validator::string($attribute, $value))
                    || ($error = Validator::date($attribute, $value))
                    || ($error = Validator::afterDate($attribute, $value, $before, $this->data[$before]))
                )
            )
            {
                $this->errors[] = $error;
            }
        };
    }
}