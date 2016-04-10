@extends('layouts.admin')
@section('jsFunctions')
@stop

@section('content')
    @include('flash::message')
    {!! filterBar($filter_list)!!}
    @if(count($result))
        <table class="table table-striped footable toggle-square">
            <thead>
            <tr>
                <th width="20px"></th>
                <th width="80px"></th>
                <th width="110px">{!!sortingLink(trans('custom.created_date'),'a','desc')!!}</th>
                <th width="110px">{!!sortingLink(trans('custom.activity_date'),'c')!!}</th>
                <th>{!!sortingLink(trans('custom.title'),'b')!!}</th>
                <th>{{trans('custom.chinese_name')}}</th>
                <th>{!!sortingLink(trans('custom.category'),'d')!!}</th>
                <th width="10%">{{trans('custom.image')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($result as $entry)
                <tr>
                    <td></td>
                    <td>
                        @if($entry->published == '1')
                            <i class="fa fa-circle fa-lg color-success"></i>&nbsp;
                        @else
                            <i class="fa fa-circle fa-lg color-danger"></i>&nbsp;
                        @endif

                        {!! iconLinkWithPermission('admin_pages','admin.ne.edit','fa-pencil-square-o',trans('custom.edit'),['pages'=>$entry->id]) !!}
                        @if(!$entry->default)
                            {!! iconLinkWithPermission('admin_pages','admin.ne.destroy','fa-trash color-danger',trans('custom.delete'),['pages'=>$entry->id],[],true) !!}
                        @endif
                    </td>
                    <td>{{ $entry->created_at->toFormattedDateString() }}</td>
                    <td>{{ $entry->activity_date->format('Y-m-d') }}</td>
                    <td>{{ $entry->title }}</td>
                    <td>{{ $entry->title_zh }}</td>
                    <td>{{ ucfirst($entry->category) }}</td>
                    <td>
                        @if(!is_null($entry->path_thumbnail))
                            <img src="{{ asset($entry->path_thumbnail) }}" class="responsive-image"/>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p class="no-record">{{trans('custom.no_record')}}</p>
    @endif

    @if(isset($paginate_appends))
        {!! $result->appends($paginate_appends)->render() !!}
    @else
        {!! $result->render() !!}
    @endif
@stop