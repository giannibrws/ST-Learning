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
                    <a href="/classrooms/{{$classroom_id}}/subjects/{{$note->fk_subject_id}}"><x-jet-button class="mt-4 px-8" type="button">Return</x-jet-button></a>
                </form>

            </div>


            <script>
                ClassicEditor
                    .create( document.querySelector( '#ck_editor' ), {
                        heading: {
                            options: [
                                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1', name: 'title'},
                                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                            ]
                        }
                    })
                    .then( editor => {
                    console.log(editor);
                    })
                    .catch( error => {
                        console.error(error);
                    });
            </script>

</div>
</div>

</x-app-layout>