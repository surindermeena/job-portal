@extends('layout.app')

@section('content')

	<section class="overlape">
		<div class="block no-padding">
			<div data-velocity="-.1"
				style="background: url(images/resource/mslider1.jpg) repeat scroll 50% 422.28px transparent;"
				class="parallax scrolly-invisible no-parallax"></div><!-- PARALLAX BACKGROUND IMAGE -->
			<div class="container fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="inner-header wform">
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
						{{-- <span class="emlthis">
							<a href="mailto:example.com" title=""><i class="la la-envelope-o"></i> Email me Jobs Like These</a>
						</span> --}}
					
						<form method="GET" id="filterForm">
							<div class="filterbar">
								<h5>{{ $data->total() }} Jobs & Vacancies</h5>
					
								<div class="sortby-sec">
									<span>Sort by</span>
					
									<select name="sort" onchange="document.getElementById('filterForm').submit()" class="chosen">
										<option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Most Recent</option>
										<option value="job_title" {{ request('sort') == 'job_title' ? 'selected' : '' }}>Job Title</option>
										<option value="company_name" {{ request('sort') == 'company_name' ? 'selected' : '' }}>Company</option>
									</select>
					
									<select name="per_page" onchange="document.getElementById('filterForm').submit()" class="chosen">
										<option value="6" {{ request('per_page') == 6 ? 'selected' : '' }}>6 Per Page</option>
										<option value="9" {{ request('per_page') == 9 ? 'selected' : '' }}>9 Per Page</option>
										<option value="12" {{ request('per_page') == 12 ? 'selected' : '' }}>12 Per Page</option>
										<option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15 Per Page</option>
									</select>
								</div>
							</div>
						</form>
					
						<div class="job-grid-sec">
							<div class="row">
								@foreach ($data as $single)
									<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
										<div class="job-grid border">
											<div class="job-title-sec">
												<div class="c-logo">
													<img src="{{ asset('images/resource/' . optional($single->company)->company_image ?? 'default.jpg') }}" width="235" height="115" alt="" />
												</div>
												<h3>{{ $single->job_title }}</h3>
												<span>{{ optional($single->company)->company_name }}</span>
												<span class="fav-job"><i class="la la-heart-o"></i></span>
											</div>					
											<span class="job-lctn">{{ optional($single->company)->city}}, {{ optional($single->company)->state}} </span>
											<a href="{{route('frontside.singleJob', $single->id)}}" title="">View Details</a>
										</div>
									</div>
								@endforeach
							</div>
						</div>
					
						{{-- Laravel Pagination --}}
						<div class="pagination">
							<ul>
								{{-- Previous Page Link --}}
								@if ($data->onFirstPage())
									<li class="prev disabled">
										<span><i class="la la-long-arrow-left"></i> Prev</span>
									</li>
								@else
									<li class="prev">
										<a href="{{ $data->previousPageUrl() }}&{{ http_build_query(request()->except('page')) }}">
											<i class="la la-long-arrow-left"></i> Prev
										</a>
									</li>
								@endif
						
								{{-- Pagination Elements --}}
								@php
									$currentPage = $data->currentPage();
									$lastPage = $data->lastPage();
									$start = max(1, $currentPage - 1);
									$end = min($lastPage, $currentPage + 1);
								@endphp
						
								@if ($start > 1)
									<li><a href="{{ $data->url(1) }}&{{ http_build_query(request()->except('page')) }}">1</a></li>
								@endif
						
								@if ($start > 2)
									<li><span class="delimeter">...</span></li>
								@endif
						
								@for ($i = $start; $i <= $end; $i++)
									<li class="{{ $i == $currentPage ? 'active' : '' }}">
										<a href="{{ $data->url($i) }}&{{ http_build_query(request()->except('page')) }}">{{ $i }}</a>
									</li>
								@endfor
						
								@if ($end < $lastPage - 1)
									<li><span class="delimeter">...</span></li>
								@endif
						
								@if ($end < $lastPage)
									<li><a href="{{ $data->url($lastPage) }}&{{ http_build_query(request()->except('page')) }}">{{ $lastPage }}</a></li>
								@endif
						
								{{-- Next Page Link --}}
								@if ($data->hasMorePages())
									<li class="next">
										<a href="{{ $data->nextPageUrl() }}&{{ http_build_query(request()->except('page')) }}">
											Next <i class="la la-long-arrow-right"></i>
										</a>
									</li>
								@else
									<li class="next disabled">
										<span>Next <i class="la la-long-arrow-right"></i></span>
									</li>
								@endif
							</ul>
						</div><!-- Pagination -->
						
					</div>
					
				</div>
			</div>
		</div>
	</section>

@endsection