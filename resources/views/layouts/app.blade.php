<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ url('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ url('vendors/css/vendor.bundle.base.css') }}">

    <script src="{{ url('vendors/js/vendor.bundle.base.js') }}"></script>

    @vite(['resources/assets/css/style.css'])

    <link rel="shortcut icon" href="{{ url('images/favicon.ico') }}" />

    <!-- Styles -->
    @livewireStyles
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.1.2/dist/trix.css">
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="container-scroller">
        @livewire('navigation-menu')

        <div class="container-fluid page-body-wrapper">

            <x-template.side-bar />

            <div class="main-panel">
                <div class="content-wrapper">

                    {{ $header }}

                    {{ $slot }}

                </div>

                <x-template.footer />

            </div>

        </div>

    </div>


    @vite([
    'resources/assets/js/jquery.cookie.js',
    'resources/assets/js/off-canvas.js',
    'resources/assets/js/hoverable-collapse.js',
    'resources/assets/js/misc.js'])

    @yield('scripts')

    @livewireScripts
    {{-- script for trix editor --}}
    <script src="https://unpkg.com/trix@2.1.2/dist/trix.umd.min.js"></script>
</body>

</html>