<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-image: url(/background/1);
                background-color: #6DCFF6;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }
            .content {
            }
            .login-frame {
                background-color: #80C342;
                width: 30rem;
                height: 10rem;
                padding: 2rem;

            }
            .login-ul{
                display: table-row;
                width: 100%; 
                height:auto;
                list-style-type: none;
            }
            .ul {
                list-style-type: none;
            }
            .login-ul li{
                display:table-cell;
                margin: 10px;
                vertical-align: middle;
            }
            a.link{
                display:block; 
                width:100%; 
                padding:1px; 
                text-decoration:none; 
                text-align:center; 
                border-style:solid;
                border-width:3px;
                border-color:#00b0f0;
                color:#00b0f0;
                background-color: #ffffff;
                border-radius:4px;
                font-weight: 1000;
                margin-bottom: 0.5rem
                }
            a.link:hover {
                border-color:#00b0ee;
                color:#ffffff;
                background-color: #95b3d7;}
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="login-frame">
                    {{-- <ul class='login-ul'>
                        <li><a class="link" href="{{route('staff.login')}}">Staff Login</a></li><br>
                        <li><a class="link" href="{{route('staff.login')}}">iSpark Project Login</a></li>
                        <li><a class="link" href="{{route('staff.login')}}">iSpark Participant Login</a></li>
                    </ul> --}}
                    <ul class='ul' style="list-style-type: none;">
                            <li><a class="link" href="{{route('staff.login')}}">Staff Login</a></li><br>
                            <li><a class="link" href="{{route('staff.login')}}">iSpark Project Login</a></li>
                            <li><a class="link" href="{{route('staff.login')}}">iSpark Participant Login</a></li>
                        </ul>
                </div>
            </div>
        </div>
    </body>
</html>
