<div class="last_update_info">
    <i>
        {{trans('custom.updated')}}

        @if($time >= 0)
            <span data-toggle="tooltip" title="{{date('d-m-Y H:i:s',$time)}}">
                {{\Carbon\Carbon::createFromTimestamp($time)->diffForHumans()}}
            </span>
        @else
            {{trans('custom.never_before')}}
        @endif

        @if(isset($name) && !empty($name))
            &nbsp; | &nbsp;
            {{trans('custom.by')}} <u>{{$name}}</u>
        @endif

    </i>
</div>