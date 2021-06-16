{{--Start card:--}}
    @if(!isset($noRedirect))
        <a href="{{ route('notes.edit', [$classroom_id, $subject_id, $note_id])}}">
    @endif
            <div class="st-card st-card--note shadow-sm {{isset($noRedirect) ? '' : 'hover:opacity-50'}}">
                <div class="st-card__content st-card__content--note">
                    <h4 class="text-2xl pb-2 font-semibold text-gray-700">{!! str_replace('&amp;', '&', ($title)) !!}</h4>
                    @if(isset($editable))
                    @else
                    <div class="text-gray-500 ml-1">{!! str_replace('&amp;', '&', (substr($description,0,125))) . "..." !!}</div>
                    @endif                   
                </div>
                <div class="st-card__footer">
                    @if(isset($madeBy))
                    <span class="font-bold st-admin-title">{{$madeBy}}</span>
                        {{--<i class="note-delete fas fa-times hover:text-purple-500"></i>--}}
                    @endif
                </div>
            </div>
            <div class="p-1 bg-indigo-600 bg-opacity-75"></div>
    @if(!isset($noRedirect))
        </a>
    @endif
{{--End card:--}}