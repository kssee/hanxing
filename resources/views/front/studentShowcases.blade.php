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
    </h1>

    @if(count($result))
        @if($type == 'films_mv')
            @foreach ($result->chunk(4) as $row)
                <div class="highlight-box row">
                    @foreach ($row as $entry)
                        <div class="col-sm-3">
                            <div class="item item-black">
                                @if(!is_null($entry['path_thumbnail']) && !empty($entry['path_thumbnail']))
                                    <a href="{{url($entry['link'])}}" class="iframe" title="{{$entry['title']}}">
                                        <img src="{{asset($entry['path_thumbnail'])}}" class="responsive-image"/>
                                    </a>
                                @endif
                                <b>
                                    <a href="{{url($entry['link'])}}" class="iframe films_link" title="{{$entry['title']}}">
                                        {{str_limit($entry['title'],30)}}
                                    </a>
                                </b>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @else
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="panel panel-success">
                        <table class="table">
                            <thead>
                            <tr>
                                <th width="10px">#</th>
                                <th>{{trans('custom.title')}}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($result as $key=>$entry)
                                <tr>
                                    <td>{{++$key + $add_order}}</td>
                                    <td>{{$entry->title}}</td>
                                    <td align="right">
                                        <a href="{{asset($entry->path_file)}}" target="_blank"><i class="fa fa-download color-main"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>

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
