{{--Start card:--}}
    @if(!isset($noRedirect))
        <a href="{{ route( $url . '.edit', $id)}}">
    @endif
            <div class="st-card st-card--note shadow-sm {{isset($noRedirect) ? '' : 'hover:opacity-50'}}">
                <div class="mx-5">
                    <h4 class="text-2xl font-semibold text-gray-700">{{ $title }}</h4>
                    @if(isset($editable))
                    @else
                    <div class="text-gray-500">{{ substr($description,0,125) . "..." }}</div>
                    @endif
                    <div class="pt-8 pb-4"></div>
                    @if(isset($madeBy))
                    <span class="font-bold st-admin-title">{{$madeBy}}</span>
                    @endif
                </div>
            </div>
            <div class="p-1 bg-indigo-600 bg-opacity-75"></div>
    @if(!isset($noRedirect))
        </a>
    @endif
{{--End card:--}}