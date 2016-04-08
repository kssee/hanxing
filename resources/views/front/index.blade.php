@extends('layouts.index')
@section('jsFunctions')

@stop

@section('content')
    @include('flash::message')
    @if(count($programmesList))
        <div class="container-fluid">
            <div class="highlight-box row">
                @foreach ($programmesList->chunk(4) as $row)
                    @foreach ($row as $entry)
                        @if(isset($entry['special']) && $entry['special'] == true)
                            <div class="col-sm-3">
                                <div class="item item-green" onclick="{!! "location.href='" . route($entry['slug']) . "'"!!}">
                                    <h2 class="color-white">{{$entry['title']}}</h2>
                                </div>
                            </div>
                        @else
                            <div class="col-sm-3">
                                <div class="item item-light">
                                    <div class="cursor-pointer" onclick="{!!"location.href='" . route('pages',['slug'=>$entry['slug']]) . "'"!!}">
                                        <h2 class="font-large">{{$entry['title']}}</h2>
                                        @if(!is_null($entry['path_thumbnail']) && !empty($entry['path_thumbnail']))
                                            <img src="{{asset($entry['path_thumbnail'])}}" class="responsive-image hidden-xs"/>
                                        @endif

                                        @if(!is_null($entry['highlight']) && !empty($entry['highlight']))
                                            <p>{{str_limit($entry['highlight'],110)}}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
    @endif

    <div class="follow-bar">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h2>{{trans('custom.follow_us')}}</h2>

                    <div class="social-bar">
                        <a href="{!! config('system_info')->facebook_url!!}" target="_blank"><i class="fa fa-facebook-square fa-lg"></i></a> &nbsp;
                        <a href="{!! config('system_info')->youtube_url!!}" target="_blank"><i class="fa fa-youtube-square fa-lg"></i></a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="link" onclick="{!! "location.href='" . route('onlineRegister') . "'"!!}">
                        <i class="fa fa-pencil-square-o fa-2x"></i>

                        <h2>{{trans('custom.online_register')}}</h2>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="link" onclick="{!! "location.href='" . route('contactUs') . "'"!!}">
                        <i class="fa fa-commenting fa-2x"></i>

                        <h2>{{trans('custom.contact_us')}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(isset($othersList) && count($othersList))
        <div class="container-fluid">
            <div class="highlight-box row">
                @foreach($othersList as $entry)
                    <div class="col-sm-3">
                        @if(isset($entry['special']) && $entry['special'] == true)
                            <iframe width="100%" src="https://www.youtube.com/embed/dt_JwOGB8Mg" frameborder="0" allowfullscreen></iframe>
                        @else
                            @include('partials.itembox',['category'=>2,'txt'=>$entry['txt'],'route'=>'pages'])
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="news-bar">
        <div class="container">
            <h2>{!! trans('custom.latest_news_events')!!}</h2>

            <div class="row">
                <div class="col-sm-6 news-dash-border">
                    <div class="row">
                        <div class="col-md-6">
                            @if(count($latest_news))
                                <h3>{!! link_to_route('viewNews',$latest_news->title,['slug'=>$latest_news->slug]) !!}</h3>
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if(isset($news) && count($news))
                                @foreach($news as $entry)
                                    <h4>{!! link_to_route('viewNews',$entry->title,['slug'=>$entry->slug]) !!}</h4>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-right">
                                {!! link_to_route('news',trans('custom.more_news'),[],['class'=>'btn btn-more']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        @if(count($events))
                            @foreach($events as $entry)
                                <div class="col-md-6">
                                    <table class="news-bar-table">
                                        <tr>
                                            <td>
                                                <div class="calender-sm-box">
                                                    <div class="month">{{$entry->activity_date->format('M')}}</div>
                                                    <div class="day">{{$entry->activity_date->format('d')}}</div>
                                                </div>
                                            </td>
                                            <td>
                                                <h4>{!! link_to_route('viewEvent',$entry->title,['slug'=>$entry->slug]) !!}</h4>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-right">
                                <div class="hidden-xs"><br/><br/><br/></div>
                                {!! link_to_route('events',trans('custom.more_events'),[],['class'=>'btn btn-more']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop