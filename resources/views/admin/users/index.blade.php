@extends('layouts.admin')
@section('jsFunctions')

@stop

@section('content')
    @include('flash::message')
    @include('errors.list')

    {!! filterBar($filter_list)!!}
    @if(count($result))
        <table class="table table-striped footable toggle-square">
            <thead>
            <tr>
                <th width="20px"></th>
                <th width="110px"></th>
                <th>{!!sortingLink(trans('custom.name'),'a','asc')!!}</th>
                <th>{!!sortingLink(trans('custom.email'),'b')!!}</th>
                <th>{!!sortingLink(trans('custom.position'),'c')!!}</th>
                <th>{!!sortingLink(trans('custom.contact_no'),'d')!!}</th>
                <th>{{trans('custom.ext')}}</th>
                <th>{{trans('custom.role')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($result as $entry)
                <tr>
                    <td></td>
                    <td>
                        @if($entry->status == 'ACTIVE')
                            <i class="fa fa-circle fa-lg color-success" data-toggle='tooltip' title="{{trans('custom.active')}}"></i>
                        @elseif($entry->status == 'SUSPEND')
                            <i class="fa fa-circle fa-lg color-danger" data-toggle='tooltip' title="{{trans('custom.suspend')}}"></i>
                        @endif

                        &nbsp;

                        {!! iconLinkWithPermission('admin_authorization','admin.user.edit','fa-pencil-square-o',trans('custom.edit'),['users'=>$entry->id]) !!}
                        @if(auth()->user()->email != $entry->email)
                            {!! iconLinkWithPermission('admin_authorization','admin.user.destroy','fa-trash color-danger',trans('custom.destroy'),['users'=>$entry->id],[],true) !!}
                        @else
                            <i class="fa fa-trash fa-lg color-gray curson-disable"></i>
                        @endif
                    </td>
                    <td>{{ $entry->name }}</td>
                    <td>{{ $entry->email }}</td>
                    <td>{{ $entry->position }}</td>
                    <td>{{ $entry->tel }}</td>
                    <td>{{ $entry->ext }}</td>
                    <td>{{ $entry->display_name }}</td>
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