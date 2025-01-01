<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen font-['Jakarta Sans']">
        <x-navbarnone></x-navbarnone>
        <div class="parallax-bg min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"  id="starfield">
            <div class=" login-container w-full sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg">
                <h1 class="text-3xl font-semibold text-white mb-2 text-center">SISENSA</h1>
                {{ $slot }}
            </div>
        </div>
        <x-footer></x-footer>
    </body>
</html>
