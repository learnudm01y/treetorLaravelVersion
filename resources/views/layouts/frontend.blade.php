<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Treetor') - {{ config('app.name', 'Treetor') }}</title>
    <meta name='description' content="@yield('meta_description', 'Comprehensive salon coaching solutions')" />
    <meta name="keywords" content="@yield('meta_keywords', 'salon coaching, beauty salon management')" />

    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="preload stylesheet" href="{{ asset('css/style.css') }}" as="style">

    @stack('styles')
</head>

<body class="loaded">
    <div class="main-wrapper">

        {{-- Header --}}
        @include('partials.frontend.header')

        {{-- Main Content --}}
        <main class="content">
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('partials.frontend.footer')

    </div>

    <div class="icon-load"></div>

    {{-- Search Modal --}}
    @include('partials.frontend.search-modal')

    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/lazyload.min.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    @stack('scripts')
</body>
</html>
