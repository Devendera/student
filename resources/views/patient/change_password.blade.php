@extends('layouts.frontend')
@section('title', 'Change Password')
@section('content')
	<!-- Breadcrumb-bar Start -->
	<section class="breadcrumb-bar">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-12 col-12">
					<nav aria-label="breadcrumb" class="page-breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">Change Password</li>
						</ol>
					</nav>
					<h2 class="breadcrumb-title">Change Password</h2>
				</div>
			</div>
		</div>
	</section>
	<!-- ./ End of Breadcrumb-bar -->
	<!-- Content Start -->
		<section class="content">
			<div class="container">
				<div class="row">
					<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
						<div class="profile-sidebar">
							<div class="widget-profile pro-widget-content">
								<div class="profile-info-widget">
									<a href="#" class="booking-doc-img">
										@if(isset($unserInfo->profile_pic))
											<img src="{{ asset('public/uploads/user') }}/{{ $unserInfo->profile_pic }}" alt="User Image" />
										@else
											<img src="{{ asset('public/frontend/img/patients/patient.jpg') }}" alt="User Image">
										@endif
									</a>
									<div class="profile-det-info">
										@if(!empty(Auth::user()->name))
									        <h3>{{ Auth::user()->name }}</h3>
										@else
											<h3>No name</h3>
										@endif
										<div class="patient-details">
											<!--<h5><i class="fas fa-birthday-cake"></i> 24 Jul 1989, 30 years</h5>-->
											<h5 class="mb-0"><i class="fas fa-map-marker-alt"></i>@if(!empty(Auth::user()->state)) {{ Auth::user()->state }} @endif @if(!empty(Auth::user()->country)) {{ Auth::user()->country }} @endif</h5>
										</div>
									</div>
								</div>
							</div>
							<div class="dashboard-widget">
								@include('patient/side_nav')
							</div>
						</div>
					</div>
					<div class="col-md-7 col-lg-8 col-xl-9">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12 col-lg-6">
									   @if(session()->has('success'))
											<div class="alert alert-success">
											  <strong>Success!</strong> {{ session()->get('success') }}
											</div>
										@endif
										@if(session()->has('error'))
											<div class="alert alert-danger">
												<strong>Warning!</strong> {{ session()->get('error') }}
											</div>
										@endif
										<form name="change-password" method="post" action="{{ url('/patient/change_password_action') }}" enctype='multipart/form-data'>
											@CSRF
											<div class="form-group">
												<label>Old Password</label>
												<input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror"  placeholder="Old password.." required>
												@error('old_password')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
											<div class="form-group">
												<label>New Password</label>
												<input type="password"  name="new_password" class="form-control  @error('new_password') is-invalid @enderror"  placeholder="New password.." required>
												@error('new_password')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
											<div class="form-group">
												<label>Confirm Password</label>
												<input type="password"  name="confirm_password"class="form-control  @error('confirm_password') is-invalid @enderror" placeholder="Confirm password.." required>
												@error('confirm_password')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
											<div class="submit-section">
												<button type="submit"  class="btn btn-primary submit-btn">Save Changes</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- ./ End of Content -->
@endsection
