@extends('layout.main')

@section('css')
	<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
@endsection

@section('title', 'หน้าแรก')

@section('content')
	@include('partials.home.carousel')

	@include('partials.home.countdown')

	@include('partials.home.news')

	{{--@include('partials.home.gallery')--}}

	@include('partials.home.info')
@endsection

@section('js')
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script src="/js/home.js?v=1231"></script>
<style>
.home-carousel {
	height: 500px;
}

.flickity-page-dots {
	bottom: 15px;
}

.dot.is-selected {
	background: #fff;
}
</style>
@endsection