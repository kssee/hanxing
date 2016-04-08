@extends('layouts.front')
@section('jsFunctions')

@stop

@section('content')
    @include('partials.breadcrumb')

    <h1>{{$result->title}}</h1>
    <span class="activity-date">{{$result->activity_date->toFormattedDateString()}}</span>
    <br/>
    <br/>
    {!! $result->page_content !!}
@stop