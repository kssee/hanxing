@extends('layouts.front')
@section('jsFunctions')

@stop

@section('content')
    @if(!is_null($page->path_banner) && !empty($page->path_banner))
        <img src="{{asset($page->path_banner)}}" class="responsive-image page-banner hidden-xs"/>
    @endif
    @include('partials.breadcrumb')

    <h1>{{trans()->locale() == 'en' ? $page->title : $page->title_zh}}</h1>
    <br/>
    {!! $page->page_content !!}

    @if($page->popup_page_id)
        <div class="text-center">
            <a href="{{route('popupPages',['id'=>$page->popup_page_id])}}" class="btn btn-more iframe">{{trans()->locale() == 'en' ? $page->popup_title : $page->popup_title_zh}}</a>
        </div>
    @endif

    <hr />

    @if(isset($child_pages) && count($child_pages))
        <div class="row">
            <div class="col-md-12">
                @foreach ($child_pages->chunk(4) as $row)
                    <div class="highlight-box row">
                        @foreach ($row as $entry)
                            <div class="col-sm-3">
                                @include('partials.itembox',['category'=>$page->child_display_category,'txt'=>trans('custom.read_more').' >','route'=>'pages'])
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@stop
