<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} &middot; @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
            <div class="navbar-nav ms-auto align-items-lg-center">
                @if (! empty($weather))
                    <span class="navbar-text me-lg-3">
                        {{ __('weather.city') }} &middot; {{ $weather['temperature'] }} °C &middot; {{ __('weather.'.$weather['condition']) }}
                    </span>
                @endif
                <a class="nav-link active" href="{{ route('products.index') }}">{{ __('app.products') }}</a>
                <a class="nav-link active" href="{{ route('cart.index') }}">{{ __('app.cart') }} ({{ count(session('cart', [])) }})</a>
                @guest
                    <a class="nav-link active" href="{{ route('login') }}">{{ __('app.login') }}</a>
                    <a class="nav-link active" href="{{ route('register') }}">{{ __('app.register') }}</a>
                @else
                    @if (auth()->user()->isAdmin())
                        <a class="nav-link active" href="{{ route('admin.home') }}">{{ __('app.admin_panel') }}</a>
                    @endif
                    <a class="nav-link active" href="{{ route('orders.index') }}">{{ __('app.my_orders') }}</a>
                    <form id="logout" action="{{ route('logout') }}" method="POST" class="d-flex">
                        @csrf
                        <a role="button" class="nav-link active" onclick="document.getElementById('logout').submit();">{{ __('app.logout') }}</a>
                    </form>
                @endguest
                @foreach (config('app.available_locales') as $locale)
                    <a class="nav-link {{ app()->getLocale() === $locale ? 'active fw-bold' : '' }}" href="{{ route('language.change', $locale) }}">{{ strtoupper($locale) }}</a>
                @endforeach
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
</body>
</html>