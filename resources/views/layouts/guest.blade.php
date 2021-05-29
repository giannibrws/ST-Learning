<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Include main css file -->
        <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
        <!-- Include favicon  -->
        <link rel="shortcut icon" type="image/png" href="{{asset('img/favicon.png')}}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body>

    {{-- Wave image: --}}
    <div class="header bg-opacity-0">
        <img class="header__image " src="{{asset('./img/wave_transparent.svg')}}" alt="">
    </div>


        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
