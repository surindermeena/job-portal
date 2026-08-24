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
                        <div class="padding-left">
                            <div class="profile-title">
                                <h3>Create Job <a href="{{ url()->previous() }}" class="btn btn-primary mx-2 my-2 float-right">Back</a></h3>
                                <div class="profile-form-edit">
                                    <form id="formA15">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <span class="pf-title">Job Title</span>
                                                <div class="pf-field">
                                                    <input type="text" name="job_title"
                                                        placeholder="Enter job title, e.g. Graphic Designer" />
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <span class="pf-title">Description</span>
                                                <div class="pf-field">
                                                    <textarea name="job_description"
                                                        placeholder="Brief description of the job"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <span class="pf-title">Job Type</span>
                                                <div class="pf-field">
                                                    <select name="job_type" style="width: 100%; padding: 10px; border: 2px solid #e8ecec; border-radius: 8px;">
                                                        <option value="">Select Job Type</option>
                                                        <option value="full-time">Full-time</option>
                                                        <option value="part-time">Part-time</option>
                                                        <option value="contract">Contract</option>
                                                        <option value="temporary">Temporary</option>
                                                        <option value="internship">Internship</option>
                                                        <option value="freelance">Freelance</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <span class="pf-title">Job Category</span>
                                                <div class="pf-field">
                                                    <select name="job_category" style="width: 100%; padding: 10px; border: 2px solid #e8ecec; border-radius: 8px;">
                                                        <option value="">Select a Category</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id}}"
                                                                {{-- {{ $job->job_category == $category->id ? 'selected' : '' }} --}}
                                                                >
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <span class="pf-title">Min Salary</span>
                                                <div class="pf-field">
                                                    <input type="number" name="salary_min"
                                                        placeholder="Minimum salary (e.g. 30000)" min="0" />
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <span class="pf-title">Max Salary</span>
                                                <div class="pf-field">
                                                    <input type="number" name="salary_max"
                                                        placeholder="Maximum salary (e.g. 50000)" min="0" />
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <span class="pf-title">Qualification</span>
                                                <div class="pf-field">
                                                    <input type="text" name="qualification0"
                                                        placeholder="Qualification 1, e.g. Bachelor's Degree" />
                                                    <input type="text" name="qualification1"
                                                        placeholder="Qualification 2, e.g. Certification" />
                                                    <input type="text" name="qualification2"
                                                        placeholder="Qualification 3, e.g. Diploma" />
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <span class="pf-title">Skills</span>
                                                <div class="pf-field">
                                                    <input type="text" name="skill0" placeholder="Skill 1, e.g. Photoshop" />
                                                    <input type="text" name="skill1" placeholder="Skill 2, e.g. HTML" />
                                                    <input type="text" name="skill2" placeholder="Skill 3, e.g. Communication" />
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <span class="pf-title">Min Experience ( years )</span>
                                                <div class="pf-field">
                                                    <input type="number" name="min_experience"
                                                        placeholder="Minimum years of experience" min="0" />
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <span class="pf-title">Last Date to Apply</span>
                                                <div class="pf-field">
                                                    <input type="date" name="application_deadline" class="form-control" />
                                                </div>
                                            </div>

                                            {{-- <input type="hidden" name="candidate-id" value="{{$job->company}}"/> --}}

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
		document.getElementById('formA15').addEventListener('submit', async function (e) {
			e.preventDefault();

			const form = e.target;
			const formData = new FormData(form);
			// formData.append('_method', 'PUT');

			try {
				const response = await fetch('{{ route("job.store") }}', {
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
					text: result.message || 'Job created successfully.',
					timer: 2000,
					showConfirmButton: false
				}).then(() => {
					if (result.redirect_url) {
						window.location.href = result.redirect_url;
					}
				});

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