<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Classrooms:') }}
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
                    <div class="st-card st-error st-grid-row-span-2">{{isset($error) ? $error : ''}}</div>
                @endif

                @php $adminName = 'Made by: ' . $adminName  @endphp

                    <div class="st-card card-editable shadow-sm">
                        <div class="st-item-flex">
                            <x-jet-cr-image class=""></x-jet-cr-image>
                            <h3 class="text-3xl mt-5 ml-5">{{$classroom->name}}</h3>
                        </div>

                        <form method="POST" action="{{ route('classrooms.update', $classroom->id)}}">
                            {{csrf_field()}}
                             @method('PUT')
                            <textarea placeholder="Set a bio for this classroom:" class="no-outline" name="cr_bio">{{$classroom->bio}}</textarea>
                            <x-jet-button type="button"><i class="fas fa-cog"></i> </x-jet-button>
                            <x-jet-button type="submit">Update bio</x-jet-button>
                        </form>
                    </div>

                    {{-- @info: Chat display::--}}
                    <div class="st-card cr-chat ">
                        {{-- @livewire component:--}}
                        @livewire('user-chat', ['classroom_id' => $classroom->id])
                    </div>
                    {{-- @info: END chat display::--}}

                 <div class="cr-subjects st-scroll-custom">
                     <div class="st-card shadow-sm">
                         <div class="mx-5">
                             <div class="text-gray-500 pb-2">
                                 <p class="font-bold">Browse subjects:</p>
                                 @foreach($linked_subjects as $subject)
                                     <p><a href="{{$classroom->id}}/subjects/{{$subject->id}}" class="st-hover">{{strtolower($subject->name)}}</a></p>
                                 @endforeach
                             </div>
                         </div>
                     </div>

                    <div class="st-card shadow-sm">
                        <div class="">
                            <form method="POST" action="{{ route('subjects.store', $classroom->id)}}">
                                @csrf
                                <div class="st-input">
                                    <div class="st-inputGroup">
                                        <input type="hidden" name="cr_id" value="{{$classroom->id}}" />
                                        <input type="text" name="sub_name" class="no-outline" placeholder="Subject name.." />
                                        <span id="st-create-classroom"><i class="fas fa-times"></i></span>
                                        <label for="name">Create a new subject:</label>
                                    </div>
                                    <x-jet-button wire:click.prevent="storeMessage" type="submit">Create subject</x-jet-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="text-center st-card cr-extensions st-grid-row-span-2">
                    @livewire('connected-apps', ['classroom_id' => $classroom->id])
                </div>

            </div>

</div>


</div>
</div>

</x-app-layout>