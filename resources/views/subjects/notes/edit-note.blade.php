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

                {{-- // is dubbel --}}
                {{-- <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script> --}}

                <script>

                        class MyUploadAdapter {
                            constructor( loader ) {
                                // The file loader instance to use during the upload.
                                this.loader = loader;
                            }

                            // Starts the upload process.
                            upload() {

                                console.log(server);

                                // Update the loader's progress.
                                server.onUploadProgress( data => {
                                    loader.uploadTotal = data.total;
                                    loader.uploaded = data.uploaded;
                                } );

                                // Return a promise that will be resolved when the file is uploaded.
                                return loader.file
                                    .then( file => server.upload( file ) );
                            }

                            // Aborts the upload process.
                            abort() {
                                // Reject the promise returned from the upload() method.
                                server.abortUpload();
                            }

                            // Initializes the XMLHttpRequest object using the URL passed to the constructor.
                            _initRequest() {
                                const xhr = this.xhr = new XMLHttpRequest();

                                // Note that your request may look different. It is up to you and your editor
                                // integration to choose the right communication channel. This example uses
                                // a POST request with JSON as a data structure but your configuration
                                // could be different.
                                xhr.open( 'POST', '{{ route('image_upload') }}', true );
                                xhr.setRequestHeader('x-scrf-token', '{{csrf_token() }}');
                                xhr.responseType = 'json';
                            }


                        // Initializes XMLHttpRequest listeners.
                        _initListeners( resolve, reject, file ) {
                                const xhr = this.xhr;
                                const loader = this.loader;
                                const genericErrorText = `Couldn't upload file: ${ file.name }.`;

                                xhr.addEventListener( 'error', () => reject( genericErrorText ) );
                                xhr.addEventListener( 'abort', () => reject() );
                                xhr.addEventListener( 'load', () => {
                                    const response = xhr.response;

                                    // This example assumes the XHR server's "response" object will come with
                                    // an "error" which has its own "message" that can be passed to reject()
                                    // in the upload promise.
                                    //
                                    // Your integration may handle upload errors in a different way so make sure
                                    // it is done properly. The reject() function must be called when the upload fails.
                                    if ( !response || response.error ) {
                                        return reject( response && response.error ? response.error.message : genericErrorText );
                                    }

                                    // If the upload is successful, resolve the upload promise with an object containing
                                    // at least the "default" URL, pointing to the image on the server.
                                    // This URL will be used to display the image in the content. Learn more in the
                                    // UploadAdapter#upload documentation.
                                    resolve( {
                                        default: response.url
                                    } );
                                } );


                                // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
                                // properties which are used e.g. to display the upload progress bar in the editor
                                // user interface.
                                if ( xhr.upload ) {
                                    xhr.upload.addEventListener( 'progress', evt => {
                                        if ( evt.lengthComputable ) {
                                            loader.uploadTotal = evt.total;
                                            loader.uploaded = evt.loaded;
                                        }
                                    } );
                                }
                            }


                            // Prepares the data and sends the request.
                            _sendRequest( file ) {
                                // Prepare the form data.
                                const data = new FormData();

                                data.append( 'upload', file );

                                // Important note: This is the right place to implement security mechanisms
                                // like authentication and CSRF protection. For instance, you can use
                                // XMLHttpRequest.setRequestHeader() to set the request headers containing
                                // the CSRF token generated earlier by your application.

                                // Send the request.
                                this.xhr.send( data );
                            }


                        } // end of class

                        function CustomUploadAdapterPlugin( editor ) {
                            editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                                // Configure the URL to the upload script in your back-end here!
                                return new MyUploadAdapter( loader );
                            };
                        }


                    ClassicEditor
                        .create( document.querySelector( '#ck_editor' ), {
                            extraPlugins: [ CustomUploadAdapterPlugin ],
                        } )
                        .catch( error => {
                            console.error( error );
                        } );


                </script>
   
</div>
</div>

</x-app-layout>