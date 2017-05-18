@extends('layout.dashboard')

@section('title', 'ระบบฝ่ายปฏิคม')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="card dashboard-card">
    <h4 class="card-title">
        ตรวจสอบรายชื่อผู้ร่วมงานทั้งหมด

        <a href="{{route('dashboard.hostess')}}" class="btn btn-primary float-right mr-2">
            <i class="fa fa-child"></i> ดูรายชื่อผู้เข้าร่วมงานในสังกัดทั้งหมด
        </a>
    </h4>
    <div class="card-block">
        <div class="university-icon-header text-center">
            <h3>โปรดเลือกมหาวิทยาลัย / สถาบัน</h3>
        </div>

        @foreach($universities->chunk(2) as $universities)
        <div class="university-icon-row">
            @foreach($universities as $university)
            <a href="{{route('hostess.attendeesuni', ['university' => $university->id])}}" class="btn btn-secondary university-icon">
                <img src="/img/logo-uni/logo{{$university->code}}.png">
                <span class="hidden-md-down">{{$university->name}}</span>
            </a>
            @endforeach
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#newsTable').DataTable({
                "language": {"url" : "//cdn.datatables.net/plug-ins/1.10.12/i18n/Thai.json"},
            });
        });
    </script>
@endsection