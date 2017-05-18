@extends('layout.dashboard')

@section('title', 'ระบบฝ่ายปฏิคม')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="card dashboard-card">
    <h4 class="card-title">
        ผู้เข้าร่วมงานจาก{{$university->name}}

        @if(current_user()->hasRole('hostess'))
        <a href="{{route('hostess.alluni')}}" class="btn btn-primary float-right">
            <i class="fa fa-users"></i> ดูรายชื่อผู้ร่วมงานทั้งหมด
        </a>
        @endif

        <a href="{{route('dashboard.hostess')}}" class="btn btn-primary float-right mr-2">
            <i class="fa fa-child"></i> ดูรายชื่อผู้เข้าร่วมงานในสังกัดทั้งหมด
        </a>
    </h4>
    <div class="card-block">
        <table class="table table-hover" id="newsTable" cellspacing="0" width="100%">
            <thead class="thead-inverse">
            <tr>
                <th>ชื่อ</th>
                <th>ประเภท</th>
            </tr>
            </thead>
            <tbody>
            @foreach($attendees as $user)
            @if($user->isAdmin())
                @continue
            @endif
            <tr>
                <td>
                    <a href="{{route('hostess.attendee', ['user' => $user->id])}}">
                        {{$user->fullname()}}
                    </a>
                </td>
                <td>
                    {{$user->type()->name}}
                </td>
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
    <script type="text/javascript">
        $(document).ready(function () {
            $('#newsTable').DataTable({
                "language": {"url" : "//cdn.datatables.net/plug-ins/1.10.12/i18n/Thai.json"},
            });
        });
    </script>
@endsection