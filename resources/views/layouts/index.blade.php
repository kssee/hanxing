<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Hanxing, malaysia, education, One World Hanxing College, course, programme, 大同韩新传播学院, 传播课程, 台湾姐妹校, 马来西亚,学院" />
    <meta name="description" content="大同韩新传播学院创办于1988年，是大马历史最悠久的中文传播学院，地点设在吉隆坡大同花园。创办人林景汉，毕业于国立政治大学新闻系。自任院长迄今，坚持有教无类办学理念，平民化收费，让更多清寒子弟有机会深造，与媒体培养专业人才。">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{asset('images/favicon.ico')}}"/>

    <link href='https://fonts.googleapis.com/css?family=Oswald:300,400,700|Roboto:300,400,100,700' rel='stylesheet' type='text/css'>
    <title>{{config('system_info')->name}}</title>
    <link href="{{ asset('css/app.css')}}" rel="stylesheet" type="text/css"/>

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-49303227-1', 'hanxing.edu.my');
        ga('send', 'pageview');

    </script>
</head>

<body>
@include('partials.nav')
@include('partials.banner')
@yield('content')
@include('partials.quickLink')
@include('partials.footer')
<script src="{{ asset('js/app.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    @include('partials.bottomJS')
    @include('partials.jqueryValidationJS')
</script>
</body>

</html>

