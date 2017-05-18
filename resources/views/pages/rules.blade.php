@extends('layout.main')

@section('title', 'ระเบียบการและกติกาการแข่งขัน')

@section('content')
<div class="content-container">
    <div class="section-header">
        <div>
            <span>ระเบียบการและกติกาการแข่งขัน</span>
        </div>
    </div>

    <div class="post">
        {{-- <div class="headline-img" style="background-image: url({{$post->thumbnail}})"></div> --}}

        <p>
            ท่านสามารถดาวน์โหลดระเบียบการและกติกาสำหรับการแข่งขันกีฬาและการแข่งขันวิชาการได้ที่ลิงค์ด้านล่าง
        </p>

        <p>
            <a href="/rules-sport.pdf">ระเบียบการและกติกาการแข่งขันกีฬา (PDF)</a> <br>
            <a href="/rules-academic.pdf">ระเบียบการและกติกาการแข่งขันวิชาการ (PDF)</a>
        </p>
    </div>

</div>
@endsection