@extends('layouts.admin')

@section('title', __('products.title_edit'))

@section('content')
    <h1 class="h3 mb-4">{{ __('products.title_edit') }}</h1>

    <div class="row">
        <div class="col-lg-8 col-xl-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.products.update', $viewData['product']->getId()) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.products._form', ['product' => $viewData['product']])
                        <button type="submit" class="btn btn-primary">
                            {{ __('products.update') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection