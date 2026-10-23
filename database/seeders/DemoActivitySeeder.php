<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoActivitySeeder extends Seeder
{
    public function run(): void
    {
        $customers = [];
        $customerData = [
            ['Laura Gómez', 'laura@artisantech.com'],
            ['Carlos Pérez', 'carlos@artisantech.com'],
            ['Ana Torres', 'ana@artisantech.com'],
        ];
        foreach ($customerData as [$name, $email]) {
            $customers[] = User::factory()->create([
                'name' => $name,
                'email' => $email,
                'password' => 'password',
            ]);
        }

        // product, customer index, rating, comment
        $reviews = [
            ['MacBook Air', 0, 5, 'Excelente batería y pantalla.'],
            ['MacBook Air', 1, 4, 'Muy buena, aunque algo costosa.'],
            ['MacBook Air', 2, 5, null],
            ['iPhone 15', 0, 5, 'La cámara es increíble.'],
            ['iPhone 15', 1, 4, null],
            ['PlayStation 5', 2, 5, 'Los juegos se ven espectaculares.'],
            ['PlayStation 5', 0, 4, 'Cargas muy rápidas.'],
            ['WH-1000XM5', 1, 5, 'La cancelación de ruido es de lo mejor.'],
            ['Galaxy S24', 2, 4, 'Muy fluido.'],
            ['ThinkPad X1', 1, 5, 'Teclado inmejorable.'],
        ];
        foreach ($reviews as [$productName, $customerIndex, $rating, $comment]) {
            $product = Product::where('name', $productName)->firstOrFail();
            Review::create([
                'rating' => $rating,
                'comment' => $comment,
                'user_id' => $customers[$customerIndex]->getId(),
                'product_id' => $product->getId(),
            ]);
        }

        // customer index, lines (product => quantity)
        $orders = [
            [0, ['iPhone 15' => 2, 'WH-1000XM5' => 1]],
            [1, ['MacBook Air' => 1, 'PlayStation 5' => 1]],
            [2, ['PlayStation 5' => 2, 'Galaxy A55' => 1]],
            [0, ['iPhone 15' => 1]],
        ];
        foreach ($orders as [$customerIndex, $lines]) {
            $cart = [];
            foreach ($lines as $productName => $quantity) {
                $cart[Product::where('name', $productName)->firstOrFail()->getId()] = $quantity;
            }
            Order::placeFromCart($customers[$customerIndex], $cart);
        }
    }
}
