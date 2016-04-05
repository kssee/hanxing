@extends('layouts.admin')
    @section('jsFunctions')
        $( "form" ).validate();
    @stop

    @section('content')
            @include('errors.list')

            {!! Form::open(['url'=>route('admin.permission.store'),'class'=>'form-horizontal','role'=>'form','enctype'=>'application/x-www-form-urlencoded']) !!}

            @include('admin.permissions.form',['type'=>'create'])

            {!! Form::close() !!}
    @stop