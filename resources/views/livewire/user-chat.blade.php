<div class="">
    <div class="cr-chat__content st-scroll-custom">
        @if($is_visible)
            <div class="">
                @php ($j = 0)  @endphp
                @php ($today = false)  @endphp
                @foreach($messages as $message)
                    @if ($message->created_at->format('Y-m-d') == date('Y-m-d'))
                        @php ($today = true)  @endphp
                    @endif
                    @foreach($linked_users as $user)
                        @if ($message->user_id == $user->id)
                            <div class="cr-chat__content__row">
                                <img class="h-10 w-10 rounded-full" src="{{$userProfilePhotos[$user->id]}}" alt="">
                                <p class="cr-chat__content__row__title"> {{$user->id . ' '}}{{$user->name}}
                                    {{$today ? 'today ' . $message->created_at->format('H:i:m') : $message->created_at->format('m-d H:i:m')}}
                                </p>
                            </div>
                            <div class="cr-chat__content__row__message">
                                <p>{{$message->body}}</p>
                                <hr class="opacity-50 mt-2 hover:bg-purple-700">
                            </div>
                        @endif
                    @endforeach
                   @php $j++ @endphp
                @endforeach
            </div>
        @else
            <div class="">
                @php ($k = 0) @endphp
                <p>Registered users:</p>
                @foreach($linked_users as $user)
                    <div class="cr-chat__content__row">
                        <img class="h-10 w-10 rounded-full" src="{{$userProfilePhotos[$user->id]}}" alt="">
                        <p class="cr-chat__content__row__title">{{$user->name}}</p>
                    </div>
                    @php $k++ @endphp
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
                        <input type="text" id="name" name="message_body" class="no-outline" placeholder="Message.." />
                        <span id="st-create-classroom"><i class="fas fa-times"></i></span>
                    </div>
                    <x-jet-button type="submit">Send</x-jet-button>
                </div>
            </form>
        @endif
        <x-jet-button wire:click.prevent="displayUserChat" class="st-item-flex">{{$is_visible ? 'Hide' : 'Show messages:' }}</x-jet-button>
    </div>
</div>
