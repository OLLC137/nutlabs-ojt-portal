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
    </head>
    <body class="landingpage-body">

        @include('layouts.public.homepage-navbar')
        
        {{$slot}}
        

        @include('layouts.public.homepage-footer')
    </body>
</html>


{{-- Public Layout Copy for full page livewire component --}}