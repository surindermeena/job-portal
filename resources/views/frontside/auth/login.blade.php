@extends('layout.app')

@section('content')

	@include('frontside.component.pageTitle', ['title' => 'Login'])

	<section>
		<div class="block remove-bottom">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="account-popup-area signin-popup-box static">
							<div class="account-popup">
								<span>Hey there! Log in to pick up where you left off and stay connected with everything you
									love here.</span>

								<form action="{{route('loginSave')}}" method="POST">
									@csrf
									<div class="cfield">
										<input type="email" placeholder="User email" name="email" required />
										<i class="la la-user"></i>
									</div>
									<div class="cfield">
										<input type="password" placeholder="********" name="password" required />
										<i class="la la-key"></i>
									</div>
									<div class="profile-options">
										<legend>Login As</legend>
										<input id="p11" name="profile" type="radio" value="candidate" />
										<label for="p11">
											Candidate
										</label>

										<input id="p22" name="profile" type="radio" value="company" />
										<label for="p22">
											Company
										</label>
									</div>
									<p class="remember-label">
										<input type="checkbox" name="cb" id="cb1"><label for="cb1">Remember me</label>
									</p>
									<li class="forget-popup"><a href="#" title="">Forgot Password?</a></li>
									<button type="submit">Login</button>
								</form>
							</div>
						</div><!-- LOGIN POPUP -->
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection