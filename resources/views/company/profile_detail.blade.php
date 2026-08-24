@extends('layout.app')

@section('content')

	@include('frontside.component.pageTitle', ['title' => 'Welcome ' . Auth::user()->name])

	<section>
		<div class="block no-padding">
			<div class="container">
				<div class="row no-gape">
					@if(auth()->check())
						@include('layout.sidebar')
					@endif
					<div class="col-lg-9 column">
						<div class="row">
							@if (auth()->user()->company->company_name == "")
								<div class="alert alert-danger alert-dismissible fade show mt-3 ml-5" role="alert">
									<strong>Heads up!</strong> Please complete your profile by clicking the <strong>Edit
										Profile</strong> button.
									<button type="button" class="btn-close mx-1" data-bs-dismiss="alert" aria-label="Close"
										style="font-size: small">Close</button>
								</div>
							@endif
						</div>
						<div class="padding-left">
							<div class="profile-title">
								<div style="display: flex; justify-content: space-between; margin:20px">
									<h3>Company Profile</h3>
									<button class="btn btn-secondary"><a href="{{route('company.edit')}}">Edit Profile</a>
									</button>
								</div>
								<div class="upload-img-bar">
									<img style="width: 200px; border-radius: 50%; margin-right: 50px;"
										src="{{asset('images/resource/' . ($company->company_image ?? 'default.jpg')) }}"
										alt="" />
								</div>
							</div>
							<div class="profile-form-edit">
								<form>
									<div class="row">
										<div class="col-lg-6">
											<span class="pf-title">User Name</span>
											<div class="pf-field">
												<input type="text" value="{{$company->user->name ?? ''}}" disabled
													placeholder="User Name" />
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Company Name</span>
											<div class="pf-field">
												<input type="text" value="{{$company->company_name ?? ''}}" disabled
													placeholder="Company Name" />
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Since</span>
											<div class="pf-field">
												<input type="text" value="{{$company->since ?? ''}}" disabled
													placeholder="Year" />
											</div>
										</div>

										<div class="col-lg-6">
											<span class="pf-title">Team Size</span>
											<div class="pf-field">
												<input type="text" value="{{$company->team_size ?? ''}}" disabled
													placeholder="Team Size" />
											</div>
										</div>

										<div class="col-lg-12">
											<span class="pf-title">Description</span>
											<div class="pf-field">
												<textarea disabled name="description"
													placeholder="Company Description">{{$company->description ?? ''}}</textarea>
											</div>
										</div>


										<div class="col-lg-6">
											<span class="pf-title">Skills</span>
											<div class="pf-field">

												@php
													$skills = $company->skills->pluck('skill')->take(3); // Get up to 3 skills
												@endphp

												@for ($i = 0; $i < 3; $i++)
													<input type="text" value="{{ $skills[$i] ?? '' }}"
														placeholder="{{ $skills[$i] ?? 'No skill added' }}" disabled>
												@endfor
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Social Link</span>
											<div class="pf-field">

												@php
													$socialLinks = $company->socialLinks->pluck('url')->take(3); // Get up to 3 URLs
												@endphp

												@for ($i = 0; $i < 3; $i++)
													<input type="text" value="{{ $socialLinks[$i] ?? '' }}"
														placeholder="{{ $socialLinks[$i] ?? 'No Social Link ' . ($i + 1) }}"
														disabled>
												@endfor
											</div>
										</div>

										<div class="col-lg-6">
											<span class="pf-title">Category</span>
											<div class="pf-field">
												<input type="text"
													value="{{ $company->categories->pluck('name')->implode(', ') }}"
													placeholder="Category" disabled />
											</div>
										</div>

										<div class="col-lg-6">
											<span class="pf-title">Phone</span>
											<div class="pf-field">
												<input type="text" value="{{$company->user->phone ?? ''}}" disabled
													placeholder="Phone" />
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Email</span>
											<div class="pf-field">
												<input type="text" value="{{$company->user->email ?? ''}}" disabled
													placeholder="Email id" />
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">HR Email</span>
											<div class="pf-field">
												<input type="text" value="{{$company->hr_email ?? ''}}" disabled
													placeholder="HR Email id" />
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Website</span>
											<div class="pf-field">
												<input type="text" value="{{$company->website ?? ''}}" disabled
													placeholder="Website" />
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Address</span>
											<div class="pf-field">
												<input type="text" value="{{$company->address ?? ''}}" disabled
													placeholder="Address" />
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">City</span>
											<div class="pf-field">
												<input type="text" value="{{$company->city ?? ''}}" disabled
													placeholder="City" />
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">State</span>
											<div class="pf-field">
												<input type="text" value="{{$company->state ?? ''}}" disabled
													placeholder="State" />
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Country</span>
											<div class="pf-field">
												<input type="text" value="{{$company->country ?? ''}}" disabled
													placeholder="Country" />
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Pin</span>
											<div class="pf-field">
												<input type="text" value="{{$company->pin ?? ''}}" disabled
													placeholder="Pin" />
											</div>
										</div>
										<div class="col-lg-12 d-none">
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