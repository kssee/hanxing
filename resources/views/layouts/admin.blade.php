<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="">
    <meta name="author" content="Rex See">
    <link rel="icon" type="image/x-icon" href="{{asset('images/favicon.ico')}}"/>

    <title>{{trans('custom.admin_site_title')}}</title>
    <link href="{{ asset('css/admin.css')}}" rel="stylesheet" type="text/css"/>

    <script type="text/javascript">
        window.closeColorbox = function () {
            $.colorbox.close();
        };
    </script>

</head>

<body>
@include('partials.adminNav')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @yield('content')
            </div>
        </div>
    </div>
</div>
@include('partials.footer')
<script src="{{ asset('js/admin.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    @include('partials.bottomJS')
    @include('partials.jqueryValidationJS')
</script>
</body>

</html>
