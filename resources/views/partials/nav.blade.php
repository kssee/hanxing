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
                            {{--<li><a href='{{route('pages',['slug'=>'about'])}}'>About us</a>--}}
                                {{--<ul>--}}
                                    {{--<li><a href='{{route('pages',['slug'=>'why-hanxing'])}}'>Why HANXING</a></li>--}}
                                    {{--<li><a href='#'>International partner universities</a></li>--}}
                                    {{--<li><a href="#">Organisation structure</a></li>--}}
                                    {{--<li><a href="#">Staff directory</a></li>--}}
                                    {{--<li><a href="#">Careers at HanXing</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li><a href='#'>Programmes</a>--}}
                                {{--<ul>--}}
                                    {{--<li><a href='#'>Diploma in Journalism</a></li>--}}
                                    {{--<li><a href='#'>Diploma in Broadcasting</a></li>--}}
                                    {{--<li><a href="#">Diploma in Public Relations</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li><a href='#'>Student services</a>--}}
                                {{--<ul>--}}
                                    {{--<li><a href="">Entry requirements</a></li>--}}
                                    {{--<li><a href="">Fees</a></li>--}}
                                    {{--<li><a href="">Scholarship &amp; financial assistance (PTPTN)</a></li>--}}
                                    {{--<li><a href="">How to apply</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}

                            {{--<li><a href='#'>Campus life</a>--}}
                                {{--<ul>--}}
                                    {{--<li><a href="">Accommodation</a></li>--}}
                                    {{--<li><a href="">Facilities</a></li>--}}
                                    {{--<li><a href="">Clubs &amp; activities</a></li>--}}
                                    {{--<li><a href="">Transport</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}

                            {{--<li><a href='#'>Student publication</a>--}}
                                {{--<ul>--}}
                                    {{--<li><a href="">Flims / MV</a></li>--}}
                                    {{--<li><a href="">Hanxi Bao</a></li>--}}
                                    {{--<li><a href="">Chuan Bo Xue Ren</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li><a href="">Contact Us</a></li>--}}
                        </ul>
                    </div>
                    @endif
                </td>
            </tr>
        </table>
    </div>
</div>