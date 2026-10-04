<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'order_date' => now(),
            'status' => 'pending',
            'total_amount' => 0,
            'user_id' => User::factory(),
        ];
    }
}