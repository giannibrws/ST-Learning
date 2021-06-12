    {{--Sidebar collapse:--}}
    <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="overflow-y-auto	fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>
    {{--Sidebar collapse:--}}

    <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="st-sidebar overflow-y-auto z-30 inset-y-0 left-0 w-52 transition duration-300 transform bg-gray-900 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">

        {{-- nav header logo:--}}
            <div class="flex">
                <div class="flex w-32 ml-4 p-4 mt-8">
                    <img src="{{asset('./img/st-logo-white.svg')}}" alt="">
                    {{--<x-jet-application-mark></x-jet-application-mark>--}}
                </div>
            </div>
        {{--header logo:--}}

        {{-- <div class="text-white text-2xl mx-2 font-semibold">Dashboard</div> --}}

        <nav class="mt-10">

            <a class="flex items-center mt-4 py-2 px-6 {{$url == "Dashboard" ? "bg-gray-700 text-gray-100": "text-gray-500 hover:bg-gray-700 hover:text-gray-100"}} hover:bg-opacity-25" href="/">
                <i class="fas fa-home"></i>
                <span class="mx-3">Dashboard</span>
            </a>

            <a class="flex items-center mt-4 py-2 px-6 text-gray:500 {{$url == "Classrooms" ? "bg-gray-700 text-gray-100": "text-gray-500 hover:bg-gray-700 hover:text-gray-100"}} hover:bg-opacity-25 " href="/classrooms">
                <i class="fas fa-users"></i>
                <span class="mx-3">Classrooms</span>
            </a>

            <a class="flex items-center mt-4 py-2 px-6 {{$url == "History" ? "bg-gray-700 text-gray-100": "text-gray-500 hover:bg-gray-700 hover:text-gray-100"}} hover:bg-opacity-25"
               href="/history-overview">
                <i class="fas fa-history"></i>
                <span class="mx-3">User history</span>
            </a>

            <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
               href="/#">
                <i class="fas fa-cogs"></i>
                <span class="mx-3">Settings</span>
            </a>

            <a class="flex items-center mt-4 py-2 px-6 {{$url == "Community" ? "bg-gray-700 text-gray-100": "text-gray-500 hover:bg-gray-700 hover:text-gray-100"}} hover:bg-opacity-25"
               href="/explore">
                <i class="fas fa-user-friends"></i>
                <span class="mx-3">Community</span>
            </a>
        </nav>
    </div>
