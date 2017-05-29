@extends('layout.dashboard')

@section('title', 'ระบบฝ่าย IT')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="card dashboard-card">
    <h4 class="card-title">ผลการแข่งขัน
        <div class="dropdown d-inline-block float-right">
            <button href="{{route('news.create')}}" type="button" class="btn btn-success dropdown-toggle"
            id="sportTypeDropdown" data-toggle="dropdown" style="font-family: inherit">
                <i class="fa fa-plus"></i> เพิ่มผลการแข่ง
            </button>

            <div class="dropdown-menu" aria-labelledby="sportTypeDropdown">
                <a href="{{route('event.create.athletic')}}" class="dropdown-item">กรีฑา</a>
                <a href="{{route('event.create.pethong')}}" class="dropdown-item">เปตอง</a>
                <a href="{{route('event.create.takraw')}}" class="dropdown-item">ตะกร้อ</a>
                <a href="{{route('event.create.bridge')}}" class="dropdown-item">บริดจ์</a>
                <a href="{{route('event.create.board')}}" class="dropdown-item">หมากกระดาน</a>
                <a href="{{route('event.create.basketball')}}" class="dropdown-item">บาส</a>
                <a href="{{route('event.create.football')}}" class="dropdown-item">ฟุตบอล</a>
                <a href="{{route('event.create.footsal')}}" class="dropdown-item">ฟุตซอล</a>
                <a href="{{route('event.create.volleyball')}}" class="dropdown-item">วอลเล่บอล</a>
                <a href="{{route('event.create.esport')}}" class="dropdown-item">E-Sport</a>
                <a href="{{route('event.create.academic')}}" class="dropdown-item">วิชาการ</a>
            </div>

        </div>
        <a href="{{route('dashboard.editor')}}" class="btn btn-success float-right mr-2">
            <i class="fa fa-newspaper-o"></i> จัดการข่าว
        </a>
    </h4>

    <div class="card-block">
        <ul class="nav nav-tabs" role="tablist">
            @foreach($events as $type => $_)
            <li class="nav-item">
                <a class="nav-link{{$loop->first ? ' active' : ''}}" href="#{{$type}}"
                data-toggle="tab" role="tab">
                    {{$_[0]->sport->name}}
                </a>
            </li>
            @endforeach    
        </ul>
        
        <div class="tab-content">

        @foreach($events as $chunk)
        <div class="tab-pane{{$loop->first ? ' active' : ''}}" 
        id="{{$chunk[0]->sport->label}}" role="tabpanel">

        <table class="table mt-4">
            <thead>
                <th>ชื่อการแข่ง</th>
                <th>ประเภทกีฬา</th>
                @if($chunk[0]->sport->id != 1)
                <th>คะแนน</th>
                @endif
                <th>เวลา</th>
            </thead>
            <tbody>
                @foreach($chunk as $event)
                <tr>
                    <td>
                        {{$event->name}} 
                        @if($event->sport->id != 1)
                        ({{$event->results[0]->university->code}} vs. {{$event->results[1]->university->code}})
                        @endif
                    </td>
                    <td>{{$event->sport->name}}</td>

                    @if($event->sport->id != 1)
                    <td>
                        @if($event->results[0]->score != null)
                        {{$event->results[0]->score}} - {{$event->results[1]->score}}
                        @elseif($event->results[0]->is_winner)
                        {{$event->results[0]->university->code}} ชนะ
                        @else
                        {{$event->results[1]->university->code}} ชนะ
                        @endif
                    </td>
                    @endif

                    <td>{{$event->date->format('d/m/Y H:i')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        </div>
        @endforeach

        </div>

    </div>

</div>
@endsection

@section('js')

@endsection