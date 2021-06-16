<div class="" @message_added.window="open = false">
    <div class="cr-chat__content st-scroll-custom">

        @if($is_visible)
            @livewire('user-messages', ['classroom_id' => $classroom_id])
        @else
            <div class="">
                <p>Registered users:</p>

                {{--Show all admins: --}}
                @foreach($linkedUsers as $user)
                    @if($user->role == 'admin')
                        <div class="cr-chat__content__row">
                            <img class="h-10 w-10 rounded-full" src="{{$userProfilePhotos[$user->id] }}" alt="">
                            <p class="cr-chat__content__row__title">{{$user->name}} <b class='ml-1'>({{$user->role}})</b></p>
                        </div>
                    @endif
                @endforeach

                {{--Show all users: --}}
                @foreach($linkedUsers as $user)
                    @if($user->role == 'user')
                        <div class="cr-chat__content__row">
                            <img class="h-10 w-10 rounded-full" src="{{$userProfilePhotos[$user->id] }}" alt="">
                            <p class="cr-chat__content__row__title">{{$user->name}} <b class='ml-1'>({{$user->role}})</b></p>
                        </div>
                    @endif
                @endforeach

                {{--Show all spectators: --}}
                @foreach($linkedUsers as $user)
                    @if($user->role == 'spectator')
                        <div class="cr-chat__content__row">
                            <img class="h-10 w-10 rounded-full" src="{{$userProfilePhotos[$user->id] }}" alt="">
                            <p class="cr-chat__content__row__title">{{$user->name}} <b class='ml-1'>{{$user->role}}</b></p>
                        </div>
                    @endif
                @endforeach

            </div>
        @endif
    </div>
    <div class="pt-8 text-left text-sm">
        @if($is_visible)
            <form method="POST" action="{{ $classroom_id . '/chat'}}">
                @csrf
                <div class="st-input">
                    <div class="st-inputGroup">
                        <label for="userChatInput">@if($showErrors) <p style="color: red">{{$errorMsg}} </p> @endif</label>
                        <input type="text" required maxlength="500" id="userChatInput" name="message_body" wire:model.defer="message_body" class="no-outline" placeholder="Message.." />
                        {{--<span class=""><i class="fas fa-times"></i></span>--}}
                    </div>

                    <div class="flex flex-wrap">
                        <x-jet-button wire:click.prevent="saveMessage" class="px-8">Send</x-jet-button>
                        <x-jet-button wire:click.prevent="displayUserChat" class="st-item-flex ml-3">{{'Return'}}</x-jet-button>
                    </div>
                </div>
            </form>
        @else
            <x-jet-button wire:click.prevent="displayUserChat" class="st-item-flex">{{'Show messages:'}}</x-jet-button>
        @endif
    </div>
</div>

<script>

    // messages staan los van de cr-chat__content container
    // daarom scrollt hij niet automatisch.
    window.addEventListener('updateFeed', event => {

        let scrollPos = $('.cr-chat__content').scrollTop();
        let chatLength = $('.cr-chat__content')[0].scrollHeight - 450;

        // only scroll to latest if user has not scrolled up:
        if(scrollPos >= chatLength){
                setTimeout(() => {
                    $('.cr-chat__content').scrollTop($('.cr-chat__content')[0].scrollHeight);
            }, 500);
        }

        console.log(scrollPos);
        console.log(scrollSize);

    })

    window.addEventListener('message_added', event => {
        // Wait a few mseconds for message to be added:
        setTimeout(() => {
            $('.cr-chat__content').scrollTop($('.cr-chat__content')[0].scrollHeight);
         }, 500);
    })
</script>