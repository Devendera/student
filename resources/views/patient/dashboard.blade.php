@extends('layouts.frontend')
@section('title', 'Patient Dashboard')
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
							<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
						</ol>
					</nav>
					<h2 class="breadcrumb-title">Dashboard</h2>
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
								@include('patient/side_nav');
							</div>
						</div>
					</div>
					<div class="col-md-7 col-lg-8 col-xl-9">
						<div class="card">
							<div class="card-body pt-0">
								<nav class="user-tabs mb-4">
									<ul class="nav nav-tabs nav-tabs-bottom nav-justified">
										<li class="nav-item"><a class="nav-link active" href="#pat_appointments" data-toggle="tab">Appointments</a>
										</li>
										<li class="nav-item"><a class="nav-link" href="#pat_prescriptions" data-toggle="tab">Prescriptions</a>
										</li>
										<li class="nav-item"><a class="nav-link" href="#pat_medical_records" data-toggle="tab"><span class="med-records">Medical Records</span></a>
										</li>
										<li class="nav-item"><a class="nav-link" href="#pat_billing" data-toggle="tab">Billing</a>
										</li>
									</ul>
								</nav>
								<div class="tab-content pt-0">
									<div id="pat_appointments" class="tab-pane fade show active">
										<div class="card card-table mb-0">
											<div class="card-body">
												<div class="table-responsive">
													<table class="table table-hover table-center mb-0">
														<thead>
															<tr>
																<th>Doctor</th>
																<th>Appt Date</th>
																<th>Booking Date</th>
																<th>Amount</th>
																<th>Follow Up</th>
																<th>Status</th>
																<th></th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>
																	<h2 class="table-avatar"><a href="" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="{{ asset('public/frontend/img/doctors/doctor-thumb-01.jpg') }}" alt="User Image"></a><a href="">Dr. Diedra Spangler <span>Dental</span></a></h2>
																</td>
																<td>16 Sep 2021 <span class="d-block text-info">10.00 AM</span>
																</td>
																<td>16 Sep 2021</td>
																<td>$200</td>
																<td>16 Sep 2021</td>
																<td><span class="badge badge-pill bg-success-light">Confirm</span>
																</td>
																<td class="text-right">
																	<div class="table-action">
																		<a href="javascript:void(0);" class="btn btn-sm bg-primary-light"><i class="fas fa-print"></i> Print</a>
																		<a href="javascript:void(0);" class="btn btn-sm bg-info-light"><i class="far fa-eye"></i> View</a>
																	</div>
																</td>
															</tr>
															<tr>
																<td>
																	<h2 class="table-avatar"><a href="" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="{{ asset('public/frontend/img/doctors/doctor-thumb-02.jpg') }}" alt="User Image"></a><a href="">Dr. Kalen Chavez <span>Dental</span></a></h2>
																</td>
																<td>16 Sep 2021 <span class="d-block text-info">8.00 PM</span>
																</td>
																<td>16 Sep 2021</td>
																<td>$290</td>
																<td>16 Sep 2021</td>
																<td><span class="badge badge-pill bg-success-light">Confirm</span>
																</td>
																<td class="text-right">
																	<div class="table-action">
																		<a href="javascript:void(0);" class="btn btn-sm bg-primary-light"><i class="fas fa-print"></i> Print</a>
																		<a href="javascript:void(0);" class="btn btn-sm bg-info-light"><i class="far fa-eye"></i> View</a>
																	</div>
																</td>
															</tr>
															<tr>
																<td>
																	<h2 class="table-avatar"><a href="" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="{{ asset('public/frontend/img/doctors/doctor-thumb-03.jpg') }}" alt="User Image"></a><a href="">Dr. Bedeelia Elliott <span>Cardiology</span></a></h2>
																</td>
																<td>16 Sep 2021 <span class="d-block text-info">11.00 AM</span>
																</td>
																<td>16 Sep 2021</td>
																<td>$440</td>
																<td>16 Sep 2021</td>
																<td><span class="badge badge-pill bg-danger-light">Cancelled</span>
																</td>
																<td class="text-right">
																	<div class="table-action">
																		<a href="javascript:void(0);" class="btn btn-sm bg-primary-light"><i class="fas fa-print"></i> Print</a>
																		<a href="javascript:void(0);" class="btn btn-sm bg-info-light"><i class="far fa-eye"></i> View</a>
																	</div>
																</td>
															</tr>
															<tr>
																<td>
																	<h2 class="table-avatar"><a href="" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="{{ asset('public/frontend/img/doctors/doctor-thumb-04.jpg') }}" alt="User Image"></a><a href="">Dr. Alyxandra Foster <span>Urology</span></a></h2>
																</td>
																<td>16 Sep 2021 <span class="d-block text-info">3.00 PM</span>
																</td>
																<td>16 Sep 2021</td>
																<td>$410</td>
																<td>16 Sep 2021</td>
																<td><span class="badge badge-pill bg-warning-light">Pending</span>
																</td>
																<td class="text-right">
																	<div class="table-action">
																		<a href="javascript:void(0);" class="btn btn-sm bg-primary-light"><i class="fas fa-print"></i> Print</a>
																		<a href="javascript:void(0);" class="btn btn-sm bg-info-light"><i class="far fa-eye"></i> View</a>
																	</div>
																</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="pat_prescriptions">
										<div class="card card-table mb-0">
											<div class="card-body">
												<div class="table-responsive">
													<table class="table table-hover table-center mb-0">
														<thead>
															<tr>
																<th>Date</th>
																<th>Name</th>
																<th>Created by</th>
																<th></th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>16 Sep 2021</td>
																<td>Prescription 1</td>
																<td>
																	<h2 class="table-avatar"><a href="" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="{{ asset('public/frontend/img/doctors/doctor-thumb-01.jpg') }}" alt="User Image"></a><a href="">Dr. Diedra Spangler <span>Dental</span></a></h2>
																</td>
																<td class="text-right">
																	<div class="table-action">
																		<a href="javascript:void(0);" class="btn btn-sm bg-primary-light"><i class="fas fa-print"></i> Print</a>
																		<a href="javascript:void(0);" class="btn btn-sm bg-info-light"><i class="far fa-eye"></i> View</a>
																	</div>
																</td>
															</tr>
															<tr>
																<td>16 Sep 2021</td>
																<td>Prescription 2</td>
																<td>
																	<h2 class="table-avatar"><a href="" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="{{ asset('public/frontend/img/doctors/doctor-thumb-02.jpg') }}" alt="User Image"></a><a href="">Dr. Kalen Chavez <span>Dental</span></a></h2>
																</td>
																<td class="text-right">
																	<div class="table-action">
																		<a href="javascript:void(0);" class="btn btn-sm bg-primary-light"><i class="fas fa-print"></i> Print</a>
																		<a href="javascript:void(0);" class="btn btn-sm bg-info-light"><i class="far fa-eye"></i> View</a>
																	</div>
																</td>
															</tr>
															<tr>
																<td>16 Sep 2021</td>
																<td>Prescription 3</td>
																<td>
																	<h2 class="table-avatar"><a href="" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="{{ asset('public/frontend/img/doctors/doctor-thumb-03.jpg') }}" alt="User Image"></a><a href="">Dr. Bedeelia Elliott <span>Cardiology</span></a></h2>
																</td>
																<td class="text-right">
																	<div class="table-action">
																		<a href="javascript:void(0);" class="btn btn-sm bg-primary-light"><i class="fas fa-print"></i> Print</a>
																		<a href="javascript:void(0);" class="btn btn-sm bg-info-light"><i class="far fa-eye"></i> View</a>
																	</div>
																</td>
															</tr>
															<tr>
																<td>16 Sep 2021</td>
																<td>Prescription 4</td>
																<td>
																	<h2 class="table-avatar"><a href="" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="{{ asset('public/frontend/img/doctors/doctor-thumb-04.jpg') }}" alt="User Image"></a><a href="">Dr. Alyxandra Foster <span>Urology</span></a></h2>
																</td>
																<td class="text-right">
																	<div class="table-action">
																		<a href="javascript:void(0);" class="btn btn-sm bg-primary-light"><i class="fas fa-print"></i> Print</a>
																		<a href="javascript:void(0);" class="btn btn-sm bg-info-light"><i class="far fa-eye"></i> View</a>
																	</div>
																</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
									<div id="pat_medical_records" class="tab-pane fade">
										<div class="card card-table mb-0">
											<div class="card-body">
												<div class="table-responsive">
													<table class="table table-hover table-center mb-0">
														<thead>
															<tr>
																<th>ID</th>
																<th>Date</th>
																<th>Description</th>
																<th>Attachment</th>
																<th>Created</th>
																<th></th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td><a href="javascript:void(0);">#MR-0010</a>
																</td>
																<td>16 Sep 2021</td>
																<td>Dental Filling</td>
																<td><a href="#">dental-test.pdf</a>
																</td>
																<td>
																	<h2 class="table-avatar"><a href="" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="{{ asset('public/frontend/img/doctors/doctor-thumb-01.jpg') }}" alt="User Image"></a><a href="">Dr. Diedra Spangler <span>Dental</span></a></h2>
																</td>
																<td class="text-right">
																	<div class="table-action">
																		<a href="javascript:void(0);" class="btn btn-sm bg-info-light"><i class="far fa-eye"></i> View</a>
																		<a href="javascript:void(0);" class="btn btn-sm bg-primary-light"><i class="fas fa-print"></i> Print</a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><a href="javascript:void(0);">#MR-0009</a>
																</td>
																<td>16 Sep 2021</td>
																<td>Teeth Cleaning</td>
																<td><a href="#">dental-test.pdf</a>
																</td>
																<td>
																	<h2 class="table-avatar"><a href="" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="{{ asset('public/frontend/img/doctors/doctor-thumb-02.jpg') }}" alt="User Image"></a><a href="">Dr. Kalen Chavez <span>Dental</span></a></h2>
																</td>
																<td class="text-right">
																	<div class="table-action">
																		<a href="javascript:void(0);" class="btn btn-sm bg-info-light"><i class="far fa-eye"></i> View</a>
																		<a href="javascript:void(0);" class="btn btn-sm bg-primary-light"><i class="fas fa-print"></i> Print</a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><a href="javascript:void(0);">#MR-0008</a>
																</td>
																<td>16 Sep 2021</td>
																<td>General Checkup</td>
																<td><a href="#">cardio-test.pdf</a>
																</td>
																<td>
																	<h2 class="table-avatar"><a href="" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="{{ asset('public/frontend/img/doctors/doctor-thumb-03.jpg') }}" alt="User Image"></a><a href="">Dr. Bedeelia Elliott <span>Cardiology</span></a></h2>
																</td>
																<td class="text-right">
																	<div class="table-action">
																		<a href="javascript:void(0);" class="btn btn-sm bg-info-light"><i class="far fa-eye"></i> View</a>
																		<a href="javascript:void(0);" class="btn btn-sm bg-primary-light"><i class="fas fa-print"></i> Print</a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><a href="javascript:void(0);">#MR-0007</a>
																</td>
																<td>16 Sep 2021</td>
																<td>General Test</td>
																<td><a href="#">general-test.pdf</a>
																</td>
																<td>
																	<h2 class="table-avatar"><a href="" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="{{ asset('public/frontend/img/doctors/doctor-thumb-04.jpg') }}" alt="User Image"></a><a href="">Dr. Alyxandra Foster <span>Urology</span></a></h2>
																</td>
																<td class="text-right">
																	<div class="table-action">
																		<a href="javascript:void(0);" class="btn btn-sm bg-info-light"><i class="far fa-eye"></i> View</a>
																		<a href="javascript:void(0);" class="btn btn-sm bg-primary-light"><i class="fas fa-print"></i> Print</a>
																	</div>
																</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
									<div id="pat_billing" class="tab-pane fade">
										<div class="card card-table mb-0">
											<div class="card-body">
												<div class="table-responsive">
													<table class="table table-hover table-center mb-0">
														<thead>
															<tr>
																<th>Invoice No</th>
																<th>Doctor</th>
																<th>Amount</th>
																<th>Paid On</th>
																<th></th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td><a href="">#INV-0010</a>
																</td>
																<td>
																	<h2 class="table-avatar"><a href="" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="{{ asset('public/frontend/img/doctors/doctor-thumb-01.jpg') }}" alt="User Image"></a><a href="">Diedra Spangler <span>Dental</span></a></h2>
																</td>
																<td>$450</td>
																<td>16 Sep 2021</td>
																<td class="text-right">
																	<div class="table-action">
																		<a href="" class="btn btn-sm bg-info-light"> <i class="far fa-eye"></i> View</a>
																		<a href="javascript:void(0);" class="btn btn-sm bg-primary-light"><i class="fas fa-print"></i> Print</a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><a href="">#INV-0009</a>
																</td>
																<td>
																	<h2 class="table-avatar"><a href="" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="{{ asset('public/frontend/img/doctors/doctor-thumb-02.jpg') }}" alt="User Image"></a><a href="">Dr. Kalen Chavez <span>Dental</span></a></h2>
																</td>
																<td>$300</td>
																<td>16 Sep 2021</td>
																<td class="text-right">
																	<div class="table-action">
																		<a href="" class="btn btn-sm bg-info-light"><i class="far fa-eye"></i> View</a>
																		<a href="javascript:void(0);" class="btn btn-sm bg-primary-light"><i class="fas fa-print"></i> Print</a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><a href="">#INV-0008</a>
																</td>
																<td>
																	<h2 class="table-avatar"><a href="" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="{{ asset('public/frontend/img/doctors/doctor-thumb-03.jpg') }}" alt="User Image"></a><a href="">Dr. Bedeelia Elliott <span>Cardiology</span></a></h2>
																</td>
																<td>$150</td>
																<td>16 Sep 2021</td>
																<td class="text-right">
																	<div class="table-action">
																		<a href="" class="btn btn-sm bg-info-light"><i class="far fa-eye"></i> View</a>
																		<a href="javascript:void(0);" class="btn btn-sm bg-primary-light"><i class="fas fa-print"></i> Print</a>
																	</div>
																</td>
															</tr>
															<tr>
																<td><a href="">#INV-0007</a>
																</td>
																<td>
																	<h2 class="table-avatar"><a href="" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="{{ asset('public/frontend/img/doctors/doctor-thumb-04.jpg') }}" alt="User Image"></a><a href="">Dr. Alyxandra Foster <span>Urology</span></a></h2>
																</td>
																<td>$50</td>
																<td>16 Sep 2021</td>
																<td class="text-right">
																	<div class="table-action">
																		<a href="" class="btn btn-sm bg-info-light"><i class="far fa-eye"></i> View</a>
																		<a href="javascript:void(0);" class="btn btn-sm bg-primary-light"><i class="fas fa-print"></i> Print</a>
																	</div>
																</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
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
