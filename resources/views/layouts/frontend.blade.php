<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
	
	<link rel="stylesheet" href="{{ asset('public/frontend/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/frontend/plugins/fontawesome/css/fontawesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/frontend/plugins/fontawesome/css/all.min.css') }}">
	<link rel="stylesheet" href="{{ asset('public/frontend/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('public/frontend/css/responsive.css') }}">
</head>
<body>
	<div class="main-wrapper">
		<header class="header">
			<nav class="navbar navbar-expand-lg header-nav">
				<div class="container">
					<div class="navbar-header">
						<a id="mobile_btn" href="javascript:void(0);"> <span class="bar-icon">
					  <span></span>
							<span></span>
							<span></span>
							</span>
						</a>
						<a href="{{url('/')}}" class="navbar-brand logo">
							<img src="{{ asset('public/frontend/img/logo.png') }}" class="img-fluid" alt="Older Adult" />
						</a>
					</div>
					<div class="main-menu-wrapper">
						<div class="menu-header">
							<a href="{{url('/')}}" class="menu-logo">
								<img src="{{ asset('public/frontend/img/logo.png') }}" class="img-fluid" alt="Older Adult">
							</a>
							<a id="menu_close" class="menu-close" href="javascript:void(0);"> <i class="fas fa-times"></i>
							</a>
						</div>
						<ul class="main-nav">
						
							@guest
							    @if (Route::has('login'))
							        <li class="login-link"> <a  class="nav-link header-login" href="{{url('/login')}}">Login</a></li>
							    @endif
							@else
								<li class="login-link"><a  class="nav-link header-login" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
								</li>
							@endguest
						</ul>
					</div>
					<ul class="nav header-navbar-rht">
						
						@guest
							@if (Route::has('login'))
								<li class="login-link"> <a class="nav-link header-login" href="{{url('/login')}}">Login</a></li>
							@endif
							@if (Route::has('register'))
								<li class="nav-item">
									<a class="nav-link header-login"  href="{{ route('register') }}">{{ __('Register') }}</a>
								</li>
							@endif
						@else
							<!--<li class="login-link">
								<a role="button">
								{{ Auth::user()->name }}
								</a>
							</li>-->
							<li class="login-link"><a class="nav-link header-login"  href="{{ route('logout') }}"
								   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
								</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
									@csrf
								</form>
							</li>
						@endguest
						<!--<li class="nav-item"> <a class="nav-link header-login" href="{{url('/login')}}">Login </a></li>-->
						
					</ul>
				</div>	
			</nav>
		</header>
		 @yield('content')
		<footer class="footer">
			<div class="footer-bottom">
				<div class="container">
					<div class="copyright">
						<div class="row">
							<div class="col-md-12 col-lg-12">
								<div class="copyright-text" style="text-align:center">
									<p class="mb-0">&copy; 2023 Company. All rights reserved.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>
	<script src="{{ asset('public/frontend/js/jquery.min.js') }}"></script>
	<script src="{{ asset('public/frontend/js/popper.min.js') }}"></script>
	<script src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('public/frontend/js/slick.js') }}"></script>
	
	<script src="{{ asset('public/frontend/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
	<script src="{{ asset('public/frontend/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>
	<script src="{{ asset('public/frontend/js/circle-progress.min.js') }}"></script>
	
	<script src="{{ asset('public/frontend/js/script.js') }}"></script>
</body>
</html>