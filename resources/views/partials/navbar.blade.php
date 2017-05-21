<div class="headnav hidden-sm-down">
    <div class="inner">
        <div class="nav-container">
				<span class="logo">
					<img src="/img/logo.png"/>
				</span>

            <div class="menu-container">
                <div class="menu-links">
                    <ul>
                        <li class="nav-item">
                            27 พฤษภาคม - 2 มิถุนายน 2560
                        </li>

                        <li class="nav-item">
                            |
                        </li>

                        <li class="nav-item">
                            <a class="social-icon"
                               href="https://www.facebook.com/tritharagames.sci.ubu/">
                                <i class="fa fa-facebook"
                                   style="color: #3b5998"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="social-icon"
                               href="https://twitter.com/TritharaGames">
                                <i class="fa fa-twitter"
                                   style="color: #42c0fb"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="social-icon"
                               href="https://instagram.com/_u/tritharagames">
                                <i class="fa fa-instagram"
                                   style="color: #c91E53"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="social-icon"
                               href="https://www.youtube.com/channel/UCDpCn4SisbtHaDALKbevJVQ">
                                <i class="fa fa-youtube"
                                   style="color: #e52727"></i>
                            </a>
                        </li>

                        <li class="nav-item">
                            |
                        </li>

                        <li class="nav-item">
                            <a href="#">ระบบบันทึกข้อความ</a>
                        </li>

                        <li class="nav-item">
                            |
                        </li>

                        <li class="nav-item">
                            @if(auth()->check())
                            <a href="/dashboard" style="font-size: 15px;">
                                <i class="fa fa-sign-in"></i> {{auth()->user()->username}}
                            </a>
                            @else
                            <a href="{{route('auth.register')}}" style="font-size: 15px;">
                                <i class="fa fa-user"></i> ลงทะเบียน
                            </a>
                            |
                            <a href="/login" style="font-size: 15px;">
                                <i class="fa fa-sign-in"></i> Login
                            </a>
                            @endif
                        </li>
                    </ul>
                </div>
                <div class="menu-nav">
                    <ul>
                        <li class="nav-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                        <li class="nav-item"><a href="/news">ข่าวสาร</a></li>
                        <li class="nav-item"><a href="/gallery">ประมวลภาพ</a></li>
                        <li class="nav-item"><a href="/rules">กติการการแข่งขัน</a></li>
                        <li class="nav-item"><a href="{{route('schedules.index')}}">ตารางการแข่งขัน</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="navbar fixed-top navbar-inverse bg-primary hidden-md-up">
    <button class="navbar-toggler navbar-toggler-right" type="button"
            data-toggle="collapse"
            data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup"
            aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#" style="color: white">
        <img src="/img/logo_small.png" height="30"
             class="d-inline-block align-top">
        ไตรธาราเกมส์
    </a>

    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="{{route('home')}}">หน้าแรก <span
                        class="sr-only">(current)</span></a>
            @if(auth()->check())
                <a href="/dashboard" class="nav-item nav-link">
                    <i class="fa fa-sign-in"></i> {{auth()->user()->username}}
                </a>
            @else
                <a href="/login" class="nav-item nav-link">
                    <i class="fa fa-sign-in"></i> Login
                </a>
            @endif
            <a class="nav-item nav-link" href="/news">ข่าวสาร</a>
            <a class="nav-item nav-link" href="/gallery">ประมวลภาพ</a>
            <a class="nav-item nav-link" href="/rules">กติการการแข่งขัน</a>
            <a class="nav-item nav-link" href="{{route('schedules.index')}}">ตารางการแข่งขัน</a>
        </div>
    </div>
</div>