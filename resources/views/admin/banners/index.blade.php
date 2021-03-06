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
                <th width="150px">{!!sortingLink(trans('custom.created_date'),'a','desc')!!}</th>
                <th>{!!sortingLink(trans('custom.title'),'b')!!}</th>
                <th>{{trans('custom.url')}}</th>
                <th width="30%">{{trans('custom.image')}}</th>
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

                        {!! iconLinkWithPermission('admin_banners','admin.banner.edit','fa-pencil-square-o',trans('custom.edit'),['banners'=>$entry->id]) !!}
                        @if(!$entry->default)
                            {!! iconLinkWithPermission('admin_banners','admin.banner.destroy','fa-trash color-danger',trans('custom.delete'),['pages'=>$entry->id],[],true) !!}
                        @endif
                    </td>
                    <td>{{ $entry->created_at->toFormattedDateString() }}</td>
                    <td>{{ is_null($entry->title)?"-":$entry->title }}</td>
                    <td>{{ is_null($entry->url)?"-":$entry->url }}</td>
                    <td><img src="{{ asset($entry->path) }}" class="responsive-image" /> </td>
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