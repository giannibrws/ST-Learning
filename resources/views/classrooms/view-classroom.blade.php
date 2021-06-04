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
                <div class="st-grid-container">

                    {{--<div class="st-grid-row--span-2" style="height:40px; text-align: center; background: white;"> ttttt</div>--}}

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    @endforeach
                    <div class="st-error st-grid-row-span-2">{{isset($error) ? $error : ''}}</div>
                @endif

                @php $adminName = 'Made by: ' . $adminName  @endphp

                <x-jet-info-card class="px-12">
                <x-slot name="display_grid">{{true}}</x-slot>
                <x-slot name="url">{{'classrooms'}}</x-slot>
                <x-slot name="id">{{$classroom->id}}</x-slot>
                <x-slot name="noRedirect">{{true}}</x-slot>
                <x-slot name="title">{{$classroom->name}}</x-slot>
                <x-slot name="description">{{$classroom->bio}}</x-slot>
                <x-slot name="editable">{{true}}</x-slot>
                <x-slot name="madeBy">{{$adminName}}</x-slot>
                </x-jet-info-card>

                    <div class="st-card cr-chat">
                        Here comes the chat.
                    </div>

                 <div class="cr-subjects">
                     <div class="st-card shadow-sm">
                         <div class="mx-5">
                             <div class="text-gray-500 pb-2">
                                 <p class="font-bold">Browse subjects:</p>
                                 @foreach($linked_subjects as $subject)
                                     <p><a href="subjects/{{$subject->id}}" class="st-hover">{{strtolower($subject->name)}}</a></p>
                                 @endforeach
                             </div>
                         </div>
                     </div>

                    <div class="st-card shadow-sm">
                        <div class="">
                            <form method="POST" action="{{ route('subjects.store')}}">
                                @csrf
                                <div class="st-input">
                                    <div class="st-inputGroup">
                                        <input type="hidden" name="cr_id" value="{{$classroom->id}}" />
                                        <input type="text" name="sub_name" class="no-outline" placeholder="Subject name.." />
                                        <span id="st-create-classroom"><i class="fas fa-times"></i></span>
                                        <label for="name">Create a new subject:</label>
                                    </div>
                                    <x-jet-button type="submit">Create subject</x-jet-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="text-center st-card cr-extensions st-grid-row-span-2">
                    <p>Connected Apps:</p>
                </div>

            </div>

</div>


</div>
</div>

</x-app-layout>