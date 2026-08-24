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
						<div class="padding-left">
							<div class="profile-title">

								<h3>Edit Candidate Profile <a href="{{ url()->previous() }}" class="btn btn-primary mx-2 my-2 float-right">Back</a></h3>
								<form id="formA13">
									@csrf

									<div class="upload-img-bar">
										<span class="round">
											<img src="{{asset('images/resource/' . ($candidate->image ?? 'default.jpg')) }}"
												alt="" />
										</span>
										<div class="upload-info">
											<input type="file" placeholder="Select File" name="file" />
											<span>Max file size is 1MB, Minimum dimension: 270x210 And Suitable files are
												.jpg & .png</span>
										</div>
									</div>
							</div>
							<div class="profile-form-edit">
								<div class="row">
									<div class="col-lg-6">
										<span class="pf-title">Full Name</span>
										<div class="pf-field">
											<input type="text" placeholder="Full Name" name="name"
												value="{{$candidate->user->name ?? ''}}" placeholder="Full Name" disabled/>
										</div>
									</div>
									<div class="col-lg-6">
										<span class="pf-title">Job Title</span>
										<div class="pf-field">
											<input type="text" placeholder="Job Title" name="job_title"
												value="{{$candidate->job_title ?? ''}}" placeholder="Job Title" />
										</div>
									</div>
									<div class="col-lg-6">
										<span class="pf-title">Categories</span>
										<div class="pf-field">
											<select name="category_id" style="width: 100%; padding: 10px; border: 2px solid #e8ecec; border-radius: 8px;">
												<option value="">Select a Category</option>
												@foreach($categories as $category)
													<option value="{{ $category->id }}"
														{{ $candidate->category_id == $category->id ? 'selected' : '' }}>
														{{ $category->name }}
													</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-lg-6">
										<span class="pf-title">Minimum Salary</span>
										<div class="pf-field">
											<input type="text" name="min_salary" value="{{$candidate->min_salary ?? ''}}"
												placeholder="Minimum Salary" />
										</div>
									</div>
									<div class="col-lg-6">
										<span class="pf-title">Experience</span>
										<div class="pf-field">
											<input type="text" name="experience" value="{{$candidate->experience ?? ''}}"
												placeholder="Experience" />
										</div>
									</div>
									<div class="col-lg-12">
										<span class="pf-title">Description</span>
										<div class="pf-field">
											<textarea name="description" placeholder="Description">{{$candidate->description ?? ''}}</textarea>
										</div>
									</div>
									<div class="col-lg-6">
										<span class="pf-title">Skills</span>
										<div class="pf-field">
											@php
											$skills = $candidate->skills->pluck('name')->take(3);
										@endphp
										
										@for ($i = 0; $i < 3; $i++)
											<input type="text" 
												   name="skill{{ $i + 1 }}" 
												   value="{{ $skills[$i] ?? '' }}" 
												   placeholder="Skill {{ $i + 1 }}">
										@endfor
										</div>
									</div>
									
									<div class="col-lg-12">
										<span class="pf-title">Languages</span>
										<div class="pf-field">
											<div class="row">
												@if($candidate->languages->isNotEmpty())
												@foreach($candidate->languages as $item)
													<div class="col-lg-6">
														<input type="text" name="language{{$loop->iteration}}" value="{{ $item->language }}" />
														<label for="level{{$loop->iteration}}">Choose Level:</label>
														<select name="level{{$loop->iteration}}" id="level{{$loop->iteration}}">
															<option value="basic" {{ $item->level == 'basic' ? 'selected' : '' }}>Basic</option>
															<option value="intermediate" {{ $item->level == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
															<option value="advanced" {{ $item->level == 'advanced' ? 'selected' : '' }}>Advanced</option>
															<option value="native" {{ $item->level == 'native' ? 'selected' : '' }}>Native</option>
														</select>
													</div>
												@endforeach
											@else
												@for($i = 1; $i <= 2; $i++)
													<div class="col-lg-6">
														<input type="text" name="language{{$i}}" value="" placeholder="Language" />
														<label for="level{{$i}}">Choose Level:</label>
														<select name="level{{$i}}" id="level{{$i}}">
															<option value="basic">Basic</option>
															<option value="intermediate">Intermediate</option>
															<option value="advanced">Advanced</option>
															<option value="native">Native</option>
														</select>
													</div>
												@endfor
											@endif
											
											</div>
										</div>
									</div>
									<hr>
									<div class="col-lg-12">
										<span class="pf-title">Education Levels</span>
										<div class="pf-field">
											<div class="row">
												@if($candidate->education->isNotEmpty())
												@foreach($candidate->education as $item)
													<div class="col-lg-4">
														<input type="text" placeholder="Degree" name="educationD{{$loop->iteration}}" value="{{ $item->degree }}" />
													</div>
													<div class="col-lg-4">
														<input type="text" placeholder="College" name="educationC{{$loop->iteration}}" value="{{ $item->institute }}" />
													</div>
													<div class="col-lg-4">
														<input type="text" placeholder="Year" name="educationY{{$loop->iteration}}" value="{{ $item->year }}" />
													</div>
												@endforeach
											@else
												@for($i = 1; $i <= 3; $i++)
													<div class="col-lg-4">
														<input type="text" placeholder="Degree" name="educationD{{$i}}" value="" />
													</div>
													<div class="col-lg-4">
														<input type="text" placeholder="College" name="educationC{{$i}}" value="" />
													</div>
													<div class="col-lg-4">
														<input type="text" placeholder="Year" name="educationY{{$i}}" value="" />
													</div>
												@endfor
											@endif
											
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<span class="pf-title">Phone</span>
										<div class="pf-field">
											<input type="text" name="phone" value="{{$candidate->user->phone ?? ''}}"
												placeholder="Phone" />
										</div>
									</div>
									<div class="col-lg-6">
										<span class="pf-title">Email</span>
										<div class="pf-field">
											<input type="text" name="email" value="{{$candidate->user->email}}"
												placeholder="Email" disabled/>
										</div>
									</div>
									<div class="col-lg-6">
										<span class="pf-title">Address</span>
										<div class="pf-field">
											<input type="text" name="address" value="{{$candidate->address ?? ''}}"
												placeholder="Address" />
										</div>
									</div>

									<div class="col-lg-6">
										<span class="pf-title">City</span>
										<div class="pf-field">
											<input type="text" name="city" value="{{$candidate->city ?? ''}}"
												placeholder="City" />
										</div>
									</div>

									<div class="col-lg-6">
										<span class="pf-title">State</span>
										<div class="pf-field">
											<input type="text" name="state" value="{{$candidate->state ?? ''}}"
												placeholder="State" />
										</div>
									</div>


									<div class="col-lg-6">
										<span class="pf-title">Country</span>
										<div class="pf-field">
											<input type="text" name="country" value="{{$candidate->country ?? ''}}"
												placeholder="Country" />
										</div>
									</div>
									<div class="col-lg-6">
										<span class="pf-title">Pin</span>
										<div class="pf-field">
											<input type="text" name="pin" value="{{$candidate->pin ?? ''}}"
												placeholder="Pin" />
										</div>
									</div>
									<div class="col-lg-12">
										<button type="submit" class="mb-4">Update</button>
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




@push('scripts')
	<script>
		document.getElementById('formA13').addEventListener('submit', async function (e) {
			e.preventDefault();

			const form = e.target;
			const formData = new FormData(form);

			// Laravel method spoofing for PUT
			formData.append('_method', 'PUT');

			try {
				const response = await fetch('{{ route("candidate.update", $candidate->id) }}', {
					method: 'POST', // Laravel will treat this as PUT because of _method
					headers: {
						'X-CSRF-TOKEN': '{{ csrf_token() }}',
						'Accept': 'application/json' // Ensures JSON validation errors
					},
					body: formData
				});

				let result;
				try {
					result = await response.json();
				} catch {
					throw new Error('Server did not return valid JSON.');
				}

				if (!response.ok) {
					// Build list of validation errors
					let errorList = '';
					for (const error of Object.values(result.errors || {})) {
						errorList += `<li>${error}</li>`;
					}

					Swal.fire({
						icon: 'error',
						title: 'Validation Error',
						html: `<ul style="text-align:left;">${errorList}</ul>`,
					});

					return;
				}

				// Success notification
				Swal.fire({
					icon: 'success',
					title: 'Success',
					text: result.message || 'Updated successfully.',
					timer: 2000,
					showConfirmButton: false
				}).then(() => {
					if (result.redirect_url) {
						window.location.href = result.redirect_url;
					}
				});

				// Optional: refresh UI or reset form
				// form.reset();

			} catch (error) {
				Swal.fire({
					icon: 'error',
					title: 'Oops!',
					text: 'Something went wrong.',
				});
				console.error(error);
			}
		});
	</script>
@endpush