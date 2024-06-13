<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    {{-- <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Roboto:wght@400;600;700&display=swap"> --}}
    <link rel="stylesheet" href="{{ asset('/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/callout.css') }}">
    @stack('styles')
    <style>
        html {
            font-family: 'Source Sans Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI',
                Roboto, 'Helvetica Neue', Arial, sans-serif;
            font-size: 16px;
            word-spacing: 1px;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            -moz-osx-font-smoothing: grayscale;
            -webkit-font-smoothing: antialiased;
            box-sizing: border-box;
        }

        [x-cloak] {
            display: none !important;
        }

        #toast-container>div {
            opacity: 1;
            -ms-filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
            filter: alpha(opacity=100);
        }
    </style>
    @if (env('APP_ENV') == 'local')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        @include('layouts.vite-build')
    @endif
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        @if ($errors->any())
            <div class="callout callout-danger">
                <h4>Error</h4>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <main>
            {{ $slot }}
        </main>
    </div>
    <footer class="block py-4">
        <div class="container mx-auto">
            {{-- <hr class="mb-4 border-b-1 border-gray-300" /> --}}
            <div class="flex flex-wrap items-center md:justify-between justify-center">
                <div class="w-full md:w-4/12 px-4">
                    <div class="text-sm text-gray-600 font-semibold py-1 text-center md:text-left">
                        © Copyright 2023
                    </div>
                </div>
                <div class="w-full md:w-8/12 px-4">
                    <ul class="flex flex-wrap list-none md:justify-end justify-center">
                        <li>
                            <a href="/about"
                                class="text-gray-700 hover:text-gray-900 text-sm font-semibold block py-1 px-3">
                                E-Presensi V2.0L
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    @livewireScripts
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    @stack('scripts')
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script>
        toastr.options = {
            "positionClass": "toast-top-center"
        }
        Livewire.on('alert', param => {
            toastr[param['type']](param['message']);
        });
    </script>
</body>

</html>
