<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function test_total_is_the_sum_of_item_subtotals(): void
    {
        $firstItem = new OrderItem;
        $firstItem->setSubtotal('1000.00');

        $secondItem = new OrderItem;
        $secondItem->setSubtotal('250.50');

        $order = new Order;
        $order->setOrderItems(new Collection([$firstItem, $secondItem]));

        $this->assertEquals(1250.50, $order->calculateTotal());
    }
}
