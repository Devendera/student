@extends('admin/layouts.backend')
@section('title', 'Edit User')
@section('content')
	<section id="content-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<div class="content-header">
					<div class="row">
						<div class="col-md-6">
							<h2 class="content-title">Dashboard</h2>
						</div>
						<div class="col-md-6">	
							<div class="page-header-breadcrumb">
								<ul class="breadcrumb">
									<li class="breadcrumb-item">
										<a href="{{ asset('admin/dashboard') }}" data-abc="true">
											<i class="fas fa-tachometer-alt"></i> Home
										</a>
									</li>
									<li class="breadcrumb-item active"><a href="{{ asset('admin/users') }}" data-abc="true">Edit User</a>
									</li>
								</ul>
							</div>
						</div>
					</div>			
				</div>
				<div class="row mt-3">
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Edit User</h3>
							</div>
							<!-- /.box-header -->
							<!-- form start -->
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
							<form role="form" action="{{ asset('admin/user/edit_user_action') }}" method="POST" enctype='multipart/form-data'>
							    @CSRF
								<input type="hidden" name="user_id" value="{{ $userInfo->id }}" required>
								<div class="box-body"> 
								    <div class="form-group">
										<label for="exampleInputEmail1">Name <span style="color:red;">*</span></label>
										<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" placeholder="Name" value="{{ $userInfo->name }}" required> 
										@error('name')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Email <span style="color:red;">*</span></label>
										<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter email"   value="{{ $userInfo->email }}" required readonly>
										@error('email')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Dob <span style="color:red;">*</span></label>
										<input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror" id="exampleInputEmail1" placeholder="DOB" value="{{ date('DD-MM-YYYY',strtotime($userInfo->dob)) }}" required>
										@error('dob')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Address <span style="color:red;">*</span></label>
										<input type="text" name="address" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" placeholder="Address" value="{{ $userInfo->address }}" required>
										@error('address')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">{{ __('Profile Picture') }} <span style="color:red;">*</span></label>
										<input id="files" type="file" class="form-control @error('profile_picture') is-invalid @enderror" name="profile_picture" placeholder="Profile Picture">
										@error('profile_picture')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
										<br/>
										<img src="{{ asset('public/uploads/user/') }}/{{ $userInfo->profile_pic }}" height="60">
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Status <span style="color:red;">*</span></label>
										<select name="status" class="form-control" required>
										    <option value="1" @if($userInfo->status==1) selected @endif>Enable</option>
										    <option value="0" @if($userInfo->status==0) selected @endif>Disable</option>
										</select>
										@error('status')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>
								<!-- /.box-body -->
								<div class="box-footer">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</form>
						</div>
						<!-- /.box -->
					</div>
				</div>
					
			</div>
		</div>
	</section>
@endsection
