@extends('layouts.admin')
@section('jsFunctions')
    @if(checkPermission('admin_update_system_information'))
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
    @endif
@stop

@section('content')
    @include('flash::message')

    @include('partials.editByInfo',['time'=>$system_information->updated_at->timestamp,'name'=>$system_information->upd_by])
    @include('errors.list')

    {!! Form::model($system_information,['url'=>route('admin.systemInfo.update'),'class'=>'form-horizontal','role'=>'form','enctype'=>'application/x-www-form-urlencoded']) !!}

    <div class="form-group">
        {!! Form::label('name',trans('custom.name'),['class'=>'control-label col-sm-3']) !!}
        <div class="col-sm-9">
            {!! Form::text('name',old('name'),['class'=>'form-control input-sm input-required','required'=>'required'])!!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('chinese_name',trans('custom.chinese_name'),['class'=>'control-label col-sm-3']) !!}
        <div class="col-sm-9">
            {!! Form::text('chinese_name',old('chinese_name'),['class'=>'form-control input-sm input-required','required'=>'required'])!!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('address',trans('custom.address'),['class'=>'control-label col-sm-3']) !!}
        <div class="col-sm-9">
            {!! Form::text('address',old('address'),['class'=>'form-control input-sm input-required','required'=>'required'])!!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('email',trans('custom.email'),['class'=>'control-label col-sm-3']) !!}
        <div class="col-sm-9">
            {!! Form::text('email',old('email'),['class'=>'form-control input-sm input-required','required'=>'required'])!!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('tel_academic',trans('custom.tel_academic'),['class'=>'control-label col-sm-3']) !!}
        <div class="col-sm-9">
            {!! Form::text('tel_academic',old('tel_academic'),['class'=>'form-control input-sm'])!!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('tel_registration',trans('custom.tel_registration'),['class'=>'control-label col-sm-3']) !!}
        <div class="col-sm-9">
            {!! Form::text('tel_registration',old('tel_registration'),['class'=>'form-control input-sm'])!!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('tel_office',trans('custom.tel_office'),['class'=>'control-label col-sm-3']) !!}
        <div class="col-sm-9">
            {!! Form::text('tel_office',old('tel_office'),['class'=>'form-control input-sm'])!!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('fax',trans('custom.fax'),['class'=>'control-label col-sm-3']) !!}
        <div class="col-sm-9">
            {!! Form::text('fax',old('fax'),['class'=>'form-control input-sm'])!!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('facebook_url',trans('custom.facebook_url'),['class'=>'control-label col-sm-3']) !!}
        <div class="col-sm-9">
            {!! Form::text('facebook_url',old('facebook_url'),['class'=>'form-control input-sm','placeholder'=>'http(s)://'])!!}
        </div>
    </div>

    <hr/>

    <div class="form-group">
        {!! Form::label('password',trans('custom.student_password'),['class'=>'control-label col-sm-3']) !!}
        <div class="col-sm-9">
            {!! Form::password('password',['class'=>'form-control input-sm','placeholder'=>'Leave it empty to remain the previous password'])!!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('password_confirmation',trans('custom.confirm_student_password'),['class'=>'control-label col-sm-3']) !!}
        <div class="col-sm-9">
            {!! Form::password('password_confirmation',['class'=>'form-control input-sm'])!!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-3"></div>
        <div class="col-sm-9">{!! Form::submit(trans('custom.edit'),['class'=>'btn btn-primary btn-block'])!!}</div>
    </div>

    {!! Form::close() !!}
@stop