<!DOCTYPE html>
<html>
    <head>
        <title>404</title>

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
                font-family: 'Lato', sans-serif;
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
                margin-bottom: 40px;
            }

            ._4-db{
                font-size: 24px;
    line-height: 28px;
    margin: 40px 0 20px;
    color: #1d2129;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="pvl _4-do">
                    <h2 class="_4-db">This page isn't available </h2> 
                    <h3 class="_4-dq">The link you followed may be broken, or the page may have been removed.</h3>
                </div>

                <p style="font-weight: bold;"><a href="{{url('/')}}">{{trans('layout.home_page')}}</a></p>

            </div>
        </div>
    </body>
</html>
