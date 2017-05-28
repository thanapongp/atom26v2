@extends('layout.main')

@section('title', 'ผลการแข่งขัน')

@section('content')
<div class="content-container">
    <div class="section-header">
        <div class="w-100 text-center">ผลการ<span style="color: #FFA02F">แข่งขัน</span></div>
    </div>

    <div class="university-icon-header text-center">
        <h3>โปรดเลือกชนิดกีฬา</h3>
    </div>

    @foreach($sports->chunk(2) as $chunk)
    <div class="university-icon-row">
        @foreach($chunk as $sport)
        <a href="{{route('events.show', ['sport' => $sport->id])}}" class="btn btn-secondary university-icon">
            <img src="/img/sports/{{kebab_case($sport->label)}}.png">
            <span class="hidden-md-down">{{$sport->name}}</span>
        </a>
        @endforeach
    </div>
    @endforeach
</div>
@endsection