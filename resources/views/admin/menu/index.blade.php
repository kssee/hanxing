@extends('layouts.admin')
@section('jsFunctions')
@stop

@section('content')
    @include('flash::message')

    @if(count($result))
        <table class="table table-striped footable toggle-square">
            <thead>
            <tr>
                <th width="20px"></th>
                <th width="60px"></th>
                <th>{!!sortingLink(trans('custom.name'),'a','asc')!!}</th>
                <th>{{trans('custom.chinese_name')}}</th>
                <th>{{trans('custom.path')}}</th>
                <th>{!!sortingLink(trans('custom.layer'),'b')!!}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($result as $entry)
                <tr>
                    <td></td>
                    <td>
                        {!! iconLinkWithPermission('admin_menu','admin.menu.edit','fa-pencil-square-o',trans('custom.edit'),['menu'=>$entry->id]) !!}
                        {!! iconLinkWithPermission('admin_menu','admin.menu.destroy','fa-trash color-danger',trans('custom.delete'),['menu'=>$entry->id],[],true) !!}
                    </td>
                    <td>{{ $entry->name }}</td>
                    <td>{{ $entry->name_zh }}</td>
                    <td>{{ $_SERVER['HTTP_HOST'] . '/' . $entry->path }}</td>
                    <td>{{ $entry->layer }}</td>
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