<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="">
    <meta name="author" content="Rex See">

    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/favicon.ico')}}"/>
    <link rel="icon" type="image/x-icon" href="{{asset('images/favicon.ico')}}"/>

    <title>{{trans('custom.admin_site_title')}}</title>
    <link href="{{ asset('css/admin.css')}}" rel="stylesheet" type="text/css"/>

</head>

<body>
@yield('content')

<script src="{{ asset('js/admin.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    @include('partials.bottomJS')
    @include('partials.jqueryValidationJS')
</script>
</body>
</html>
