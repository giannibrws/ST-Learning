<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

        <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
        <x-jet-nav-sidebar></x-jet-nav-sidebar>

            <div class="flex-1 flex flex-col overflow-hidden">
                {{--header start:--}}
                <header class="flex justify-between items-center py-4 px-6 bg-white border-b-4 border-indigo-600">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"></path>
                            </svg>
                        </button>

                        <div class="relative mx-4 lg:mx-0">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                                <path
                                        d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                        </span>

                            <input class="form-input w-32 sm:w-64 rounded-md pl-10 pr-4 focus:border-indigo-600" type="text"
                                   placeholder="Search">
                        </div>
                    </div>

                    {{--buttons start:--}}

                </header>

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">

                    <div class="container mx-auto px-6 py-8">
                        <h3 class="text-gray-700 text-3xl font-bold font-medium text-center">Dashboard</h3>

                            <div class="flex flex-wrap -mx-6 mt-4">

                                    @for ($i = 0; $i < 9; $i++)
                                            {{--Start card:--}}
                                        <div class="w-full px-6 sm:w-1/2 xl:w-1/3 mb-8">
                                            <div class="flex items-center px-5 py-12 shadow-sm rounded-md bg-white">
                                                <div class="p-3 rounded-full bg-indigo-600 bg-opacity-75">
                                                    <svg class="h-12 w-12 text-white" viewBox="0 0 28 30" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                                d="M18.2 9.08889C18.2 11.5373 16.3196 13.5222 14 13.5222C11.6804 13.5222 9.79999 11.5373 9.79999 9.08889C9.79999 6.64043 11.6804 4.65556 14 4.65556C16.3196 4.65556 18.2 6.64043 18.2 9.08889Z"
                                                                fill="currentColor"></path>
                                                        <path
                                                                d="M25.2 12.0444C25.2 13.6768 23.9464 15 22.4 15C20.8536 15 19.6 13.6768 19.6 12.0444C19.6 10.4121 20.8536 9.08889 22.4 9.08889C23.9464 9.08889 25.2 10.4121 25.2 12.0444Z"
                                                                fill="currentColor"></path>
                                                        <path
                                                                d="M19.6 22.3889C19.6 19.1243 17.0927 16.4778 14 16.4778C10.9072 16.4778 8.39999 19.1243 8.39999 22.3889V26.8222H19.6V22.3889Z"
                                                                fill="currentColor"></path>
                                                        <path
                                                                d="M8.39999 12.0444C8.39999 13.6768 7.14639 15 5.59999 15C4.05359 15 2.79999 13.6768 2.79999 12.0444C2.79999 10.4121 4.05359 9.08889 5.59999 9.08889C7.14639 9.08889 8.39999 10.4121 8.39999 12.0444Z"
                                                                fill="currentColor"></path>
                                                        <path
                                                                d="M22.4 26.8222V22.3889C22.4 20.8312 22.0195 19.3671 21.351 18.0949C21.6863 18.0039 22.0378 17.9556 22.4 17.9556C24.7197 17.9556 26.6 19.9404 26.6 22.3889V26.8222H22.4Z"
                                                                fill="currentColor"></path>
                                                        <path
                                                                d="M6.64896 18.0949C5.98058 19.3671 5.59999 20.8312 5.59999 22.3889V26.8222H1.39999V22.3889C1.39999 19.9404 3.2804 17.9556 5.59999 17.9556C5.96219 17.9556 6.31367 18.0039 6.64896 18.0949Z"
                                                                fill="currentColor"></path>
                                                    </svg>
                                                </div>

                                                <div class="mx-5">
                                                    <h4 class="text-2xl font-semibold text-gray-700">My Classroom</h4>
                                                    <div class="text-gray-500">Join Classroom</div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--End card:--}}
                                    @endfor
                            </div>


                        {{-- @info: Data table template:--}}
                            {{--<div class="flex flex-col mt-8">--}}
                                {{--<div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">--}}
                                    {{--<div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">--}}
                                     {{--start table:--}}
                                        {{--<x-jet-table></x-jet-table>--}}
                                     {{--end table--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                       {{-- @info: End Data table template:--}}


                    </div>
                </main>
            </div>
        </div>
    </div>

</x-app-layout>
