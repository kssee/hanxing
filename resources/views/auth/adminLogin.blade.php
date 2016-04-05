@extends('layouts.adminFront')
@section('jsFunctions')
    $( "form" ).validate({
    rules: {
    email: {
    email: true,
    },
    }
    });
@stop

@section('content')
    <div class="container">
        <br/><br/>

        <div class="text-center">
            {!! Html::image(asset('/images/logos/logo.png'),config('system_info')->name . ' Logo',['width'=>'200px']) !!}
        </div>

        <br/><br/>

        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <div class="login-panel panel panel-default">

                    <div class="panel-heading"><h3 class="panel-title">{{trans('custom.admin_signin')}}</h3></div>

                    <div class="panel-body">

                        {!! Form::open(['role'=>'form','enctype'=>'application/x-www-form-urlencoded']) !!}
                        <fieldset>
                            @include('errors.list')

                            <div class="form-group">
                                {!! Form::text('email',NULL,['required','class'=>'form-control input-lg','placeholder'=>trans('custom.email'),'autofocus'=>'autofocus'])!!}
                            </div>

                            <div class="form-group">
                                {!! Form::password('password',['required','class'=>'form-control input-lg','placeholder'=>trans('custom.password')])!!}
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
