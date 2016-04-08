@extends('layouts.admin')
@section('jsFunctions')
    $( "form" ).validate();
@stop

@section('content')
    @include('partials.editByInfo',['time'=>$result->updated_at->timestamp])
    @include('errors.list')

    {!! Form::model($result,['url'=>route('admin.ne.update',['permissions'=>$result->id]),'method'=>'PATCH','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data']) !!}

    @include('admin.ne.form',['type'=>'edit'])

    {!! Form::close() !!}
@stop