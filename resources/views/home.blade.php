<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ST-Learning - Online learning platform</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- Include main css file -->
        <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
        <!-- Include favicon  -->
        <link rel="shortcut icon" type="image/png" href="{{asset('img/favicon.png')}}">

    </head>
    <body class="">

    {{-- Wave image: --}}
    <div class="header">
        <img class="header__image " src="{{asset('./img/wave_transparent.svg')}}" alt="">
    </div>


    {{--Start login navigation: --}}
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
    {{--End login navigation: --}}


    <div class="mx-auto">
        {{-- Logo image: --}}
        <img class="mx-auto w-1/12" src="{{asset('./img/st-learning-logo.png')}}" alt="">
    </div>

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class=" mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laravel.com/docs" class="underline text-gray-900 dark:text-white">About us:</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    Welcome to Structured Learning

                                    <p>
                                        Structured learning is an online platform to create your own working environemnt specifically
                                            designed to collaborate with others.
                                    </p>
                                    <p>
                                        <ul class="list-disc ml-8 my-4">
                                            <li>Everything in one place</li>
                                            <li>Collaborate with others!</li>
                                            <li>Create your own custom lay-outs</li>
                                        </ul>
                                    </p>

                                    <p class="">Start your journey now by clicking the button below!</p>
                                </div>
                            </div>


                            <div class="text-center my-8">
                                {{--To customize this go to views/vendor/jetstream/components/button.blade.php--}}
                                <a href="{{url('/register')}}">
                                    <x-jet-button type="button">Register here:</x-jet-button>
                                </a>
                            </div>

                        </div>

                        {{--Login form: --}}
                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">

                            <x-jet-validation-errors class="mb-4" />

                            @if (session('status'))
                                <div class="mb-4 font-medium text-sm text-green-600">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div>
                                    <x-jet-label for="email" value="{{ __('Email') }}" />
                                    {{--<x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />--}}
                                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" value="admin@admin.com" required autofocus />
                                </div>

                                <div class="mt-4">
                                    <x-jet-label for="password" value="{{ __('Password') }}" />
                                    <x-jet-input id="password" class="block mt-1 w-full" value="testtest" type="password" name="password" required autocomplete="current-password" />
                                </div>

                                <div class="block mt-4">
                                    <label for="remember_me" class="flex items-center">
                                        <x-jet-checkbox id="remember_me" name="remember" />
                                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                    </label>
                                </div>

                                <div class="flex items-center justify-start mt-4">

                                    <x-jet-button class="px-10">
                                        {{ __('Log in') }}
                                    </x-jet-button>

                                    <a href="{{url('/register')}}">
                                        <x-jet-button type="button" class="ml-4 mr-2 p-0 m-0 bg-blue-500 text-pink-100 hover:bg-blue-700 font-bold rounded shadow-sm">
                                            {{ __('Register') }}
                                        </x-jet-button>
                                    </a>

                                </div>

                                @if (Route::has('password.request'))
                                    <div class="mt-4">
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    </div>
                                @endif

                            </form>

                        {{--End login form--}}


                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 sm:text-left">
                        <div class="flex items-center">
                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="-mt-px w-5 h-5 text-gray-400">
                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>

                            <a href="https://laravel.bigcartel.com" class="ml-1 underline">
                                Shop
                            </a>

                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="ml-4 -mt-px w-5 h-5 text-gray-400">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>

                            <a href="https://github.com/sponsors/taylorotwell" class="ml-1 underline">
                                Sponsor
                            </a>
                        </div>
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>


        <div class="footer">
            <img class="footer__image" src="{{asset('./img/wave.svg')}}" alt="">
        </div>

    </body>
</html>
