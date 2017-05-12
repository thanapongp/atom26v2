<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('meta')
    @include('partials.favico')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
	@yield('css')
	<title>@yield('title') | ไตรธาราเกมส์ กีฬาวิทยาศาสตร์สัมพันธ์แห่งประเทศไทย ครั้งที่ 26</title>
</head>
<body>
	@include('partials.navbar')

	@yield('content')

	@include('partials.footer')

<script src="{{ mix('js/app.js') }}"></script>
@yield('js')
</body>
</html>