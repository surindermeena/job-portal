@extends('layout.app')

@section('content')

	@include('frontside.component.pageTitle', ['title'=>$titleCat. ' Jobs'])

	<section>
		<div class="block">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						
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