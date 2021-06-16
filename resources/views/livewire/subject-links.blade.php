<div>
    <form method="POST" action="">
        {{csrf_field()}}
        @method('PUT')

        <p class="useful-links__desc font-bold">List useful links for quick navigation:</p>

        @php $write_permission = ($user_role == 'admin' || $user_role == 'user'); @endphp

        <div class="min-w-full">
            @foreach($linkedUrls as $value)
                <div class="useful-links__item pb-2.5 mb-2.5 border-b border-gray-200">
                    <div class="useful-links__item-top">
                        <div class="useful-links__label">
                            <div class="text-sm leading-5 text-gray-900">{{$value->url_name}}</div>
                        </div>
                        <div class="useful-links__url pt-2 whitespace-no-wrap text-sm leading-5 font-medium">
                            <a href="{{url($value->url)}}" class="text-indigo-600 hover:text-indigo-900" target="_blank">{{$value->url}}</a>
                        </div>
                    </div>
                    <div class="useful-links__delete py-2 px-2 text-sm leading-5 font-medium">
                        @if($write_permission)
                        <a href="#" wire:click.prevent="destroy({{ $value->id }})" title="Delete" ><i class="hover:text-purple-500 fas fa-times "></i></a>
                        @endif
                    </div>
                </div>
            @endforeach

            {{-- Create useful links:  --}}
            @if($write_permission)
                    <div class="text-sm leading-5 mb-2 text-gray-900">
                        <x-jet-input wire:model="url_name" value="{{}}" class="pr-2" placeholder="link name"></x-jet-input>
                    </div>
                    <div class="text-sm leading-5 text-gray-900">
                        <x-jet-input wire:model="url" class="" placeholder="url"></x-jet-input>
                    </div>
                    <x-jet-button wire:click.prevent="store" type="button" class="mt-8">Add</x-jet-button>
            @endif

        </div>
    </form>
</div>
