<div>
    <p class="cr-extensions__title">Connected Apps:</p>
    <div class="cr-extensions__list flex">
        @if(filled($connectedApps))

            @foreach($connectedApps as $key => $app)
                <div class="cr-extensions__list st-item-flex h-full items-center">
                    <a wire:click.prevent="interactWith('{{$key}}')" class="h-full" href="{{url($app->webhook_url)}}" target="_blank">
                        <div class="flex flex-col h-full mr-6">

                            <img alt="app" class="border-gray-300  {{$app->type == 'discord' ? 'rounded-full border-2' : ''}} " src="{{asset('img/connectedApps/' . $app->type . '.png' )}}" />
                            <div id="header-text" class="leading-5 sm">
                                <h5 id="job" class="mt-2 font-semibold text-blue-600">{{$app->name}}</h5>
                            </div>
                        </div>
                    </a>
                    @if($interactWith && ($selected_idx == $key))
                        <div class="flex-column mr-2 st-card noPadding border-gray-200 border-2">
                            <div class="py-2 pl-3 pr-11 text-left">
                            <p>
                                <a href="{{url($app->webhook_url)}}" class="font-bold hover:text-purple-700" target="_blank">Visit link</a>
                                <i wire:click.prevent="closeInteraction" class="cursor-pointer ml-8 absolute cr-extensions__add-new fas fa-times hover:text-purple-700"></i>
                            </p>
                            <p>
                                <a href="#" wire:click.prevent="destroy('{{$app->id}}')" class="font-bold hover:text-purple-700" target="_blank">Remove app</a>
                            </p>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
                {{--// Display add icon:--}}
                <div class="cr-extensions__list ml-12 st-item-flex items-center h-full">
                    <a href="#" wire:click.prevent="connectApp"><i class="cr-extensions__add-new fas fa-plus"></i></a>
                </div>
            {{--// End of list --}}
            </div>
        @else
            <div class="cr-extensions__list st-item-flex">
                {{--// Display add icon:--}}
                <a href="#" wire:click.prevent="connectApp"><i class="cr-extensions__add-new fas fa-plus"></i></a>
            </div>
        @endif

        @if($connectApp)
            <div class="cr-extensions__add-form">
                <div class="">
                    <select wire:model="app_type" name="app_type" class="w-full pl-3 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500">
                        <option selected value="discord">Discord</option>
                        <option value="gdrive">Google Drive</option>
                        <option value="other">Other...</option>
                    </select>
                </div>
                <div class=""><x-jet-input  wire:model="webhook_url" required type="text" value="" name="webhook_url" placeholder="webhook url"/></div>
                <div class=""><x-jet-input  wire:model="app_name" required type="text" value="" name="app_name" placeholder="Name your app"/></div>
                <div class="pt-1 pb-8"><x-jet-button wire:click.prevent="store" type="button">Connect App</x-jet-button></div>
            </div>
        @endif
    </div>
</div>
