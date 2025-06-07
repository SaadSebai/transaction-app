<?php

namespace App\Http\ApiResponse;

use App\Core\ApiResource;

class TransactionApiResponse extends ApiResource
{
    protected function toArray($resource): array
    {
        return [
            'amount' => $resource->getAmount(),
            'currency' => $resource->getCurrency()->value,
            'type' => $resource->getType()->value,
            'description' => $resource->getDescription(),
            'created_at' => $resource->getCreatedAt(),
        ];
    }
}