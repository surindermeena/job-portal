@extends('layout.app')

@section('content')

	@include('frontside.component.pageTitle', ['title'=>'Welcome '. Auth::user()->name])
	
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
									<h3>Edit Company Profile (Edit Mode) <a href="{{ url()->previous() }}" class="btn btn-primary mx-2 my-2 float-right">Back</a></h3>
								</div>
								<form id="formA17">
									@csrf
									<div class="upload-img-bar">
										<img style="width: 150px; border-radius: 50%; margin-right: 50px;" src="{{asset('images/resource/' . ($company->company_image ?? 'default.jpg')) }}" alt="company Image" />
										<input id="customLabelName" type="file" name="image" />
									</div>
								
									<div class="profile-form-edit">
										<div class="row">
											<div class="col-lg-6">
												<span class="pf-title">User Name</span>
												<div class="pf-field">
													<input type="text" name="user_name" value="{{ $company->user->name ?? ''}}" disabled placeholder="User Name"/>
												</div>
											</div>

											<div class="col-lg-6">
												<span class="pf-title">Company Name</span>
												<div class="pf-field">
													<input type="text" name="company_name" value="{{ $company->company_name ?? ''}}" placeholder="Company Name"/>
												</div>
											</div>
								
											<div class="col-lg-6">
												<span class="pf-title">Since</span>
												<div class="pf-field">
													<input type="text" name="since" value="{{ $company->since ?? ''}}" placeholder="Year"/>
												</div>
											</div>

											<div class="col-lg-6">
												<span class="pf-title">Team Size</span>
												<div class="pf-field">
													<input type="text" name="team_size" value="{{$company->team_size ?? ''}}" placeholder="Team Size"/>
												</div>
											</div>
								
											<div class="col-lg-12">
												<span class="pf-title">Description</span>
												<div class="pf-field">
													<textarea name="description" placeholder="Company Description">{{ $company->description ?? ''}}</textarea>
												</div>
											</div>
							
											<div class="col-lg-6">
												<span class="pf-title">Skills</span>
												<div class="pf-field">

													@php
    $skills = $company->skills->pluck('skill')->take(3);
@endphp

@for ($i = 0; $i < 3; $i++)
    <input type="text" 
           name="skill{{ $i + 1 }}" 
           value="{{ $skills[$i] ?? '' }}" 
           placeholder="Skill {{ $i + 1 }}">
@endfor
												</div>
											</div>
								
											<div class="col-lg-6">
												<span class="pf-title">Social Link</span>
												<div class="pf-field">

												@php
    $socialLinks = $company->socialLinks->pluck('url')->take(3);
@endphp

@for ($i = 0; $i < 3; $i++)
    <input type="text" 
           name="socialLinks{{ $i + 1 }}" 
           value="{{ $socialLinks[$i] ?? '' }}" 
           placeholder="Social Link {{ $i + 1 }}">
@endfor
												</div>
											</div>
								
											<div class="col-lg-6">
												<span class="pf-title">Categories</span>
												<div class="pf-field">
													<select name="category_id[]" multiple style="width: 100%; padding: 10px; border: 2px solid #e8ecec; border-radius: 8px;">
														@foreach($categories101 as $category101)
															<option value="{{ $category101->id }}"
																{{ $company->categories->contains('id', $category101->id) ? 'selected' : '' }}>
																{{ $category101->name }}
															</option>
														@endforeach
													</select>
												</div>
											</div>
								
											<div class="col-lg-6">
												<span class="pf-title">Phone</span>
												<div class="pf-field">
													<input type="text" name="phone" value="{{ $company->user->phone ?? ''}}" placeholder="Phone"/>
												</div>
											</div>
								
											<div class="col-lg-6">
												<span class="pf-title">Email</span>
												<div class="pf-field">
													<input type="text" name="email" value="{{ $company->user->email ?? ''}}" disabled placeholder="Email Id"/>
												</div>
											</div>

											<div class="col-lg-6">
												<span class="pf-title">HR Email</span>
												<div class="pf-field">
													<input type="text" name="hr_email" value="{{$company->hr_email ?? ''}}" placeholder="HR Email id"/>
												</div>
											</div>
								
											<div class="col-lg-6">
												<span class="pf-title">Website</span>
												<div class="pf-field">
													<input type="text" name="website" value="{{ $company->website ?? ''}}" placeholder="Website"/>
												</div>
											</div>
								
											<div class="col-lg-6">
												<span class="pf-title">Address</span>
												<div class="pf-field">
													<input type="text" name="address" value="{{ $company->address ?? ''}}" placeholder="Address"/>
												</div>
											</div>
								
											<div class="col-lg-6">
												<span class="pf-title">City</span>
												<div class="pf-field">
													<input type="text" name="city" value="{{ $company->city ?? ''}}" placeholder="City"/>
												</div>
											</div>

											<div class="col-lg-6">
												<span class="pf-title">State</span>
												<div class="pf-field">
													<input type="text" name="state" value="{{ $company->state ?? ''}}" placeholder="State"/>
												</div>
											</div>
								
											<div class="col-lg-6">
												<span class="pf-title">Country</span>
												<div class="pf-field">
													<input type="text" name="country" value="{{ $company->country ?? ''}}" placeholder="Country"/>
												</div>
											</div>
								
											<div class="col-lg-6">
												<span class="pf-title">Pin</span>
												<div class="pf-field">
													<input type="text" name="pin" value="{{ $company->pin ?? ''}}" placeholder="Pin"/>
												</div>
											</div>
								
											<div class="col-lg-12 mb-4">
												<button type="submit">Update</button>
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




@push('scripts')
	<script>
		document.getElementById('formA17').addEventListener('submit', async function (e) {
			e.preventDefault();

			const form = e.target;
			const formData = new FormData(form);

			formData.append('_method', 'PUT');

			try {
				const response = await fetch('{{ route("company.update", $company->id) }}', {
					method: 'POST', 
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

