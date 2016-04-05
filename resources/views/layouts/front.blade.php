<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="Rex See">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{asset('images/favicon.ico')}}"/>
    <link href='https://fonts.googleapis.com/css?family=Oswald:300,400,700|Roboto:300,400,100,700' rel='stylesheet' type='text/css'>

    <title>{{config('system_info')->name . (isset($page_title) ? ' :: ' . $page_title : '')}}</title>
    <link href="{{ asset('css/app.css')}}" rel="stylesheet" type="text/css"/>

    <script type="text/javascript">
        window.closeColorbox = function () {
            $.colorbox.close();
        };
    </script>
</head>

<body>
@include('partials.nav')

<div class="container body-content">
    @yield('content')
</div>
@include('partials.quickLink')

@include('partials.footer')
<script src="{{ asset('js/app.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    @include('partials.bottomJS')
    @include('partials.jqueryValidationJS')
</script>
</body>

</html>
