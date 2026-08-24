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
                <h3>Job Detail Description <a href="{{ url()->previous() }}" class="btn btn-primary mx-2 my-2 float-right">Back</a></h3>
                <div class="profile-form-edit">
                  <form>
                    <div class="row">

                      <div class="col-lg-12">
                        <span class="pf-title">Job Title</span>
                        <div class="pf-field">
                          <input type="text" value="{{$jobData->job_title ?? '' }}" disabled placeholder="Job Title"/>
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <span class="pf-title">Description</span>
                        <div class="pf-field">
                          <input value="{{$jobData->job_description ?? ''}}" disabled placeholder="Job Description"/>
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <span class="pf-title">Email</span>
                        <div class="pf-field">
                          <input type="text" value="{{$jobData->company->hr_email ?? 'N/A' }}" disabled placeholder="HR Email Id"/>
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <span class="pf-title">Min Salary</span>
                        <div class="pf-field">
                          <input type="text" value="{{$jobData->salary_min ?? ''}}" disabled placeholder="Min Salary"/>
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <span class="pf-title">Max Salary</span>
                        <div class="pf-field">
                          <input type="text" value="{{$jobData->salary_max ?? ''}}" disabled placeholder="Max Salary"/>
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <span class="pf-title">Min Experience (years)</span>
                        <div class="pf-field">
                          <input type="text" value="{{$jobData->min_experience ?? ''}}" disabled placeholder="Min Experience In Years"/>
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <span class="pf-title">Skills</span>

                        <div class="pf-field"
                          style="border: 1px solid #ccc; padding: 15px; border-radius: 5px; background-color: #f9f9f9;">
                          @foreach ($jobData->skills as $item)
                            <input type="text" value="{{ $item->skill ?? ''}}" disabled class="form-control mb-2" placeholder="Skills"/>
                          @endforeach
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <span class="pf-title">Qualification</span>
                        <div class="pf-field"
                          style="border: 1px solid #ccc; padding: 15px; border-radius: 5px; background-color: #f9f9f9;">
                          @foreach ($jobData->qualifications as $item)
                            <input placeholder="Qualification" type="text" value="{{$item->qualification}}" disabled class="form-control mb-2" />
                          @endforeach
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <span class="pf-title">Job Type (Categories)</span>
                        <div class="pf-field"
                          style="border: 1px solid #ccc; padding: 15px; border-radius: 5px; background-color: #f9f9f9;">
                          @foreach ($jobData->types as $item)
                            <input type="text" value="{{$item->type ?? ''}}" disabled class="form-control mb-2" placeholder="Job Type"/>
                          @endforeach
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <span class="pf-title">Complete Address</span>
                        <div class="pf-field">
                          <input placeholder="Complete Address" type="text" value="{{$jobData->company->address ?? 'N/A' }}" disabled />
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <span class="pf-title">Application Deadline Date</span>
                        <div class="pf-field">
                          <input placeholder="Last Date to Apply" type="text" value="{{optional($jobData->application_deadline)->format('Y-m-d')}}"
                            disabled />
                        </div>
                      </div>

                    </div>

                    <div class="row d-none">
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