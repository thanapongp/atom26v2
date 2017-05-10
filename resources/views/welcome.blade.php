<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/css/app.css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
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

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .daydiv {
                padding-right: 1em;
                min-width: 310px;
            }

            .clock {
                min-width: 310px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <div id="clockdiv"></div>
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
<script>
var deadline = '2017-05-27';
startClock('clockdiv', deadline);

function getTimeRemaining(endtime) {
    var remainTime = Date.parse(endtime) - Date.parse(new Date());

    return {
        'total' : remainTime,
        'days'  : Math.floor(remainTime/(1000*60*60*24)),
        'hours' : Math.floor((remainTime/(1000*60*60*60)) % 24),
        'mins'  : Math.floor((remainTime/1000/60) % 60),
        'secs'  : Math.floor((remainTime/1000) % 24),
    };
}

function startClock(id, endtime) {
    var clock = document.getElementById(id);

    var interval = setInterval(function() {
        var remainTime = getTimeRemaining(endtime);

        clock.innerHTML = '<span class="daydiv">' + remainTime.days + 'วัน</span>' +
                          '<span class="clock">' + ('0' + remainTime.hours).slice(-2) + ':' +
                          ('0' + remainTime.mins).slice(-2) + ':' +
                          ('0' + remainTime.secs).slice(-2) + '</span>'

        if (remainTime.t <= 0) {
            clearInterval(interval);
        }
    }, 1000);
}
</script>
</html>
