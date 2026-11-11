@extends('layouts.admin')

@section('title', __('categories.title_create'))

@section('content')
    <h1 class="h3 mb-4">{{ __('categories.title_create') }}</h1>

    <div class="row">
        <div class="col-lg-8 col-xl-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        @include('admin.categories._form', ['category' => null])
                        <div class="d-grid d-md-block">
                            <button type="submit" class="btn btn-primary">
                                {{ __('categories.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
