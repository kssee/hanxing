<!DOCTYPE html>
<html>
    <head>
        <title>{{trans('custom.page_no_found')}}</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <img src="{{asset('images/logos/logo.png')}}" width="150px" />
                <div class="title">{{trans('custom.page_no_found')}}</div>
                {!! link_to_route('index',trans('custom.back_to_home')) !!}
            </div>
        </div>
    </body>
</html>

