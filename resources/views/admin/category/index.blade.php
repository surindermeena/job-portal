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
						<div class="padding-left">
							<div class="manage-jobs-sec">
								<h3>All Categories <a class="btn btn-primary btn-sm ml-3 " href="{{route('create.category')}}">Create Category</a>
								</h3>
								<div class="extra-job-info">
									<span><i class="la la-clock-o"></i><strong>{{$mdata->count()}}</strong> Total
										Categories</span>
									{{-- <span><i class="la la-file-text"></i><strong>20</strong> Application</span> --}}
									<span><i
											class="la la-users"></i><strong>{{ $mdata->where('status', '1')->count() }}</strong>
										Active Categories</span>
								</div>
								<table>
									<thead>
										<tr>
											<td>S.No.</td>
											<td>Name</td>
											<td>Status</td>
											<td>Open Position</td>
											<td>Action</td>
										</tr>
									</thead>
									<tbody>

										@foreach ($mdata as $job)
											<tr>
												<td>
													<div class="table-list-title">
														<h3><a href="#" title="">{{$loop->iteration}}</a></h3>
														{{-- <span><i class="la la-map-marker"></i>{{$job->id}}</span> --}}
													</div>
												</td>
												<td>
													<div class="table-list-title">
														<h3><a href="#" title="">{{$job->name}}</a></h3>
														{{-- <span><i class="la la-map-marker"></i>{{$job->category}}</span>
														--}}
													</div>
												</td>
												<td>
													<div class="table-list-title d-flex align-items-center justify-content-center"
														style="height: 100px; width: 60px;">
														<h3 class="mb-0">
															<a href="{{ route('category.toggleStatus', $job->id) }}"
																title="Click to change status"
																style="color: {{ $job->status == 1 ? 'gray' : 'red' }};">
																{{ $job->status == 1 ? 'Active' : 'Inactive' }}
															</a>
														</h3>
													</div>
												</td>
												{{-- <td>
													<span>{{$job->created_at->format('F j, Y')}}</span><br />
													<span>{{$job->application_deadline->format('F j, Y')}}</span>
												</td> --}}
												<td>
													<div class="table-list-title d-flex justify-items-start">
														<h3><a href="#" title="">{{$job->open_positions}}</a></h3>
													</div>
												</td>
												<td>
													<ul class="action_job">
														<li><span>Edit</span><a class="btn btn-success text-white m-1"
																href="{{route('admin.category.edit', $job->id)}}" title="">
																<i class="la la-pencil"></i>
															</a></li>
														<li><span>Delete</span><a class="btn btn-danger text-white m-1"
																href="{{route('category.delete', $job->id)}}" title="">
																<i class="la la-trash "></i>
															</a></li>
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

