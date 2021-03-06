@extends('layouts.admin')
    @section('jsFunctions')
        $( "form" ).validate();
    @stop

    @section('content')
            @include('errors.list')

            {!! Form::open(['url'=>route('admin.ne.store'),'class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data']) !!}

            @include('admin.ne.form',['type'=>'create'])

            {!! Form::close() !!}
    @stop