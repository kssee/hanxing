@extends('layouts.front')
@section('jsFunctions')

@stop

@section('content')
    @if(!is_null($page->path_banner) && !empty($page->path_banner))
        <img src="{{asset($page->path_banner)}}" class="responsive-image page-banner hidden-xs"/>
    @endif
    @include('partials.breadcrumb')

    <h1>{{$page->title}}</h1>
    <br/>
    {!! $page->page_content !!}

    @if(isset($child_pages) && count($child_pages))
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @foreach ($child_pages->chunk(4) as $row)
                    <div class="highlight-box row">
                        @foreach ($row as $entry)
                            <div class="col-sm-3">
                                @include('partials.itembox',['category'=>$page->child_display_category,'txt'=>'Find out more >','route'=>'pages'])
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@stop