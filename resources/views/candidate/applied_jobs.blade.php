@extends('layout.app')

@section('content')

	@include('frontside.component.pageTitle', ['title'=>'Welcome '. ucfirst(Auth::user()->name)])

	<section>
		<div class="block no-padding">
			<div class="container">
				 <div class="row no-gape">
					@if(auth()->check())
						@include('layout.sidebar')
					@endif
				 	<div class="col-lg-9 column">
				 		<div class="padding-left">
					 		<div class="manage-jobs-sec">
					 			<h3>Jobs Applied by Candidate</h3>
						 		<table>
						 			<thead>
						 				<tr>
						 					<td>Job / Post</td>
						 					<td>Company</td>
						 					<td>Date</td>
						 				</tr>
						 			</thead>
						 			<tbody>
										@foreach ($jobs as $job)
										<tr>

											<td>
												<div class="table-list-title">
													<h3><a href="#" title="">{{$job->job_title}}</a></h3>
												</div>
											</td>
											<td>
												<div class="table-list-title">
													<i>{{$job->company->company_name}}</i><br />
													<span><i class="la la-map-marker"></i>{{$job->company->city}},{{$job->company->country}}</span>
												</div>
											</td>
											<td>
												<span>{{ $job->created_at->format('M d, Y') }}</span><br />
											</td>
										</tr>
										@endforeach
						 			</tbody>
						 		</table>
					 		</div>
					 	</div>
					</div>
				 </div>
			</div>
		</div>
	</section>

    @endsection
