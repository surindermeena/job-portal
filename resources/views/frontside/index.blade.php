@extends('layout.app')

@section('content')

    <section>
        <div class="block no-padding">
            <div class="container fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-featured-sec">
                            <ul class="main-slider-sec text-arrows">
                                <li class="slideHome"><img src="images/resource/mslider3.jpg" alt="" /></li>
                                <li class="slideHome"><img src="images/resource/mslider2.jpg" alt="" /></li>
                                <li class="slideHome"><img src="images/resource/mslider1.jpg" alt="" /></li>
                            </ul>
							<div class="job-search-sec">
								<div class="job-search">
									<h4>Explore Thousand Of Jobs With Just Simple Search...</h4>
									<form method="GET" action="{{route('frontside.jobs')}}">
										<div class="row">
											<div class="col-lg-7">
												<div class="job-field">
													<input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Job title or Company name" />
													<i class="la la-keyboard-o"></i>
												</div>
											</div>
											<div class="col-lg-4">
                                                <div class="job-field">
                                                    <select name="location" id="location" class="chosen-city">
                                                        <option value="">Select Location</option>
                                                        @foreach (['Noida', 'Gurgaon', 'Jaipur', 'Bangalore','Pune','Hyderabad'] as $city)
                                                            <option value="{{ $city }}" {{ request('location') == $city ? 'selected' : '' }}>
                                                                {{ $city }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <i class="la la-map-marker"></i>
                                                </div>
											</div>
											<div class="col-lg-1">
												<button type="submit"><i class="la la-search"></i></button>
											</div>
										</div>
									</form>
									
								</div>
							</div>
                            <div class="scroll-to">
                                <a href="#scroll-here" title=""><i class="la la-arrow-down"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="scroll-here">
        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading">
                            <h2>Popular Categories</h2>

                            @php
                               $totalJobs = $category->sum('open_positions');
                            @endphp

                            <span>{{$totalJobs}} jobs live - {{$jobsAddedToday}} added today.</span>
                        </div><!-- Heading -->
                        <div class="cat-sec">
                            <div class="row no-gape">
                                @foreach ($category as $item)
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="p-category">
                                        <a href="{{route('frontside.jobByCat', $item->name)}}" title="">
                                            <i class="{{$item->icon}}"></i>
                                            <span>{{$item->name}}</span>
                                            <p>({{$item->open_positions}} open positions)</p>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="block double-gap-top double-gap-bottom">
            <div data-velocity="-.1"
                style="background: url(images/resource/parallax1.jpg) repeat scroll 50% 422.28px transparent;"
                class="parallax scrolly-invisible layer color"></div><!-- PARALLAX BACKGROUND IMAGE -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="simple-text-block">
                            <h3>Make a Difference with Your Online Resume!</h3>
                            <span>Your resume in minutes with JobHunt resume assistant is ready!</span>
                            <a href="#" title="Create an Account" class="signup-popup">
                                Create an Account
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<section>
    <div class="block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading">
                        <h2>Featured Jobs</h2>
                        <span>Leading Employers already using job and talent.</span>
                    </div><!-- Heading -->

                    <div class="job-listings-sec">
                        @foreach ($jobs as $job)
                            <div class="job-listing" style="display: flex; justify-content: center; align-items: center; column-gap:20px">
                                <div class="job-title-sec" style="display: flex; align-items: center; column-gap:20px">
                                    <div class="c-logo">
                                        <img src="{{ asset('images/resource/' . ($job->company->company_image ?? 'default-logo.png')) }}" alt="" />
                                    </div>
                                    <div>

                                        <h3><a href="{{route('frontside.singleJob', $job->id)}}" title="">{{ $job->job_title }}</a></h3>
                                        <span>{{ $job->company->company_name ?? 'Unknown Company' }}</span>
                                    </div>
                                </div>

                                
<span class="job-lctn"style="margin-right:8px;">    
    @php
        $stars = rand(1, 5); // random number between 1 and 5
    @endphp
    <span class="stars" >
        <span style="display: flex; align-items: center; column-gap:10px">
        <strong>Rating:</strong>
        @for($i = 1; $i <= 5; $i++)
            <span style="font-size:22px; color: red;">
                {{ $i <= $stars ? '★' : '☆' }}
            </span>
        @endfor
        </span>
    </span>
</span>

                                <span class="job-lctn">
                                    <i class="la la-map-marker"></i>
                                    {{ $job->company->city ?? '' }}, {{ $job->company->state ?? '' }}
                                </span>

                                <span class="fav-job"><i class="la la-heart-o"></i></span>

                                {{-- Job Types --}}
                                @foreach($job->types as $type)
                                    @php
                                        $jobTypes = [
                                            'Full-Time'   => 'ft',
                                            'Part-Time'   => 'pt',
                                            'FREELANCE'   => 'fl',
                                            'TEMPORARY'   => 'tp',
                                            'Contract'    => 'ct',
                                            'Internship'  => 'it',
                                            'Remote'      => 'rm',
                                        ];
                                        $typeLabel = $type->type;
                                        $typeClass = $jobTypes[$typeLabel] ?? 'uk'; // fallback
                                    @endphp

                                    <span class="job-is {{ $typeClass }}">{{ strtoupper($typeLabel) }}</span>
                                @endforeach
                            </div><!-- Job -->
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="browse-all-cat">
                        <a href="{{ route('frontside.jobs') }}" title="">View More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


    <section>
        <div class="block">
            <div data-velocity="-.1"
                style="background: url(images/resource/parallax2.jpg) repeat scroll 50% 422.28px transparent;"
                class="parallax scrolly-invisible layer color light">
            </div><!-- PARALLAX BACKGROUND IMAGE -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading light">
                            <h2>Kind Words From Happy Candidates</h2>
                            <span>What other people thought about the service provided by JobHunt</span>
                        </div><!-- Heading -->
                        <div class="reviews-sec" id="reviews-carousel">
							@foreach ($reviews as $item)
								<div class="col-lg-6">
									<div class="reviews">
										<img src="images/resource/{{$item->image}}" alt="" />
										<h3>{{$item->name}} <span>{{$item->job_post}}</span></h3>
										<p>{{$item->description}}</p>
									</div><!-- Reviews -->
								</div>
							@endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading">
                            <h2>Companies We've Helped</h2>
                            <span>Some of the companies we've helped recruit excellent applicants over the years.</span>
                        </div><!-- Heading -->
                        <div class="comp-sec">
                            @for ($i = 1; $i < 6; $i++)
							<div class="company-img">
								<a href="#" title=""><img src="images/resource/cc{{$i}}.jpg" alt="" /></a>
							</div><!-- Client  -->
							@endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="block no-padding">
            <div class="container fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="simple-text">
                            <h3>Gat a question?</h3>
                            <span>We're here to help. Check out our FAQs, send us an email or call us at {{$footerPhone}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection