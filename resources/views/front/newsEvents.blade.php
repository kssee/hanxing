@extends('layouts.front')
@section('jsFunctions')

@stop

@section('content')
    @include('partials.breadcrumb')

    <h1>
        @if($type == 'events')
            {{trans('custom.events')}}

            <div class="pull-right">
                @if($past)
                    {!! link_to_route('events',trans('custom.coming_soon'),['past'=>0],['class'=>'x-small underline']) !!} .
                    <span class="x-small color-gray">{{trans('custom.past')}}</span>
                @else
                    <span class="x-small color-gray">{{trans('custom.coming_soon')}}</span> .
                    {!! link_to_route('events',trans('custom.past'),['past'=>1],['class'=>'x-small underline']) !!}
                @endif
            </div>
        @else
            {{trans('custom.news')}}
        @endif
    </h1>

    @if(count($result))
        @if($type == 'news')
            @foreach ($result->chunk(4) as $row)
                <div class="highlight-box row">
                    @foreach ($row as $entry)
                        <div class="col-sm-3">
                            <div class="item item-light">
                                <div class="cursor-pointer" onclick="{!!"location.href='" . route('viewNews',['slug'=>$entry['slug']]) . "'"!!}">

                                    @if(!is_null($entry['path_thumbnail']) && !empty($entry['path_thumbnail']))
                                        <img src="{{asset($entry['path_thumbnail'])}}" class="responsive-image hidden-xs"/>
                                    @endif

                                    <b>{{str_limit($entry['title'],30)}}</b>

                                    @if(!is_null($entry['highlight']) && !empty($entry['highlight']))
                                        <p>{{str_limit($entry['highlight'],110)}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @else
            @foreach ($result->chunk(2) as $row)
                <div class="highlight-box row">
                    @foreach ($row as $entry)
                        <div class="col-sm-6">
                            <div class="item item-event">
                                <table width="100%">
                                    <tr>
                                        <td valign="top" width="100px" class="hidden-xs">
                                            <span class="fa-stack fa-3x color-main">
                                                <i class="fa fa-calendar-o fa-stack-2x"></i>
                                                <span class="calendar-txt">
                                                    {{$entry->activity_date->format('d')}}<br/>
                                                    {{$entry->activity_date->format('M')}}
                                                </span>
                                            </span>
                                        </td>
                                        <td valign="top">
                                            <h2>{!! link_to_route('viewEvent',ucwords(str_limit($entry->title,30)),['slug'=>$entry->slug]) !!}</h2>
                                            <span class="activity-date visible-xs">{{$entry->activity_date->toFormattedDateString()}}</span>

                                            <p>{{ucfirst(str_limit($entry->highlight,160))}}</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @endif

        @if(isset($paginate_appends))
            {!! $result->appends($paginate_appends)->render() !!}
        @else
            {!! $result->render() !!}
        @endif
    @else
        <p class="no-record">{{trans('custom.no_record')}}</p>
    @endif
@stop