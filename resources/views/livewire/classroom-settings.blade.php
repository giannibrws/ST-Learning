<div>

    <x-jet-button wire:click.prevent="interactWith" type="button"><i class="fas fa-cog"></i> </x-jet-button>
    {{-- Submit btn --}}
    <x-jet-button type="submit">Update bio</x-jet-button>

    @if($interactWith)
        <div class="cr-settings">
            <div class="">

                <div class="">
                       <x-jet-label for="webhook_url" value="{{ __('Classroom name:') }}" class="mt-2 pr-2 w-full" />
                        <x-jet-input id="webhook_url" type="text" value="{{$classroom->name}}" name="cr_name" />
                </div>
                <div class="">
                    <x-jet-label for="cr_publicity" value="{{ __('Classroom publicity:') }}" class="mt-2 pr-2 w-full" />
                    <select name="cr_publicity" class="w-full pl-3 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500">
                        <option selected value="{{$classroom->is_public}}">{{$classroom->is_public ? 'Public' : 'Private'}}</option>
                        <option value="{{$classroom->is_public ? '0' : '1'}}">{{$classroom->is_public ? 'Private' : 'Public'}}</option>
                    </select>
                </div>
                <div class="cr-settings__inline">
                    <div class="w-4/5">
                        <x-jet-label for="invitation_link" value="{{ __('Invitation link:') }}" class="mt-2 pr-2" />
                        <x-jet-input id="invitation_link" wire:model="invitation_link" name="invitation_link" required type="text" value="{{$invitation_link}}" />
                    </div>
                    <a href="#" title="Copy link" onclick="CopyText()" ><i class="hover:text-purple-500 pt-10 ml-3 fas fa-copy "></i></a>
                    <a href="#" title="Generate link" wire:click.prevent="updateLink"><i class="hover:text-purple-500 pt-10 ml-3 fas fa-sync "></i></a>

                </div>
                <div class="cr-settings__row">
                    <div class="pr-2"><x-jet-button type="submit">Save settings</x-jet-button></div>
                    <div class=""><x-jet-button wire:click.prevent="interactWith" type="button">Close</x-jet-button></div>
                </div>
            </div>
        </div>
    @endif
</div>


<script>
    function CopyText() {
        var copyText = document.getElementById('invitation_link')
        copyText.select();
        document.execCommand('copy')
        console.log('Text copied')
    }
</script>