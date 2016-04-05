@extends('layouts.admin')
@section('jsFunctions')
    $( "form" ).validate();
@stop

@section('content')
    @if(count($permissions))
        {!! Form::open(['url'=>route('admin.role.storePermission',['roles'=>$role->id]),'method'=>'PATCH','class'=>'form-horizontal','role'=>'form','enctype'=>'application/x-www-form-urlencoded']) !!}
        @include('errors.list')
        <div class="form-group">
            {!! Form::label('name',trans('custom.permission_lists'),['class'=>'control-label col-sm-2']) !!}
            <div class="col-sm-10">
                @foreach($permissions as $entry)
                    <label>{!! Form::checkbox('permission[]',$entry->id, in_array($entry->id,$permission_role)?true:NULL )!!}
                        &nbsp; {{$entry->display_name}}</label><br/>
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">{!! Form::submit('&nbsp;&nbsp;&nbsp;'.trans('custom.update').'&nbsp;&nbsp;&nbsp;',['class'=>'btn btn-primary'])!!}
                &nbsp;&nbsp;&nbsp;{!! link_to_route('admin.role.index',trans('custom.cancel'),[],['class'=>'btn btn-danger']) !!}</div>
        </div>
        {!! Form::close() !!}
    @else
        <p class="no-record">{{trans('custom.no_record')}}</p>
    @endif
@stop