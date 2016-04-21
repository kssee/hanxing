<!-- Navigation -->
<nav class="navbar navbar-default {{Agent::isMobile() == true ? "" : "navbar-fixed-top"}}" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand"
           href="{{route('admin.home')}}">{!! Html::image(asset('/images/logos/logo.png'),config('system_info')->name . ' Logo',['width'=>'120px']) !!}</a>

        <div class="page-subject">
            {!! isset($page_subject) ? $page_subject : ''!!}
            @if(isset($add_route))
                &nbsp;<a href="{{route($add_route)}}" class="add-link">{{trans('custom.add_new')}}</a>
            @endif
        </div>
    </div>

    <ul class="nav navbar-top-links navbar-right">
        <li><a href="{{route('admin.logout')}}">{{trans('custom.logout') . ' ' . auth()->user()->name}}</a></li>
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="{{route('admin.home')}}"><i class="fa fa-dashboard fa-fw"></i>&nbsp;{{trans('custom.dashboard')}}</a>
                </li>

                {!! navIconLinkWithPermission('admin_menu','admin.menu.index','fa-ellipsis-h',trans('custom.menu')) !!}
                {!! navIconLinkWithPermission('admin_banners','admin.banner.index','fa-clone',trans('custom.banners')) !!}
                {!! navIconLinkWithPermission('admin_pages','admin.page.index','fa-paint-brush',trans('custom.pages')) !!}
                {!! navIconLinkWithPermission('admin_news_events','admin.ne.index','fa-newspaper-o',trans('custom.news_event')) !!}
                {!! navIconLinkWithPermission('admin_student_showcases','admin.sshowcase.index','fa-video-camera',trans('custom.student_showcases')) !!}
                {!! navIconLinkWithPermission('admin_student_files','admin.sfiles.index','fa-file-text',trans('custom.student_files')) !!}

                @if(auth()->user()->hasRole(env('SUPER_ADMIN_ROLE_NAME')) || auth()->user()->can('admin_authorization'))
                    <li>
                        <a href="#"><i class="fa fa-key fa-fw"></i>&nbsp;{{trans('custom.authorization')}}<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            {!! navLinkWithPermission('admin_authorization','admin.user.index',trans('custom.users')) !!}
                            {!! navLinkWithPermission('admin_authorization','admin.permission.index',trans('custom.permissions')) !!}
                            {!! navLinkWithPermission('admin_authorization','admin.role.index',trans('custom.role_group')) !!}
                        </ul>
                    </li>
                @endif
            </ul>
            <br/>
            <div class="text-right">
                @if(trans()->locale() == 'en')
                    <small>English</small> . {!! link_to_route('setLanguage','中文',['lg'=>'zh']) !!}
                @else
                    {!! link_to_route('setLanguage','English',['lg'=>'en']) !!} .
                    <small>中文</small>
                @endif
                &nbsp;&nbsp;
            </div>
        </div>
    </div>

    <!-- /.navbar-static-side -->
</nav>