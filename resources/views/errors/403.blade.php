<!DOCTYPE html>
<html>
    <head>
        <title>error 403</title>
        <link href="http://cdn.font-store.ir/shahab.css" rel="stylesheet" type="text/css">

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
                font-family: 'Shahab';

                background-size: cover;
                opacity: 0.5;
                box-shadow: 0 0 50px #000;
            }
            body:before {
                content: "";
                position: absolute;
                background: url("{{ asset('img/error/403.jpg') }}");
                background-size: cover;
                z-index: -1; /* Keep the background behind the content */
                height: 20%; width: 20%; /* Using Glen Maddern's trick /via @mente */

                /* don't forget to use the prefixes you need */
                transform: scale(5);
                transform-origin: top left;
                filter: blur(2px);
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
                color: #ffffff;
                text-shadow: 0 0 25px #000;
                font-weight: bold;
            }
            a{
                text-decoration: none;
                color:white;
                transition: all .5s;

            }
            a:hover{
                transform: scale(4);
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">شما دسترسی به این صفحه ندارید</div>
                <h3><a href="{{ url('/') }}">بازگشت</a></h3>
            </div>
        </div>
    </body>
</html>
