@extends('layout.main')

@section('meta')
<meta property="og:url" content="{{url()->current()}}" />
<meta property="og:type" content="website" />
<meta property="og:title" content="{{$gallery->name}}" />
<meta property="og:image" content="{{url($gallery->photos->first()->path)}}" />
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.1.1/ekko-lightbox.min.css">
@endsection

@section('title', $gallery->name)

@section('content')
<div id="fb-root"></div>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<div class="content-container">
    <div class="section-header justify-content-center">
        {{$gallery->name}}
    </div>

    <div class="d-flex justify-content-center flex-column">
        <span class="d-block text-muted" style="font-size: 1rem; margin: 0 auto;">
                {{$gallery->created_at->format('d/m/Y')}} • {{$gallery->photos->count()}} รูป • เข้าชม {{$gallery->getViewCount()}} ครั้ง
        </span>
        <div class="fb-like"
             style="margin: 0 auto" 
             data-href="{{url()->current()}}"
             data-layout="button_count"
             data-action="like"
             data-show-faces="true"
             data-share="true">
        </div>
    </div>

    <div class="gallery">

        <div class="gallery-wrapper">
            @foreach($gallery->photos->chunk(5) as $chunk)
            <div class="row">
                @foreach($chunk as $photo)
                <a href="{{url($photo->path)}}" 
                data-toggle="lightbox" data-gallery="gallery" class="col gallery-image" 
                style="
                background-image: url({{$photo->path}});
                background-position: {{$loop->last ? 'top' : 'center'}};
                max-height: 175px;">
                </a>
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
