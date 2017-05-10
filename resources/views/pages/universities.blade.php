@extends('layout.main')

@section('title', 'ตรวจสอบรายชื่อผู้ร่วมงาน')

@section('content')
<div class="content-container">
    <div class="section-header">
        <div>ตรวจสอบรายชื่อ<span style="color: #FFA02F">ผู้ร่วมงาน</span></div>
    </div>

    <div class="university-icon-header text-center">
        <h3>โปรดเลือกมหาวิทยาลัย / สถาบัน</h3>
    </div>

    @foreach($universities->chunk(2) as $universities)
    <div class="university-icon-row">
        @foreach($universities as $university)
        <a href="{{route('attendees.index', ['university' => $university->id])}}" class="btn btn-secondary university-icon">
            <img src="/img/logo-uni/logo{{$university->code}}.png">
            <span class="hidden-md-down">{{$university->name}}</span>
        </a>
        @endforeach
    </div>
    @endforeach
</div>
@endsection