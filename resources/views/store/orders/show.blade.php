@extends('layouts.app')

@section('title', __('orders.title_show', ['id' => $viewData['order']->getId()]))

@section('content')
    <div class="container py-4">
        <a href="{{ route('orders.index') }}" class="btn btn-link px-0 mb-3">&larr; {{ __('orders.back') }}</a>

        <h1>{{ __('orders.title_show', ['id' => $viewData['order']->getId()]) }}</h1>
        <p class="text-muted">
            {{ $viewData['order']->getFormattedOrderDate() }} ·
            {{ __('orders.status_'.$viewData['order']->getStatus()) }} ·
            {{ __('orders.customer') }}: {{ $viewData['order']->getUser()->getName() }}
        </p>

        <table class="table align-middle">
            <thead>
                <tr>
                    <th>{{ __('orders.product') }}</th>
                    <th>{{ __('orders.quantity') }}</th>
                    <th>{{ __('orders.unit_price') }}</th>
                    <th>{{ __('orders.subtotal') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($viewData['order']->getOrderItems() as $item)
                    <tr>
                        <td>{{ $item->getProduct()->getName() }}</td>
                        <td>{{ $item->getQuantity() }}</td>
                        <td>{{ $item->getFormattedUnitPrice() }}</td>
                        <td>{{ $item->getFormattedSubtotal() }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-end">{{ __('orders.total') }}</th>
                    <th>{{ $viewData['order']->getFormattedTotal() }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection