@extends('layouts.admin')
@section('jsFunctions')
    $( "form" ).validate();
    $(".multi-select").select2();
@stop

@section('content')
    @include('partials.editByInfo',['time'=>$result->updated_at->timestamp,'name'=>$result->upd_by])
    @include('errors.list')

    {!! Form::model($result,['url'=>route('admin.page.update',['permissions'=>$result->id]),'method'=>'PATCH','class'=>'form-horizontal','role'=>'form','enctype'=>'multipart/form-data']) !!}

    @include('admin.pages.form',['type'=>'edit'])

    {!! Form::close() !!}
@stop