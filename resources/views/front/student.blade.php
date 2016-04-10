@extends('layouts.adminFront')
@section('jsFunctions')
    $( "form" ).validate();
@stop

@section('content')
    <div class="container">
        <br/>
        <div class="text-right">{!! link_to_route('index',trans('custom.back_to_home')) !!}</div>
        <br/>

        <div class="text-center">
            {!! Html::image(asset('/images/logos/logo.png'),config('system_info')->name . ' Logo',['width'=>'200px']) !!}
        </div>

        <br/><br/>

        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <div class="login-panel panel panel-default">

                    <div class="panel-heading"><h3 class="panel-title">{{$page_title}}</h3></div>

                    <div class="panel-body">

                        {!! Form::open(['role'=>'form','enctype'=>'application/x-www-form-urlencoded']) !!}
                        <fieldset>
                            @include('errors.list')

                            <div class="form-group">
                                {!! Form::text('username',NULL,['class'=>'form-control input-lg','placeholder'=>$username,'disabled'])!!}
                            </div>

                            <div class="form-group">
                                {!! Form::password('password',['required','class'=>'form-control input-lg','placeholder'=>trans('custom.password'),'autofocus'=>'autofocus'])!!}
                            </div>

                            {!! Form::submit(trans('custom.login'),['class'=>'btn btn-lg btn-success btn-block'])!!}
                        </fieldset>
                        {!! Form::Close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

