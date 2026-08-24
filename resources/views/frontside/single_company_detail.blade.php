@extends('layout.app')

@section('content')

@include('frontside.component.pageTitle', ['title'=> $data->company_name])

	<section>
		<div class="block">
			<div class="container">
				<div class="row">
				 	<div class="col-lg-12 column">
				 		<div class="job-single-sec style3">
				 			<div class="job-head-wide">
				 				<div class="row">
				 					<div class="col-lg-10">
				 						<div class="job-single-head3 emplye">
							 				<div class="job-thumb"> <img src="{{asset('images/resource/' . $data->company_image)}}" alt="" /></div>
							 				<div class="job-single-info3">
							 					<h3>{{$data->company_name}}</h3>
							 					<span><i class="la la-map-marker"></i>{{$data->city}}, {{$data->state}}</span>
							 					<ul class="tags-jobs">
								 					<li><i class="la la-file-text"></i> Applications 1</li>
								 					<li><i class="la la-calendar-o"></i> Post Date: {{ $data->updated_at->format('F d, Y') }}</li>
								 					<li><i class="la la-eye"></i> Views 5683</li>
								 				</ul>
							 				</div>
							 			</div><!-- Job Head -->
				 					</div>
				 					<div class="col-lg-2">
				 						<div class="share-bar">
							 				<a href="#" title="" class="share-google"><i class="fab fa-google"></i></a>
											<a href="#" title="" class="share-fb"><i class="fab fa-facebook"></i></a>
											<a href="#" title="" class="share-twitter"><i class="fab fa-twitter"></i></a>
							 			</div>
								 		<div class="emply-btns">
								 			<a class="seemap" href="#" title=""><i class="fas fa-map-marker-alt mx-2"></i> See On Map</a>
								 			<a class="followus" href="#" title=""><i class="fas fa-paper-plane mx-2"></i> Follow us</a>
								 		</div>
				 					</div>
				 				</div>
				 			</div>
				 			<div class="job-wide-devider">
							 	<div class="row">
							 		<div class="col-lg-8 column">		
							 			<div class="job-details">
							 				<h3>About Business Network</h3>
							 				<p>Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement irresistibly fussy penguin insect additionally wow absolutely crud meretriciously hastily dalmatian a glowered inset one echidna cassowary some parrot and much as goodness some froze the sullen much connected bat wonderfully on instantaneously eel valiantly petted this along across highhandedly much. </p>
							 				<p>Repeatedly dreamed alas opossum but dramatically despite expeditiously that jeepers loosely yikes that as or eel underneath kept and slept compactly far purred sure abidingly up above fitting to strident wiped set waywardly far the and pangolin horse approving paid chuckled cassowary oh above a much opposite far much hypnotically more therefore wasp less that hey apart well like while superbly orca and far hence one.Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement irresistibly fussy.</p>
							 				<ul>
							 					<li>Ability to write code – HTML & CSS (SCSS flavor of SASS preferred when writing CSS)</li>
							 					<li>Proficient in Photoshop, Illustrator, bonus points for familiarity with Sketch (Sketch is our preferred concepting)</li>
							 					<li>Cross-browser and platform testing as standard practice</li>
							 					<li>Experience using Invision a plus</li>
							 					<li>Experience in video production a plus or, at a minimum, a willingness to learn</li>
							 				</ul>
							 				<p>Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement irresistibly fussy penguin insect additionally wow absolutely crud meretriciously hastily dalmatian a glowered inset one echidna cassowary some parrot and much as goodness some froze the sullen much connected bat wonderfully on instantaneously eel valiantly petted this along across highhandedly much. </p>
							 				<p>Repeatedly dreamed alas opossum but dramatically despite expeditiously that jeepers loosely yikes that as or eel underneath kept and slept compactly far purred sure abidingly up above fitting to strident wiped set waywardly far the and pangolin horse approving paid chuckled cassowary oh above a much opposite far much hypnotically more therefore wasp less that hey apart well like while superbly orca and far hence one.Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement irresistibly fussy.</p>
							 			</div>
								 		<div class="recent-jobs">
							 				<h3>Jobs from {{$data->company_name}}</h3>
							 				<div class="job-list-modern">
											 	<div class="job-listings-sec no-border">
													@foreach ($alldata as $item)
													<div class="job-listing wtabs noimg">
														<div class="job-title-sec">
															<h3><a href="#" title="">{{$item->categories[0]->name}}</a></h3>
															<span>{{$item->company_name}}</span>
															<div class="job-lctn"><i class="la la-map-marker"></i>{{$item->city}}, {{$item->state}}</div>
														</div>
														<div class="job-style-bx">
															<span class="job-is ft">Full time</span>
															<span class="fav-job"><i class="la la-heart-o"></i></span>
															<i>{{ $data->updated_at->diffForHumans()}}</i>
														</div>
													</div><!-- Job -->
													@endforeach
												</div>
											 </div>
							 			</div>
							 		</div>
							 		<div class="col-lg-4 column">
							 			<div class="job-overview">
								 			<h3>Company Information</h3>
								 			<ul>
								 				{{-- <li><i class="la la-file-text"></i><h3>Posted Jobs</h3><span>{{$data->jobs}}</span></li> --}}
								 				<li><i class="la la-map"></i><h3>Locations</h3><span>{{$data->city}}, {{$data->state}}</span></li>
								 				<li><i class="la la-bars"></i><h3>Categories</h3>
														@foreach ($data->categories as $item)
														<span>
															{{$item->name}}
														</span>
														@endforeach
												</li>
								 				<li><i class="la la-clock-o"></i><h3>Since</h3><span>{{$data->since}}</span></li>
								 				<li><i class="la la-users"></i><h3>Team Size</h3><span>{{$data->team_size}}</span></li>
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
