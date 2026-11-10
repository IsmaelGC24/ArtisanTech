<?php

namespace App\Util;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class AlliedStore
{
    private bool $stale = false;

    /**
     * @return array<int, array{name: string, model: string, category: string, price: float, stock: int}>|null
     *                                                                                                         null when the service fails and there is no saved copy
     */
    public function getProducts(): ?array
    {
        $cached = Cache::get('allied_store_products');
        if ($cached !== null) {
            return $cached;
        }

        $products = $this->fetchProducts();
        if ($products === null) {
            $lastGood = Cache::get('allied_store_products_last_good');
            $this->stale = $lastGood !== null;

            return $lastGood;
        }

        Cache::put('allied_store_products', $products, 60);
        Cache::forever('allied_store_products_last_good', $products);

        return $products;
    }

    public function isStale(): bool
    {
        return $this->stale;
    }

    private function fetchProducts(): ?array
    {
        try {
            $response = Http::timeout(3)->acceptJson()->get(config('services.allies.products_url'));
        } catch (ConnectionException) {
            return null;
        }

        if (! $response->successful() || ! is_array($response->json())) {
            return null;
        }

        $products = [];
        foreach ($response->json() as $item) {
            if (! is_array($item) || empty($item['name'])) {
                continue;
            }
            $products[] = [
                'name' => (string) $item['name'],
                'model' => (string) ($item['model'] ?? ''),
                'category' => (string) ($item['category'] ?? ''),
                'price' => (float) ($item['price'] ?? 0),
                'stock' => (int) ($item['stock'] ?? 0),
            ];
        }

        return $products;
    }
}
