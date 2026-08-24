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
								<h3>All Companies <a class="btn btn-primary btn-sm ml-3 "
										href="{{route('view.create.company')}}">Create Company</a>
								</h3>
								<table>
									<thead>
										<tr>
											<td>Company Name</td>
											<td>Status</td>
											<td>Action</td>
										</tr>
									</thead>
									<tbody>

										@foreach ($company as $item)
											<tr>
												<td>
													<div class="table-list-title">
														<h3><a href="#" title="">{{$item->company_name}}</a></h3>
														<span><i class="la la-map-marker"></i>{{$item->city}}</span>
													</div>
												</td>
												<td>
													<a href="{{ route('company.toggleStatus', $item->id) }}"
														title="Click to change status"
														style="color: {{ $item->status == 1 ? 'gray' : 'red' }};">
														{{ $item->status == 1 ? 'Active' : 'Inactive' }}
													</a>
												</td>
												<td>
													<ul class="action_job">
														{{-- <li><span>View Job Details</span>
															<a class="btn btn-primary text-white m-1"
																href="{{route('job.detail', $item->id)}}" title="">
																<i class="la la-eye"></i>
															</a>
														</li> --}}
														<li><span>Edit Details</span><a
																class="btn btn-success text-white m-1"
																href="{{route('view.edit.company', $item->id)}}" title="">
																<i class="la la-pencil"></i>
															</a>
														</li>
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