<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SISENSA') }}</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen font-['Jakarta Sans']">
    <x-navbarnone></x-navbarnone>
    <div class="parallax-bg min-h-screen flex items-center justify-center bg-gray-100 px-5 sm:px-8 lg:px-8"
        id="starfield">
        <div
            class="login-container w-full max-w-xs sm:max-w-sm md:max-w-md px-6 py-4 sm:px-8 sm:py-6 shadow-md sm:rounded-lg relative overflow-auto">
            <h1 class="text-3xl font-semibold text-white mb-2 text-center">SISENSA</h1>
            {{ $slot }}
        </div>
    </div>
    <x-footer></x-footer>
</body>

</html>
