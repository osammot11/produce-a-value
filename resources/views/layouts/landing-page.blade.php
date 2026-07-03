<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Produce a Value'))</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}">
    @stack('styles')
</head>

<body>
    @include('partials.header-landing')
    @yield('content')

    @include('partials.footer')

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>

</html>
