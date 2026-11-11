@extends('layouts.app')

@section('title', __('orders.title_show', ['id' => $viewData['order']->getId()]))

@section('content')
    <div class="container py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('catalog.breadcrumb_home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">{{ __('orders.title_index') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('orders.title_show', ['id' => $viewData['order']->getId()]) }}</li>
            </ol>
        </nav>

        <h1>{{ __('orders.title_show', ['id' => $viewData['order']->getId()]) }}</h1>
        <p class="text-muted small">
            {{ $viewData['order']->getFormattedOrderDate() }} ·
            {{ __('orders.status_'.$viewData['order']->getStatus()) }} ·
            {{ __('orders.payment_method') }}: {{ __('orders.payment_'.$viewData['order']->getPaymentMethod()) }} &middot;
            {{ __('orders.customer') }}: {{ $viewData['order']->getUser()->getName() }}
        </p>

        <div class="table-responsive">
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
                            <td class="text-nowrap">{{ $item->getFormattedUnitPrice() }}</td>
                            <td class="text-nowrap">{{ $item->getFormattedSubtotal() }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">{{ __('orders.total') }}</th>
                        <th class="text-nowrap">{{ $viewData['order']->getFormattedTotal() }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection