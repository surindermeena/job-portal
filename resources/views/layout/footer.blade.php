<footer>
	<div class="block">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 column">
					<div class="widget">
						<div class="about_widget">
							<div class="logo">
								<a href="{{route('frontside.home')}}" title=""><img
										src="{{asset('images/resource/logo.png')}}" alt="logo" /></a>
							</div>
							<span>{{ substr($footerAddress, 0, 28) }}</span>
							<span>{{ substr($footerAddress, 29) }}</span>
							<span><a href="tel:{{ $footerPhone }}">{{ $footerPhone }}</a> (India)</span>
							<a href="mailto:"></a>
							<span><a href="mailto:{{ $footerEmail }}">{{ $footerEmail }}</a></span>
							<div class="social">
								@foreach ($footerSocialLinks as $social)
									<a href="{{ $social['url'] ?? '#' }}" title="{{ $social['platform'] }}">
										<i class="{{ $social['icon'] }}"></i>
									</a>
								@endforeach
							</div>
						</div><!-- About Widget -->
					</div>
				</div>
				<div class="col-lg-4 column">
					<div class="widget">
						<h3 class="footer-title">Quick Links</h3>
						<div class="link_widgets">
							<div class="row">
								<div class="col-lg-6">
									<a href="{{route('frontside.about')}}" title="About Us">About Us</a>
									<a href="{{route('frontside.terms')}}" title="Terms & Conditions">Terms &
										Conditions</a>
									<a href="{{route('frontside.faq')}}" title="FAQ's">FAQ's</a>
									<a href="{{route('frontside.contact')}}" title="Contact Us">Contact Us</a>
									<a href="{{route('website.sitemap')}}" title="sitemap">SiteMap</a>
								</div>
								<div class="col-lg-6">
									<a href="{{route('frontside.howitwork')}}" title="How It Works">How It Works</a>
									<a href="{{route('frontside.companies')}}" title="Companies">Companies</a>
									<a href="{{route('frontside.jobs')}}" title="Jobs">Jobs</a>
									<a href="{{route('frontside.contact')}}" title="Support">Support</a>
									<a href="{{route('frontside.contact')}}" title="For Employers">Career</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-2 column">
					<div class="widget">
						<h3 class="footer-title">Find Jobs</h3>
						<div class="link_widgets">
							<div class="row">
								@php
									$cities = [
										['slug' => 'noida', 'name' => 'Noida', 'title' => 'Jobs in Noida'],
										['slug' => 'gurgaon', 'name' => 'Gurgaon', 'title' => 'Jobs in Gurugram'],
										['slug' => 'jaipur', 'name' => 'Jaipur', 'title' => 'Jobs in Jaipur'],
										['slug' => 'bangalore', 'name' => 'Bangalore', 'title' => 'Jobs in Bangalore'],
										['slug' => 'pune', 'name' => 'Pune', 'title' => 'Jobs in Pune'],
										['slug' => 'hyderabad', 'name' => 'Hyderabad', 'title' => 'Jobs in Hyderabad'],
									];
								@endphp
								<div class="col-lg-12">
									@foreach($cities as $city)
										<a href="{{route('frontside.jobByCity', $city['name'])}}" target="_blank"
											title="{{ $city['title'] }}">
											Jobs in {{ $city['name'] }}
										</a>
									@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 column">
					<div class="widget">
						<div class="download_widget">
							<a href="https://www.apple.com/app-store/" target="_blank" title="App Store"><img
									src="{{asset('images/resource/dw1.png')}}" alt="" /></a>
							<a href="https://play.google.com/store" target="_blank" title="Google Play"><img
									src="{{asset('images/resource/dw2.png')}}" alt="" /></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="bottom-line">
		<span>© {{date('Y')}} Jobhunt All rights reserved. Design by <a class="font-weight-boldest text-white"
				href="https://www.w3care.com/">{{ Config('app.design_credit')}}</a></span>
		<a href="#scrollup" class="scrollup" title=""><i class="la la-arrow-up"></i></a>
	</div>
</footer>