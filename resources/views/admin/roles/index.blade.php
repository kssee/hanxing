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
                <th width="80px"></th>
                <th>{!!sortingLink(trans('custom.name'),'a','asc')!!}</th>
                <th>{!!sortingLink(trans('custom.display_name'),'b')!!}</th>
                <th data-hide="phone">{{trans('custom.description')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($result as $entry)
                <tr>
                    <td></td>
                    <td>
                        {!! iconLinkWithPermission('admin_authorization','admin.role.permission','fa-lock color-warning',trans('custom.edit_permission'),['roles'=>$entry->id]) !!}
                        {!! iconLinkWithPermission('admin_authorization','admin.role.edit','fa-pencil-square-o',trans('custom.edit'),['roles'=>$entry->id]) !!}
                        {!! iconLinkWithPermission('admin_authorization','admin.role.destroy','fa-trash color-danger',trans('custom.delete'),['roles'=>$entry->id],[],true) !!}
                    </td>
                    <td>{{ $entry->name }}</td>
                    <td>{{ $entry->display_name }}</td>
                    <td>{{ $entry->description }}</td>
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