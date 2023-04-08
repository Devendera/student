<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<meta name="description" content="">
	<meta name="author" content="">
	<title>@yield('title')</title>
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="{{ asset('public/admin/css/bootstrap.min.css') }}">
	<link href="{{ asset('public/admin/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<!-- Custom styles for this site -->
	<link href="{{ asset('public/admin/css/custom.css') }}" rel="stylesheet">
	<link href="{{ asset('public/admin/css/responsive.css') }}" rel="stylesheet">
</head>
<body>
	<main role="main" id="DT-dashboard">
	    <div id="wrapper">
			<aside id="sidebar-wrapper">
				<div class="sidebar-brand">
					<a href="{{ asset('admin/dashboard') }}"><img src="{{ asset('public/admin/images/logo.png') }}" alt="" class="d-block img-fluid" /></a>
				</div>
				<ul class="sidebar-nav">
					<li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"> <a href="{{ url('/admin/dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
					</li>
					<li class="{{ Request::is('admin/add-user') ? 'active' : '' }} {{ Request::is('admin/users') ? 'active' : '' }}"> <a href="#" data-toggle="collapse" data-target="#tables" class="active collapsed" aria-expanded="false"><i class="fas fa-table"></i> <span class="nav-label">User Management</span><span class="fa fa-chevron-left pull-right"></span></a>
						<ul class="sub-menu collapse" id="tables" style="">
							<li>
								<a href="{{ asset('admin/add-user')}}"> <i class="far fa-circle"></i> Add User</a>
							</li>
							<li>
								<a href="{{ asset('admin/users')}}"> <i class="far fa-circle"></i> Users</a>
							</li>
						</ul>
					</li>
					
					
					
				</ul>
			</aside>
			<div id="navbar-wrapper">
				<nav class="navbar navbar-inverse fixed-top">
					<div class="container-fluid">
						<div class="navbar-header"> <a href="#" class="navbar-brand" id="sidebar-toggle"><i class="fa fa-bars"></i></a>
						</div>
						<ul class="custom-navbar-nav">
							<li><a href=""><i class="far fa-bell"></i> <span class="badge badge-light">7</span></a>
							</li>
							<li><a href=""><i class="far fa-envelope"></i> <span class="badge badge-light">7</span></a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<img src="http://via.placeholder.com/30x30" class="rounded-circle" alt="User Image"> <span class="admin-txt">{{ Auth::user()->name }}</span>
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
								<a class="dropdown-item" href="{{ url('admin/profile') }}">My Profile</a>
								<!-- <a class="dropdown-item" href="{{ url('admin/setting') }}">Settings</a> -->
								<a class="dropdown-item" href="{{ url('admin/logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
								<form id="logout-form" action="{{ url('admin/logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
								</div>
						  </li>  
						</ul>
					</div>
				</nav>
			</div>
			@yield('content')
		</div>
	</main>
	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="{{ asset('public/admin/js/jquery.min.js')}}"></script>
	<script src="{{ asset('public/admin/js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{ asset('public/admin/js/dataTables.bootstrap4.min.js')}}"></script>
	<script src="{{ asset('public/admin/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{ asset('public/admin/js/custom.js')}}"></script>
</body>
</html>
