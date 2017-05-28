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
        <table class="table">
            <thead>
                <th>ชื่อการแข่ง</th>
                <th>ประเภทกีฬา</th>
                <th>เวลา</th>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td>{{$event->name}}</td>
                    <td>{{$event->sport->name}}</td>
                    <td>{{$event->date->format('d/m/Y H:i')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.15/type-detection/date-uk.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.15/sorting/date-uk.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#newsTable').DataTable({
                "language": {"url" : "//cdn.datatables.net/plug-ins/1.10.12/i18n/Thai.json"},
                "columnDefs": [
                    { "type": "date-uk", targets: 1 }
                ],
                "order": [[ 1, "desc" ]]
            });
        });
    </script>
@endsection