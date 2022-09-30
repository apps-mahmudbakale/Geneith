<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', app(App\Settings\StoreSettings::class)->store_name) }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{asset('css/auth.css')}}" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="{{!empty(app(App\Settings\StoreSettings::class)->favicon) ? asset('storage/settings/'.app(App\Settings\StoreSettings::class)->favicon):asset('favicon.png')}}">

    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>
<body>
    @yield('content')
</body>
</html>
