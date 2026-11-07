<?php

namespace Tests\Unit;

use App\Models\OrderItem;
use PHPUnit\Framework\TestCase;

class OrderItemTest extends TestCase
{
    public function test_subtotal_is_quantity_times_unit_price(): void
    {
        $orderItem = new OrderItem;
        $orderItem->setQuantity(3);
        $orderItem->setUnitPrice('1500.50');

        $this->assertEquals(4501.50, $orderItem->calculateSubtotal());
    }

    public function test_formatted_subtotal_has_currency_and_two_decimals(): void
    {
        $orderItem = new OrderItem;
        $orderItem->setSubtotal('2500');

        $this->assertEquals('$2,500.00', $orderItem->getFormattedSubtotal());
    }
}
