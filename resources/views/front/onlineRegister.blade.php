@extends('layouts.front')
@section('jsFunctions')
    $( "form" ).validate();
@stop

@section('content')
    @include('flash::message')
    <div class="row">
        <div class="col-sm-offset-2 col-sm-8">
            <h1>{{trans('custom.application_form')}}</h1>
            <p>{{trans('custom.will_contact_you_txt')}}</p>
            <hr />

            {!! Form::Open(['url'=>route('sendRegister'),'role'=>'form','class'=>'form-horizontal','enctype'=>'application/x-www-form-urlencoded']) !!}
            @include('errors.list')
            <div class="form-group">
                <div class="col-sm-12">
                    {!! Form::text('full_name',old('full_name'),['class'=>'form-control input-sm','required'=>'required','autofocus'=>'autofocus','placeholder'=>trans('custom.full_name')])!!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    {!! Form::text('email',old('email'),['class'=>'form-control input-sm','required'=>'required','placeholder'=>trans('custom.email')])!!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    {!! Form::text('contact_no',old('contact_no'),['class'=>'form-control input-sm','required'=>'required','placeholder'=>trans('custom.contact_no')])!!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    {!! Form::select('programme', $programmeList ,NULL,['class'=>'form-control input-sm'])!!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    {!! Form::select('intake_year', $yearList ,NULL,['class'=>'form-control input-sm'])!!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    {!! Form::select('intake_month', $monthList ,NULL,['class'=>'form-control input-sm'])!!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    {!! Form::select('contacted_method', $contacted_method ,NULL,['class'=>'form-control input-sm'])!!}
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-12">
                    <script src='{{env('GOOGLE_RECAPTCHA_JS')}}'></script>
                    <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_CLIENT')}}"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    {!! Form::submit(trans('custom.submit'),['class'=>'btn btn-primary btn-block'])!!}
                </div>
            </div>
            {!! Form::Close() !!}
            <div class="visible-xs-block">
                <hr />
            </div>
        </div>
    </div>
@stop
