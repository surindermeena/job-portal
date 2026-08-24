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
							<div class="manage-jobs-sec">
								<h3>Manage Jobs <a class="btn btn-primary btn-sm ml-3 "
										href="{{route('create.job')}}">Create Job</a>
								</h3>
								<div class="extra-job-info">
									<span><i class="la la-clock-o"></i><strong>{{$alljobs->count()}}</strong> Job
										Posted</span>
									<span><i
											class="la la-users"></i><strong>{{ $alljobs->where('status', '1')->count() }}</strong>
										Active Jobs</span>
								</div>
								<table>
									<thead>
										<tr>
											<td>Title</td>
											<td>Created</td>
											<td>Expired</td>
											<td>Status</td>
											<td>Action</td>
										</tr>
									</thead>
									<tbody>

										@foreach ($alljobs as $job)
											<tr>
												<td>
													<div class="table-list-title">
														<h3><a href="#" title="">{{$job->job_title}}</a></h3>
														<span><i class="la la-map-marker"></i>
															{{$job->company->city ?? 'N/A' }},{{$job->company->state ?? 'N/A' }}
														</span>
													</div>
												</td>
												<td>
													<span>{{$job->created_at->format('F j, Y')}}</span><br />
												</td>
												<td>
													<span>{{$job->application_deadline->format('F j, Y')}}</span>
												</td>
												<td>
													<a href="{{ route('job.toggleStatus', $job->id) }}"
														title="Click to change status"
														style="color: {{ $job->status == 1 ? 'gray' : 'red' }};">
														{{ $job->status == 1 ? 'Active' : 'Inactive' }}
													</a>

												</td>
												<td>
													<ul class="action_job">
														<li><span>View Job Details</span>
															<a class="btn btn-primary text-white m-1"
																href="{{route('job.detail', $job->id)}}" title="">
																<i class="la la-eye"></i>
															</a>
														</li>
														<li><span>Edit Job Details</span><a
																class="btn btn-success text-white m-1"
																href="{{route('job.edit', $job->id)}}" title="">
																<i class="la la-pencil"></i>
															</a>
														</li>
														@if (Auth::check() && Auth::user()->role == 'admin')
															<li><span>Job Delete</span><a
																	class="btn btn-danger text-white m-1"
																	href="{{route('job.delete', $job->id)}}" title="">
																	<i class="la la-trash"></i>
																</a>
															</li>
														@endif
													</ul>
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