{{--Refresh component every 2 seconds: (only if component is visible) --}}
<div wire:poll="mountData('{{$classroom_id}}')".visible class="">
    @php ($today = false)  @endphp
    @foreach($messages as $message)
        @if ($message->created_at->format('Y-m-d') == date('Y-m-d'))
            @php ($today = true)  @endphp
        @endif
        @foreach($linked_users as $user)
            @if ($message->user_id == $user->id)
                <div class="cr-chat__content__row">
                    <img class="h-10 w-10 rounded-full" src="{{$userProfilePhotos[$user->id]}}" alt="">
                    <p class="cr-chat__content__row__title">{{$user->name}}
                        {{$today ? 'today ' . $message->created_at->format('H:i:m') : $message->created_at->format('m-d H:i:m')}}
                    </p>
                </div>
                <div class="cr-chat__content__row__message">
                    <p>{{$message->body}}</p>
                    <hr class="opacity-50 mt-2 hover:bg-purple-700">
                </div>
            @endif
        @endforeach
    @endforeach

    @if(!filled($messages))
        <div class="cr-chat__content__row">
            <p class="cr-chat__content__row__title ml-3 text-gray-600">This chat has no messages..</p>
        </div>
    @endif

</div>

