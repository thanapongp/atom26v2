@extends('layout.main')

@section('title', 'ตรวจสอบรายชื่อ'.$attendees->first()->university()->name)

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="content-container">
    <div class="section-header">
        <div>ตรวจสอบรายชื่อ<span style="color: #FFA02F">ผู้ร่วมงาน</span>
            <span class="float-right">
                <a href="{{route('attendees.index')}}"> กลับ</a>
            </span>
        </div>
    </div>

    <table class="table table-hover" id="attendeesTable" cellspacing="0" width="100%">
        <thead class="thead-inverse">
        <tr>
            <th>ชื่อ</th>
            <th>ประเภท</th>
        </tr>
        </thead>
        <tbody>
        @foreach($attendees as $user)
        <tr>
            <td>{{$user->fullname()}}</td>
            <td>
                {{$user->type()->name}}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    $('#attendeesTable').DataTable({
        "language": {"url" : "//cdn.datatables.net/plug-ins/1.10.12/i18n/Thai.json"},
    });
});
</script>
@endsection