@extends('layouts.app')

@section('title', __('orders.title_index'))

@section('content')
    <div class="container py-4">
        <h1 class="mb-4">{{ __('orders.title_index') }}</h1>

        @if ($viewData['orders']->isEmpty())
            <p class="text-muted">{{ __('orders.empty') }}</p>
            <a href="{{ route('products.index') }}" class="btn btn-dark">{{ __('cart.continue_shopping') }}</a>
        @else
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>{{ __('orders.number') }}</th>
                            <th>{{ __('orders.date') }}</th>
                            <th>{{ __('orders.status') }}</th>
                            <th>{{ __('orders.payment_method') }}</th>
                            <th>{{ __('orders.total') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($viewData['orders'] as $order)
                            <tr>
                                <td>#{{ $order->getId() }}</td>
                                <td class="text-nowrap">{{ $order->getFormattedOrderDate() }}</td>
                                <td>{{ __('orders.status_'.$order->getStatus()) }}</td>
                                <td>{{ __('orders.payment_'.$order->getPaymentMethod()) }}</td>
                                <td class="text-nowrap">{{ $order->getFormattedTotal() }}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('orders.show', $order->getId()) }}" class="btn btn-outline-dark btn-sm">
                                        {{ __('orders.view') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $viewData['orders']->links('pagination::bootstrap-5') }}
        @endif
    </div>
@endsection