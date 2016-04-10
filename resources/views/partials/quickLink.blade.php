<div class="quick-link-bar">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h4>{{trans('custom.quick_links')}}</h4>
                @if(count($links['quick_links']))
                    <ul>
                    @foreach($links['quick_links'] as $name=>$link)
                        <li>{!! link_to($link,$name) !!}</li>
                    @endforeach
                    </ul>
                @endif
            </div>
            <div class="col-sm-4">
                <h4>{{trans('custom.programmes')}}</h4>
                @if(count($links['programme_links']))
                    <ul>
                        @foreach($links['programme_links'] as $name=>$link)
                            <li>{!! link_to($link,$name) !!}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="col-sm-4">
                <h4>{{trans('custom.follow_us')}}</h4>
                <ul>
                    <li><a href="{!! config('system_info')->facebook_url!!}" target="_blank"><i class="fa fa-facebook-square fa-lg"></i> &nbsp;Facebook</a></li>
                    <li><a href="{!! config('system_info')->youtube_url!!}" target="_blank"><i class="fa fa-youtube-square fa-lg"></i> &nbsp;Youtube</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

