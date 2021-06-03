<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Subjects:') }}
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
                    <h2>
                        <a href="{{URL::previous()}}" class="st-hover text-lg">{{$parent_page_name}}</a>
                    @if($is_child_page)
                        <span class="font-bold">{{'>'}}</span>
                        <a href="{{url()->current()}}" class="st-hover font-bold">{{$subject->name}}</a>
                    @endif
                    </h2>
                </div>
            </header>

            <div class="container py-8 mx-auto">

                <div class="subject-grid-container">

                    <div class="st-card st-card--headers"><h4>Info:</h4></div>
                    <div class="st-card st-card--headers"><h4>Notes:</h4></div>

                @php $adminName = 'Made by: ' . $adminName  @endphp

                <div class="w-full mb-8">
                    <div class="st-card shadow-sm">
                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-gray-700">{{$subject->name}}</h4>
                            <div class="text-gray-500 pb-2">{{$subject->bio}}</div>
                            @if(isset($adminName))
                                <span class="absolute -ml-12 font-bold st-admin-title">{{$adminName}}</span>
                            @endif
                        </div>
                    </div>
                </div>

                    <div class="notes-container">

                        @foreach($subject_notes as $note)
                            <x-jet-card-note>
                                <x-slot name="url">{{'notes'}}</x-slot>
                                <x-slot name="id">{{$note->id}}</x-slot>
                                <x-slot name="title">{{$note->name}}</x-slot>
                                <x-slot name="description">{{$note->content}}</x-slot>
                                <x-slot name="madeBy">{{$adminName}}</x-slot>
                            </x-jet-card-note>
                        @endforeach

                    </div>
                </div>
</div>


</div>
</div>

</x-app-layout>