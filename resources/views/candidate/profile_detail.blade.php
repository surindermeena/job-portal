@extends('layout.app')

@section('content')

	@include('frontside.component.pageTitle', ['title' => 'Welcome ' . $candidate->name])

	<section>
		<div class="block no-padding">
			<div class="container">
				<div class="row no-gape">
					@if(auth()->check())
						@include('layout.sidebar')
					@endif
					<div class="col-lg-9 column">
						<div class="row">
							{{-- @if (auth()->user()->candidate->job_title == "")
							<div class="alert alert-danger alert-dismissible fade show mt-3 ml-5" role="alert">
								<strong>Heads up!</strong> Please complete your profile by clicking the <strong>Edit
									Profile</strong> button.
								<button type="button" class="btn-close mx-1" data-bs-dismiss="alert" aria-label="Close"
									style="font-size: small">Close</button>
							</div>
							@endif --}}
							@if (isset(auth()->user()->candidate) && auth()->user()->candidate->job_title == "")
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
									<h3>Candidate Profile</h3>
									<button class="btn btn-secondary"><a href="{{route('candidate.edit')}}">Edit Profile</a>
									</button>
								</div>
								<div class="upload-img-bar">
									<img style="width: 200px; border-radius: 50%; margin-right: 50px;"
										src="{{asset('images/resource/' . ($candidate->image ?? 'default.jpg')) }}"
										alt="" />
								</div>
							</div>
							<div class="profile-form-edit">
								<form>
									<div class="row">
										<div class="col-lg-6">
											<span class="pf-title">Full Name</span>
											<div class="pf-field">
												<input type="text" value="{{$candidate->user->name ?? ''}}"
													placeholder="Full Name" disabled />
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Job Title</span>
											<div class="pf-field">
												<input type="text" value="{{$candidate->job_title ?? ''}}"
													placeholder="Job Title" disabled />
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Categories</span>
											<div class="pf-field">
												<input type="text" value="{{$candidate->category->name ?? ''}}"
													placeholder="Categories" disabled />
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Minimum Salary</span>
											<div class="pf-field">
												<input type="text" value="{{$candidate->min_salary ?? ''}}"
													placeholder="Minimum Salary" disabled />
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Experience</span>
											<div class="pf-field">
												<input type="text" value="{{$candidate->experience ?? ''}}"
													placeholder="Experience" disabled />
											</div>
										</div>
										<div class="col-lg-12">
											<span class="pf-title">Description</span>
											<div class="pf-field">
												<textarea disabled
													placeholder="Description">{{$candidate->description ?? ''}}</textarea>
											</div>
										</div>

										<div class="col-lg-6">
											<span class="pf-title">Skills</span>
											<div class="pf-field">
												@php
													$skills = $candidate->skills->pluck('name')->take(3);
												@endphp

												@for ($i = 0; $i < 3; $i++)
													<input type="text" value="{{ $skills[$i] ?? '' }}"
														placeholder="{{ $skills[$i] ? '' : 'No skills added yet' }}" disabled>
												@endfor
											</div>
										</div>

										<div class="col-lg-6">
											<span class="pf-title">Languages</span>
											<div class="pf-field">
												@php
													$languages = $candidate->languages->take(3);
												@endphp

												@for ($i = 0; $i < 3; $i++)
													@php
														$language = $languages[$i]->language ?? '';
														$level = $languages[$i]->level ?? '';
														$value = trim("{$language} | {$level}", " |");
													@endphp
													<input type="text" value="{{ $value }}" placeholder="No language added yet"
														disabled />
												@endfor
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Education Levels</span>
											<div class="pf-field">
												@php
													$education = $candidate->education->take(3);
												@endphp

												@for ($i = 0; $i < 3; $i++)
													@php
														$degree = $education[$i]->degree ?? '';
														$institute = $education[$i]->institute ?? '';
														$year = $education[$i]->year ?? '';
														$value = trim("{$degree} | {$institute} | {$year}", " |");
													@endphp

													<input type="text" value="{{ $value }}" placeholder="No education added yet"
														disabled />
												@endfor
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Phone</span>
											<div class="pf-field">
												<input type="text" value="{{$candidate->user->phone ?? ''}}" disabled
													placeholder="Phone" />
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Email</span>
											<div class="pf-field">
												<input type="text" value="{{$candidate->user->email ?? ''}}" disabled
													placeholder="Email" />
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Address</span>
											<div class="pf-field">
												<input type="text" value="{{$candidate->address ?? ''}}" disabled
													placeholder="Address" />
											</div>
										</div>

										<div class="col-lg-6">
											<span class="pf-title">City</span>
											<div class="pf-field">
												<input type="text" value="{{$candidate->city ?? ''}}" disabled
													placeholder="City" />
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">State</span>
											<div class="pf-field">
												<input type="text" value="{{$candidate->state ?? ''}}" disabled
													placeholder="State" />
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Country</span>
											<div class="pf-field">
												<input type="text" value="{{$candidate->country ?? ''}}" disabled
													placeholder="Country" />
											</div>
										</div>
										<div class="col-lg-6">
											<span class="pf-title">Pin</span>
											<div class="pf-field">
												<input type="text" value="{{$candidate->pin ?? ''}}" disabled
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