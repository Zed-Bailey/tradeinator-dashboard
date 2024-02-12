<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @vite('resources/css/app.css')
        @filamentStyles
        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body>

        <nav class="sticky top-0 mx-3 mt-2 rounded-xl bg-gray-200 h-10 flex items-center px-2 z-50">
            <h1 class="text-lg font-semibold">Dashboard</h1>
        </nav>

        <div class="flex justify-center w-full">
            {{ $slot }}
        </div>

        @livewire('notifications')
        @filamentScripts
        @vite('resources/js/app.js')
    </body>
</html>
