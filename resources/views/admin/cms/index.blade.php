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
                        <div class="padding-left" style="padding-bottom: 20px;">

                            <div style="margin:20px">
                                <h3>CMS <a href="{{ url()->previous() }}" class="btn btn-primary mx-2 my-2 float-right">Back</a></h3>
                            </div>

                            <div class="padding-left">
                                <div class="profile-title">
                                    <h3>About Content</h3>
                                </div>
                                <div class="profile-form-edit">
                                    <form id="formA3">
                                        @csrf
                                    
                                        <input type="hidden" name="id" value="{{ $aboutData->id }}" />
                                    
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <span class="pf-title"><strong></strong>Title</span>
                                                <div class="pf-field">
                                                    <input type="text" name="title" value="{{ $aboutData->title }}" />
                                                </div>
                                            </div>
                                    
                                            @for ($i = 1; $i <= 4; $i++)
                                                <div class="col-lg-12">
                                                    <span class="pf-title">Content {{ $i }}</span>
                                                    <div class="pf-field">
                                                        <input type="text" name="content_{{ $i }}" value="{{ $aboutData->{'content_' . $i} }}" />
                                                    </div>
                                                </div>
                                            @endfor
                                    
                                            <div class="row m-3">
                                                <span class="pf-title">Services</span>
                                    
                                                @foreach ($aboutData->services as $index => $service)
                                                    <div class="col-lg-4">
                                                        <input type="hidden" name="services[{{ $index }}][id]" value="{{ $service->id }}" />
                                                        <span class="pf-title">Icon</span>
                                                        <input type="text" name="services[{{ $index }}][icon]" value="{{ $service->icon }}" />
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <span class="pf-title">Title</span>
                                                        <input type="text" name="services[{{ $index }}][title]" value="{{ $service->service_title }}" />
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <span class="pf-title">Description</span>
                                                        <input type="text" name="services[{{ $index }}][description]" value="{{ $service->service_description }}" />
                                                    </div>
                                                @endforeach
                                            </div>
                                    
                                            <div class="col-lg-12">
                                                <span class="pf-title">Social Links</span>
                                                @foreach ($aboutData->socialLinks as $index => $social)
                                                    <div class="pf-field">
                                                         <input type="hidden" name="social_links[{{ $index }}][id]" value="{{ $social->id }}" />
                                                        <span class="pf-title"><i class="{{ $social['icon'] }} mx-2"></i>{{ $social->platform }}</span>
                                                        <input type="text" name="social_links[{{ $index }}][url]" value="{{ $social->url }}" />
                                                        <input type="hidden" name="social_links[{{ $index }}][icon]" value="{{ $social->icon }}" />
                                                        <input type="hidden" name="social_links[{{ $index }}][platform]" value="{{ $social->platform }}" />
                                                    </div>
                                                @endforeach
                                            </div>
                                    
                                            <div class="col-lg-12">
                                                <button type="submit">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>


                            <div class="padding-left">
                                <div class="profile-title">
                                    <h3>Edit FAQ's</h3>
                                </div>
                                <div class="profile-form-edit">
                                    <form id="formA4">
                                        @csrf
                                        <div class="row">
                                            @foreach ($faqData as $index => $data)
                                                <input type="hidden" name="faqs[{{ $index }}][id]" value="{{ $data->id }}">
                                    
                                                <div class="col-lg-5">
                                                    <span class="pf-title">Question</span>
                                                    <div class="pf-field">
                                                        <input type="text" name="faqs[{{ $index }}][question]" value="{{ $data->question }}" />
                                                    </div>
                                                </div>
                                    
                                                <div class="col-lg-5">
                                                    <span class="pf-title">Answer</span>
                                                    <div class="pf-field">
                                                        <input type="text" name="faqs[{{ $index }}][answer]" value="{{ $data->answer }}" />
                                                    </div>
                                                </div>
                                    
                                                <div class="col-lg-2">
                                                    <span class="pf-title">Status</span>
                                                    <div class="pf-field">
                                                        <input type="text" name="faqs[{{ $index }}][status]" value="{{ $data->status == 1 ? 1 : 0}}" />
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <button type="submit">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>

                            <div class="padding-left">
                                <div class="profile-title">
                                    <h3>Edit Terms and Conditions</h3>
                                </div>
                                <div class="profile-form-edit">
                                    <form id="formA5">
                                        @csrf
                                        <div class="row">
                                            @foreach ($termsData as $index => $data)
                                                <input type="hidden" name="terms[{{ $index }}][id]" value="{{ $data->id }}">
                                    
                                                <div class="col-lg-5">
                                                    <span class="pf-title">Title</span>
                                                    <div class="pf-field">
                                                        <input type="text" name="terms[{{ $index }}][title]" value="{{ $data->title }}" />
                                                    </div>
                                                </div>
                                    
                                                <div class="col-lg-5">
                                                    <span class="pf-title">Content</span>
                                                    <div class="pf-field">
                                                        <input type="text" name="terms[{{ $index }}][content]" value="{{ $data->content }}" />
                                                    </div>
                                                </div>
                                    
                                                <div class="col-lg-2">
                                                    <span class="pf-title">Status</span>
                                                    <div class="pf-field">
                                                        <input type="text" name="terms[{{ $index }}][status]" value="{{ $data->status }}" />
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    
                                        <div class="row">
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
        </div>
    </section>
@endsection



@push('scripts')
<script>
document.getElementById('formA3').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    try {
        const response = await fetch('{{route("about.update")}}', {
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


@push('scripts')
<script>
document.getElementById('formA4').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    try {
        const response = await fetch('{{route("faqs.update")}}', {
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


@push('scripts')
<script>
document.getElementById('formA5').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    try {
        const response = await fetch('{{route("terms.update")}}', {
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
