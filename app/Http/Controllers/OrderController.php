<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $viewData = [];
        $viewData['orders'] = Order::where('user_id', $request->user()->getId())
            ->latest()
            ->paginate(10);

        return view('store.orders.index')->with('viewData', $viewData);
    }

    public function show(Request $request, string $id): View
    {
        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);

        if (! $order->canBeViewedBy($request->user())) {
            abort(403);
        }

        $viewData = [];
        $viewData['order'] = $order;

        return view('store.orders.show')->with('viewData', $viewData);
    }

    public function store(Request $request): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);

        if (count($cart) === 0) {
            return redirect()->route('cart.index');
        }

        $order = Order::placeFromCart($request->user(), $cart);

        if ($order === null) {
            return redirect()->route('cart.index')->with('error', __('orders.stock_error'));
        }

        $request->session()->forget('cart');

        return redirect()->route('orders.show', $order->getId())->with('success', __('orders.placed'));
    }
}
