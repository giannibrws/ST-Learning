<x-guest-layout>

    {{--Start login navigation: --}}
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
           <a href="{{ url('/') }}" class="text-sm text-gray-700 underline">Home</a>
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                @else
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="ml-4 text-sm text-gray-700 underline">Log in</a>
                @endif
            @endauth
        </div>
    @endif
    {{--End login navigation: --}}

    <div class="pt-4 bg-gray-100">
        <div class="min-h-screen flex flex-col items-center pt-60">
            <div>
                <x-jet-authentication-card-logo />
            </div>

            <div class="w-full mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose text-center">
                {!! $policy !!}
            </div>
        </div>
    </div>
</x-guest-layout>
