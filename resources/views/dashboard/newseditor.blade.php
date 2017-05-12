@extends('layout.dashboard')

@section('title', 'ระบบฝ่าย IT')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="card dashboard-card">
    <h4 class="card-title">แก้ไขข่าว <small><a href="{{route('dashboard.editor')}}">กลับ</a></small></h4>
    <div class="card-block">
        <form action="{{route('news.update', ['post' => $post->id])}}" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">หัวข้อข่าว</label>
                <input type="title" name="title" class="form-control" placeholder="หัวข้อข่าว"
                       value="{{$post->title}}" required>
            </div>
            <div class="form-group">
                <textarea name="content" class="form-control" required>{{$post->content}}</textarea>
            </div>
            <div class="form-group">
                <label for="thumbnail">ภาพหัวข่าว</label>
                <input type="file" name="thumbnail">
                <small class="form-text text-muted">ภาพนี้จะแสดงบนหัวข่าวและหน้าเว็บ</small>
                <small class="form-text text-muted">หากต้องการแก้ไขภาพที่มีอยู่ ให้อัพโหลดภาพขึ้นใหม่</small>
            </div>
            {{csrf_field()}}
            <button class="btn btn-primary"><i class="fa fa-edit"></i> แก้ไข</button>
            <button class="btn btn-danger" type="button" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                <i class="fa fa-trash"></i> ลบ
            </button>
        </form>

        <form action="{{route('news.delete', ['post' => $post->id])}}" style="display: none" id="delete-form" method="POST">
            {{csrf_field()}}
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="//cloud.tinymce.com/stable/tinymce.min.js?apiKey={{env('TINYMCE_KEY')}}"></script>
<script type="text/javascript">
$(document).ready(function () {
    tinymce.init({
        selector: 'textarea',
        plugins: 'image code paste',
        paste_as_text: true,
        toolbar: 'undo redo | link image | code',
        image_title: true,
        automatic_uploads: true,
        images_upload_url: '{{route('news.upload')}}',
        images_upload_base_path: '/',
        relative_urls : false,
        file_picker_types: 'image',
        min_height: 500,
        content_style: `
        p {
          font-size: 1.2rem;
          font-weight: 400;
          line-height: 2rem;
        }

        img {
          display: block;
          margin: 1.5rem auto;
          width: auto;
          max-width: 400px;
          height: auto;
        }
    `,
        file_picker_callback: function(cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            input.onchange = function () {
                var file = this.files[0];

                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function () {
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var blobInfo = blobCache.create(id, file, reader.result);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), {title: file.name});
                };
            };

            input.click();
        }
    });
});
</script>
@endsection