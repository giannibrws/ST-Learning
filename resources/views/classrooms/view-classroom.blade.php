<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Classrooms:') }}
        </h2>
    </x-slot>

    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
        <x-jet-nav-sidebar>
            <x-slot name="url">{{"Classrooms"}}</x-slot>
        </x-jet-nav-sidebar>

        <div class="w-full">
            {{--header start:--}}
            <header class="flex py-8 px-6 bg-white border-b-4 border-indigo-600">
                {{--Expand btn: --}}
                <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"></path>
                    </svg>
                </button>
            </header>

            <div class="container py-8 mx-auto">

                @php $adminName = 'Made by: ' . $adminName  @endphp

                <x-jet-info-card class="px-12">
                <x-slot name="id">{{$classroom->id}}</x-slot>
                <x-slot name="noRedirect">{{true}}</x-slot>
                <x-slot name="title">{{$classroom->name}}</x-slot>
                <x-slot name="description">{{$classroom->bio}}</x-slot>
                <x-slot name="editable">{{true}}</x-slot>
                <x-slot name="madeBy">{{$adminName}}</x-slot>
                </x-jet-info-card>

                <div class="st-card w-full px-6 sm:w-1/2 xl:w-1/3 mb-8">
                        <div class="flex items-center px-5 py-12 shadow-sm rounded-md bg-white">
                            <div class="mx-5">
                                <h4 class="text-2xl font-semibold text-gray-700"></h4>
                                <div class="text-gray-500"></div>
                            </div>
                        </div>
                </div>

</div>


</div>
</div>

</x-app-layout>