<?php

namespace App\Util;

use App\Interfaces\PaymentMethod;

class CashOnDeliveryPayment implements PaymentMethod
{
    public function getInitialStatus(): string
    {
        return 'pending';
    }

    public function getName(): string
    {
        return 'cash';
    }
}
