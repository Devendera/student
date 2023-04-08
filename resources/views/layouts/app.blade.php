<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="{{ asset('public/admin/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<!-- Custom styles for this site -->
	<link href="{{ asset('public/admin/css/custom.css') }}" rel="stylesheet">
	<link href="{{ asset('public/admin/css/responsive.css') }}" rel="stylesheet">
</head>

<body>
    <main role="main" id="DT-login" class="login-banner">
	  @yield('content')
	</main>
	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="{{ asset('public/admin/js/jquery.min.js') }}"></script>
	<script src="{{ asset('public/admin/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('public/admin/js/custom.js') }}"></script>
</body>

</html>