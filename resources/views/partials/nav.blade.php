<div class="top-bar">
    <div class="container">
        <div class="mini-nav">
            @if(trans()->locale() == 'en')
                <small>English</small> . {!! link_to_route('setLanguage','中文',['lg'=>'zh']) !!}
            @else
                {!! link_to_route('setLanguage','English',['lg'=>'en']) !!} . <small>中文</small>
            @endif
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
                {!! link_to_route('student',trans('custom.student')) !!} &nbsp;&nbsp;&nbsp;{!! link_to_route('alumni',trans('custom.alumni')) !!}
        </div>
        <table width="100%">
            <tr>
                <td id="nav-logo" valign="top">
                    <a href="{{route('index')}}"><img src="{{asset('images/logos/logo.png')}}" class="responsive-image" alt="Logo"/></a>
                </td>
                <td align="right">
                    @if(count($menu))
                    <div id='my-nav'>
                        <ul>
                            @foreach($menu as $entry)
                                <li><a {!! $entry['id'] == $entry['active_id'] ? 'class="active"' : ''!!} href='{{url($entry['path'])}}'>{{$entry['name']}}</a>
                                    @if(count($entry['sub_menu']))
                                        <ul>
                                        @foreach($entry['sub_menu'] as $entry_sub)
                                            <li><a href='{{url($entry_sub['path'])}}'>{{$entry_sub['name']}}</a></li>
                                        @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </td>
            </tr>
        </table>
    </div>
</div>