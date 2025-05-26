<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Todo App') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/js/app.js'])
       
    </head>
    <body class="font-sans antialiased bg-gray-50 min-h-screen">
        <x-header />

        <main class="pt-24 pb-8">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>

        <footer class="bg-gray-100 border-t py-4 text-center text-gray-500 text-sm fixed bottom-0 w-full z-0">
            &copy; {{ date('Y') }} Todo App. Desenvolvido por Rodrigo Granada.
        </footer>
    </body>
</html>
