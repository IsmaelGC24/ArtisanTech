<?php

namespace App\Util;

use App\Interfaces\PaymentMethod;

class CardPayment implements PaymentMethod
{
    public function getInitialStatus(): string
    {
        return 'paid';
    }

    public function getName(): string
    {
        return 'card';
    }
}
