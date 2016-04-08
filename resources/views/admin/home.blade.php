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
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <br />
            <div align="center">
                <b>Welcome to {{config('system_info')->name}} Admin Panel!</b><br/>
                Have a nice day.
            </div>

            <hr /><br />

            <div class="panel panel-default">
                <div class="panel-heading">
                    System Information
                    @if(checkPermission('system_information'))
                        <a class="btn btn-primary btn-xs pull-right" href="{{route('admin.systemInfo.edit')}}">{{trans('custom.edit')}}</a>
                    @endif
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td><label>{{trans('custom.name')}}</label></td>
                            <td>{{$system_information->name}}</td>
                        </tr>
                        <tr>
                            <td><label>{{trans('custom.chinese_name')}}</label></td>
                            <td>{{$system_information->chinese_name}}</td>
                        </tr>
                        <tr>
                            <td><label>{{trans('custom.address')}}</label></td>
                            <td>{{$system_information->address}}</td>
                        </tr>
                        <tr>
                            <td><label>{{trans('custom.email')}}</label></td>
                            <td>{{$system_information->email}}</td>
                        </tr>
                        <tr>
                            <td><label>{{trans('custom.tel_academic')}}</label></td>
                            <td>{{$system_information->tel_academic}}</td>
                        </tr>
                        <tr>
                            <td><label>{{trans('custom.tel_registration')}}</label></td>
                            <td>{{$system_information->tel_registration}}</td>
                        </tr>
                        <tr>
                            <td><label>{{trans('custom.tel_office')}}</label></td>
                            <td>{{$system_information->tel_office}}</td>
                        </tr>
                        <tr>
                            <td><label>{{trans('custom.fax')}}</label></td>
                            <td>{{$system_information->fax}}</td>
                        </tr>
                        <tr>
                            <td><label>{{trans('custom.facebook_url')}}</label></td>
                            <td>{{$system_information->facebook_url}}</td>
                        </tr>
                        <tr>
                            <td><label>{{trans('custom.youtube_url')}}</label></td>
                            <td>{{$system_information->youtube_url}}</td>
                        </tr>
                        <tr>
                            <td><label>{{trans('custom.student_password')}}</label></td>
                            <td><i class="color-gray">*encrypted*</i></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop