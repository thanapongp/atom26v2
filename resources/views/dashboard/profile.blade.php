@extends('layout.dashboard')

@section('title', 'ดูข้อมูลผู้ร่วมงาน')

@section('content')
<div class="card dashboard-card">
    <h4 class="card-title">
        ข้อมูลส่วนตัว
        <small>
            <a href="{{route('home')}}">
                กลับ
            </a>
        </small>
    </h4>
    <div class="card-block">
        <div class="media">
            <img src="{{$user->pic()}}" class="d-flex mr-3 rounded" width="100" height="100">
            <div class="media-body">
                <h4>
                    {{$user->fullname()}}
                    <small>QRCode: {{$user->getQRCode()}}</small>
                </h4>

                <p>
                    ประเภท: {{$user->type()->name}} {{$user->isHost() ? $user->department()->name : ''}}
                    <br>
                    สังกัด: {{$user->university()->name}}
                </p>
            </div>
        </div>

        <p class="mt-2">
            <i class="fa fa-envelope"></i> E-mail: {{$user->email}} <br>
             <i class="fa fa-phone"></i> โทรศัพท์: {{$user->info->tel}}
        </p>

        @if($user->isAthlete())
            <h4>รายชื่อกีฬา / กิจกรรมที่ลงแข่ง</h4>
            <ul>
                @foreach($user->sports as $sport)
                    <li>{{$sport->name}}</li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection