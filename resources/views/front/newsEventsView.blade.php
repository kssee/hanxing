@extends('layouts.front')
@section('jsFunctions')

@stop

@section('content')
    @include('partials.breadcrumb')

    <h1>{{trans()->locale() == 'en' ? $result->title : $result->title_zh}}</h1>
    <span class="activity-date">{{$result->activity_date->toFormattedDateString()}}</span>
    <br/>
    <br/>
    {!! $result->page_content !!}
@stop
