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
                                <a href="{{$entry->url}}" target="_blank">Read more</a>
                            @endif
                        </div>
                        <div class="carousel-caption-mobile visible-xs-block">
                            @if(!is_null($entry->url) && !empty($entry->url))
                                <a href="{{$entry->url}}" target="_blank">Read more</a>
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

{{--<div id="myCarousel" class="carousel slide hidden-xs" data-ride="carousel">--}}
{{--<ol class="carousel-indicators">--}}
{{--<li data-target="#myCarousel" data-slide-to="0" class="active"></li>--}}
{{--<li data-target="#myCarousel" data-slide-to="1"></li>--}}
{{--</ol>--}}
{{--<div class="carousel-inner">--}}
{{--<div class="item active">--}}
{{--<img src="{{asset('images/banners/test3.png')}}" alt="First slide">--}}

{{--<div class="carousel-caption hidden-xs">--}}
{{--<h1>Slide 1</h1>--}}

{{--<h3>Aenean a rutrum nulla. Vestibulum a asd sssadasdsa sas</h3>--}}
{{--<span>Read more</span>--}}
{{--</div>--}}
{{--<div class="carousel-caption-mobile visible-xs-block">--}}
{{--<span>Read more</span>--}}
{{--<b>Slide 1</b><br>--}}
{{--Aenean a rutrum nulla. Vestibulum a asd sssadasdsa sas--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="item">--}}
{{--<img src="{{asset('images/banners/test3.png')}}" alt="Second slide">--}}

{{--<div class="carousel-caption hidden-xs">--}}
{{--<h1>Slide 2</h1>--}}

{{--<h3>ARex See see kok isnag</h3>--}}
{{--<span>Read more</span>--}}
{{--</div>--}}
{{--<div class="carousel-caption-mobile visible-xs-block">--}}
{{--<span>Read more</span>--}}
{{--<b>Slide 2</b><br>--}}

{{--ARex See see kok isnag--}}
{{--</div>--}}
{{--</div>--}}

{{--</div>--}}
{{--<a class="left carousel-control hidden-xs" href="#myCarousel" data-slide="prev">--}}
{{--<span class="glyphicon glyphicon-chevron-left"></span>--}}
{{--</a>--}}
{{--<a class="right carousel-control hidden-xs" href="#myCarousel" data-slide="next">--}}
{{--<span class="glyphicon glyphicon-chevron-right"></span>--}}
{{--</a>--}}
{{--</div>--}}