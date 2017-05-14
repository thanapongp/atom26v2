<div class="content-container">
    <div class="section-header">
        <div>ประมวลภาพ <span style="color: #FFA02F">"ไตรธาราเกมส์"</span></div>
        <div><a href="/gallery">ดูทั้งหมด</a></div>
    </div>

    <div class="row home-gallery hidden-md-down">
        <div class="col-md-6">
            <a href="#" class="grid-big" style="
					background: url({{$galleries->first()->photos->first()->path}}) no-repeat center center;
					background-size: cover;">
				<span>
					{{$galleries->first()->name}}
					<br>
					<span>{{$galleries->first()->photos->count()}} รูป</span>
				</span>
            </a>
        </div>

        <div class="col-md-6 row">
            @foreach($galleries->splice(1) as $gallery)
            <div class="col-md-6">
                <a href="#" class="grid-small grid-small-top" style="
					margin-bottom: 10px;
					background: url({{$gallery->photos->first()->path}}) no-repeat center center; 
					background-size: cover;">
					<span>
						{{$gallery->name}}
						<br>
						<span>{{$gallery->photos->count()}} รูป {{-- • เข้าชม 2,000 ครั้ง --}}</span>
					</span>
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <div id="gallery-carousel" class="home-gallery hidden-lg-up">
        <div class="col-md-12 carousel-cell">
            <a href="#" class="grid-small grid-small-top" style="
					margin-bottom: 10px;
					background: url('http://placehold.it/318x180') no-repeat center center;
					background-size: cover;">
                <span>
                    พิธีเปิดไตรธาราเกมส์
                    <br>
                    <span>124 รูป • เข้าชม 2,000 ครั้ง</span>
                </span>
            </a>
        </div>
        <div class="col-md-12 carousel-cell">
            <a href="#" class="grid-small grid-small-top" style="
					margin-bottom: 10px;
					background: url('http://placehold.it/318x180') no-repeat center center;
					background-size: cover;">
                <span>
                    พิธีเปิดไตรธาราเกมส์
                    <br>
                    <span>124 รูป • เข้าชม 2,000 ครั้ง</span>
                </span>
            </a>
        </div>
        <div class="col-md-12 carousel-cell">
            <a href="#" class="grid-small grid-small-top" style="
					margin-bottom: 10px;
					background: url('http://placehold.it/318x180') no-repeat center center;
					background-size: cover;">
                <span>
                    พิธีเปิดไตรธาราเกมส์
                    <br>
                    <span>124 รูป • เข้าชม 2,000 ครั้ง</span>
                </span>
            </a>
        </div>
    </div>
</div>