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
                <div class="cr-header">
                    <h2><a href="{{url()->current()}}" class="st-hover">{{$classroom->name}}</a></h2>
                </div>
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


                 <div class="w-full px-6 sm:w-1/2 xl:w-1/3 mb-8">
                    <div class="st-card shadow-sm">
                        <div class="mx-5">
                            <form method="POST" action="{{ route('subjects.store')}}">
                                @csrf
                                <div class="st-input">
                                    <div class="st-inputGroup">
                                        <input type="hidden" name="cr_id" value="{{$classroom->id}}" />
                                        <input type="text" name="sub_name" class="no-outline" placeholder="Subject name.." />
                                        <span id="st-create-classroom"><i class="fas fa-times"></i></span>
                                        <label for="name">Subject name:</label>
                                    </div>
                                    <div class="text-gray-500 pb-2">Create a new subject:</div>
                                    <x-jet-button type="submit">Create subject</x-jet-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="w-full px-6 sm:w-1/2 xl:w-1/3 mb-8">
                    <div class="st-card shadow-sm">
                        <div class="mx-5">
                            <div class="text-gray-500 pb-2">Browse subjects:</div>
                        </div>
                    </div>
                </div>



</div>


</div>
</div>

</x-app-layout>