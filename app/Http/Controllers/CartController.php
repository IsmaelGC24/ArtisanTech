<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $cart = $request->session()->get('cart', []);
        $products = Product::with('brand')->whereIn('id', array_keys($cart))->get();

        $items = [];
        $total = 0;
        foreach ($products as $product) {
            $quantity = $cart[$product->getId()];
            $subtotal = (float) $product->getPrice() * $quantity;
            $total += $subtotal;
            $items[] = ['product' => $product, 'quantity' => $quantity, 'subtotal' => $subtotal];
        }

        $viewData = [];
        $viewData['items'] = $items;
        $viewData['total'] = $total;

        return view('store.cart.index')->with('viewData', $viewData);
    }

    public function add(AddToCartRequest $request, string $id): RedirectResponse
    {
        $product = Product::where('active', true)->findOrFail($id);

        if (! $product->checkAvailability()) {
            return redirect()->route('products.show', $product->getId());
        }

        $cart = $request->session()->get('cart', []);
        $quantity = ($cart[$product->getId()] ?? 0) + (int) $request->validated('quantity');
        $cart[$product->getId()] = min($quantity, $product->getStock());
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index');
    }

    public function remove(Request $request, string $id): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);
        unset($cart[(int) $id]);
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index');
    }
}
