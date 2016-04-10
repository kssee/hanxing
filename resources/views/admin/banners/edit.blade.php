@extends('layouts.admin')
@section('jsFunctions')
    $( "form" ).validate();
@stop

@section('content')
    @include('partials.editByInfo',['time'=>$result->updated_at->timestamp,'name'=>$result->upd_by])
    @include('errors.list')

    {!! Form::model($result,['url'=>route('admin.banner.update',['permissions'=>$result->id]),'method'=>'PATCH','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data']) !!}

    @include('admin.banners.form',['type'=>'edit'])

    {!! Form::close() !!}
@stop