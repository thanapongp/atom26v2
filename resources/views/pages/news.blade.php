@extends('layout.main')

@section('meta')
<meta property="og:url" content="{{url()->current()}}" />
<meta property="og:type" content="website" />
<meta property="og:title" content="{{$post->title}}" />
<meta property="og:image" content="{{url($post->thumbnail)}}" />
@endsection

@section('title', $post->title)

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
    <div class="section-header">
        <div>
            <span>{{$post->title}}</span> <br>
        </div>
    </div>

    <div class="post">
        <span class="d-block text-muted" style="font-size: 1rem">
                {{$post->created_at->format('d/m/Y')}}
        </span>
        <div class="fb-like"
             data-href="{{url()->current()}}"
             data-layout="button_count"
             data-action="like"
             data-show-faces="true"
             data-share="true">
        </div>
        <div class="headline-img" style="background-image: url({{$post->thumbnail}})"></div>

        {!! $post->content !!}
    </div>

</div>
@endsection