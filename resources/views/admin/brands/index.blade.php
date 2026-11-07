@extends('layouts.admin')

@section('title', __('brands.title_index'))

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">{{ __('brands.title_index') }}</h1>
        <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">
            {{ __('brands.new_link') }}
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">{{ __('brands.name') }}</th>
                        <th scope="col">{{ __('brands.country') }}</th>
                        <th scope="col">{{ __('brands.website') }}</th>
                        <th scope="col">{{ __('brands.products_count') }}</th>
                        <th scope="col">{{ __('brands.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($viewData['brands'] as $brand)
                        <tr>
                            <td>{{ $brand->getName() }}</td>
                            <td>{{ $brand->getCountry() }}</td>
                            <td>{{ $brand->getWebsite() }}</td>
                            <td>{{ $brand->getProducts()->count() }}</td>
                            <td>
                                <a href="{{ route('admin.brands.edit', $brand->getId()) }}" class="btn btn-warning btn-sm">
                                    {{ __('brands.edit') }}
                                </a>
                                <form action="{{ route('admin.brands.destroy', $brand->getId()) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('{{ __('brands.confirm_delete') }}')" class="btn btn-danger btn-sm">
                                        {{ __('brands.delete') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">{{ __('brands.empty') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $viewData['brands']->links() }}
    </div>
@endsection