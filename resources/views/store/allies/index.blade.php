@extends('layouts.app')

@section('title', __('allies.title'))

@section('content')
    <div class="container py-4">
        <h1 class="h3 mb-1">{{ __('allies.title') }}</h1>
        <p class="text-muted mb-4">{{ __('allies.subtitle') }}</p>
        @if ($viewData['stale'])
            <div class="alert alert-warning" role="alert">{{ __('allies.stale') }}</div>
        @endif

        @if ($viewData['products'] === null)
            <div class="alert alert-warning" role="alert">{{ __('allies.unavailable') }}</div>
        @elseif (count($viewData['products']) === 0)
            <div class="alert alert-info" role="alert">{{ __('allies.empty') }}</div>
        @else
            <div class="card shadow-sm">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">{{ __('allies.name') }}</th>
                                <th scope="col">{{ __('allies.model') }}</th>
                                <th scope="col">{{ __('allies.category') }}</th>
                                <th scope="col">{{ __('allies.price') }}</th>
                                <th scope="col">{{ __('allies.availability') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($viewData['products'] as $product)
                                <tr>
                                    <td>{{ $product['name'] }}</td>
                                    <td>{{ $product['model'] }}</td>
                                    <td>{{ $product['category'] }}</td>
                                    <td>${{ number_format($product['price'], 2) }}</td>
                                    <td>
                                        @if ($product['stock'] > 0)
                                            <span class="badge text-bg-success">{{ __('allies.in_stock') }} ({{ $product['stock'] }})</span>
                                        @else
                                            <span class="badge text-bg-secondary">{{ __('allies.out_of_stock') }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection