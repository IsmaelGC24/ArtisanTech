@extends('layouts.admin')

@section('title', __('products.title_create'))

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">{{ __('products.title_create') }}</h1>

    <div class="bg-white rounded shadow p-6 max-w-lg">
        <form action="{{ route('admin.products.store') }}" method="POST">
            @csrf
            @include('admin.products._form', ['product' => null])
            <button type="submit" class="bg-slate-800 text-white px-4 py-2 rounded hover:bg-slate-700 transition">
                {{ __('products.save') }}
            </button>
        </form>
    </div>
@endsection