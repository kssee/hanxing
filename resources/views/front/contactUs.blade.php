@extends('layouts.front')
@section('jsFunctions')

@stop

@section('content')
    @include('flash::message')
    <h1>{{trans('custom.contact_us')}}</h1>
    <p>{{trans('custom.need_help_txt')}}</p>

    <div class="row">
        <div class="col-sm-8">
            {!! Form::Open(['url'=>route('sendContact'),'role'=>'form','class'=>'form-horizontal','enctype'=>'application/x-www-form-urlencoded']) !!}
            @include('errors.list')
            <div class="form-group">
                <div class="col-sm-12">
                    {!! Form::text('name',old('name'),['class'=>'form-control input-sm','required'=>'required','autofocus'=>'autofocus','placeholder'=>trans('custom.name')])!!}
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
                    {!! Form::select('nature', $natures ,NULL,['class'=>'form-control input-sm'])!!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    {!! Form::textarea('enquiry_message', NULL ,['class'=>'form-control input-sm','required'=>'required','placeholder'=>trans('custom.enquiry')])!!}
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
        <div class="col-sm-4 contact-info-box">
            <div class="header">
                {{config('system_info')->name}}
            </div>
            <div class="content">
            <b>Address</b> : {{config('system_info')->address}}<br/>
            <b>Tel (教务处)</b> : {{config('system_info')->tel_academic}}<br/>
            <b>Tel (招生处)</b> : {{config('system_info')->tel_registration}}<br/>
            <b>Tel (行政处)</b> : {{config('system_info')->tel_office}}<br/>
            <b>Fax</b> : {{config('system_info')->fax}}<br/>
            <b>Email</b> : {{config('system_info')->email}}<br/>
            <b>Social</b> : {{config('system_info')->facebook_url}}
            </div>
        </div>
    </div>
@stop