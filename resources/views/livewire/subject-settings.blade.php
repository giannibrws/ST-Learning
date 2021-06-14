<div>

    <x-jet-button wire:click.prevent="interactWith" type="button"><i class="fas fa-cog"></i> </x-jet-button>
    {{-- Submit btn --}}
    <x-jet-button type="submit">Update bio</x-jet-button>

     {{--@if(isset($adminName))--}}
        {{--<span class="ml-3 font-bold">{{$adminName}}</span>--}}
    {{--@endif--}}

    @if($interactWith)
        <div class="cr-settings">
            <div class="">

                <div class="">
                       <x-jet-label for="subject_name" value="{{ __('Subject name:') }}" class="mt-2 pr-2 w-full" />
                        <x-jet-input id="subject_name" type="text" value="{{$subject->name}}" name="sub_name" />
                </div>

                    <div class="ml-1 mt-1 font-bold">
                <a href="#" wire:click.prevent="toggleAdvanced" class="st-hover">{{$advancedOptions ? 'Hide' : 'Show'}} advanced options:</a>
                </div>

                @if($advancedOptions)
                <a class="delete-confirm ml-2" onclick="deleteConfirm()" href="{{route('subjects.destroy', ['classroom_id' => $subject->fk_classroom_id, 'subject' => $subject->id])}}">
                    <x-jet-danger-button-secondary class="mt-4 text-sm" type="button">Delete subject</x-jet-danger-button-secondary>
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
            var keyword = 'subject';
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