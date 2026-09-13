<?php

namespace App\Exceptions;

class SaleAlreadyCancelledException extends SaleException
{
    public function __construct()
    {
        parent::__construct(
            'Cette vente a déjà été annulée.'
        );
    }
}