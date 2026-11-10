<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} &middot; @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container-fluid">
        <div class="row min-vh-100">
            <aside class="col-12 col-md-3 col-lg-2 bg-dark text-white d-flex flex-column p-0">
                <div class="p-3 border-bottom border-secondary">
                    <h2 class="h5 mb-0">{{ __('admin.panel_title') }}</h2>
                </div>

                <nav class="nav nav-pills flex-column p-2 flex-grow-1" aria-label="{{ __('admin.panel_title') }}">
                    <a href="{{ route('admin.home') }}"
                       @class(['nav-link', 'text-white', 'active' => request()->routeIs('admin.home')])
                       aria-current="{{ request()->routeIs('admin.home') ? 'page' : 'false' }}">
                        {{ __('admin.dashboard') }}
                    </a>
                    <a href="{{ route('admin.products.index') }}"
                       @class(['nav-link', 'text-white', 'active' => request()->routeIs('admin.products.*')])
                       aria-current="{{ request()->routeIs('admin.products.*') ? 'page' : 'false' }}">
                        {{ __('admin.products') }}
                    </a>
                    <a href="{{ route('admin.categories.index') }}"
                       @class(['nav-link', 'text-white', 'active' => request()->routeIs('admin.categories.*')])
                       aria-current="{{ request()->routeIs('admin.categories.*') ? 'page' : 'false' }}">
                        {{ __('admin.categories') }}
                    </a>
                    <a href="{{ route('admin.brands.index') }}"
                       @class(['nav-link', 'text-white', 'active' => request()->routeIs('admin.brands.*')])
                       aria-current="{{ request()->routeIs('admin.brands.*') ? 'page' : 'false' }}">
                        {{ __('admin.brands') }}
                    </a>
                </nav>

                <div class="border-top border-secondary p-2">
                    <div class="d-flex gap-3 px-3 py-2 small">
                        @foreach (config('app.available_locales') as $locale)
                            <a href="{{ route('language.change', $locale) }}"
                               class="text-white text-decoration-none {{ app()->getLocale() === $locale ? 'fw-bold' : 'opacity-50' }}">{{ strtoupper($locale) }}</a>
                        @endforeach
                    </div>
                    <a href="{{ route('home') }}" class="nav-link text-white-50 small px-3 py-2">{{ __('admin.back_to_store') }}</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-link text-white-50 text-decoration-none text-start small w-100 px-3">
                            {{ __('admin.logout') }}
                        </button>
                    </form>
                </div>
            </aside>

            <main class="col-12 col-md-9 col-lg-10 p-4">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>