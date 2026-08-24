@extends('layout.app')

@section('content')

@include('frontside.component.pageTitle', ['title'=>'Job Details'])

	<section>
		<div class="block">
			<div class="container">
				<div class="row">
				 	<div class="col-lg-12 column">
				 		<div class="job-single-sec style3">
				 			<div class="job-head-wide">
				 				<div class="row mb-3">
				 					<div class="col-lg-8">
				 						<div class="job-single-head3">
							 				<div class="job-thumb"> <img src="{{asset('images/resource/' . $data->company->company_image)}}" alt="" /><span>12 Open Position</span> </div>
							 				<div class="job-single-info3">
							 					<h3>{{$data->company->company_name}}</h3>
							 					<span><i class="la la-map-marker"></i>{{$data->company->address}}</span>
												<span class="job-is ft">Full time</span>
							 					<ul class="tags-jobs">
								 					<li><i class="la la-calendar-o"></i> Job Post Date : {{ $data->updated_at->format('F d, Y') }}</li>
								 					<li><i class="la la-calendar-o"></i> Last Date to Apply : {{ $data->application_deadline->format('F d, Y') }}</li>
								 				</ul>
							 				</div>
							 			</div><!-- Job Head -->
				 					</div>
				 					<div class="col-lg-4">
										<a href="{{ Auth::check() ? route('jobapply', $data->id) : 'javascript:void(0);' }}"
											class="apply-thisjob {{ Auth::guest() ? 'signin-popup' : '' }}"
											title="Apply for job">
											<i class="la la-paper-plane"></i> Apply for job
										 </a>
				 					</div>
				 				</div>
				 			</div>
				 			<div class="job-wide-devider">
							 	<div class="row">
							 		<div class="col-lg-8 column">		
							 			<div class="job-details">
							 				<h3>Job Description</h3>
											<p>{{$data->job_description}} Company is a 2016 Iowa City-born start-up that develops consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.</p>
							 				<h3>Required Knowledge, Skills, and Abilities</h3>
							 				<ul>
												@foreach ($data->skills as $skill)
												<li>{{$skill->skill}}</li>
												@endforeach
							 				</ul>
							 				<h3>Education</h3>
							 				<ul>
												@foreach ($data->qualifications as $item)
												<li>{{$item->qualification}}</li>
												@endforeach							 			
											</ul>
							 			</div>
										 <div class="share-bar">
											<span>Share: </span>
											
											<!-- Facebook -->
											<a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
											   title="Share on Facebook" target="_blank" class="share-fb">
												<i class="fab fa-facebook"></i>
											</a>
											
											<!-- Twitter -->
											<a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}"
											   title="Share on Twitter" target="_blank" class="share-twitter">
												<i class="fab fa-twitter"></i>
											</a>
											
											<!-- WhatsApp -->
											<a href="https://api.whatsapp.com/send?text={{ urlencode(request()->fullUrl()) }}"
											   title="Share on WhatsApp" target="_blank" >
												<i class="fab fa-whatsapp"></i>
											</a>
											
											<!-- LinkedIn -->
											<a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}"
											   title="Share on LinkedIn" target="_blank" >
												<i class="fab fa-linkedin"></i>
											</a>
										</div>
										
							 		</div>
							 		<div class="col-lg-4 column">
							 			<div class="job-overview">
								 			<h3>Job Overview</h3>
								 			<ul>
								 				<li><i class="la la-money"></i><h3>Offerd Salary</h3><span>₹ {{$data->salary_min}} - ₹ {{$data->salary_max}}</span></li>
								 				<li><i class="la la-mars-double"></i><h3>Gender</h3><span>Female</span></li>
								 				<li><i class="la la-thumb-tack"></i><h3>Career Level</h3><span>Executive</span></li>
								 				<li><i class="la la-puzzle-piece"></i><h3>Industry</h3><span>Management</span></li>
								 				<li><i class="la la-shield"></i><h3>Experience</h3><span>{{$data->min_experience}} Years</span></li>
								 			</ul>
								 		</div><!-- Job Overview -->
							 		</div>
							 	</div>
							 </div>
					 	</div>
				 	</div>
				</div>
			</div>
		</div>
	</section>

@endsection
