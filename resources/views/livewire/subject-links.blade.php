<div>
    <form method="POST" action="">
        {{csrf_field()}}
        @method('PUT')

        <div class="flex">
            <p class="useful-links__desc ">Pin useful links to your subjects</p>
        </div>

        <table class="min-w-full">
            <thead>
            <tr>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Link name:</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    URL:</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">

                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($linkedUrls as $value)
                <tr>
                    <td class="pl-3 pr-2 whitespace-no-wrap border-b border-gray-200">
                        <div class="text-sm leading-5 text-gray-900">{{$value->url_name}}</div>
                    </td>
                    <td class="py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium">
                        <a href="{{url($value->url)}}" class="text-indigo-600 hover:text-indigo-900" target="_blank">{{$value->url}}</a>
                    </td>
                    <td class="py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium">
                        <a href="#" wire:click.prevent="destroy({{ $value->id }})" title="Delete" ><i class="hover:text-purple-500 fas fa-times "></i></a>
                    </td>
                </tr>
            @endforeach
            <tr class="">
                <td class="pt-4 pr-2">
                    <div class="text-sm leading-5 text-gray-900">
                        <x-jet-input wire:model="url_name" value="{{}}" class="pr-2" placeholder="link name"></x-jet-input>
                    </div>
                </td>
                <td class="pt-4">
                    <div class="text-sm leading-5 text-gray-900">
                        <x-jet-input wire:model="url" class="" placeholder="url"></x-jet-input>
                    </div>
                </td>
                <td></td>
            </tr>
            </tbody>
        </table>
        <x-jet-button wire:click.prevent="store" type="button" class="mt-8">Add</x-jet-button>
    </form>
</div>
