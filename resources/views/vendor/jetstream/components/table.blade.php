<table class="min-w-full">
    <thead>
    <tr>
        <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Name</th>
        <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Title</th>
        <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Status</th>
        <th
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
            Last edited:</th>
        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
    </tr>
    </thead>

    <tbody class="bg-white">
    <tr>
        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
            <div class="flex items-center">
                <div class="flex-shrink-0 h-10 w-10">
                    <img class="h-10 w-10 rounded-full"
                         src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80"
                         alt="">
                </div>

                <div class="ml-4">
                    <div class="text-sm leading-5 font-medium text-gray-900">John Doe
                    </div>
                    <div class="text-sm leading-5 text-gray-500">john@example.com</div>
                </div>
            </div>
        </td>

        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
            <div class="text-sm leading-5 text-gray-900">{{$title}}</div>
            {{--<div class="text-sm leading-5 text-gray-500">Web dev</div>--}}
        </td>

        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
        </td>

        <td
                class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
            {{$created_at}}</td>

        <td
                class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium">
            <a href="#" class="text-indigo-600 hover:text-indigo-900">Navigate to item</a>
        </td>
    </tr>

    </tbody>
</table>