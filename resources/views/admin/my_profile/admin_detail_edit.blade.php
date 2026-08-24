@extends('layout.app')

@section('content')

	@include('frontside.component.pageTitle', ['title' => 'Welcome ' . $admin->name])

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
								<h3>Administrator Profile (Edit Mode) <a href="{{ url()->previous() }}" class="btn btn-primary mx-2 my-2 float-right">Back</a></h3>
								<form id="formA9">
									@csrf

									<div class="upload-img-bar">
										<span class="round">
											<img src="{{asset('images/resource/' . ($admin->image ?? 'default.jpg')) }}" alt="" />
										</span>
										<div class="upload-info">
											<input type="file" placeholder="file" name="file" />
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
												value="{{$admin->user->name ?? ''}}" disabled/>
										</div>
									</div>
									<div class="col-lg-6">
										<span class="pf-title">Phone</span>
										<div class="pf-field">
											<input type="text" name="phone" value="{{$admin->user->phone ?? ''}}" placeholder="Phone" disabled/>
										</div>
									</div>
									<div class="col-lg-6">
										<span class="pf-title">Email</span>
										<div class="pf-field">
											<input type="text" name="email" value="{{$admin->user->email ?? ''}}" placeholder="Email" disabled/>
										</div>
									</div>
									<div class="col-lg-6">
										<span class="pf-title">Address</span>
										<div class="pf-field">
											<input type="text" name="address" value="{{$admin->address ?? ''}}" placeholder="Address"/>
										</div>
									</div>

									<div class="col-lg-6">
										<span class="pf-title">City</span>
										<div class="pf-field">
											<input type="text" name="city" value="{{$admin->city ?? ''}}" placeholder="City"/>
										</div>
									</div>
									<div class="col-lg-6">
										<span class="pf-title">State</span>
										<div class="pf-field">
											<input type="text" name="state" value="{{$admin->state ?? ''}}" placeholder="State"/>
										</div>
									</div>
									<div class="col-lg-6">
										<span class="pf-title">Country</span>
										<div class="pf-field">
											<input type="text" name="country" value="{{$admin->country ?? ''}}" placeholder="Country"/>
										</div>
									</div>
									<div class="col-lg-6">
										<span class="pf-title">Pin</span>
										<div class="pf-field">
											<input type="text" name="pin" value="{{$admin->pin ?? ''}}" placeholder="Pin"/>
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
		document.getElementById('formA9').addEventListener('submit', async function (e) {
			e.preventDefault();

			const form = e.target;
			const formData = new FormData(form);

			// Laravel method spoofing for PUT
			formData.append('_method', 'PUT');

			try {
				const response = await fetch('{{ route("admin.detail.update", $admin->id) }}', {
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