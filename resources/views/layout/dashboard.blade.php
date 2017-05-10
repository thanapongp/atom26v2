<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	@include('partials.favico')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
	@yield('css')
	<title>@yield('title') | ระบบไตรธาราเกมส์</title>
</head>
<body class="dashboard">
	@include('partials.dashboard.navbar')

	<div class="container">
        @yield('content')
    </div>

<script src="{{ mix('js/app.js') }}"></script>
@yield('js')
</body>
</html>