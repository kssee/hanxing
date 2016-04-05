@extends('layouts.index')
@section('jsFunctions')

@stop

@section('content')
    @include('flash::message')

    <div class="container-fluid">
        <div class="highlight-box highlight-box-light row">
            <div class="col-sm-3">
                <div class="item">
                    <h2>Title</h2>
                    <a href=""><img src="{{asset('images/item-example.jpg')}}" class="responsive-image"/></a>

                    <p>Our Foundation Programme offers tailored pathways, in Science or Business, to our undergraduate degree programmes degree programmes....</p>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="item">
                    <h2>Title</h2>
                    <img src="{{asset('images/item-example.jpg')}}" class="responsive-image"/>

                    <p>Our career-focused degrees include business, finance, built environment and engineering specialisms.</p>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="item">
                    <h2>Title</h2>
                    <img src="{{asset('images/item-example.jpg')}}" class="responsive-image"/>

                    <p>Our professionally relevant Masters are designed to meet the demands and economic drivers of the world today.</p>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="item">
                    <h2>Title</h2>
                    <img src="{{asset('images/item-example.jpg')}}" class="responsive-image"/>

                    <p>Our professionally relevant Masters are designed to meet the demands and economic drivers of the world today.</p>
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
        <div class="highlight-box highlight-box-dark row">
            <div class="col-sm-3">
                <div class="item">
                    <img src="{{asset('images/item-example.jpg')}}" class="responsive-image"/>

                    <h2>Title</h2>
                    <span>text 123</span>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="item">
                    <img src="{{asset('images/item-example.jpg')}}" class="responsive-image"/>

                    <h2>Title</h2>
                    <span>text 123</span>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="item">
                    <img src="{{asset('images/item-example.jpg')}}" class="responsive-image"/>

                    <h2>Title</h2>
                    <span>text 123</span>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="item">
                    <img src="{{asset('images/item-example.jpg')}}" class="responsive-image"/>

                    <h2>Title</h2>
                    <span>text 123</span>
                </div>
            </div>
        </div>
    </div>
@stop