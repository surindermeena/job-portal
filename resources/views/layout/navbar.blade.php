<div class="responsive-header">
	<div class="responsive-menubar">
		<div class="res-logo"><a href="{{route('frontside.home')}}" title=""><img
					src="{{asset('images/resource/logo.png')}}" alt="" /></a></div>
		<div class="menu-resaction">
			<div class="res-openmenu">
				<img src="{{asset('images/icon.png')}}" alt="" /> Menu
			</div>
			<div class="res-closemenu">
				<img src="{{asset('images/icon2.png')}}" alt="" /> Close
			</div>
		</div>
	</div>
	<div class="responsive-opensec">
		<div class="btn-extars">
			<ul class="account-btns">
				<li class="signup-popup"><a title=""><i class="la la-key"></i> Sign Up</a></li>
				<li class="signin-popup"><a title=""><i class="la la-external-link-square"></i> Login</a></li>
			</ul>
		</div>
		<div class="responsivemenu">
			<ul>
				<li class="">
					<a href="{{route('frontside.home')}}" title=""><i class="la la-home mr-1"></i>Home</a>
				</li>
				<li class="menu-item-has-children">
					<a href="#" title=""><i class="la la-info-circle mr-1"></i>About</a>
					<ul>
						<li><a href="{{route('frontside.about')}}" title=""> About</a></li>
						<li><a href="{{route('frontside.terms')}}" title="">Terms & Condition</a></li>
						<li><a href="{{route('frontside.faq')}}" title="">FAQ's</a></li>
						<li><a href="{{route('frontside.howitwork')}}" title="">How it works</a></li>
					</ul>
				</li>
				<li class="">
					<a href="{{route('frontside.companies')}}" title=""><i class="la la-building mr-1"></i>Company</a>
				</li>
				<li class="">
					<a href="{{route('frontside.jobs')}}" title=""><i class="la la-briefcase mr-1"></i>Jobs</a>
				</li>

				@auth
					@php
						$role = Auth::user()->role;
					@endphp

					@if ($role === 'admin')
						<li class="">
							<a href="{{ route('admin.index') }}" title=""><i class="la la-tachometer mr-1"></i>Dashboard</a>
						</li>
					@elseif ($role === 'company')
						<li class="">
							<a href="{{ route('company.detail') }}" title=""><i class="la la-tachometer mr-1"></i>Dashboard</a>
						</li>
					@elseif ($role === 'candidate')
						<li class="">
							<a href="{{ route('candidate.detail') }}" title=""><i
									class="la la-tachometer mr-1"></i>Dashboard</a>
						</li>
					@endif
				@endauth
				<li class="">
					<a href="{{route('frontside.contact')}}" title=""><i class="la la-envelope mr-1"></i>Contact Us</a>
				</li>
			</ul>
		</div>
	</div>
</div>

<header class="stick-top forsticky">
	<div class="menu-sec">
		<div class="container">
			<div class="logo">
				<a href="{{route('frontside.home')}}" title=""><img class="hidesticky"
						src="{{asset('images/resource/logo.png')}}" alt="" /><img class="showsticky"
						src="{{asset('images/resource/logo10.png')}}" alt="" /></a>
			</div>
			@auth
				<div class="my-profiles-sec">
					@php
						$user = auth()->user();
						$image = $user->candidate->image ?? $user->admin->image ?? $user->company->company_image ?? 'default.jpg';
					@endphp
					<span><img src="{{ asset('images/resource/' . $image) }}" alt="" style="width: 50px; height: 50px;" />
						{{ ucfirst(Auth::user()->name) }} <i class="la la-bars"></i></span>
				</div>
			@else
				<div class="btn-extars">
					<ul class="account-btns">
						@guest
							<li class="signup-popup"><a title=""><i class="la la-key"></i> Sign Up</a></li>
							<li class="signin-popup"><a title=""><i class="la la-external-link-square"></i> Login</a></li>
						@endguest
						@auth
							<li class="logout-popup"><a href="{{route('logout')}}" title=""><i class="la la-unlink"></i>
									Logout</a></li>
						@endauth
					</ul>
				</div><!-- Btn Extras -->
			@endauth

			<nav>
				<ul>
					<li class="">
						<a href="{{route('frontside.home')}}" title=""><i class="la la-home mr-1"></i>Home</a>
					</li>
					<li class="menu-item-has-children">
						<a href="#" title=""> <i class="la la-info-circle mr-1"></i>About</a>
						<ul>
							<li><a href="{{route('frontside.about')}}" title="">About</a></li>
							<li><a href="{{route('frontside.terms')}}" title="">Terms & Condition</a></li>
							<li><a href="{{route('frontside.faq')}}" title="">FAQ's</a></li>
							<li><a href="{{route('frontside.howitwork')}}" title="">How it works</a></li>
						</ul>
					</li>
					<li class="">
						<a href="{{route('frontside.companies')}}" title=""> <i
								class="la la-building mr-1"></i>Company</a>
					</li>
					<li class="">
						<a href="{{route('frontside.jobs')}}" title=""><i class="la la-briefcase mr-1"></i>Jobs</a>
					</li>

					@auth
						@php
							$role = Auth::user()->role;
						@endphp

						@if ($role === 'admin')
							<li class="">
								<a href="{{ route('admin.index') }}" title=""><i class="la la-tachometer mr-1"></i>Dashboard</a>
								<a href="{{ route('create.job') }}" title="" class="post-job-btn"><i
										class="la la-plus"></i>Create Job</a>
							</li>
						@elseif ($role === 'company')
							<li class="">
								<a href="{{ route('company.detail') }}" title=""><i
										class="la la-tachometer mr-1"></i>Dashboard</a>
								<a href="{{ route('create.job') }}" title="" class="post-job-btn"><i
										class="la la-plus"></i>Create Job</a>
							</li>
						@elseif ($role === 'candidate')
							<li class="">
								<a href="{{ route('candidate.detail') }}" title=""><i
										class="la la-tachometer mr-1"></i>Dashboard</a>
							</li>
						@endif
					@endauth

					<li class="">
						<a href="{{route('frontside.contact')}}" title=""><i class="la la-envelope mr-1"></i>Contact
							Us</a>
					</li>
				</ul>
			</nav><!-- Menus -->
		</div>
	</div>
</header>