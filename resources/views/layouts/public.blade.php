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
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <link rel="stylesheet" href="{{ url('vendors/mdi/css/materialdesignicons.min.css') }}">
        <link rel="stylesheet" href="{{ url('vendors/css/vendor.bundle.base.css') }}">

        @vite(['resources/assets/css/style.css'])

        <link rel="shortcut icon" href="{{ url('images/favicon.ico') }}" />

        <!-- Styles -->
        @livewireStyles
    </head>
    <body>

        @include('layouts.public.homepage-navbar')
        
        {{$slot}}

        @include('layouts.public.homepage-footer')
        
        <script src="{{ url('vendors/js/vendor.bundle.base.js') }}"></script>
        
        @vite([
            'resources/assets/js/off-canvas.js',
            'resources/assets/js/hoverable-collapse.js',
            'resources/assets/js/misc.js'
        ])

        @livewireScripts
    </body>
</html>
