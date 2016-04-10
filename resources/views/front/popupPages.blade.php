@extends('layouts.simple')
@section('jsFunctions')

@stop

@section('content')
    <script>
        function closeWindow()
        {
            window.parent.closeColorbox();
        }
    </script>
    @if(!is_null($page->path_banner) && !empty($page->path_banner))
        <img src="{{asset($page->path_banner)}}" class="responsive-image page-banner hidden-xs"/>
    @endif

    <h1>{{trans()->locale() == 'en' ? $page->title : $page->title_zh}}</h1>
    <br/>
    {!! $page->page_content !!}

    <div class="text-center">
        <button class="btn btn-more" onclick="closeWindow();">{{trans('custom.close')}}</button>
    </div>
@stop
