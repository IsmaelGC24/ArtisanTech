@extends('layouts.admin')

@section('title', __('products.title_edit'))

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">{{ __('products.title_edit') }}</h1>

    <div class="bg-white rounded shadow p-6 max-w-lg">
        <form action="{{ route('admin.products.update', $viewData['product']->getId()) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.products._form', ['product' => $viewData['product']])
            <button type="submit" class="bg-slate-800 text-white px-4 py-2 rounded hover:bg-slate-700 transition">
                {{ __('products.update') }}
            </button>
        </form>
    </div>
@endsection