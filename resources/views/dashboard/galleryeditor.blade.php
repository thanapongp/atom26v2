@extends('layout.dashboard')

@section('title', 'ระบบฝ่าย IT')

@section('css')
<link rel="stylesheet" href="{{url('/css/dropzone.css')}}">
@endsection

@section('content')
<div class="card dashboard-card">
    <h4 class="card-title">แก้ไขอัลบัม "{{$gallery->name}}" <small><a href="{{route('gallery.index.dashboard')}}">กลับ</a></small></h4>
    <div class="card-block">
        <form action="{{route('gallery.update', ['gallery' => $gallery])}}" method="POST" id="main-form">
            <div class="form-group">
                <label for="name">ชื่ออัลบัม</label>
                <input type="text" name="name" class="form-control" placeholder="ชื่ออัลบัม"
                value="{{$gallery->name}}" required>
            </div>
            {{csrf_field()}}
        </form>
        
        <label>อัพโหลดรูป (ขนาดไม่เกิน 30 MB ต่อรูป และ ควรใช้รูปความระเอียดสูง)</label>
        <form action="{{route('gallery.upload')}}" method="POST" class="dropzone" id="imageDropzone">
            
        </form>
        <button class="btn btn-primary" id="mainBtn" type="button" onclick="
        event.preventDefault(); 
        document.getElementById('main-form').submit();" disabled>
            <i class="fa fa-pencil"></i> แก้ไขอัลบัมรูป
        </button>
        <form action="{{route('gallery.delete', ['gallery' => $gallery])}}" class="d-inline" method="post">
            {{csrf_field()}}
            <button class="btn btn-danger" type="submit">
                <i class="fa fa-trash"></i> ลบอัลบัมรูป
            </button>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="/js/dropzone.js"></script>
<script type="text/javascript">
Dropzone.autoDiscover = false;
var dropzone = null;

$(document).ready(function () {
    instantiateDropzone();
    fetchUploadedFiles({{$gallery->id}});
});

function instantiateDropzone() {
    var options = {
        acceptedFiles: 'image/*',
        maxThumbnailFilesize: 1,
        maxFilesize: 30,
        addRemoveLinks: true,

        init: function () {
            this.on("addedfile", function (file) {
                $('#mainBtn').prop('disabled', true);
            });

            this.on("sending", function(file, xhr, formData) {
                formData.append("_token", $('meta[name="token"]').attr('content'));
            });

            this.on("success", function (file, response) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'images[]',
                    value: response
                }).appendTo('#main-form');
            });

            this.on("removedfile", function (file) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'delimages[]',
                    value: file.name
                }).appendTo('#main-form');
            });

            this.on("queuecomplete", function () {
                $('#mainBtn').prop('disabled', false);
            });
        }
    }

    dropzone = new Dropzone('#imageDropzone', options);
}

function fetchUploadedFiles(id) {
    axios.get('{{route('gallery.pics', ['gallery' => $gallery])}}')
    .then(function (response) {
        response.data.forEach(function (file) {
            insertFileToDropzone(file);
        });
    });
}

function insertFileToDropzone(file) {
    var newfile = { name: file.url, size: file.size };
    dropzone.emit("addedfile", newfile);
    dropzone.emit("thumbnail", newfile, file.url);
    dropzone.emit("complete", newfile);
}
</script>
<style>
.dropzone {
    margin-bottom: 2rem;
    border: 2px dashed #0087F7;
    border-radius: 5px;
    padding: 50px;
}
</style>
@endsection