<div class="content-container">
    <div class="section-header">
        <div>ติดตามข่าว <span style="color: #FFA02F">"ไตรธาราเกมส์"</span></div>
        <div><a href="/news">ดูทั้งหมด</a></div>
    </div>

    <div class="hidden-lg-up" id="news-carousel">
        @foreach($news as $post)
            <div class="col-md-12 carousel-cell">
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

    <div class="row hidden-md-down">
        @foreach($news as $post)
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
</div>