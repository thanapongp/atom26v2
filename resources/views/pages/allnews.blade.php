@extends('layout.main')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.1.1/ekko-lightbox.min.css">
@endsection

@section('title', 'ประมวลภาพ')

@section('content')
<div class="content-container">
    <div class="section-header justify-content-center">
        <div>ติดตามข่าว <span style="color: #FFA02F">"ไตรธาราเกมส์"</span></div>
    </div>
    
    @foreach($news->chunk(3) as $chunk)
    <div class="row">
        @foreach($chunk as $post)
            <div class="col-md-4">
                <div class="card news-card">
                    <a href="{{route('news.show', ['post' => $post->id])}}" class="news-img" style="
                    background: url({{$post->thumbnail}}) no-repeat center center;
                    background-size: cover;">
                    </a>
                    <div class="card-block">
                        <a href="{{route('news.show', ['post' => $post->id])}}" class="card-title">{{$post->title}}</a>
                        <p class="card-text">
                            <small class="text-muted">
                                {{$post->created_at->format('d/m/Y')}}
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endforeach

    <div class="d-flex justify-content-center">
        {{ $news->links('vendor.pagination.bootstrap-4') }}
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
