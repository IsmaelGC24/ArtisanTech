<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} &middot; @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark app-navbar">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="{{ route('home') }}">{{ config('app.name') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="{{ __('app.toggle_menu') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main-navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => request()->routeIs('products.*')]) href="{{ route('products.index') }}">{{ __('app.products') }}</a>
                    </li>
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => request()->routeIs('allies.*')]) href="{{ route('allies.index') }}">{{ __('app.allies') }}</a>
                    </li>
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => request()->routeIs('cart.*')]) href="{{ route('cart.index') }}">
                            {{ __('app.cart') }}
                            <span class="badge rounded-pill text-bg-light">{{ count(session('cart', [])) }}</span>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav align-items-lg-center">
                    @if (! empty($weather))
                        <li class="nav-item">
                            <span class="navbar-text small me-lg-2">
                                {{ __('weather.city') }} &middot; {{ $weather['temperature'] }} °C &middot; {{ __('weather.'.$weather['condition']) }}
                            </span>
                        </li>
                    @endif
                    @foreach (config('app.available_locales') as $locale)
                        <li class="nav-item">
                            <a @class(['nav-link', 'px-lg-2', 'active fw-bold' => app()->getLocale() === $locale]) href="{{ route('language.change', $locale) }}">{{ strtoupper($locale) }}</a>
                        </li>
                    @endforeach
                    @guest
                        <li class="nav-item ms-lg-2">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('app.login') }}</a>
                        </li>
                        <li class="nav-item my-2 my-lg-0">
                            <a class="btn btn-outline-light btn-sm" href="{{ route('register') }}">{{ __('app.register') }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown ms-lg-2">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="{{ __('app.account_menu') }}">
                                <span class="avatar-initials">{{ auth()->user()->getInitials() }}</span>
                                <span class="d-lg-none">{{ auth()->user()->getName() }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <span class="dropdown-item-text">
                                        <span class="d-block fw-semibold">{{ auth()->user()->getName() }}</span>
                                        <span class="d-block small text-muted">{{ auth()->user()->getEmail() }}</span>
                                    </span>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('orders.index') }}">{{ __('app.my_orders') }}</a></li>
                                @if (auth()->user()->isAdmin())
                                    <li><a class="dropdown-item" href="{{ route('admin.home') }}">{{ __('app.admin_panel') }}</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">{{ __('app.logout') }}</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @if (session('success'))
            <div class="container mt-3"><div class="alert alert-success">{{ session('success') }}</div></div>
        @endif
        @if (session('error'))
            <div class="container mt-3"><div class="alert alert-danger">{{ session('error') }}</div></div>
        @endif
        @yield('content')
    </main>

    @if (! empty($weather))
        <footer class="container border-top mt-5 py-3 small text-muted">
            {{ __('weather.credit') }}
        </footer>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
