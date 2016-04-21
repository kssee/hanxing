@extends('layouts.front')
@section('jsFunctions')

@stop

@section('content')
    @include('partials.breadcrumb')

    <h1>
        @if($type == 'chuan_bao_xue_ren')
            {{trans('custom.chuan_bao_xue_ren')}}
        @elseif($type == 'han_xin_bao')
            {{trans('custom.han_xin_bao')}}
        @else
            {{trans('custom.films_mv')}}
        @endif

        <div class="pull-right">
            @if(count($subcategory))
                @foreach($subcategory as $key=>$name)
                    @if($key == $sub)
                        <span class="color-main bold x-small">{{$name}}</span> &nbsp;&nbsp;
                    @else
                        {!! link_to_route('studentShowcases',$name,['type'=>$input,'sub'=>$key],['class'=>'x-small underline']) !!} &nbsp;&nbsp;
                    @endif
                @endforeach
            @endif
        </div>
    </h1>

    @if(count($result))
        {{--@if($type == 'films_mv')--}}
        @foreach ($result->chunk(6) as $row)
            <div class="highlight-box row">
                @foreach ($row as $entry)
                    <div class="col-sm-2">
                        <div class="item item-mv">
                            @if(!is_null($entry['path_thumbnail']) && !empty($entry['path_thumbnail']))
                                <a href="{{url($entry['link'])}}" {!! $type == 'films_mv' ? 'class="iframe"' : 'target="_blank"'!!} title="{{$entry['title']}}">
                                    <img src="{{asset($entry['path_thumbnail'])}}" class="responsive-image"/>
                                </a>
                            @endif
                            <b>
                                <a href="{{url($entry['link'])}}" {!! $type == 'films_mv' ? 'class="iframe films-link"' : 'class="films-link" target="_blank"'!!} title="{{$entry['title']}}">
                                    {{str_limit($entry['title'],30)}}
                                </a>
                            </b>
                            @if(!is_null($entry['author']) && !empty($entry['author']))
                                <span class="films-author">By: {{$entry['author']}}</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
        {{--@else--}}
        {{--<div class="row">--}}
        {{--<div class="col-sm-8 col-sm-offset-2">--}}
        {{--<div class="panel panel-success">--}}
        {{--<table class="table">--}}
        {{--<thead>--}}
        {{--<tr>--}}
        {{--<th width="10px">#</th>--}}
        {{--<th>{{trans('custom.title')}}</th>--}}
        {{--<th></th>--}}
        {{--</tr>--}}
        {{--</thead>--}}
        {{--<tbody>--}}
        {{--@foreach ($result as $key=>$entry)--}}
        {{--<tr>--}}
        {{--<td>{{++$key + $add_order}}</td>--}}
        {{--<td>{{$entry->title}}</td>--}}
        {{--<td align="right">--}}
        {{--<a href="{{asset($entry->path_file)}}" target="_blank"><i class="fa fa-download color-main"></i></a>--}}
        {{--</td>--}}
        {{--</tr>--}}
        {{--@endforeach--}}
        {{--</tbody>--}}
        {{--</table>--}}

        {{--</div>--}}

        {{--</div>--}}
        {{--</div>--}}

        {{--@endif--}}

        @if(isset($paginate_appends))
            {!! $result->appends($paginate_appends)->render() !!}
        @else
            {!! $result->render() !!}
        @endif
    @else
        <p class="no-record">{{trans('custom.no_record')}}</p>
    @endif
@stop
