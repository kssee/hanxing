@extends('layouts.front')
@section('jsFunctions')

@stop

@section('content')
    @include('partials.breadcrumb')

    <h1>{{trans('custom.student_files')}}</h1>

    @if(count($result))

        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-success">
                    <table class="table">
                        <thead>
                        <tr>
                            <th width="10px">#</th>
                            <th>{{trans('custom.title')}}</th>
                            <th class="hidden-xs">{{trans('custom.uploaded_date')}}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($result as $key=>$entry)
                            <tr>
                                <td>{{++$key + $add_order}}</td>
                                <td>
                                    <a href="{{route('studentFileView',['id'=>$entry->id])}}" target="_blank">{{$entry->title}}</a>
                                    <span class="small color-gray">{{$categoryArr[$entry->category]}}</span>
                                </td>
                                <td class="hidden-xs">{{$entry->created_at->toFormattedDateString()}}</td>
                                <td align="right">
                                    <a href="{{route('studentFileView',['id'=>$entry->id])}}" target="_blank"><i class="fa fa-download color-main"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

        @if(isset($paginate_appends))
            {!! $result->appends($paginate_appends)->render() !!}
        @else
            {!! $result->render() !!}
        @endif
    @else
        <p class="no-record">{{trans('custom.no_record')}}</p>
    @endif
@stop
