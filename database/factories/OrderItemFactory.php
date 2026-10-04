<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition(): array
    {
        return [
            'quantity' => fake()->numberBetween(1, 5),
            'unit_price' => fake()->randomFloat(2, 10, 2000),
            'subtotal' => fn (array $attributes) => $attributes['quantity'] * $attributes['unit_price'],
            'order_id' => Order::factory(),
            'product_id' => Product::factory(),
        ];
    }
}