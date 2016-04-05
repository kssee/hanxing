@extends('layouts.admin')
@section('jsFunctions')
    $( "form" ).validate({
        rules: {
            email: {
                email: true,
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            },
            name: {
                rangelength: [3, 32]
            }
        }
    });
@stop

@section('content')
    @include('errors.list')

    {!! Form::open(['url'=>route('admin.user.store'),'class'=>'form-horizontal','role'=>'form','enctype'=>'application/x-www-form-urlencoded']) !!}
    @include('admin.users.form',['type'=>'create'])

    {!! Form::close() !!}
@stop