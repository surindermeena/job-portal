@extends('layout.app')

@section('content')

	@include('frontside.component.pageTitle', ['title'=>'About Us'])

	<section>
		<div class="block">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="about-us">
							<div class="row">
								<div class="col-lg-12 mb-4">
									<h3>About {{$alldata['title']}}</h3>
								</div>
								<div class="col-lg-7">
									<p>{{$alldata['content_1']}}</p>
									<p>{{$alldata['content_2']}}</p>
									<p>{{$alldata['content_3']}}</p>
								</div>
								<div class="col-lg-5">
									<img src="{{asset('images/resource/bsd1.jpg')}}" alt="" />
								</div>
								<div class="col-lg-12">
									<p>{{$alldata['content_4']}}</p>
								</div>
							</div>
							<div class="tags-share">
								<div class="share-bar">
									@foreach ($alldata->socialLinks as $link)
										<a href="{{ $link->url }}" class="share-{{$link->platform}}">
											<i class="{{ $link->icon}}"></i>
										</a>
									@endforeach
									<span><strong>Share: </strong></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	@include('frontside.component.about_services', ["alldata"=>$alldata])

	<section>
		<div class="block">
			<div data-velocity="-.1"
				style="background: url(images/resource/parallax2.jpg) repeat scroll 50% 422.28px transparent;"
				class="parallax scrolly-invisible layer color light"></div><!-- PARALLAX BACKGROUND IMAGE -->
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="heading light">
							<h2>Kind Words From Happy Candidates</h2>
							<span>What other people thought about the service provided by JobHunt</span>
						</div><!-- Heading -->
						<div class="reviews-sec" id="reviews-carousel">
							@foreach ($reviews as $item)
								<div class="col-lg-6">
									<div class="reviews">
										<img src="images/resource/{{$item->image}}" alt="" />
										<h3>{{$item->name}} <span>{{$item->job_post}}</span></h3>
										<p>{{$item->description}}</p>
									</div><!-- Reviews -->
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="block">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="stats-sec style2">
							<div class="row">
								@foreach ($stats as $stat)
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
										<div class="stats">
											<span>{{ $stat['count'] }}</span>
											<h5>{{ $stat['label'] }}</h5>
										</div>
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="block">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="heading">
							<h2>Companies We've Helped</h2>
							<span>Some of the companies we've helped recruit excellent applicants over the years.</span>
						</div><!-- Heading -->
						<div class="comp-sec">
							@for ($i = 1; $i < 6; $i++)
								<div class="company-img">
									<a href="#" title="">
										<img src="{{ asset('images/resource/cc' . $i . '.jpg') }}" alt="" />
									</a>
								</div><!-- Client  -->
							@endfor
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection