@extends('layout.main')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.1.1/ekko-lightbox.min.css">
@endsection

@section('title', 'ประมวลภาพ')

@section('content')
<div class="content-container">
    <div class="section-header justify-content-center">
        อัลบัมทั้งหมด
    </div>

    <div class="gallery">

        <div class="gallery-wrapper">
            @foreach($galleries->chunk(2) as $chunk)
            <div class="row">
                @foreach($chunk as $gallery)
                <div class="col">
                    <a href="{{route('gallery.show', ['gallery' => $gallery->id])}}" 
                    class="gallery-all-image" 
                    style="
                    background-image: url({{$gallery->photos->first()->path}});
                    background-position: top;
                    ">
                        <span class="align-self-end">
                            {{$gallery->name}}
                        <br>
                        <span>
                            {{$gallery->photos->count()}} รูป 
                            • เข้าชม {{$gallery->getViewCount()}} ครั้ง</span>
                        </span>
                    </a>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>

    </div>

</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.1.1/ekko-lightbox.min.js"></script>
<script>
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});
</script>
@endsection
