@extends('layouts.admin')

@section('title', __('products.title_create'))

@section('content')
    <h1 class="h3 mb-4">{{ __('products.title_create') }}</h1>

    <div class="row">
        <div class="col-lg-8 col-xl-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.products.store') }}" method="POST">
                        @csrf
                        @include('admin.products._form', ['product' => null])
                        <button type="submit" class="btn btn-primary">
                            {{ __('products.save') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection