@extends('layout.dashboard')

@section('title', 'ดูข้อมูลผู้ร่วมงาน')

@section('content')
<div class="card dashboard-card">
    <h4 class="card-title">
        ข้อมูลผู้ร่วมงาน
        <small>
            <a href="{{route('dashboard.hostess')}}">
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
                    <br>
                    สถานะ: {!! $user->active ? '<span class="text-success">ยืนยันแล้ว</span>' : '<span class="text-danger">ยังไม่ยืนยัน</span>' !!}
                </p>
            </div>
        </div>

        <p>
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

        @if(current_user()->hasRole('hostess'))
        <hr>

        <a href="{{$user->idCard()}}" class="btn btn-primary">
            <i class="fa fa-id-card"></i> ดู ID Card
        </a>

        @endif
    </div>
</div>
@endsection