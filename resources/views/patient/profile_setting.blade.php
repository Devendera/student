@extends('layouts.frontend')
@section('title', 'Profile Setting')
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
							<li class="breadcrumb-item active" aria-current="page">Profile Setting</li>
						</ol>
					</nav>
					<h2 class="breadcrumb-title">Profile Setting</h2>
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
							
								<form name="update-doctor-profile" method="post" action="{{ url('/patient/profile_setting_actions') }}" enctype='multipart/form-data'>
								    @CSRF
									<div class="row form-row">
										<div class="col-12 col-md-12">
											<div class="form-group">
												<div class="change-avatar">
													<div class="profile-img">
														@if(isset($unserInfo->profile_pic))
														<img src="{{ asset('public/uploads/user') }}/{{ $unserInfo->profile_pic }}" alt="User Image" />
													@else
														<img src="{{ asset('public/frontend/img/doctors/doctor-thumb-02.jpg') }}" alt="User Image" />
													@endif
													</div>
													<div class="upload-img">
														<div class="change-photo-btn"><span><i class="fa fa-upload"></i> Upload Photo</span>
															<input type="file" name="profile_pic" class="upload">
														</div><small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
													</div>
												</div>
											</div>
										</div>
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label>First Name</label>
												<input type="text" name="first_name" value="{{ $unserInfo->name }}" class="form-control" required>
											</div>
										</div>
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label>Last Name</label>
												<input type="text" name="last_name" value="{{ $unserInfo->last_name }}" class="form-control" required>
											</div>
										</div>
										<!--<div class="col-12 col-md-6">
											<div class="form-group">
												<label>Date of Birth</label>
												<div class="cal-icon">
													<input type="text" class="form-control datetimepicker" value="24-07-1989">
												</div>
											</div>
										</div>
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label>Blood Group</label>
												<select class="form-control">
													<option>A1+</option>
													<option>A-</option>
													<option>A+</option>
													<option>B-</option>
													<option>B+</option>
													<option>AB-</option>
													<option>AB+</option>
													<option>O-</option>
													<option>O+</option>
												</select>
											</div>
										</div>-->
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label>Gender</label>
												<select name="gender" class="form-control select" required>
													<option value="">-Select-</option>
													<option value="Male" @if($unserInfo->gender=='Male') selected @endif>Male</option>
													<option value="Female" @if($unserInfo->gender=='Female') selected @endif>Female</option>
												</select>
											</div>
										</div>
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label>Email ID</label>
												<input type="email" name="email" class="form-control"  value="{{ $unserInfo->email }}" readonly="" required>
											</div>
										</div>
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label>Mobile</label>
												<input type="text"  name="mobile_no" value="{{ $unserInfo->mobile_no }}"  class="form-control" required>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label>Address</label>
												<input type="text" class="form-control" name="address" value="{{ $unserInfo->address }}" required>
											</div>
										</div>
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label>City</label>
												<input type="text" class="form-control" name="city" value="{{ $unserInfo->city }}" required>
											</div>
										</div>
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label>State</label>
												<input type="text" class="form-control" name="state" value="{{ $unserInfo->state }}" required>
											</div>
										</div>
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label>Zip Code</label>
												<input type="text" class="form-control" name="zip_code" value="{{ $unserInfo->zip_code }}" required>
											</div>
										</div>
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label>Country</label>
												<input type="text" class="form-control" name="country" value="{{ $unserInfo->country }}" required>
											</div>
										</div>
									</div>
									<div class="submit-section">
										<button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- ./ End of Content -->
@endsection
