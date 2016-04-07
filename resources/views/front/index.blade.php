@extends('layouts.index')
@section('jsFunctions')

@stop

@section('content')
    @include('flash::message')
    <div class="container-fluid">

        {{--<span class="fa-stack fa-3x color-main">--}}
        {{--<i class="fa fa-calendar-o fa-stack-2x"></i>--}}
        {{--<span class="calendar-txt">--}}
        {{--23<br/>--}}
        {{--Apr--}}
        {{--</span>--}}
        {{--</span>--}}
        <div class="highlight-box row">
            <div class="col-sm-3">
                <div class="item item-green">
                    <h2 class="color-white">Apply Now</h2>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="item item-light">
                    <div class="cursor-pointer">
                        <h2>Title</h2>
                        <img src="{{asset('images/item-example.jpg')}}" class="responsive-image hidden-xs"/>

                        <p>Our career-focused degrees include business, finance, built environment and engineering specialisms.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="item item-light">
                    <div class="cursor-pointer">
                        <h2>Title</h2>
                        <img src="{{asset('images/item-example.jpg')}}" class="responsive-image hidden-xs"/>

                        <p>Our professionally relevant Masters are designed to meet the demands and economic drivers of the world today.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="item item-light">
                    <div class="cursor-pointer">
                        <h2>Title</h2>
                        <img src="{{asset('images/item-example.jpg')}}" class="responsive-image hidden-xs"/>

                        <p>Our professionally relevant Masters are designed to meet the demands and economic drivers of the world today.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="follow-bar">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h2>Follow Us</h2>

                    <div class="social-bar">
                        <i class="fa fa-facebook-square fa-lg"></i> &nbsp;
                        <i class="fa fa-youtube-square fa-lg"></i>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="link">
                        <i class="fa fa-pencil-square-o fa-2x"></i>

                        <h2>Online Register</h2>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="link">
                        <i class="fa fa-commenting fa-2x"></i>

                        <h2>Contact Us</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="highlight-box row">
            <div class="col-sm-3">
                <div class="item item-dark">
                    <div class="cursor-pointer">
                        <img src="{{asset('images/item-example.jpg')}}" class="responsive-image hidden-xs"/>

                        <h2>Title</h2>
                        <span>text 123</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="item item-dark">
                    <div class="cursor-pointer">
                        <img src="{{asset('images/item-example.jpg')}}" class="responsive-image hidden-xs"/>

                        <h2>Title</h2>
                        <span>text 123</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="item item-dark">
                    <div class="cursor-pointer">
                        <img src="{{asset('images/item-example.jpg')}}" class="responsive-image hidden-xs"/>

                        <h2>Title</h2>
                        <span>text 123</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="item item-dark">
                    <div class="cursor-pointer">
                        <img src="{{asset('images/item-example.jpg')}}" class="responsive-image hidden-xs"/>

                        <h2>Title</h2>
                        <span>text 123</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="news-bar">
        <div class="container">
            <h2>Latest News &amp; Events</h2>

            <div class="row">
                <div class="col-sm-6 news-dash-border">
                    <div class="row">
                        <div class="col-md-6">
                            <h3><a href="">Researching the future of pensions and mortality</a></h3>
                        </div>
                        <div class="col-md-6">
                            <h4><a href="">Dubai Students doing the business</a></h4>
                            <h4><a href="">Reaching the heights through photographing the depths</a></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-right">
                                <a href="{{route('newsEvents',['type'=>'news'])}}" class="btn btn-more">More news</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="news-bar-table">
                                <tr>
                                    <td>
                                        <div class="calender-sm-box">
                                            <div class="month">Apr</div>
                                            <div class="day">10</div>
                                        </div>
                                    </td>
                                    <td><h4><a href="">Dubai Students doing the business</a></h4></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="news-bar-table">
                                <tr>
                                    <td>
                                        <div class="calender-sm-box">
                                            <div class="month">Apr</div>
                                            <div class="day">10</div>
                                        </div>
                                    </td>
                                    <td><h4><a href="">Dubai Students doing the business doing the business</a></h4></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-right">
                                <div class="hidden-xs"><br/><br/><br/></div>
                                <a href="{{route('newsEvents',['type'=>'events'])}}" class="btn btn-more">More events</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop