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
									<h3>Create New Company <a href="{{ url()->previous() }}" class="btn btn-primary mx-2 my-2 float-right">Back</a></h3>
								</div>
							</div>
							<div class="profile-form-edit">
                                <form id="formA6">
                                    @csrf
                                    <div class="row">
                                
                                        <div class="col-lg-6">
                                            <span class="pf-title">Company Name</span>
                                            <div class="pf-field">
                                                <input type="text" name="company_name" placeholder="Company Name" value="{{ old('company_name') }}" />
                                            </div>
                                        </div>
                                
                                        <div class="col-lg-6">
                                            <span class="pf-title">Image</span>
                                            <div class="pf-field">
                                                <input type="file" name="image" />
                                            </div>
                                        </div>
                                
                                        <div class="col-lg-6">
                                            <span class="pf-title">Since</span>
                                            <div class="pf-field">
                                                <input type="number" name="since" placeholder="Since" value="{{ old('since') }}" />
                                            </div>
                                        </div>
                                
                                        <div class="col-lg-6">
                                            <span class="pf-title">Team Size</span>
                                            <div class="pf-field">
                                                <input type="number" name="team_size" placeholder="Team Size" value="{{ old('team_size') }}" />
                                            </div>
                                        </div>
                                
                                        <div class="col-lg-12">
                                            <span class="pf-title">Description</span>
                                            <div class="pf-field">
                                                <textarea name="description" placeholder="Description">{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                
                                        <div class="col-lg-6">
                                            <span class="pf-title">Skills</span>
                                            <div class="pf-field">
                                                    <input type="text" name="skill1" value="" placeholder="Skill 1">
                                                    <input type="text" name="skill2" value="" placeholder="Skill 2">
                                                    <input type="text" name="skill3" value="" placeholder="Skill 3">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <span class="pf-title">Social Link</span>
                                            <div class="pf-field">
                                                <input type="text" name="socialLinks1" value="" placeholder="Socia Link 1">
                                                <input type="text" name="socialLinks2" value="" placeholder="Socia Link 2">
                                                <input type="text" name="socialLinks3" value="" placeholder="Socia Link 3">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <span class="pf-title">Category</span>
                                            <div class="pf-field">
                                                <select name="job_category" style="width: 100%; padding: 10px; border: 2px solid #e8ecec; border-radius: 8px;">
                                                    <option value="">Select a Category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id}}">
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                
                                        <div class="col-lg-6">
                                            <span class="pf-title">Phone</span>
                                            <div class="pf-field">
                                                <input type="text" name="mobile" placeholder="Mobile" value="{{ old('mobile') }}" />
                                            </div>
                                        </div>
                                
                                        <div class="col-lg-6">
                                            <span class="pf-title">Email</span>
                                            <div class="pf-field">
                                                <input type="email" name="hr_email" placeholder="HR Email" value="{{ old('hr_email') }}" />
                                            </div>
                                        </div>
                                
                                        <div class="col-lg-6">
                                            <span class="pf-title">Website</span>
                                            <div class="pf-field">
                                                <input type="url" name="website" placeholder="Website Url" value="{{ old('website') }}" />
                                            </div>
                                        </div>
                                
                                        <div class="col-lg-6">
                                            <span class="pf-title">Address</span>
                                            <div class="pf-field">
                                                <input type="text" name="address" placeholder="Address" value="{{ old('address') }}" />
                                            </div>
                                        </div>
                                
                                        <div class="col-lg-6">
                                            <span class="pf-title">City</span>
                                            <div class="pf-field">
                                                <input type="text" name="city" placeholder="City" value="{{ old('city') }}" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <span class="pf-title">State</span>
                                            <div class="pf-field">
                                                <input type="text" name="state" placeholder="State" value="{{ old('state') }}" />
                                            </div>
                                        </div>
                                
                                        <div class="col-lg-6">
                                            <span class="pf-title">Country</span>
                                            <div class="pf-field">
                                                <input type="text" name="country" placeholder="Country" value="{{ old('country') }}" />
                                            </div>
                                        </div>
                                
                                        <div class="col-lg-6">
                                            <span class="pf-title">Pin</span>
                                            <div class="pf-field">
                                                <input type="text" name="pin" placeholder="Pin" value="{{ old('pin') }}" />
                                            </div>
                                        </div>
                                
                                        <div class="col-lg-12">
                                            <button type="submit">Submit</button>
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
document.getElementById('formA6').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    try {
        const response = await fetch('{{ route("Company.create.store") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json' // Ensures Laravel sends JSON on validation error
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
            // Collect and display validation errors
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

        // Success message
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: result.message,
            timer: 2000,
            showConfirmButton: false
        });

        form.reset();

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