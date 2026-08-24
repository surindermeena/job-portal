@extends('layout.app')

@section('content')

@include('frontside.component.pageTitle', ['title'=>'Welcome '. $user->name])

	<section>
		<div class="block no-padding">
			<div class="container">
				<div class="row no-gape">
					@if(auth()->check())
						@include('layout.sidebar')
					@endif
					<div class="col-lg-9 column">
						<div class="padding-left">
							<div class="profile-title">
								<div style="margin:20px">
									<h3>User Details <a href="{{ url()->previous() }}" class="btn btn-primary mx-2 my-2 float-right">Back</a></h3>
								</div>
							</div>
							<div class="profile-form-edit">
								<form>
									<div class="row">
										<div class="col-lg-6">
											<span class="pf-title">Name</span>
											<div class="pf-field">
												<input type="text" value="{{$user->name}}" disabled />
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Email</span>
											<div class="pf-field">
												<input type="text" value="{{$user->email}}" disabled />
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Phone</span>
											<div class="pf-field">
												<input type="text" value="{{$user->phone}}" disabled />
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Profile</span>
											<div class="pf-field">
												<input type="text" value="{{$user->role}}" disabled />
											</div>
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