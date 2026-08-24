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
					 			<h3>Contact Us - Messages <a href="{{route('admin.contactus.delete.all')}}" class="btn btn-danger mx-2 my-2 float-right">Delete All</a><a href="{{ url()->previous() }}" class="btn btn-primary mx-2 my-2 float-right">Back</a></h3>
					 			<div class="extra-job-info">
						 			<span><i class="la la-clock-o"></i><strong>{{$mdata->count()}}</strong> Total Messages</span>
						 		</div>
						 		<table >
						 			<thead>
						 				<tr>
						 					<td>Name</td>
                                            <td>Email</td>
						 					<td>Subject</td>
						 					<td>Message</td>
											<td>Action</td>
						 				</tr>
						 			</thead>
						 			<tbody>
                                        @foreach ($mdata as $data)
						 				<tr>
											<td>
												<div class="table-list-title" style="padding-right: 30px;">
													<h3><a href="#" title="">{{$data->full_name}}</a></h3>
												</div>
											</td>
                                            <td>
												<div class="table-list-title" style="width: 200; padding-right: 30px;">
													<h3><a href="#" title="">{{$data->email}}</a></h3>
												</div>
											</td>
											<td>
												<div class="table-list-title" style="width: 200; padding-right: 30px;">
													<h3><a href="#" title="">{{$data->subject}}</a></h3>
												</div>
											</td>
                                            <td>
												<div class="table-list-title" style="width: 250; padding-right: 30px;">
													<h3><a href="#" title="">{{$data->message}}</a></h3>
												</div>
											</td>
											<td>
												<ul class="action_job">
													<li><span>Delete</span><a class="btn btn-danger text-white m-1"
															href="{{route('admin.delete.single', $loop->iteration)}}" title="">
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



