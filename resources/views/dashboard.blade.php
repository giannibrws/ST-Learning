<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div>

        <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
        <x-jet-nav-sidebar></x-jet-nav-sidebar>

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

                        {{--Search box: --}}
                            <div class="absolute mx-4 right-0 -mt-5">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                    <i class="fas fa-search"></i>
                                </span>
                                    <input class=" items-end form-input w-32 sm:w-64 rounded-md pl-10 pr-4 focus:border-indigo-600" type="text"
                                           placeholder="Search">
                            </div>

                        {{--End Search box: --}}

                    {{--buttons start:--}}

                </header>

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">

                    <div class="container mx-auto px-6 py-8">
                        <h3 class="text-gray-700 text-3xl font-bold font-medium text-center">Dashboard</h3>

                            <div class="flex flex-wrap -mx-6 mt-4">

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
