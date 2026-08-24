@extends('layout.app')

@section('content')

@include('frontside.component.pageTitle', ['title'=>'All Companies'])

	<section>
		<div class="block less-top">
			<div class="container">
				 <div class="row">
						<aside class="col-lg-3 column margin_widget">
							<form method="GET" action="{{ url()->current() }}">
								
								<div class="text-center mt-3">
									<a href="{{ url()->current() }}" class="btn btn-secondary btn-sm">CLEAN ALL</a>
									<button type="submit" class="btn btn-primary btn-sm">APPLY FILTERS</button>
								</div>

							{{-- Search Fields --}}
							<div class="widget">
								<div class="search_widget_job">
									<div class="field_w_search">
										<input type="text" name="city" value="{{ request('city') }}" placeholder="All City" />
										<i class="la la-map-marker"></i>
									</div>
								</div>
							</div>
					
							{{-- Specialism --}}
							<div class="widget border">
								<h3 class="sb-title open">Specialism</h3>
								<div class="specialism_widget">
									<div class="simple-checkbox">
										@php
										// List of specialisms
											$specialisms = ['Software Development', 
											'Data and Analytics', 'Design', 
											'Content and Marketing', 'Human Resources', 
											'IT and Network', 'Sales and Business Development', 'Project and Product Management'];
										@endphp
										@foreach ($specialisms as $key => $label)
											@php $id = 'spe_'.$key; @endphp
											<p>
												<input type="checkbox" name="specialism[]" id="{{ $id }}" value="{{ $label }}"
													{{ in_array($label, request()->input('specialism', [])) ? 'checked' : '' }}>
												<label for="{{ $id }}">{{ $label }}</label>
											</p>
										@endforeach
									</div>
								</div>
							</div>
					
							{{-- Team Size --}}
							<div class="widget border">
								<h3 class="sb-title open">Team Size</h3>
								<div class="specialism_widget">
									<div class="simple-checkbox">
										@php
											$teams = ['1 - 25', '26 - 50', '51 - 75', '76 - 100', '101 - 125', '126 - 150'];
										@endphp
										@foreach ($teams as $key => $label)
											@php $id = 'team_'.$key; @endphp
											<p>
												<input type="checkbox" name="team_size[]" id="{{ $id }}" value="{{ $label }}"
													{{ in_array($label, request()->input('team_size', [])) ? 'checked' : '' }}>
												<label for="{{ $id }}">{{ $label }}</label>
											</p>
										@endforeach
									</div>
								</div>
							</div>
			
						</form>
						</aside>
					
				 	<div class="col-lg-9 column">
				 		<div class="filterbar">
				 			<p>Total of {{$data->total()}} Company</p>
							 <form method="GET" action="{{ url()->current() }}">
								<div class="sortby-sec">
									<span>Sort by</span>
									<select name="per_page" onchange="this.form.submit()" class="chosen">
										<option value="6" {{ request('per_page') == 6 ? 'selected' : '' }}>6 Per Page</option>
										<option value="9" {{ request('per_page') == 9 ? 'selected' : '' }}>9 Per Page</option>
										<option value="12" {{ request('per_page') == 12 ? 'selected' : '' }}>12 Per Page</option>
										<option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15 Per Page</option>
									</select>
								</div>
							</form>
				 		</div>
				 		<div class="emply-list-sec">
				 			<div class="row" id="masonry">
								@foreach ($data as $item)
								<a href="{{route('frontside.singleCompany', $item->id)}}" target="_blank">
									<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
										<div class="emply-list box">
											<div class="emply-list-thumb">
												<a href="{{route('frontside.singleCompany', $item->id)}}" title=""><img src="{{asset('images/resource/' . $item->company_image)}}" alt="" /></a>
											</div>
											<div class="emply-list-info">
												<div class="emply-pstn">
													{{$item->jobs_count}} 
													Jobs
												</div>
												<h3>{{$item->company_name}}</h3>
												<span>
													@foreach ($item->categories as $cat)
														{{$cat->name}}
													@endforeach
												</span>
												<h6><i class="la la-map-marker"></i> {{$item->city}}, {{$item->state}}</h6>
											</div>
										</div>
									</div>
								</a>
								@endforeach
								

						 		<div class="col-lg-12">
						 			<div class="pagination">
										<ul>
											@if ($data->onFirstPage())
												<li class="prev disabled"><span><i class="la la-long-arrow-left"></i> Prev</span></li>
											@else
												<li class="prev">
													<a href="{{ $data->previousPageUrl() }}&per_page={{ request('per_page') }}">
														<i class="la la-long-arrow-left"></i> Prev
													</a>
												</li>
											@endif
										
											@php
												$currentPage = $data->currentPage();
												$lastPage = $data->lastPage();
												$start = max(1, $currentPage - 1);
												$end = min($lastPage, $currentPage + 1);
											@endphp
										
											@if ($start > 1)
												<li><a href="{{ $data->url(1) }}&per_page={{ request('per_page') }}">1</a></li>
											@endif
										
											@if ($start > 2)
												<li><span class="delimeter">...</span></li>
											@endif
										
											@for ($i = $start; $i <= $end; $i++)
												<li class="{{ $i == $currentPage ? 'active' : '' }}">
													<a href="{{ $data->url($i) }}&per_page={{ request('per_page') }}">{{ $i }}</a>
												</li>
											@endfor
										
											@if ($end < $lastPage - 1)
												<li><span class="delimeter">...</span></li>
											@endif
										
											@if ($end < $lastPage)
												<li><a href="{{ $data->url($lastPage) }}&per_page={{ request('per_page') }}">{{ $lastPage }}</a></li>
											@endif
										
											@if ($data->hasMorePages())
												<li class="next">
													<a href="{{ $data->nextPageUrl() }}&per_page={{ request('per_page') }}">
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
				 </div>
			</div>
		</div>
	</section>

@endsection
	

@push('scripts')
<script>
    $(document).ready(function () {
        $('.nstSlider').nstSlider({
            "left_grip_selector": ".leftGrip",
            "right_grip_selector": ".rightGrip",
            "value_bar_selector": ".bar",
            "value_changed_callback": function (cause, leftValue, rightValue) {
                $(this).parent().find('.leftLabel').text(leftValue);
                $(this).parent().find('.rightLabel').text(rightValue);
                $('#since_min').val(leftValue);
                $('#since_max').val(rightValue);
            }
        });
    });
</script>
@endpush
