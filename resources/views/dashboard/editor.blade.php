@extends('layout.dashboard')

@section('title', 'ระบบฝ่าย IT')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="card dashboard-card">
    <h4 class="card-title">ข่าวทั้งหมด
        <a href="{{route('news.create')}}" class="btn btn-success float-right">
            <i class="fa fa-plus"></i> เพิ่มข่าว
        </a>
    </h4>
    <div class="card-block">
        <table class="table table-hover" id="newsTable" cellspacing="0" width="100%">
            <thead class="thead-inverse">
            <tr>
                <th>หัวข้อข่าว</th>
                <th>วันที่ประกาศ</th>
            </tr>
            </thead>
            <tbody>
            @foreach($news as $post)
            <tr>
                <td>
                    <a href="{{route('news.edit', ['post' => $post->id])}}">
                        {{$post->title}}
                    </a>
                </td>
                <td>
                    {{$post->created_at->format('d/m/Y')}}
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