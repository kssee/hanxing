@extends('layouts.admin')
@section('jsFunctions')
    $( "form" ).validate();
@stop

@section('content')
    @include('partials.editByInfo',['time'=>$result->updated_at->timestamp,'name'=>$result->upd_by])
    @include('errors.list')

    {!! Form::model($result,['url'=>route('admin.menu.update',['menu'=>$result->id]),'method'=>'PATCH','class'=>'form-horizontal','role'=>'form','enctype'=>'application/x-www-form-urlencoded']) !!}

    @include('admin.menu.form',['type'=>'edit'])

    {!! Form::close() !!}
@stop