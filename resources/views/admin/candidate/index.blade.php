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
					 			<h3>All Candidates <a href="{{ url()->previous() }}" class="btn btn-primary mx-2 my-2 float-right">Back</a></h3>
						 		<table >
						 			<thead>
						 				<tr>
						 					<td>Name</td>
											<td>Post</td>
						 					<td>Action</td>
						 				</tr>
						 			</thead>
						 			<tbody>

                                        @foreach ($mdata as $data)
						 				<tr>
											<td>
												<div class="table-list-title">
													<h3><a href="#" title="">{{$data->user->name}}</a></h3>
												</div>
											</td>
											<td>
												<div class="table-list-title">
													<h3><a href="#" title="">{{$data->job_title}}</a></h3>
												</div>
											</td>
						 					<td>
						 						<ul class="action_job">
						 							<li><span>View Details</span><a class="btn btn-success btn-lg text-white m-1 py-1 px-2" href="{{ route('applied.candidate.detail', $data->id) }}" title="">
                                                        View Details
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
