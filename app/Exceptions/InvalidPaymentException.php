<?php

namespace App\Exceptions;

class InvalidPaymentException extends SaleException
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}