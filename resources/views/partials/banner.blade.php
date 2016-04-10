@if(count($banners))
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        @if(count($banners) > 1)
            <ol class="carousel-indicators">
                @foreach($banners as $key=>$entry)
                    <li data-target="#myCarousel" data-slide-to="{{$key}}" {!! $key == 0 ? 'class="active"' : '' !!}></li>
                @endforeach
            </ol>
        @endif

        <div class="carousel-inner">
            @foreach($banners as $key=>$entry)
                <div class="item {{ $key == 0 ? 'active' : '' }}">
                    @if(!is_null($entry->title) && !empty($entry->title))
                        <img src="{{asset($entry->path)}}" alt="{{$entry->title}}">

                        <div class="carousel-caption hidden-xs">
                            <h1>{{$entry->title}}</h1>

                            <h3>{{$entry->description}}</h3>
                            @if(!is_null($entry->url) && !empty($entry->url))
                                {!! link_to($entry->url,trans('custom.read_more'),[],['target'=>'_blank']) !!}
                            @endif
                        </div>
                        <div class="carousel-caption-mobile visible-xs-block">
                            @if(!is_null($entry->url) && !empty($entry->url))
                                {!! link_to($entry->url,trans('custom.read_more'),[],['target'=>'_blank']) !!}
                            @endif
                            <b>{{$entry->title}}</b><br>
                            {{$entry->description}}
                        </div>
                    @elseif(!is_null($entry->url) && !empty($entry->url))
                        <a href="{{$entry->url}}" target="_blank"><img src="{{asset($entry->path)}}" alt="{{$entry->title}}"></a>
                    @else
                        <img src="{{asset($entry->path)}}" alt="{{$entry->title}}">
                    @endif
                </div>
            @endforeach
        </div>

        @if(count($banners) > 1)
            <a class="left carousel-control hidden-xs" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control hidden-xs" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        @endif
    </div>

@endif