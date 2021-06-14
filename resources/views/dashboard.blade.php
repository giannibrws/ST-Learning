<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

        <div x-data="{ sidebarOpen: false }" class="flex bg-gray-200">
        <x-jet-nav-sidebar>
            <x-slot name="url">{{"Dashboard"}}</x-slot>
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
                        <h2 class="font-bold">
                            Dashboard
                        </h2>
                    </div>
                </header>

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="st-grid-container py-8 px-8 mx-auto">
                        <div class="st-card card-editable shadow-sm">
                            <p class="font-bold">Welcome to the dashboard of st-learning!</p><br>
                            <p>Within this st-learning platform you can attend classrooms, add subjects and interact with other users.</p>
                        </div>

                        <div class="st-card card-editable shadow-sm">
                            <div class="st-scroll-custom overflow-y-auto db-history">
                                <p class="font-bold mb-5">User History: <br>Your personal browse history</p>
                                {{-- @info: Data table template:--}}
                                    <table class="min-w-full">
                                        <thead>
                                        <tr>
                                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                Last visited:</th>
                                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                Time:</th>
                                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                </th>
                                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                                        </tr>
                                        </thead>

                                        <tbody class="bg-white">
                                            @foreach($userHistory as $history_item)
                                                <tr>
                                                
                                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                        <div class="text-sm leading-5 text-gray-900">{{$history_item->visited_page}}</div>
                                                    </td>
                                            
                                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                                                        {{$history_item->created_at}}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium">
                                                        <a href="{{$history_item->page_url}}" class="text-indigo-600 hover:text-indigo-900">Navigate to item</a>
                                                    </td>
                                                </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                {{-- @info: End Data table template:--}}
                            </div>
                        </div>
                     </div>
                </main>
            </div>
        </div>

</x-app-layout>
