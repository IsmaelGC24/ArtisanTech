@extends('layouts.app')

@section('title', __('cart.title'))

@section('content')
    <div class="container py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('catalog.breadcrumb_home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('cart.breadcrumb') }}</li>
            </ol>
        </nav>

        <h1 class="mb-4">{{ __('cart.title') }}</h1>

        @if (count($viewData['items']) === 0)
            <p class="text-muted">{{ __('cart.empty') }}</p>
            <a href="{{ route('products.index') }}" class="btn btn-dark">{{ __('cart.continue_shopping') }}</a>
        @else
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>{{ __('cart.product') }}</th>
                            <th>{{ __('cart.price') }}</th>
                            <th>{{ __('cart.quantity') }}</th>
                            <th>{{ __('cart.subtotal') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($viewData['items'] as $item)
                            <tr>
                                <td>
                                    <a href="{{ route('products.show', $item['product']->getId()) }}">{{ $item['product']->getName() }}</a>
                                    <div class="text-muted small">{{ $item['product']->getBrand()->getName() }}</div>
                                </td>
                                <td class="text-nowrap">{{ $item['product']->getFormattedPrice() }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td class="text-nowrap">${{ number_format($item['subtotal'], 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $item['product']->getId()) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">{{ __('cart.remove') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">{{ __('cart.total') }}</th>
                            <th colspan="2" class="text-nowrap">${{ number_format($viewData['total'], 2) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            @auth
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ __('cart.payment_method') }}</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="payment_card" value="card" checked>
                            <label class="form-check-label" for="payment_card">{{ __('cart.payment_card') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="payment_cash" value="cash">
                            <label class="form-check-label" for="payment_cash">{{ __('cart.payment_cash') }}</label>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-sm-flex">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-dark">{{ __('cart.continue_shopping') }}</a>
                        <button type="submit" class="btn btn-dark">{{ __('cart.checkout') }}</button>
                    </div>
                </form>
            @else
                <div class="d-grid gap-2 d-sm-flex">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-dark">{{ __('cart.continue_shopping') }}</a>
                    <a href="{{ route('login') }}" class="btn btn-dark">{{ __('cart.login_to_buy') }}</a>
                </div>
            @endauth
        @endif
    </div>
@endsection