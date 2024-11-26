<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>VinoTrip</title>
        <link rel="stylesheet" href="/assets/css/style.css">
        @yield('head')
    </head>
    <body>
        @yield('body')

        <script src="https://unpkg.com/lucide@latest"></script>
        <script src="/assets/js/main.js" defer></script>
        @yield('scripts')
    </body>
</html>
