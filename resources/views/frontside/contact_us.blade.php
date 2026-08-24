@extends('layout.app')

@section('content')

@include('frontside.component.pageTitle', ['title'=>'Contact Us'])

	<section>
		<div class="block remove-bottom">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="contact-map">
							<iframe src="{{$googleMap}}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
				 	<div class="col-lg-6 column">
				 		<div class="contact-form">
				 			<h3>Keep In Touch</h3>

							 <form action="{{ route('contact.store') }}" method="POST">
								@csrf
								<div class="row">
									<div class="col-lg-12">
										<span class="pf-title">Full Name</span>
										<div class="pf-field">
											<input type="text" name="full_name" placeholder="Full Name" value="{{ old('full_name') }}" required>
										</div>
									</div>
									<div class="col-lg-12">
										<span class="pf-title">Email</span>
										<div class="pf-field">
											<input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
										</div>
									</div>
									<div class="col-lg-12">
										<span class="pf-title">Subject</span>
										<div class="pf-field">
											<input type="text" name="subject" placeholder="Subject" value="{{ old('subject') }}" required>
										</div>
									</div>
									<div class="col-lg-12">
										<span class="pf-title">Message</span>
										<div class="pf-field">
											<textarea name="message" placeholder="Write your message..." rows="5" required>{{ old('message') }}</textarea>
										</div>
									</div>
									<div class="col-lg-12">
										<button type="submit">Send</button>
									</div>
								</div>
							</form>
							
							
				 		</div>
				 	</div>
				 	<div class="col-lg-6 column">
					 	<div class="contact-textinfo style2">
					 		<h3>JobHunt Office</h3>
					 		<ul>
					 			<li><i class="la la-map-marker"></i><span>{{$footerAddress}} </span></li>
					 			<li><i class="la la-phone"></i><span>Call Us : {{$footerPhone}}</span></li>
					 			<li><i class="la la-fax"></i><span>Fax : {{$footerPhone}}</span></li>
					 			<li><i class="la la-envelope-o"></i><span>Email : {{$footerEmail}}</span></li>
					 		</ul>
					 	</div>
					</div>
				 </div>
			</div>
		</div>
	</section>

@endsection