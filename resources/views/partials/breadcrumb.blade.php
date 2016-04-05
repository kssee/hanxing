@if(count($breadcrumb))
    <ol class="breadcrumb">
        @foreach($breadcrumb['link'] as $entry)
            @foreach($entry as $name=>$link)
                <li><a href="{{$link}}">{{$name}}</a></li>
            @endforeach
        @endforeach
        <li class="active">{{$breadcrumb['active']}}</li>
    </ol>
@endif