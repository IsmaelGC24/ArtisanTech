@extends('layouts.admin')

@section('title', __('products.title_index'))

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">{{ __('products.title_index') }}</h1>
        <a href="{{ route('admin.products.create') }}" class="bg-slate-800 text-white px-4 py-2 rounded hover:bg-slate-700 transition">
            {{ __('products.new_link') }}
        </a>
    </div>

    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-600">{{ __('products.name') }}</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-600">{{ __('products.brand') }}</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-600">{{ __('products.category') }}</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-600">{{ __('products.price') }}</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-600">{{ __('products.stock') }}</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-600">{{ __('products.active') }}</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-600">{{ __('products.actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($viewData['products'] as $product)
                    <tr>
                        <td class="px-4 py-3">{{ $product->getName() }}</td>
                        <td class="px-4 py-3">{{ $product->getBrand()->getName() }}</td>
                        <td class="px-4 py-3">{{ $product->getCategory()->getName() }}</td>
                        <td class="px-4 py-3">{{ $product->getPrice() }}</td>
                        <td class="px-4 py-3">{{ $product->getStock() }}</td>
                        <td class="px-4 py-3">{{ $product->getActive() ? __('products.yes') : __('products.no') }}</td>
                        <td class="px-4 py-3 space-x-2">
                            <a href="{{ route('admin.products.edit', $product->getId()) }}" class="inline-block bg-amber-500 text-white px-3 py-1 rounded text-sm hover:bg-amber-600 transition">
                                {{ __('products.edit') }}
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->getId()) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('{{ __('products.confirm_delete') }}')" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600 transition">
                                    {{ __('products.delete') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">{{ __('products.empty') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $viewData['products']->links() }}
    </div>
@endsection