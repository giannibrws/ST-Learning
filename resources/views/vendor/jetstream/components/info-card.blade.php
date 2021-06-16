{{--Start card:--}}
<div class="{{isset($display_grid) ? '' : 'w-full px-6 sm:w-1/2 xl:w-1/3 mb-8'}}">
    @if(!isset($noRedirect))
    <a href="{{ route( $url . '.show', $id)}}">
    @endif
    <div class="{{isset($display_grid) ? '' : '' }} st-card {{isset($card_type) ? $card_type : ''}} shadow-sm {{isset($noRedirect) ? '' : 'hover:opacity-50'}}">

        <div class="st-card__content">

            <x-jet-cr-image>
                <x-slot name="cr_card"></x-slot>
            </x-jet-cr-image>

            <div class="mx-5 st-card__description">
                <h4 class="text-2xl font-semibold text-gray-700">{{ $title }}</h4>
                @if(isset($editable))
                @else
                <div class="text-gray-500">{!! substr($description,0,100) . "..." !!}</div>
                @endif
            </div>

        {{--End content --}}
        </div>

        <div class="st-card__footer">
            @if(isset($createdBy))
                <span class="font-bold st-admin-title">
                    @if(isset($memberCount))
                        <span title="members">
                            <i class="fas fa-users"></i> <b class="mr-3">{{$memberCount}}</b>
                        </span>
                    @endif
                    Made by: {{$createdBy}}
                </span>

                @if(isset($communityED))
                    <p class="mt-3 font-bold">
                        <a href="{{route('classrooms.visit', $id)}}" class="st-hover text-purple-400">Visit classroom</a>
                    </p>
                @endif

            @endif
        </div>

    </div>
    @if(!isset($noRedirect))
    </a>
    @endif
</div>
{{--End card:--}}