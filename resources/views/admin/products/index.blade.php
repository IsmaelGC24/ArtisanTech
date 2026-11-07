@extends('layouts.admin')

@section('title', __('products.title_index'))

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">{{ __('products.title_index') }}</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            {{ __('products.new_link') }}
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">{{ __('products.name') }}</th>
                        <th scope="col">{{ __('products.brand') }}</th>
                        <th scope="col">{{ __('products.category') }}</th>
                        <th scope="col">{{ __('products.price') }}</th>
                        <th scope="col">{{ __('products.stock') }}</th>
                        <th scope="col">{{ __('products.active') }}</th>
                        <th scope="col">{{ __('products.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($viewData['products'] as $product)
                        <tr>
                            <td>{{ $product->getName() }}</td>
                            <td>{{ $product->getBrand()->getName() }}</td>
                            <td>{{ $product->getCategory()->getName() }}</td>
                            <td>{{ $product->getPrice() }}</td>
                            <td>{{ $product->getStock() }}</td>
                            <td>{{ $product->getActive() ? __('products.yes') : __('products.no') }}</td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product->getId()) }}" class="btn btn-warning btn-sm">
                                    {{ __('products.edit') }}
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->getId()) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('{{ __('products.confirm_delete') }}')" class="btn btn-danger btn-sm">
                                        {{ __('products.delete') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">{{ __('products.empty') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $viewData['products']->links() }}
    </div>
@endsection