@extends('layouts.admin')
@section('jsFunctions')
    $( "form" ).validate();
@stop

@section('content')
    @include('partials.editByInfo',['time'=>$result->updated_at->timestamp])
    @include('errors.list')

    {!! Form::model($result,['url'=>route('admin.role.update',['roles'=>$result->id]),'method'=>'PATCH','class'=>'form-horizontal','role'=>'form','enctype'=>'application/x-www-form-urlencoded']) !!}

    @include('admin.roles.form',['type'=>'edit'])

    {!! Form::close() !!}
@stop