<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} · @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-slate-800 text-white flex flex-col">
            <div class="p-6 border-b border-slate-700">
                <h2 class="text-lg font-bold">{{ __('admin.panel_title') }}</h2>
            </div>
            <nav class="flex-1 p-4 space-y-1">
                <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 rounded hover:bg-slate-700 transition">
                    {{ __('admin.products') }}
                </a>
            </nav>
        </aside>

        <section class="flex-1 p-8">
            @yield('content')
        </section>
    </div>
</body>
</html>