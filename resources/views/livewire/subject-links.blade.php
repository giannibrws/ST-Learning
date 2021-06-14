<div>
    <form method="POST" action="">
        {{csrf_field()}}
        @method('PUT')

        <p class="useful-links__desc font-bold">Pin useful links to your subjects</p>

        <div class="min-w-full">
            <tbody>
            @foreach($linkedUrls as $value)
                <div class="useful-links__item pb-2.5 mb-2.5 border-b border-gray-200">
                    <div class="useful-links__item-top">
                        <div class="useful-links__label">
                            <div class="text-sm leading-5 text-gray-900">{{$value->url_name}}</div>
                        </div>
                        <div class="useful-links__url pt-4 whitespace-no-wrap text-sm leading-5 font-medium">
                            <a href="{{url($value->url)}}" class="text-indigo-600 hover:text-indigo-900" target="_blank">{{$value->url}}</a>
                        </div>
                    </div>
                    <div class="useful-links__delete py-5 px-5 text-sm leading-5 font-medium">
                        <a href="#" wire:click.prevent="destroy({{ $value->id }})" title="Delete" ><i class="hover:text-purple-500 fas fa-times "></i></a>
                    </div>
                </div>
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
