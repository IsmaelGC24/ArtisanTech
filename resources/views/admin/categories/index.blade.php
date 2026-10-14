@extends('layouts.admin')

@section('title', __('categories.title_index'))

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">{{ __('categories.title_index') }}</h1>
        <a href="{{ route('admin.categories.create') }}" class="bg-slate-800 text-white px-4 py-2 rounded hover:bg-slate-700 transition">
            {{ __('categories.new_link') }}
        </a>
    </div>

    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-600">{{ __('categories.name') }}</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-600">{{ __('categories.description') }}</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-600">{{ __('categories.products_count') }}</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-600">{{ __('categories.actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($viewData['categories'] as $category)
                    <tr>
                        <td class="px-4 py-3">{{ $category->getName() }}</td>
                        <td class="px-4 py-3">{{ $category->getDescription() }}</td>
                        <td class="px-4 py-3">{{ $category->getProducts()->count() }}</td>
                        <td class="px-4 py-3 space-x-2">
                            <a href="{{ route('admin.categories.edit', $category->getId()) }}" class="inline-block bg-amber-500 text-white px-3 py-1 rounded text-sm hover:bg-amber-600 transition">
                                {{ __('categories.edit') }}
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category->getId()) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('{{ __('categories.confirm_delete') }}')" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600 transition">
                                    {{ __('categories.delete') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-gray-500">{{ __('categories.empty') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $viewData['categories']->links() }}
    </div>
@endsection