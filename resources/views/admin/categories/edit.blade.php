@extends('layouts.admin')

@section('title', __('categories.title_edit'))

@section('content')
    <h1 class="h3 mb-4">{{ __('categories.title_edit') }}</h1>

    <div class="row">
        <div class="col-lg-8 col-xl-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.categories.update', $viewData['category']->getId()) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.categories._form', ['category' => $viewData['category']])
                        <div class="d-grid d-md-block">
                            <button type="submit" class="btn btn-primary">
                                {{ __('categories.update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
