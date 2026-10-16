@extends('layouts.app')

@section('title', __('cart.title'))

@section('content')
    <div class="container py-4">
        <h1 class="mb-4">{{ __('cart.title') }}</h1>

        @if (count($viewData['items']) === 0)
            <p class="text-muted">{{ __('cart.empty') }}</p>
            <a href="{{ route('products.index') }}" class="btn btn-dark">{{ __('cart.continue_shopping') }}</a>
        @else
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
                            <td>{{ $item['product']->getFormattedPrice() }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>${{ number_format($item['subtotal'], 2) }}</td>
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
                        <th colspan="2">${{ number_format($viewData['total'], 2) }}</th>
                    </tr>
                </tfoot>
            </table>

            <a href="{{ route('products.index') }}" class="btn btn-outline-dark">{{ __('cart.continue_shopping') }}</a>
            @auth
                <form action="{{ route('orders.store') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-dark">{{ __('cart.checkout') }}</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-dark">{{ __('cart.login_to_buy') }}</a>
            @endauth
        @endif
    </div>
@endsection