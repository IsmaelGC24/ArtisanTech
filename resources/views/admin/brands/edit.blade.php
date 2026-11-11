@extends('layouts.admin')

@section('title', __('brands.title_edit'))

@section('content')
    <h1 class="h3 mb-4">{{ __('brands.title_edit') }}</h1>

    <div class="row">
        <div class="col-lg-8 col-xl-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.brands.update', $viewData['brand']->getId()) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.brands._form', ['brand' => $viewData['brand']])
                        <div class="d-grid d-md-block">
                            <button type="submit" class="btn btn-primary">
                                {{ __('brands.update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
