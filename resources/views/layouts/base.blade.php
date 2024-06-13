<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @if (env('APP_ENV') == 'local')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        @include('layouts.vite-build')
    @endif
    @livewireStyles
    @stack('styles')
</head>

<body>
    <main>
        {{ $slot }}
    </main>
    @livewireScripts
    @stack('scripts')
</body>

</html>
