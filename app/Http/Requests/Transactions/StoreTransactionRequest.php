<?php

namespace App\Http\Requests\Transactions;

use App\Core\FormRequest;
use App\Core\Validator;
use App\Enums\CurrencyEnum;
use App\Enums\TransactionTypeEnum;
use App\Repositories\ClientRepository;

class StoreTransactionRequest extends FormRequest
{

    protected function rules(): array
    {
        return [
            'client' => $this->validateClient(),
            'amount' => $this->validateAmount(),
            'currency' => $this->validateCurrency(),
            'type' => $this->validateType(),
            'description' => $this->validateDescription(),
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

    private function validateAmount(): callable
    {
        return function (string $attribute, mixed $value)
        {
            if (
                ($error = Validator::required($attribute, $value))
                || ($error = Validator::numeric($attribute, $value, 1, 1000000))
            )
            {
                $this->errors[] = $error;
            }
        };
    }

    private function validateCurrency(): callable
    {

        return function (string $attribute, mixed $value)
        {
            if (
                ($error = Validator::required($attribute, $value))
                || ($error = Validator::string($attribute, $value))
                || ($error = Validator::inEnum($attribute, $value, CurrencyEnum::class))
            )
            {
                $this->errors[] = $error;
            }
        };
    }

    private function validateType(): callable
    {

        return function (string $attribute, mixed $value)
        {
            if (
                ($error = Validator::required($attribute, $value))
                || ($error = Validator::string($attribute, $value))
                || ($error = Validator::inEnum($attribute, $value, TransactionTypeEnum::class))
            )
            {
                $this->errors[] = $error;
            }
        };
    }

    private function validateDescription(): callable
    {

        return function (string $attribute, mixed $value)
        {
            if (
                $value
                && (
                    ($error = Validator::string(attribute: $attribute, value: $value, max: 10000000))
                )
            )
            {
                $this->errors[] = $error;
            }
        };
    }
}