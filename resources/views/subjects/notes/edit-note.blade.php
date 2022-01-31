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
                        <a href="{{url('classrooms/' . $classroom_id . 'subject/' . $note->fk_subject_id)}}" class="st-hover text-lg">
                            {{$parent_page_name}}
                        </a>

                    @if($is_child_page)
                        @if(!empty($note->name))
                            <span class="font-bold">{{'>'}}</span>
                        @endif
                        <a href="{{url()->current()}}" class="st-hover font-bold">{{$note->name}}</a>
                    @endif
                    </h2>
                </div>
            </header>

            <div class="ck-textarea">
                <form method="POST" action="{{ route('notes.update', ['classroom_id' => $classroom_id, $note->fk_subject_id , $note->id])}}">
                    {{--Post methods are unsupported for this route, therefore use PUT--}}
                    {{csrf_field()}}
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$note->id}}">
                    <input type="hidden" name="fk_subject_id" value="{{$note->fk_subject_id}}">
                    <textarea id="ck_editor" name="content" placeholder="start writing..">{{$note->content}}</textarea>
                    <x-jet-button-secondary class="mt-4 px-8" type="submit">Submit</x-jet-button-secondary>
                    <a class="delete-confirm" href="{{route('notes.destroy', ['classroom_id' => $classroom_id, 'subject_id' => $note->fk_subject_id , 'note' => $note->id])}}">
                        <x-jet-danger-button-secondary class="mt-4 px-8" type="button">Delete Note</x-jet-danger-button-secondary></a>
                    <a href="/classrooms/{{$classroom_id}}/subjects/{{$note->fk_subject_id}}"><x-jet-button class="mt-4 px-8" type="button">Return</x-jet-button></a>
                </form>

            </div>

                <!-- include editor class -->
                @include('ckeditor')

                <script>

                    // default function:
                    function CustomUploadAdapterPlugin( editor ) {
                        editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                            // Configure the URL to the upload script in your back-end here!
                            return new MyUploadAdapter( loader );
                        };
                    }

                    // use custom adapter:
                    ClassicEditor
                        .create( document.querySelector( '#ck_editor' ), {
                            extraPlugins: [ CustomUploadAdapterPlugin ],
                            image: {
                                // You need to configure the image toolbar, too, so it uses the new style buttons.
                                toolbar: [ 'imageTextAlternative', '|', 'imageStyle:alignLeft', 'imageStyle:full', 'imageStyle:alignRight' ],

                                styles: [
                                    // This option is equal to a situation where no style is applied.
                                    'full',

                                    // This represents an image aligned to the left.
                                    'alignLeft',

                                    // This represents an image aligned to the right.
                                    'alignRight'
                                ]
                            }
                        } )
                        .catch( error => {
                            console.error( error );
                        });

                </script>

</div>
</div>
</x-app-layout>
