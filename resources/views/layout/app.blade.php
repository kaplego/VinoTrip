<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'VinoTrip')</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/cookies.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="b446234c-b83c-4bb5-ace9-c9241e79f49b" data-blockingmode="auto" type="text/javascript"></script>

    @yield('head')
</head>
<body>
    @yield('body')

    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="/assets/js/main.js" defer></script>
    <script src="/assets/js/cookies.js" defer></script>
    @yield('scripts')
</body>

</html>
