<?php

namespace App\Models;

use App\Core\Helpers\Str;
use App\Enums\CurrencyEnum;
use App\Enums\TransactionTypeEnum;

class Transaction
{
    private int $id;
    private int $client_id;
    private float $amount;
    private CurrencyEnum $currency;
    private TransactionTypeEnum $type;
    private string $description;
    private string $created_at;

    public function __construct()
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getClientId(): int
    {
        return $this->client_id;
    }

    public function setClientId(int $client_id): void
    {
        $this->client_id = $client_id;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function getCurrency(): CurrencyEnum
    {
        return $this->currency;
    }

    public function setCurrency(CurrencyEnum|string $currency): void
    {
        $this->currency = is_string($currency)
            ? CurrencyEnum::{Str::uppercase($currency)}
            : $currency;
    }

    public function getType(): TransactionTypeEnum
    {
        return $this->type;
    }

    public function setType(TransactionTypeEnum|string $type): void
    {
        $this->type = is_string($type)
            ? TransactionTypeEnum::{Str::uppercase($type)}
            : $type;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }
}