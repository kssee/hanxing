@extends('layouts.front')
@section('jsFunctions')

@stop

@section('content')
    @include('partials.breadcrumb')
    <div class="row">
        <div class="col-sm-8">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31872.286592708893!2d101.732433!3d3.085114!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x12bb13e64e73a78a!2sOne+World+HanXing+College+of+Journalism+and+Communication!5e0!3m2!1sen!2sus!4v1460116233115"
                    width="100%" height="300px" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
        <div class="col-sm-4 contact-info-box">
            <div class="header">
                {{trans('custom.office_hour')}}
            </div>
            <div class="content">
                {!! nl2br(config('system_info')->sticker_content) !!}
            </div>
        </div>
    </div>

    <div class="row contact-us-info-bar">
        <div class="col-sm-3 border-right-dash">
            <table class="contact-us-info-bar" width="100%">
                <tr>
                    <td valign="top" width="30px"><i class="fa fa-home fa-2x color-main"></i></td>
                    <td>
                        <h4>{{trans('custom.address')}}</h4>
                        <p>{{config('system_info')->address}}</p>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-sm-3 border-right-dash">
            <table class="contact-us-info-bar" width="100%">
                <tr>
                    <td valign="top" width="30px"><i class="fa fa-envelope-o fa-2x color-main"></i></td>
                    <td>
                        <h4>{{trans('custom.email')}}</h4>
                        <p>{{config('system_info')->email}}</p>
                        <div class="hidden-xs">
                            <br/><br/>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-sm-3 border-right-dash">
            <table class="contact-us-info-bar" width="100%">
                <tr>
                    <td valign="top" width="30px"><i class="fa fa-phone fa-2x color-main"></i></td>
                    <td>
                        <h4>{{trans('custom.contact_no')}}</h4>
                        <p>
                            {{trans('custom.tel_academic')}} : {{config('system_info')->tel_academic}}<br />
                            {{trans('custom.tel_registration')}} : {{config('system_info')->tel_registration}}<br />
                            {{trans('custom.tel_office')}} : {{config('system_info')->tel_office}}
                        </p>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-sm-3">
            <table class="contact-us-info-bar" width="100%">
                <tr>
                    <td valign="top" width="30px"><i class="fa fa-fax fa-2x color-main"></i></td>
                    <td>
                        <h4>{{trans('custom.fax')}}</h4>
                        <p>{{config('system_info')->fax}}</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <hr/>

    <div class="row">
        <div class="col-sm-8 border-right-dash">
            {!! config('system_info')->page_content !!}
        </div>
        <div class="col-sm-4">
            <div class="visible-xs"> <br /></div>
            <div id="fb">
                <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fhanxingcollege&amp;width=350&amp;height=330&amp;colorscheme=light&amp;show_faces=false&amp;header=false&amp;stream=true&amp;show_border=false&amp;appId=502119806575071"
                        scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100%; height:330px;" allowTransparency="true"></iframe>
            </div>
        </div>
    </div>
@stop
