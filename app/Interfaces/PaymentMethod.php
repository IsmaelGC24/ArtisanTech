<?php

namespace App\Interfaces;

interface PaymentMethod
{
    public function getInitialStatus(): string;

    public function getName(): string;
}
