<div class="item
@if($category == 3)
        item-black
@elseif($category == 2)
        item-dark
@else
        item-light
@endif
        ">
    <div class="cursor-pointer" onclick="{!!"location.href='" . route($route,['slug'=>$entry['slug']]) . "'"!!}">
        @if($category == 1)
            <h2>{{trans()->locale() == 'en' ? $entry['title'] : $entry['title_zh']}}</h2>

            @if(!is_null($entry['path_thumbnail']) && !empty($entry['path_thumbnail']))
                <img src="{{asset($entry['path_thumbnail'])}}" class="responsive-image hidden-xs"/>
            @endif
        @else
            @if(!is_null($entry['path_thumbnail']) && !empty($entry['path_thumbnail']))
                <img src="{{asset($entry['path_thumbnail'])}}" class="responsive-image hidden-xs"/>
            @endif

                <h2>{{trans()->locale() == 'en' ? $entry['title'] : $entry['title_zh']}}</h2>
        @endif

        @if(!is_null($entry['highlight']) && !empty($entry['highlight']) && $category != 2)
            <p>{{str_limit($entry['highlight'],110)}}</p>
        @endif

        @if($category == 2)
            <span>{{$txt}}</span>
        @elseif($category == 3)
            <div class="more-link">{{$txt}}</div>
        @endif
    </div>
</div>
