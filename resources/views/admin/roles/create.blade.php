@extends('layouts.admin')
@section('jsFunctions')
    $( "form" ).validate();
@stop

@section('content')
    @include('errors.list')

    {!! Form::open(['url'=>route('admin.role.store'),'class'=>'form-horizontal','role'=>'form','enctype'=>'application/x-www-form-urlencoded']) !!}

    @include('admin.roles.form',['type'=>'create'])

    {!! Form::close() !!}
@stop