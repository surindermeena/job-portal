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
									<h3>Edit Testimonial <a href="{{ url()->previous() }}" class="btn btn-primary mx-2 my-2 float-right">Back</a></h3>
								</div>
							</div>
							<div class="profile-form-edit">
                                <form id="formA12">
                                    @csrf
                                    <div class="row">
                                
                                        <div class="col-lg-6">
                                            <span class="pf-title">Name</span>
                                            <div class="pf-field">
                                                <input type="text" name="name" placeholder="Name" value="{{$data->name}}" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <span class="pf-title">Job Post</span>
                                            <div class="pf-field">
                                                <input type="text" name="job_post" placeholder="Job Profile" value="{{$data->job_post}}" />
                                            </div>
                                        </div>
                                
                                        <div class="col-lg-6">
                                            <span class="pf-title">Image</span>
                                            <div class="pf-field">
                                                <input type="file" name="image" value="{{$data->image}}" />
                                            </div>
                                        </div>
                                
                                        <div class="col-lg-12">
                                            <span class="pf-title">Description</span>
                                            <div class="pf-field">
                                                <textarea name="description" placeholder="Description">{{$data->description}}</textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
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



@push('scripts')
<script>
document.getElementById('formA12').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    // Laravel method spoofing for PUT
    formData.append('_method', 'PUT');

    try {
        const response = await fetch('{{ route("admin.testimonial.update", $data->id) }}', {
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