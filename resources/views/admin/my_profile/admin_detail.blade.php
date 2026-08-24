@extends('layout.app')

@section('content')

	@include('frontside.component.pageTitle', ['title'=>'Welcome '. $admin->name])

	<section>
		<div class="block no-padding">
			<div class="container">
				<div class="row no-gape">
					@if(auth()->check())
						@include('layout.sidebar')
					@endif
					<div class="col-lg-9 column">
						<div class="row">
							@if (auth()->user())
								<div class="alert alert-danger alert-dismissible fade show mt-3 ml-5" role="alert">
									<strong>Heads up!</strong> Please complete your profile by clicking the <strong>Edit Profile</strong> button.
									<button type="button" class="btn-close mx-1" data-bs-dismiss="alert" aria-label="Close" style="font-size: small">Close</button>
								</div>
							@endif
						</div>
						<div class="padding-left">
							<div class="profile-title">
								<div style="display: flex; justify-content: space-between; margin:20px"> 
									<h3>Administrator Profile</h3>
									<div style="display: flex; justify-content: space-between; gap:20px">
										<button class="btn btn-primary"><a href="{{route('view.changePassword')}}">Change password</a> </button>
										<button class="btn btn-success"><a href="{{route('admin.profie.edit')}}">Edit Profile</a> </button>
									</div>
								</div>
								<div class="upload-img-bar">
										<img style="width: 200px; border-radius: 50%; margin-right: 50px;" src="{{asset('images/resource/' . ($admin->image ?? 'default.jpg')) }}"
											alt="" />
								</div>
							</div>
							<div class="profile-form-edit">
								<form>
									<div class="row">
										<div class="col-lg-6">
											<span class="pf-title">Full Name</span>
											<div class="pf-field">
												<input type="text" value="{{$admin->user->name ?? ''}}" disabled placeholder="Full Name"/>
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Phone</span>
											<div class="pf-field">
												<input type="text" value="{{$admin->user->phone ?? ''}}" disabled placeholder="Phone"/>
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Email</span>
											<div class="pf-field">
												<input type="text" value="{{$admin->user->email ?? ''}}" disabled placeholder="Email"/>
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Address</span>
											<div class="pf-field">
												<input type="text" value="{{$admin->address ?? ''}}" disabled placeholder="Address"/>
											</div>
										</div>

										<div class="col-lg-6">
											<span class="pf-title">City</span>
											<div class="pf-field">
												<input type="text" value="{{$admin->city ?? ''}}" disabled placeholder="City"/>
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">State</span>
											<div class="pf-field">
												<input type="text" value="{{$admin->state ?? ''}}" disabled placeholder="State"/>
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Country</span>
											<div class="pf-field">
												<input type="text" value="{{$admin->country ?? ''}}" disabled placeholder="Country"/>
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Pin</span>
											<div class="pf-field">
												<input type="text" value="{{$admin->pin ?? ''}}"  disabled placeholder="Pin"/>
											</div>
										</div>
										<div class="col-lg-12 d-none" >
											<button type="submit">Update</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection