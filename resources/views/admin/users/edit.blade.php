@extends('layouts.admin')
@section('jsFunctions')
    $( "form" ).validate({
        rules: {
            email: {
                email: true,
            },
            password_confirmation: {
                equalTo: "#password"
            },
            name: {
                rangelength: [3, 32]
            }
        }
    });
@stop

@section('content')
    @include('partials.editByInfo',['time'=>$user->updated_at->timestamp,'name'=>$user->upd_by])
    @include('flash::message')
    @include('errors.list')


    {!! Form::model($user,['url'=>route('admin.user.update',['users'=>$user->id]),'method'=>'PATCH','class'=>'form-horizontal','role'=>'form','enctype'=>'application/x-www-form-urlencoded']) !!}

    @include('admin.users.form',['type'=>'edit'])

    {!! Form::close() !!}
@stop