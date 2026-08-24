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
								<h3>Testimonial <a class="btn btn-primary btn-sm ml-3 "
										href="{{route('view.admin.testimonial.create')}}">Create New</a>
								</h3>
								<div class="extra-job-info">
									<span><i class="la la-clock-o"></i><strong>{{$mdata->count()}}</strong> Total
										Reviews</span>
									<span><i
											class="la la-users"></i><strong>{{ $mdata->where('status', '1')->count() }}</strong>
										Active Reviews</span>
								</div>
								<table>
									<thead>
										<tr>
											{{-- <td>Id</td> --}}
											<td>Name</td>
											<td>Job-Profile</td>
											<td>Content</td>
											<td>Status</td>
											<td>Action</td>
										</tr>
									</thead>
									<tbody>

										@foreach ($mdata as $data)
											<tr>
												<td>
													<div class="table-list-title">
														<h3><a href="#" title="">{{$data->name}}</a></h3>
													</div>
												</td>
												<td>
													<div class="table-list-title">
														<h3><a href="#" title="">{{$data->job_post}}</a></h3>
													</div>
												</td>
												<td>
													<div class="table-list-title" style="height: 100px; width: 250px;">
														<h3><a href="#" title="">{{$data->description}}</a></h3>
													</div>
												</td>
												<td>
													<div class="table-list-title d-flex align-items-center justify-content-center"
														style="height: 100px; width: 60px;">
														<h3 class="mb-0">
															<a href="{{ route('testimonial.toggleStatus', $data->id) }}"
																title="Click to change status"
																style="color: {{ $data->status == 1 ? 'gray' : 'red' }};">
																{{ $data->status == 1 ? 'Active' : 'Inactive' }}
															</a>
														</h3>
													</div>
												</td>
												<td>
													<ul class="action_job">
														<li><span>Edit</span><a
																class="btn btn-success text-white m-1"
																href="{{route('admin.testimonial.edit', $data->id)}}" title="">
																<i class="la la-pencil"></i>
															</a>
														</li>
														<ul class="action_job">
															<li><span>Delete</span><a class="btn btn-danger text-white m-1"
																	href="{{route('admin.testimonial.delete', $data->id)}}" title="">
																	<i class="la la-trash "></i>
																</a></li>
														</ul>
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