<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::with(['brand', 'category'])
            ->where('active', true)
            ->where('stock', '>', 0)
            ->get();

        $data = [];
        foreach ($products as $product) {
            $data[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'description' => $product->getDescription(),
                'price' => $product->getPrice(),
                'stock' => $product->getStock(),
                'brand' => $product->getBrand()->getName(),
                'category' => $product->getCategory()->getName(),
                'url' => route('products.show', ['id' => $product->getId()]),
            ];
        }

        return response()->json($data);
    }
}
