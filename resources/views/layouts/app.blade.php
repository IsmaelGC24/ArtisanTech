<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} · @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
            <div class="navbar-nav ms-auto">
                @guest
                    <a class="nav-link active" href="{{ route('login') }}">{{ __('app.login') }}</a>
                    <a class="nav-link active" href="{{ route('register') }}">{{ __('app.register') }}</a>
                @else
                    @if (auth()->user()->isAdmin())
                    <a class="nav-link active" href="{{ route('admin.home') }}">{{ __('app.admin_panel') }}</a>
                    @endif
                    <form id="logout" action="{{ route('logout') }}" method="POST">
                        <a role="button" class="nav-link active" onclick="document.getElementById('logout').submit();">{{ __('app.logout') }}</a>
                        @csrf
                    </form>
                @endguest
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
</body>
</html>