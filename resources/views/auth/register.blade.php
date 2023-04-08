@extends('layouts.frontend')
@section('title', 'Register')
@section('content')
<!-- Content Start -->
		<section class="content">
			<div class="container">
				<div class="row">
					<div class="col-md-10 offset-md-1">
						<div class="account-content">
							<div class="row align-items-center justify-content-center">
								<div class="col-md-7 col-lg-6 login-left">
									<img src="{{asset('public/frontend/img/login-banner.png') }}" class="img-fluid" alt="Docucare Register">
								</div>
								<div class="col-md-12 col-lg-6 login-right">
									<div class="login-header">
										<h3>Registration</h3>
									</div>
									<form method="POST" action="{{ url('add_user_action') }}" enctype="multipart/form-data">
										@csrf
										<div class="form-group form-focus">
											<input id="name" type="text" class="form-control floating @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
											@error('name')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
											<label class="focus-label">Name</label>
										</div>
										<div class="form-group form-focus">
											<input id="email" type="email" class="form-control floating @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
											@error('email')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
											<label class="focus-label">Email</label>
										</div>
										<div class="form-group form-focus">
											<input id="password" type="password" class="form-control floating @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
											@error('password')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
											<label class="focus-label">Create Password</label>
										</div>
										
										<div class="form-group form-focus">
											<input id="password-confirm" type="password" class="form-control floating @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
											<label class="focus-label">Confirm Password</label>
										</div>
										<div class="form-group form-focus">
											<input id="address" type="text" class="form-control floating @error('address') is-invalid @enderror" name="address" required autocomplete="new-address">
											@error('address')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
											<label class="focus-label">Address</label>
										</div>
										<div class="form-group form-focus">
											<input id="dob" type="date" class="form-control floating @error('dob') is-invalid @enderror" name="dob" required autocomplete="new-dob">
											@error('dob')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
											<label class="focus-label">DOB</label>
										</div>
										<div class="form-group form-focus">
											<input id="profile_picture" type="file" class="form-control floating @error('profile_picture') is-invalid @enderror" name="profile_picture" required autocomplete="new-profile_picture">
											@error('profile_picture')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
											<label class="focus-label">Photo</label>
										</div>
										
										<button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Signup</button>
										
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- ./ End of Content -->
@endsection
