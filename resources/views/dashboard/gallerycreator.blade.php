@extends('layout.dashboard')

@section('title', 'ระบบฝ่าย IT')

@section('css')
<link rel="stylesheet" href="{{url('/css/dropzone.css')}}">
@endsection

@section('content')
<div class="card dashboard-card">
    <h4 class="card-title">สร้างอัลบัมรูป <small><a href="{{route('gallery.index.dashboard')}}">กลับ</a></small></h4>
    <div class="card-block">
        <form action="{{route('gallery.store')}}" method="POST" id="main-form">
            <div class="form-group">
                <label for="name">ชื่ออัลบัม</label>
                <input type="text" name="name" class="form-control" placeholder="ชื่ออัลบัม" required>
            </div>
            {{csrf_field()}}
        </form>
        
        <label>อัพโหลดรูป (ขนาดไม่เกิน 30 MB ต่อรูป และ ควรใช้รูปความระเอียดสูง)</label>
        <form action="{{route('gallery.upload')}}" method="POST" class="dropzone" id="imageDropzone">
            
        </form>
        <button class="btn btn-success" id="mainBtn" type="button" onclick="
        event.preventDefault(); 
        document.getElementById('main-form').submit();" disabled>
            <i class="fa fa-plus"></i> สร้างอัลบัมรูป
        </button>
    </div>
</div>
@endsection

@section('js')
<script src="/js/dropzone.js"></script>
<script type="text/javascript">
Dropzone.options.imageDropzone = {
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

        this.on("queuecomplete", function () {
            $('#mainBtn').prop('disabled', false);
        });
    }
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