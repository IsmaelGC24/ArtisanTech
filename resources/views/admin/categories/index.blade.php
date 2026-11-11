@extends('layouts.admin')

@section('title', __('categories.title_index'))

@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-4">
        <h1 class="h3 mb-0">{{ __('categories.title_index') }}</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            {{ __('categories.new_link') }}
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">{{ __('categories.name') }}</th>
                        <th scope="col">{{ __('categories.description') }}</th>
                        <th scope="col">{{ __('categories.products_count') }}</th>
                        <th scope="col">{{ __('categories.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($viewData['categories'] as $category)
                        <tr>
                            <td>{{ $category->getName() }}</td>
                            <td>{{ $category->getDescription() }}</td>
                            <td>{{ $category->getProducts()->count() }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('admin.categories.edit', $category->getId()) }}" class="btn btn-warning btn-sm">
                                    {{ __('categories.edit') }}
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category->getId()) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('{{ __('categories.confirm_delete') }}')" class="btn btn-danger btn-sm">
                                        {{ __('categories.delete') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">{{ __('categories.empty') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $viewData['categories']->links() }}
    </div>
@endsection
