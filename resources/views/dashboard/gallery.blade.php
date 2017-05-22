@extends('layout.dashboard')

@section('title', 'ระบบฝ่าย IT')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="card dashboard-card">
    <h4 class="card-title">อัลบัมทั้งหมด
        <a href="{{route('gallery.new')}}" class="btn btn-success float-right">
            <i class="fa fa-plus"></i> สร้างอัลบัม
        </a>
        <a href="{{route('dashboard.editor')}}" class="btn btn-success float-right mr-2">
            <i class="fa fa-newspaper-o"></i> จัดการข่าว
        </a>
    </h4>
    <div class="card-block">
        <table class="table table-hover" id="galleriesTable" cellspacing="0" width="100%">
            <thead class="thead-inverse">
            <tr>
                <th>ชื่ออัลบัมรูป</th>
                <th>จำนวนรูป</th>
                <th>วันที่สร้าง</th>
            </tr>
            </thead>
            <tbody>
            @foreach($galleries as $gallery)
            <tr>
                <td>
                    <a href="{{route('gallery.edit', ['gallery' => $gallery])}}">
                        {{$gallery->name}}
                    </a>
                </td>
                <td> {{$gallery->photos->count()}} </td>
                <td>
                    {{$gallery->created_at->format('d/m/Y')}}
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
            $('#galleriesTable').DataTable({
                "language": {"url" : "//cdn.datatables.net/plug-ins/1.10.12/i18n/Thai.json"},
                "columnDefs": [
                    { "type": "date-uk", targets: 2 }
                ],
                "order": [[ 2, "desc" ]]
            });
        });
    </script>
@endsection