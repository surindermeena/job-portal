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
								<h3>All Registered User <a class="btn btn-primary btn-sm ml-3 "
										href="{{route('user.appliedUsers')}}">Applied Users</a>
								</h3>
								<table>
									<thead>
										<tr>
											<td>User Name</td>
											<td>Action</td>
										</tr>
									</thead>
									<tbody>

										@foreach ($allUsers as $user)
											<tr>
												<td>
													<div class="table-list-title">
														<h3><a href="#" title="">{{$user->name}}</a></h3>
													</div>
												</td>
												<td>
													<ul class="action_job">
														<li><span>View User Details</span>
															<a class="btn btn-primary text-white m-1"
																href="{{route('user.details', $user->id)}}" title="">
																<i class="la la-eye"></i>
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