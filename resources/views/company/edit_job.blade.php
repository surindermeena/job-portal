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
                                <h3>Edit Job <a href="{{ url()->previous() }}" class="btn btn-primary mx-2 my-2 float-right">Back</a></h3>
                                <div class="profile-form-edit">

                                    <form id="formA16">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <span class="pf-title">Job Title</span>
                                                <div class="pf-field">
                                                    <input type="text" name="job_title" value="{{ $jobData->job_title }}"
                                                        placeholder="Enter job title" />
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <span class="pf-title">Description</span>
                                                <div class="pf-field">
                                                    <textarea name="job_description"
                                                        placeholder="Brief job description">{{ $jobData->job_description }}</textarea>
                                                </div>
                                            </div>

                                            {{-- Job Types --}}
                                            @php
                                                $selectedTypes = $jobData->types->pluck('type')->toArray();
                                            @endphp

                                            <div class="col-lg-6">
                                                <span class="pf-title">Job Type</span>
                                                <div class="pf-field">
                                                    <select name="job_type"
                                                        style="width: 100%; padding: 10px; border: 2px solid #e8ecec; border-radius: 8px;">
                                                        @foreach(['full-time', 'part-time', 'contract', 'temporary', 'internship', 'freelance'] as $type)
                                                            <option value="{{ $type }}" {{ in_array($type, $selectedTypes) ? 'selected' : '' }}>
                                                                {{ ucfirst($type) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            {{-- Job Category --}}
                                            <div class="col-lg-6">
                                                <span class="pf-title">Job Category</span>
                                                <div class="pf-field">
                                                    <select name="job_category"
                                                        style="width: 100%; padding: 10px; border: 2px solid #e8ecec; border-radius: 8px;">
                                                        <option value="">Select a Category</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}" {{ $jobData->job_category == $category->id ? 'selected' : '' }}>
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
                                                        value="{{ $jobData->salary_min }}" min="0" />
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <span class="pf-title">Max Salary</span>
                                                <div class="pf-field">
                                                    <input type="number" name="salary_max"
                                                        value="{{ $jobData->salary_max }}" min="0" />
                                                </div>
                                            </div>

                                            {{-- Qualifications --}}
                                            <div class="col-lg-6">
                                                <span class="pf-title">Qualification</span>
                                                <div class="pf-field">
                                                    @foreach ($jobData->qualifications as $i => $qualification)
                                                        <input type="text" name="qualification{{ $i }}"
                                                            value="{{ $qualification->qualification }}"
                                                            placeholder="Qualification {{ $i + 1 }}" />
                                                    @endforeach
                                                </div>
                                            </div>

                                            {{-- Skills --}}
                                            <div class="col-lg-6">
                                                <span class="pf-title">Skills</span>
                                                <div class="pf-field">
                                                    @foreach ($jobData->skills as $i => $skill)
                                                        <input type="text" name="skill{{ $i }}" value="{{ $skill->skill }}"
                                                            placeholder="Skill {{ $i + 1 }}" />
                                                    @endforeach
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <span class="pf-title">Min Experience (years)</span>
                                                <div class="pf-field">
                                                    <input type="number" name="min_experience"
                                                        value="{{ $jobData->min_experience }}" min="0" />
                                                </div>
                                            </div>



                                            {{-- Deadline --}}
                                            <div class="col-lg-6">
                                                <span class="pf-title">Application Deadline Date</span>
                                                <div class="pf-field">
                                                    <input type="date" name="application_deadline" class="form-control"
                                                        value="{{ optional($jobData->application_deadline)->format('Y-m-d') }}" />
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
        document.getElementById('formA16').addEventListener('submit', async function (e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);

            formData.append('_method', 'PUT');

            try {
                const response = await fetch('{{ route("job.update", $jobData->id) }}', {
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