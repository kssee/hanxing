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

                {!! navIconLinkWithPermission('admin_pages','admin.page.index','fa-info-circle',trans('custom.pages')) !!}
                {!! navIconLinkWithPermission('admin_menu','admin.menu.index','fa-users',trans('custom.menu')) !!}
                {!! navIconLinkWithPermission('admin_banner','admin.banner.index','fa-users',trans('custom.banners')) !!}
                {!! navIconLinkWithPermission('admin_users','admin.user.index','fa-users',trans('custom.users')) !!}

                @if(auth()->user()->hasRole(env('SUPER_ADMIN_ROLE_NAME')) || auth()->user()->can('admin_authorization'))
                    <li>
                        <a href="#"><i class="fa fa-key fa-fw"></i>&nbsp;{{trans('custom.authorization')}}<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            {!! navLinkWithPermission('admin_authorization','admin.permission.index',trans('custom.permissions')) !!}
                            {!! navLinkWithPermission('admin_authorization','admin.role.index',trans('custom.role_group')) !!}
                        </ul>
                    </li>
                @endif


                {{--{!! navIconLinkWithPermission('gc_make_code','gcMakeCode','fa-plus-square',trans('custom.menu.generate_giftcard')) !!}--}}

            </ul>
        </div>
    </div>

    <!-- /.navbar-static-side -->
</nav>