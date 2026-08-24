@extends('layout.app')

@section('content')

	@include('frontside.component.pageTitle', ['title'=>'FAQ\'s'])

	<section>
		<div class="block ">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="faqs">
							@foreach ($alldata as $data)
								@if ($data->status == 1)
									<div class="faq-box">
										<h2>{{$loop->iteration}}. {{$data->question}}<i class="la la-minus"></i></h2>
										<div class="contentbox">
											<p>{{$data->answer}}</p>
										</div>
									</div>
								@endif
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection