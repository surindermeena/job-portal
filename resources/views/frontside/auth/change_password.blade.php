@extends('layout.app')

@section('content')

	<section class="overlape">
		<div class="block no-padding">
			<div data-velocity="-.1"
				style="background: url('{{ asset('images/resource/mslider1.jpg') }}') repeat scroll 50% 422.28px transparent;"
				class="parallax scrolly-invisible no-parallax"></div><!-- PARALLAX BACKGROUND IMAGE -->
			<div class="container fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="inner-header">
							<h3>Welcome {{Auth::user()->name}}</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="block no-padding">
			<div class="container">
				<div class="row no-gape">
					@if(auth()->check())
						@include('layout.sidebar')
					@endif
					<div class="col-lg-9 column">
						<div class="padding-left">
							<div class="manage-jobs-sec">
								<h3>Change Password <a href="{{ url()->previous() }}"
										class="btn btn-primary mx-2 my-2 float-right">Back</a></h3>

								<div class="change-password">
									<form action="{{ route('changePasswordSubmit') }}" method="POST">
										@csrf
										<div class="row">
											<div class="col-lg-6">
												<span class="pf-title">Old Password</span>
												<div class="pf-field">
													<input type="password" name="old_password" required
														placeholder="Enter your current password" />
												</div>

												<span class="pf-title">New Password</span>
												<div class="pf-field">
													<input type="password" name="new_password" required
														placeholder="Create a new password" />
												</div>

												<span class="pf-title">Confirm Password</span>
												<div class="pf-field">
													<input type="password" name="new_password_confirmation" required
														placeholder="Confirm your new password" />
												</div>

												<button type="submit" class="mb-4">Update</button>
											</div>
											<div class="col-lg-6">
												<i class="la la-key big-icon"></i>
											</div>
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

@endsection