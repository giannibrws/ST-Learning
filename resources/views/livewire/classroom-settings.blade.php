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

                    <div class="ml-1 mt-1 font-bold">
                <a href="#" wire:click.prevent="toggleAdvanced" class="st-hover">{{$advancedOptions ? 'Hide' : 'Show'}} advanced options:</a>
                </div>

                @if($advancedOptions)
                <a class="delete-confirm ml-2" onclick="deleteConfirm()" href="{{route('classrooms.destroy', ['classroom' => $classroom->id])}}">
                    <x-jet-danger-button-secondary class="mt-4 text-sm" type="button">Delete classroom</x-jet-danger-button-secondary>
                </a>
                @endif

                <div class="cr-settings__row">
                    <div class="pr-2"><x-jet-button type="submit">Save settings</x-jet-button></div>
                    <div class=""><x-jet-button wire:click.prevent="interactWith" type="button">Close</x-jet-button></div>
                </div>
            </div>
        </div>
    @endif
</div>


<script>

    function deleteConfirm(){
            event.preventDefault();
            // if confirm redirect destroy route:
            // use jQuery instead $ to prevent loading issues:
            const url = jQuery('.delete-confirm').attr('href') + '/delete';
            var keyword = 'classroom';
            console.log(url)

            swal({
                title: 'Are you sure?',
                text: 'This ' + keyword + ' and all of its contents will be permanantly deleted!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function (value) {
                if (value) {
                    window.location.href = url;
                }
            });
    }

    // default js:
    function CopyText() {
        var copyText = document.getElementById('invitation_link')
        copyText.select();
        document.execCommand('copy')
        console.log('Text copied')
    }

</script>