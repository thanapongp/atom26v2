<div class="content-container">
    <div class="section-header">
        <div>ประมวลภาพ <span style="color: #FFA02F">"ไตรธาราเกมส์"</span></div>
        <div><a href="/gallery">ดูทั้งหมด</a></div>
    </div>

    <div class="home-gallery hidden-md-down">

        @foreach($galleries->chunk(5) as $chunk)
        <div class="row">
            @foreach($chunk as $gallery)
            <div class="col">
                <a href="{{route('gallery.show', ['gallery' => $gallery->id])}}" class="grid-small grid-small-top" style="
					margin-bottom: 10px;
					background: url({{$gallery->photos->first()->path}}) no-repeat center center; 
					background-size: cover;">
					<span>
						{{$gallery->name}}
						<br>
						<span>{{$gallery->photos->count()}} รูป 
                        • เข้าชม {{$gallery->getViewCount()}} ครั้ง</span>
					</span>
                </a>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>

    <div id="gallery-carousel" class="home-gallery hidden-lg-up">
        @foreach($galleries as $gallery)
        <div class="col-md-12 carousel-cell">
            <a href="{{route('gallery.show', ['gallery' => $gallery->id])}}" class="grid-small grid-small-top" style="
					margin-bottom: 10px;
					background: url({{$gallery->photos->first()->path}}) no-repeat center center;
					background-size: cover;">
                <span>
                    {{$gallery->name}}
                    <br>
                    <span>{{$gallery->photos->count()}} รูป • เข้าชม {{$gallery->getViewCount()}} ครั้ง</span>
                </span>
            </a>
        </div>
        @endforeach
    </div>
</div>