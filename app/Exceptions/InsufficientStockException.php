<?php

namespace App\Exceptions;

use RuntimeException;

class InsufficientStockException extends RuntimeException
{
    public function __construct(
        public readonly int $availableStock,
        public readonly int $requestedQuantity,
    ) {
        parent::__construct(
            "Stock insuffisant. Stock disponible : {$availableStock}, quantité demandée : {$requestedQuantity}."
        );
    }
}