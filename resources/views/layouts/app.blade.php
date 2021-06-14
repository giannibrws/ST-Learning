<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Font awesome -->
        <link rel="stylesheet" type="text/css" href="{{asset('css/fontawesome.css')}}">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <!-- Include main css file -->
        <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
        <!-- Include favicon  -->
        <link rel="shortcut icon" type="image/png" href="{{asset('img/favicon.png')}}">

        @livewireStyles

        <!-- Scripts -->

        <!-- Jquery: -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <!-- Ckeditor: 4 -->
        <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

        {{--<!-- Ckeditor: 5 -->--}}
        {{--<script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>--}}

        <!-- Alpine: -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        <!-- SweetAlert: -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script src="{{ mix('js/app.js') }}" defer></script>
        <script type="text/javascript" src="{{ asset('js/search.js') }}" defer></script>
        <script type="text/javascript" src="{{ asset('js/custom.js') }}" defer></script>



    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            <!-- Insert nav menu: -->
            @livewire('navigation-menu')
            <!-- End nav menu: -->

            <!-- Page Heading -->
            @if (isset($header))
                {{--Leave empty for now:--}}
                <header class="bg-white shadow">
                    {{--<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">--}}
                        {{--{{ $header }}--}}
                    {{--</div>--}}

                </header>
            @endif

            <!-- Page Content -->
            <main>
                <!-- Page Content Goes here -->
                {{ $slot }}

            <!-- End some divs here  -->

            </main>
        </div>

        <footer>

            @stack('modals')

            @livewireScripts
            @stack('scripts')

        </footer>

    </body>


</html>
